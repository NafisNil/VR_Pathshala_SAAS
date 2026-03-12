@extends('frontend.auth.app')
@section('title')
    Forget password - Email
@endsection
@section('content')
    @include('backend.sessionMsg')
    <form class="form-default" action="{{ route('forget.password.store') }}" method="POST">
        @csrf
        <div class="login-form">
            <!-- logo-login -->
            <div class="logo-login">
                <a href="{{ route('index') }}"><img src="{{ asset('backend/logo/logo_vr.jpg') }}" alt="VR Pathshala"></a>
                </div>
                <h2>Email</h2>
                <div class="form-input">
                    <label for="email">Email</label>
                    <input  type="email" name="email" placeholder="Enter your email">
                  
                </div>
                
                <div class="form-input pt-30">
                    <input type="submit" name="submit" value="Submit Email">
                </div>
                
                <!-- Forget Password -->
                
                <!-- Forget Password -->
                <a href="{{ route('login.form') }}" class="registration">Login</a>
            </div>
        </form>
@endsection