@extends('frontend.auth.app')
@section('title')
    Registration
@endsection
@section('content')
    @include('backend.sessionMsg')
    <form class="form-default" action="{{ route('registration') }}" method="POST">
        @csrf
            <div class="login-form">
                <!-- logo-login -->
                <div class="logo-login">
                    <a href="{{ route('index') }}"><img src="{{ asset('backend/logo/logo_vr.jpg') }}" alt="VR Pathshala"></a>
                </div>
            <h2>Registration Here</h2>

            <div class="form-input">
                <label for="name">Full name</label>
                <input  type="text" name="name" placeholder="Full name" value="{{ old('name') }}">
            </div>
            <div class="form-input">
                <label for="name">Email Address</label>
                <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}">
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
                <input type="submit" name="submit" value="Registration">
            </div>
            <!-- Forget Password -->
            <a href="{{ route('login.form') }}" class="registration">login</a>
            </div>
        </form>
@endsection