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
use App\Models\BillingAddress;
use Illuminate\Support\Facades\Auth;

use Session;

class SubscriptionBuyController extends Controller
{
    //
    public function buySubscription($planId)
    {
        $user = auth()->user();
        $billingAddress = $user->billingAddress;
      
        $plan = Plan::findOrFail($planId);

       
        Session::put('plan', $plan);
        Session::put('billing_address', $billingAddress);
        return redirect()->route('payment.form');
    }

    public function cancelSubscription()
    {
        $user = auth()->user();
        $subscription = Subscription::where('user_id', $user->id)->where('status', 'active')->first();
        // $plan = $subscription ? $subscription->plan : null;
        // $plan_duration = $plan ? $plan->duration : 30; // Default to 30 days if no plan found

        $date_remaining = $subscription ? Carbon::now()->diffInDays($subscription->expires_at) : 0;
       
       // dd($date_remaining);

        if ($subscription) {
            $subscription->update([
                'expires_at' => now()->addDays($date_remaining),
            ]);

            return back()->with('message', 'Your subscription will remain active until ' . $subscription->expires_at->format('d M, Y'));
           
        }

        return redirect()->route('profile.edit')->with('error', 'No active subscription found.');
    }
}
