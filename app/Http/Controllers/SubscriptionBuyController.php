<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class SubscriptionBuyController extends Controller
{
    //
    public function buySubscription($planId)
    {
        $user = auth()->user();
        $plan = Plan::findOrFail($planId);

        // Create a new subscription
        $subscription = Subscription::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'started_at' => Carbon::now(),
            'expires_at' => Carbon::now()->addDays($plan->duration), 
            'status' => 'active',
        ]);

        // Create a payment record
        Payment::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'amount' => $plan->price,
            'payment_method' => 'credit_card', // Assuming a default payment method
            'transaction_id' => 'TXN' . strtoupper(uniqid()), // Generate a unique transaction ID
            'status' => 'completed',
        ]);

        return redirect()->route('user.dashboard')->with('success', $plan->name.'  plan purchased successfully!');
    }
}
