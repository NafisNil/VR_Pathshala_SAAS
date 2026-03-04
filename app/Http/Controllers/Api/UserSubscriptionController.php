<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Payment;

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

        if ($subscription) {
            return response()->json([
                'subscribed' => true,
                'plan' => $subscription->plan_id,
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
                'expires_at' => now()->addDays(30),
                'status' => 'active',
            ]);

            $payment = Payment::create([
                'user_id' => $user->id,
                'plan_id' => $request->plan_id,
               // 'amount' => $subscription->plan->price,
                 'amount' => 9.99, // For testing, you can replace this with the actual plan price
                'transaction_id' => 'txn_' . uniqid(),
                'payment_method' => 'credit_card',
                'currency' => 'USD',
                'status' => 'completed',
            ]);

            return [$subscription, $payment];
        });

        return response()->json([
            'message' => 'Subscription created successfully',
            'subscription' => $subscription,
        ]);
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
}
