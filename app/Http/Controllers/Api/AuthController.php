<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deviceinfo as Device;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



class AuthController extends Controller
{

    //registration 
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        [$user, $device] = DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'otp' => rand(100000, 999999),
            ]);

            $device = Device::create([
                'user_id' => $user->id,
                'device_id' => $user->id . '-' . ($request->device_id ?? Str::random(64)),
                'device_model' => $request->device_model ?? 'Unknown',
            ]);

            return [$user, $device];
        });

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'status' => 'success',
        ]);
    }

    //login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!\Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = \App\Models\User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        $device = Device::where('user_id', $user->id)->firstOrFail();

        if ($device->device_id == $request->device_id && $device->device_model == $request->device_model) {
            # code...
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'status' => 'success',
                'message' => 'Logged in successfully from the same device',
            ]);
        }else{
            return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'status' => 'success',
            'message' => 'Logged in successfully from a new device',
            ]);
        }

        
    }


    //otp verification
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'otp' => 'required|string',
        ]);

        $user = \App\Models\User::where('email', $request->email)->firstOrFail();

        if ($user->otp == $request->otp) {
            $user->otp = null;
            $user->status = 'active';
            $user->save();
            return response()->json([
                'status' => 'success',
                'message' => 'OTP verified successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid OTP',
            ], 400);
        }
    }


    //unlink device request
    public function unlinkDeviceRequest(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = \App\Models\User::where('email', $request->email)->where('status', 'active')->first();

        $this->checkActive($user);
        $user->otp = rand(100000, 999999);
        $user->save();
        return response()->json([
            'status' => 'success',
            'message' => 'OTP sent to your email for device unlinking',
        ]);
    }

    //unlink device confirm
    public function unlinkDeviceConfirm(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'otp' => 'required|string',
        ]);

        $user = \App\Models\User::where('email', $request->email)->where('status', 'active')->first();
        $this->checkActive($user);

        if ($user->otp == $request->otp) {
            $user->otp = null;
            $user->save();
            $device = Device::where('user_id', $user->id)->firstOrFail();
            $device->device_id = $user->id . '-' . ($request->device_id ?? Str::random(64));
            $device->device_model = $request->device_model ?? 'Unknown';
            $device->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Device unlinked successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid OTP',
            ], 400);
        }
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
