@extends('frontend.layouts.master')
@section('title')
    Password Change
@endsection
@section('content')
        <section class="slider-area slider-area2">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height2">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-11 col-md-12">
                                <div class="hero__caption hero__caption2">
                                    <h1 data-animation="bounceIn" data-delay="0.2s">User Dashboard</h1>
                                    <!-- breadcrumb Start-->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <x-home-link />
                                            <li class="breadcrumb-item"><a href="#">User Dashboard</a></li> 
                                        </ol>
                                    </nav>
                                    <!-- breadcrumb End -->
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
            </div>
        </section>
<div class="courses-area section-padding40 fix" style="background-color: #fcf1f4; min-height: 60vh;">
    <div class="container">
        <div class="row py-5">
            <!-- Sidebar Navigation -->
            <x-user-sidebar/>

            <!-- Main Content Area -->
            <div class="col-md-9 pl-md-5 mt-4 mt-md-0">
                <div class="dashboard-content bg-white p-4 p-md-5 rounded shadow-sm">
                    <h3 class="mb-4" style="font-weight: 600;">Change Password</h3>
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('password.change') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group mb-4">
                            <label for="current_password" style="font-weight: 500;">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" style="border-radius: 4px; border: 1px solid #ced4da; padding: 10px 15px;" required>
                            @error('current_password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="email" style="font-weight: 500;">New Password </label>
                            <input type="password" class="form-control" id="new_password" name="password" style="border-radius: 4px; border: 1px solid #ced4da; padding: 10px 15px;" required>
                          
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                                                
                        <div class="form-group mb-4">
                            <label for="email" style="font-weight: 500;">Confirm Password </label>
                            <input type="password" class="form-control" id="new_password" name="password_confirmation" style="border-radius: 4px; border: 1px solid #ced4da; padding: 10px 15px;" required>
                          
                            @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-3" style="background-color: #b33969; border-color: #b33969; padding: 12px 30px; font-weight: 600; letter-spacing: 0.5px;">SAVE CHANGES</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection