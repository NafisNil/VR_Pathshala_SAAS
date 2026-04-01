<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Payment;
use App\Mail\PasswordChangeMail as PasswordChange; 
use Carbon\Carbon;

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
            'plan_id' => 'required|exists:plans,id',
        ]);

        $user = User::where('email', $request->email)->where('status', 'active')->first();
        $this->checkActive($user);

        [$subscription, $payment] = DB::transaction(function () use ($user, $request) {
            $subscription = Subscription::create([
                'user_id' => $user->id,
                'plan_id' => $request->plan_id,
                'started_at' => now(),
                'expires_at' => now()->addDays($plan->duration),
                'status' => 'active',
            ]);

            $payment = Payment::create([
                'user_id' => $user->id,
                'plan_id' => $request->plan_id,
                'amount' => $subscription->plan->price,
                // 'amount' => 9.99, // For testing, you can replace this with the actual plan price
                'transaction_id' => 'txn_' . uniqid(),
                'payment_method' => 'credit_card',
                'currency' => 'USD',
                'status' => 'completed',
            ]);

            return [$subscription, $payment];
        });

        return response()->json([
            'message' => 'Subscription created successfully',
            'status' => 'success',
            'planName' => $subscription->plan->name,
            'expires_at' => $subscription->expires_at,
        ]);
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
