<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\Deviceinfo as Device;
use Illuminate\Support\Facades\DB;
use App\Models\Plan;

class HomeController extends Controller
{
    //
    public function index()
    {
        $data['users'] = User::count();
        $data['subscriptions'] = Subscription::count();
        $data['payments'] = Payment::sum('amount');
        $data['plans'] = Plan::count();
        return view('backend.index', compact('data'));
    }


    //user routes
    public function users(Request $request)
    {
        $query = User::with('device')->where('role', 'user');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $user = $query->get();

        if ($request->ajax()) {
            return view('backend.users.partials.user_table', compact('user'))->render();
        }

        return view('backend.users.index', compact('user'));
    }

    public function makeUserSuspended($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'suspended';
        $user->save();

        return redirect()->route('users.index')->with('success', 'User suspended successfully.');
    }

    public function makeUserActive($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

        return redirect()->route('users.index')->with('success', 'User activated successfully.');
    }

    public function show($id)
    {
        $user = User::with(['device', 'payments', 'subscriptions'])->findOrFail($id);
        return view('backend.users.show', compact('user'));
    }


    //subscription routes
    public function subscriptions(Request $request)
    {
        $query = Subscription::with(['user', 'plan'])->latest();

        if ($request->filled('username')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->username . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $subscriptions = $query->get();

        if ($request->ajax()) {
            return view('backend.subscriptions.partials.subscription_table', compact('subscriptions'))->render();
        }
            
        return view('backend.subscriptions.index', compact('subscriptions'));
    }

    //payment routes
    public function payments(Request $request)
    {
        $query = Payment::with(['user', 'plan'])->latest();

        if ($request->filled('username')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->username . '%');
            });
        }

        if ($request->filled('plan')) {
            $query->whereHas('plan', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->plan . '%');
            });
        }

        if ($request->filled('transaction_id')) {
            $query->where('transaction_id', 'like', '%' . $request->transaction_id . '%');
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', 'like', '%' . $request->payment_method . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $payments = $query->get();

        if ($request->ajax()) {
            return view('backend.payments.partials.payment_table', compact('payments'))->render();
        }

        return view('backend.payments.index', compact('payments'));
    }
    



}
