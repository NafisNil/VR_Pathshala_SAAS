<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Deviceinfo as Device;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPVerificationMail as OTPMail;


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

            Mail::to($user->email)->send(new OTPMail([$user->otp, $user->name]));

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

        $user = \App\Models\User::where('email', $request->email)->first();
        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }else if($user->status != 'active'){
                return response()->json([
                    'status' => 'unverified',
                    'message' => 'User not active',
                    'email' => $user->email
                ], 200);
        }else if ($user->status == 'active') {
            $token = $user->createToken('auth_token')->plainTextToken;

            $device = Device::where('user_id', $user->id)->first();
            $request_device_id = $user->id . '-' . $request->device_id;


            if($device->device_id == null && $device->device_model == null){
                $device->device_id = $user->id . '-' . ($request->device_id ?? Str::random(64));
                $device->device_model = $request->device_model ?? 'Unknown';
                $device->save();
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'status' => 'add_new_device',
                    'message' => 'Logged in successfully from a new device and associated with your account',
                    'email' => $user->email
                ]);

            }else{
                if ($device && $device->device_id == $request_device_id && $device->device_model == $request->device_model) {
                    # code...
                    return response()->json([
                        'access_token' => $token,
                        'token_type' => 'Bearer',
                        'status' => 'verified_same_device',
                        'message' => 'Logged in successfully from the same device',
                        'email' => $user->email
                    ]);
                }else{
                    return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'status' => 'verified_new_device',
                    'message' => 'Logged in successfully from a new device',
                    'email' => $user->email
                    ]);
                }
            }


        }
        
    }


    //otp verification
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'otp' => 'required|string',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();
        $device = Device::where('user_id', $user->id)->first();

        if ($user->otp == $request->otp) {
            $user->otp = null;
            $user->status = 'active';
            $user->save();
            $device->device_id = $user->id . '-' . ($request->device_id ?? Str::random(64));
            $device->device_model = $request->device_model ?? 'Unknown';
            $device->save();
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

        Mail::to($user->email)->send(new OTPMail([$user->otp, $user->name]));

        return response()->json([
            'status' => 'success',
            'message' => 'OTP sent to your email for device unlinking',
            'email' => $user->email
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
                'email' => $user->email
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid OTP',
                'email' => $user->email
            ], 400);
        }
    }

    //check if user is active or not
    public function checkActive(?User $user)
    {
        if (!$user) {
          abort(response()->json([
            'status' => 'unverified',
            'message' => 'User not found or inactive',
            'user_email' => $user ? $user->email : null

            ]), 403);
        }
    }


    //get user info
    public function userInfo(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = User::where('email', $request->email)->where('status', 'active')->firstOrFail();
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'status' => $user->status,
            'success' => true
        ]);
    }

    //logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully',
        ]);
    }

    // public function getProfileInfo(Request $request)
    // {
    //     $user = User::where('email', $request->email)->where('status', 'active')->first();
    //      $subscription = Subscription::where('user_id', $user->id)->latest()->first();
        
    //     return response()->json([
    //         'name' => $user->name,
    //         'email' => $user->email,
    //         'status' => $user->status,
    //         'created_at' => $user->created_at,
    //         'updated_at' => $user->updated_at,
    //         'subscription' => $subscription ? [
    //             'plan_name' => $subscription->plan->name,
    //             'expires_at' => $subscription->expires_at,
                
    //         ] : null,
    //          'success' => true
    //     ]);
    // }


    public function getProfileInfo(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)
                    ->where('status', 'active')
                    ->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        // Fetch Subscription with Plan relation to avoid extra queries (Eager Loading)
        $subscription = Subscription::with('plan')
                                    ->where('user_id', $user->id)
                                    ->latest()
                                    ->first();

        // Prepare Subscription Data
        $subData = null;
        if ($subscription) {
            $subData = [
                'plan_name'  => $subscription->plan->name ?? 'N/A',
                'expires_at' => $subscription->expires_at ? $subscription->expires_at->format('d M, Y') : null,
                'is_cancellation_requested' => (bool)$subscription->cancel_req, 
                'message' => $subscription->cancel_req ? 'You have requested cancellation. Your subscription will remain active until ' . ($subscription->expires_at ? $subscription->expires_at->format('d M, Y') : 'N/A') : null,
            ];
        }

        return response()->json([
            'success'      => true,
            'name'         => $user->name,
            'email'        => $user->email,
            'status'       => $user->status,
            'created_at'   => $user->created_at->format('d M, Y'),
            'updated_at'   => $user->updated_at->format('d M, Y'),
            'subscription' => $subData,
        ]);
    }
}
