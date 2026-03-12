<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPVerificationMail as OTPMail;
use App\Mail\PasswordChangeMail as PasswordChange;
use App\Mail\ForgetpasswordMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Objective;
use App\Models\Plan;
use App\Models\Payment;
use Carbon\Carbon;
use App\Models\Subscription;
use App\Models\Deviceinfo as Device;
use App\Models\FeatureTopic;

class UserController extends Controller
{
    //
    public function login_form()
    {
        return view('frontend.auth.login');
    }

    public function registration_form()
    {
        return view('frontend.auth.registration');
    }

    public function registration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $otp = rand(100000, 999999);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'otp' => $otp,
        ]);

        // Send OTP email

        

        Mail::to($user->email)->send(new OTPMail([$otp, $user->email]));

        Session::put('email', $user->email);

        return redirect()->route('otp.form')->with('success', 'Registration successful. Please enter the OTP sent to your email.');
    }

    public function otp_form()
    {
        $email = Session::get('email');
        return view('frontend.auth.otp', compact('email'));
    }

    public function verify_otp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && $user->otp == $request->otp) {
            // OTP is correct, you can log the user in or perform other actions
            $user->otp = null; // Clear OTP after successful verification
            $user->status = 'active'; // Set user status to active
            $user->save();
            return redirect()->route('login.form')->with('success', 'OTP verified successfully. Please login.');
        } else {
            return back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/user-dashboard')->with('success', 'Logged in successfully.');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully.');
    }


    //user activities
    public function userDashboard()
    {
        $data['objectives'] = Objective::latest()->first();
        $data['subscription'] = Subscription::where('user_id', Auth::id())->latest()->first();
        $data['device'] = Device::where('user_id', Auth::id())->latest()->first();

        return view('frontend.user_dashboard', $data);
    }

    public function userProfile()
    {
         $data['objectives'] = Objective::latest()->first();
        return view('frontend.user_profile', $data);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
          
           
        ]);

        $user->name = $request->name;


        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }

    public function paymentHistory()
    {
        $data['objectives'] = Objective::latest()->first();
        $data['payments'] = Payment::where('user_id', Auth::id())->latest()->paginate(15);
        return view('frontend.payment_history', $data);
    }

    public function contentRatingForm()
    {
        $data['objectives'] = Objective::latest()->first();
        $data['feature_topic'] = FeatureTopic::latest()->get();
        return view('frontend.rate_content', $data);
    }

    public function submitContentRating(Request $request)
    {
        $request->validate([
            'feature_topic_id' => 'required|exists:feature_topics,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $user = Auth::user();
        $featureTopic = FeatureTopic::find($request->feature_topic_id);

        $featureTopic = FeatureTopic::find($request->feature_topic_id);
        $featureTopic->rating = $request->rating;
        $featureTopic->total_reviews = $featureTopic->total_reviews + 1;
        $featureTopic->save();

        return redirect()->route('content-rating-form')->with('success', 'Thank you for your rating!');
    }


    public function passwordChangeForm()
    {
        $data['objectives'] = Objective::latest()->first();
        return view('frontend.password_change', $data);
    }

        public function changePassword(Request $request)
        {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|confirmed|min:6',
            ]);
    
            $user = Auth::user();
    
            if (!\Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
            else{
                if($request->current_password == $request->password){
                    return back()->withErrors(['password' => 'New password cannot be the same as the current password.']);
                }else{
                    $user->password = bcrypt($request->password);
                    $user->save();
                    Mail::to($user->email)->send(new PasswordChange(['Your password has been changed successfully.', $user->email]));
                }
            }
    
            
    
            return redirect()->route('password.change.form')->with('success', 'Password changed successfully.');
        }


        public function unlinkDevices()
        {
            $user = Auth::user();
            $device = Device::where('user_id', $user->id)->first();
            $device->update([
                'device_id' =>null,
                'device_model' => null,
            ]);

            return redirect()->route('user.dashboard')->with('success', 'Current device has been unlinked successfully.');
        }

        public function forgetPasswordForm()
        {
            $data['objectives'] = Objective::latest()->first();
            return view('frontend.auth.forget_password_form', $data);
        }

            public function forgetPassword(Request $request)
            {
                $request->validate([
                    'email' => 'required|email|exists:users,email',
                ]);
    
                $otp = rand(100000, 999999);
                $user = User::where('email', $request->email)->first();
                $user->otp = $otp;
                $user->save();
    
                Mail::to($user->email)->send(new ForgetpasswordMail([$otp, $user->email]));
    
                Session::put('email', $user->email);
    
                return redirect()->route('forget.password.otp.form')->with('success', 'OTP has been sent to your email. Please enter the OTP to reset your password.');
            }

            public function forgetPasswordRequestForm()
            {
                $data['objectives'] = Objective::latest()->first();
                $data['email'] = Session::get('email');
                return view('frontend.auth.forget_password_otp', $data);
            }


            public function forgetPasswordRequest(Request $request)
            {
                $request->validate([
                    
                    'otp' => 'required|digits:6',
                    
                ]);
    
                $user = User::where('email', $request->email)->first();
    
                if ( $user->otp == $request->otp) {
                    // OTP is correct, reset the password
                    
                    $user->otp = null; // Clear OTP after successful password reset
                    $user->save();
                    Session::put('email', $user->email);
    
                    return redirect()->route('confirm.password.form')->with('success', 'OTP verified successfully. Please enter your new password.');
                } else {
                    return back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
                }
            }


            public function confirmPasswordForm()
            {
                $data['objectives'] = Objective::latest()->first();
                $data['email'] = Session::get('email');
                return view('frontend.auth.confirm_password_form', $data);
            }

            public function confirmPassword(Request $request)
            {
                $request->validate([
                    'email' => 'required|email|exists:users,email',
                    'password' => 'required|confirmed|min:6',
                ]);
    
                $user = User::where('email', $request->email)->first();
                $user->password = bcrypt($request->password);
                $user->save();
    
                return redirect()->route('login.form')->with('success', 'Password reset successfully. Please login with your new password.');
            }


        
}
