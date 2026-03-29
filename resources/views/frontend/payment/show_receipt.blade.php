@extends('frontend.layouts.master')
@section('title')
    Show Receipt
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
                                    <h1 data-animation="bounceIn" data-delay="0.2s">Show Receipt</h1>
                                    <!-- breadcrumb Start-->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <x-home-link />
                                            <li class="breadcrumb-item"><a href="#">Show Receipt</a></li> 
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
            <x-user-sidebar />

            <!-- Main Content Area -->
            <div class="col-md-9 pl-md-5 mt-4 mt-md-0">
                <div class="dashboard-content bg-white p-4 p-md-5 rounded shadow-sm">
                    <h3 class="mb-4" style="font-weight: 600;">Transaction Receipt</h3>
                    
                    <div class="p-4 p-md-5 bg-light rounded" style="border: 1px solid #e0e0e0; font-size: 15px;">
                        @if(isset($data['element']) && count($data['element']) > 0)
                            @php
                                $receipt = $data['element'][0];
                            @endphp
                            
                            <div class="row">
                                <div class="col-md-6 mb-4 border-bottom pb-3">
                                    <p class="text-muted text-uppercase mb-1" style="font-size: 12px; font-weight: 600;">Transaction ID</p>
                                    <p class="mb-0" style="font-weight: 500; color: #333;">{{ $receipt['tran_id'] }}</p>
                                </div>

                                <div class="col-md-6 mb-4 border-bottom pb-3">
                                    <p class="text-muted text-uppercase mb-1" style="font-size: 12px; font-weight: 600;">Status</p>
                                    <p class="mb-0">
                                        @if($receipt['status'] === 'VALIDATED')
                                            <span class="badge badge-success" style="background-color: #28a745; padding: 6px 12px; font-size: 12px;">{{ $receipt['status'] }}</span>
                                        @else
                                            <span class="badge badge-danger" style="background-color: #dc3545; padding: 6px 12px; font-size: 12px;">{{ $receipt['status'] }}</span>
                                        @endif
                                    </p>
                                </div>

                                <div class="col-md-6 mb-4 border-bottom pb-3">
                                    <p class="text-muted text-uppercase mb-1" style="font-size: 12px; font-weight: 600;">Validated On</p>
                                    <p class="mb-0" style="font-weight: 500; color: #333;">{{ $receipt['validated_on'] }}</p>
                                </div>

                                <div class="col-md-6 mb-4 border-bottom pb-3">
                                    <p class="text-muted text-uppercase mb-1" style="font-size: 12px; font-weight: 600;">Amount & Currency</p>
                                    <p class="mb-0" style="font-weight: 500; color: #333;">{{ $receipt['currency_amount'] }} {{ $receipt['currency_type'] }}</p>
                                </div>

                                <div class="col-md-6 mb-4 border-bottom pb-3">
                                    <p class="text-muted text-uppercase mb-1" style="font-size: 12px; font-weight: 600;">Card Type</p>
                                    <p class="mb-0" style="font-weight: 500; color: #333;">{{ $receipt['card_type'] }}</p>
                                </div>

                                <div class="col-md-6 mb-4 border-bottom pb-3">
                                    <p class="text-muted text-uppercase mb-1" style="font-size: 12px; font-weight: 600;">Card No</p>
                                    <p class="mb-0" style="font-weight: 500; color: #333;">{{ empty($receipt['card_no']) ? 'N/A' : $receipt['card_no'] }}</p>
                                </div>

                                <div class="col-md-12 mb-4 border-bottom pb-3">
                                    <p class="text-muted text-uppercase mb-1" style="font-size: 12px; font-weight: 600;">Card Issuer</p>
                                    <p class="mb-0" style="font-weight: 500; color: #333;">{{ $receipt['card_issuer'] }}</p>
                                </div>
                            </div>
                            
                            <div class="mt-4 text-center">
                                <button onclick="window.print()" class="btn btn-primary" style="background-color: #0056b3; border-color: #0056b3;">
                                    Print Receipt
                                </button>
                                <a href="{{ route('payment.history') }}" class="btn btn-outline-secondary ml-3">
                                    Back to History
                                </a>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <p class="text-danger" style="font-size: 18px; font-weight: 600;">No valid transaction details found.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection