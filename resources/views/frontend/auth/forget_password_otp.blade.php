@extends('frontend.auth.app')
@section('title')
    Forget password - OTP Verification
@endsection
@section('content')
    @include('backend.sessionMsg')
    <form class="form-default" action="" method="POST">
        @csrf
        <div class="login-form">
            <!-- logo-login -->
            <div class="logo-login">
                <a href="{{ route('index') }}"><img src="{{ asset('backend/logo/logo_vr.jpg') }}" alt="VR Pathshala"></a>
                </div>
                <h2>OTP Verification</h2>
                <div class="form-input">
                    <label for="otp">Code</label>
                    <input  type="number" name="otp" placeholder="Enter OTP">
                    <input type="hidden" name="email" value="{{ $email }}">
                </div>
                
                <div class="form-input pt-30">
                    <input type="submit" name="submit" value="Verify OTP">
                </div>
                
                <!-- Forget Password -->
                
                <!-- Forget Password -->
                <a href="{{ route('login.form') }}" class="registration">Login</a>
            </div>
        </form>
@endsection