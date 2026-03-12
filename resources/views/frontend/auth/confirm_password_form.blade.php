@extends('frontend.auth.app')
@section('title')
    Change Password
@endsection
@section('content')
    <form class="form-default" action="{{ route('confirm.password.store') }}" method="POST">
        @csrf
            <div class="login-form">
                <!-- logo-login -->
                <div class="logo-login">
                    <a href="{{ route('index') }}"><img src="{{ asset('backend/logo/logo_vr.jpg') }}" alt="VR Pathshala"></a>
                </div>
                <h2>Change Password</h2>
                <div class="form-input">
                    <label for="name">Email</label>
                    <input  type="email" name="email" placeholder="Email">
                </div>
                <div class="form-input">
                    <label for="name">Password</label>
                    <input type="password" name="password" placeholder="Password">
                </div>
                <div class="form-input">
                    <label for="name">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password">
                </div>
                <div class="form-input pt-30">
                    <input type="submit" name="submit" value="Change Password">
                </div>
                
                <!-- Forget Password -->
                <a href="{{ route('forget.password.form') }}" class="forget">Forget Password</a>
                <!-- Forget Password -->
                <a href="{{ route('registration.form') }}" class="registration">Registration</a>
            </div>
        </form>
@endsection