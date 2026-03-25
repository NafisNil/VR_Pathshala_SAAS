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

use Session;

class SubscriptionBuyController extends Controller
{
    //
    public function buySubscription($planId)
    {
        $user = auth()->user();
        $plan = Plan::findOrFail($planId);

       
        Session::put('plan', $plan);
        return redirect()->route('payment.form');
    }
}
