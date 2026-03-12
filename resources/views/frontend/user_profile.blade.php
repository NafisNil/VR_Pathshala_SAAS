@extends('frontend.layouts.master')
@section('title')
    User Dashboard
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
                    <h3 class="mb-4" style="font-weight: 600;">Edit Profile</h3>
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('user.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group mb-4">
                            <label for="name" style="font-weight: 500;">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" style="border-radius: 4px; border: 1px solid #ced4da; padding: 10px 15px;">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="email" style="font-weight: 500;">Email Address</label>
                            <input type="email" class="form-control bg-light" id="email" value="{{ Auth::user()->email }}" readonly style="border-radius: 4px; border: 1px solid #ced4da; padding: 10px 15px; cursor: not-allowed;">
                            <small class="text-muted">Your email address cannot be changed.</small>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3" style="background-color: #b33969; border-color: #b33969; padding: 12px 30px; font-weight: 600; letter-spacing: 0.5px;">SAVE CHANGES</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection