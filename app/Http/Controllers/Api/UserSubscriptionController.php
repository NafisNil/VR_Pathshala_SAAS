<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\Plan;
use App\Mail\PasswordChangeMail as PasswordChange; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class UserSubscriptionController extends Controller
{
    //
    public function checkSubscription(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', $request->email)->where('status', 'active')->first();
        $this->checkActive($user);

        $subscription = Subscription::where('user_id', $user->id)->where('status', 'active')->first();

        if ($subscription && $subscription->expires_at < now()) {
            $subscription->status = 'expired';
            $subscription->save();
        }

         if ($subscription && $subscription->status === 'active') {
            return response()->json([
                'subscribed' => true,
                'planName' => $subscription->plan->name,
                'expires_at' => $subscription->expires_at,
            ]);
        } else {
            return response()->json([
                'subscribed' => false,
            ]);
        }
    }


    public function makeSubscription(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'plan_sku' => 'required|exists:plans,sku',
            'meta_receipt' => 'required', // The JSON receipt from Unity
            'formatted_price' => 'required', // The price as shown in Unity (for reference, not used for verification)
        ]);

         $user = User::where('email', $request->email)->first();
        
        // // 1. Verify the Receipt with Meta
        // $isVerified = $this->verifyMetaPurchase($request->plan_sku, $request->meta_receipt);

        // if (!$isVerified) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Invalid or fraudulent purchase receipt.'
        //     ], 403);
        // }

         $clean = str_replace(['$', '-'], '', $request->formatted_price);

        // Convert to decimal
        $price = (float) $clean;
        $plan = Plan::where('sku', $request->plan_sku)->first();

        // 2. Proceed with existing logic if verified
        $plan = Plan::where('sku', $request->plan_sku)->first();

        [$subscription, $payment] = DB::transaction(function () use ($user, $plan, $price, $request) {
            $subscription = Subscription::create([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'started_at' => now(),
                'expires_at' => now()->addDays($plan->duration),
                'status' => 'active',
            ]);

            $payment = Payment::create([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'amount' => $price, // Use the cleaned and converted price
                'transaction_id' => 'meta_' . uniqid(), // Mark as Meta transaction
                'payment_method' => 'meta_iap',
                'currency' => 'USD',
                'status' => 'completed',
            ]);

            return [$subscription, $payment];
        });

        return response()->json([
            'message' => 'Subscription verified and created successfully',
            'status' => 'success',
            'planName' => $plan->name,
            'expires_at' => $subscription->expires_at->toDateTimeString(),
        ]);
    }

    /**
     * Helper to verify against Meta Graph API
     */
    private function verifyMetaPurchase($sku, $receiptJson)
    {
        // 1. Decode the outer receipt JSON
        $receiptData = json_decode($receiptJson, true);

        if (!$receiptData) {
            return false;
        }

        // 2. CHECK FOR UNITY EDITOR (MOCK STORE)
        // If we are in debug mode and the store is 'fake', approve it immediately for the demo.
        if (config('app.debug') || config('app.env') === 'local') {
            if (isset($receiptData['Store']) && ($receiptData['Store'] === 'fake' || $receiptData['Store'] === 'UnityEditor')) {
                return true;
            }
        }

        // 3. PREPARE FOR PRODUCTION (META)
        $appId = config('services.meta.app_id');
        
        // Unity IAP often nests the real Meta data inside 'Payload'
        $payload = $receiptData['Payload'] ?? null;
        
        // If Payload is a string (common in Unity), we might need to decode it again
        $payloadData = is_string($payload) ? json_decode($payload, true) : $payload;
        
        // For Meta, the purchase token is usually the 'receipt_data' or 'purchase_token' inside the payload
        $purchaseToken = $payloadData['purchase_token'] ?? $payload; 

        // 4. CALL META GRAPH API
        $response = \Illuminate\Support\Facades\Http::get("https://graph.oculus.com/verify_entitlement", [
            'access_token' => "{$appId}|{$purchaseToken}",
            'sku' => $sku,
            'user_id' => $receiptData['UserId'] ?? ($payloadData['user_id'] ?? ''),
        ]);

        // Check if Meta confirms the user is entitled to this subscription
        return $response->successful() && $response->json('is_entitled') === true;
    }



    public function cancelSubscription(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->where('status', 'active')->first();
        $this->checkActive($user);

        $subscription = Subscription::where('user_id', $user->id)->where('status', 'active')->first();
        $date_remaining = $subscription ? Carbon::now()->diffInDays($subscription->expires_at) : 0;

        if ($subscription) {
            $subscription->update([
                 'expires_at' => now()->addDays($date_remaining),
                 'cancel_req' => true,
            ]);

            return response()->json([
                'message' => 'Your subscription has been cancelled and will remain active until ' . $subscription->expires_at->format('d M, Y'),
                'status' => 'success',
            ]);
        }

        return response()->json([
            'message' => 'No active subscription found.',
            'status' => 'error',
        ], 404);
    }


    //check if user is active or not
    public function checkActive(?User $user)
    {
        if (!$user) {
          abort(response()->json([
            'status' => 'error',
            'message' => 'User not found or inactive',
            ]), 404);
        }
    }


    //change password
    public function changePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->where('status', 'active')->first();
        $this->checkActive($user);

        if (!\Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Current password is incorrect',
            ], 400);
        }

        $user->password = bcrypt($request->password);
        $user->save();
        // Send password change email
        \Mail::to($user->email)->send(new PasswordChange($user));
        return response()->json([
            'status' => 'success',
            'message' => 'Password changed successfully',
        ]);
    }


    //cancel request check
    public function cancelRequestCheck(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->where('status', 'active')->first();
        $this->checkActive($user);

        $subscription = Subscription::where('user_id', $user->id)->where('cancel_req', true)->first();

        if ($subscription) {

            return response()->json([
                'message' => 'You have requested cancellation. Your subscription will remain active until ' . $subscription->expires_at->format('d M, Y'),
                'status' => 'cancellation_requested',
            ]);
        }

        return response()->json([
            'message' => 'No cancellation request found.',
            'status' => 'not_cancellation_requested',
        ]);
    }
}
