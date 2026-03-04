<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deviceinfo as Device;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('backend.index');
    }


    //user routes
    public function users()
    {
        $user = User::with('device')->where('role', 'user')->get();
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

    



}
