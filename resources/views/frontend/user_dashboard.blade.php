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
        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

        <div class="row py-5">
            <!-- Sidebar Navigation -->
           <x-user-sidebar />

            <!-- Main Content Area -->
            <div class="col-md-9 pl-md-5 mt-4 mt-md-0">
                <div class="dashboard-content" style="padding-left: 20px;">
                    <p style="font-size: 16px; color: #333; margin-bottom: 25px;">
                        Hello <strong style="color: #000;">{{ Auth::user()->name }}</strong>
                    </p>
                    
                    <p style="font-size: 16px; color: #555; line-height: 1.8;">
                         SINCE: {{ Auth::user()->created_at->format('F j, Y') }} <br>
                        
                        ACCOUNT STATUS: <span style="color: {{ Auth::user()->status == 'active' ? 'green' : 'red' }};">{{ Auth::user()->status == 'active' ? 'Active' : 'Inactive' }}</span>

                    </p>

                    <hr style="margin: 30px 0;">
                    <p style="font-size: 16px; color: #333; margin-bottom: 25px;">
                        <strong style="color: #000;">Subscription Plan:</strong> {{ $subscription ? $subscription->plan->name : 'No active subscription' }} &nbsp; 
                        @if($subscription && !$subscription->cancel_req)
                            (<a href="{{ route('cancel.subscription') }}" title="Cancel Subscription" style="color: #007bff; text-decoration: none;">Cancel</a>)
                        @elseif($subscription && $subscription->cancel_req)
                            (Cancellation Requested)
                        @endif
                        <br>
                        @php
                            $nextBillingDate = @$subscription->expires_at
                        @endphp
                        @if($subscription && $subscription->expires_at && $subscription->cancel_req == false)
                            <strong style="color: #000;">Next Billing Date:</strong> {{ \Carbon\Carbon::parse( $nextBillingDate)->format('j F, Y') }}
                        @elseif($subscription && $subscription->expires_at && $subscription->cancel_req)
                            <strong style="color: #000;">Subscription Expiry Date:</strong> {{ \Carbon\Carbon::parse( $nextBillingDate)->format('j F, Y') }}
                         
                        @endif

                    </p>


                     <hr style="margin: 30px 0;">
                      <p style="font-size: 16px; color: #333; margin-bottom: 25px;">
                        <strong style="color: #000;">Current Device UUID:</strong> {{ $device ? $device->device_id : 'No active device' }}
                        <br>
                       
                            <strong style="color: #000;">Current Device Model:</strong> {{ $device ? $device->device_model : 'Not found' }}
                            <br>
                            @if($device)
                                <a href="{{ route('unlink.devices') }}" class="btn btn-danger btn-sm mt-2">Unlink Device</a>
                            @endif


                    </p>

                    <!-- You can inject the other sections (Payment History, Plan details) here if needed later -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection