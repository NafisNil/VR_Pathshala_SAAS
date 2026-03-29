@extends('frontend.layouts.master')
@section('title')
    Billing Address
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
                                    <h1 data-animation="bounceIn" data-delay="0.2s">Billing Address</h1>
                                    <!-- breadcrumb Start-->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <x-home-link />
                                            <li class="breadcrumb-item"><a href="#">Billing Address</a></li> 
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
                    <h3 class="mb-4" style="font-weight: 600;">Billing Address</h3>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ isset($billingAddress) ? route('billing-address.update', $billingAddress->id) : route('billing-address.store') }}" method="POST">
                        @csrf
                        @if(isset($billingAddress))
                            @method('PUT')
                        @endif
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="address_line1" style="font-weight: 500; font-size: 14px;">Address Line 1 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="address_line1" name="address_line1" value="{{ old('address_line1', $billingAddress->address_line1 ?? '') }}" required placeholder="1234 Main St">
                                @error('address_line1')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="address_line2" style="font-weight: 500; font-size: 14px;">Address Line 2 <span class="text-muted">(Optional)</span></label>
                                <input type="text" class="form-control" id="address_line2" name="address_line2" value="{{ old('address_line2', $billingAddress->address_line2 ?? '') }}" placeholder="Apartment, studio, or floor">
                                @error('address_line2')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="mobile" style="font-weight: 500; font-size: 14px;">Mobile Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile', $billingAddress->mobile ?? '') }}" required placeholder="+1 234 567 8900">
                                @error('mobile')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="country" style="font-weight: 500; font-size: 14px;">Country <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $billingAddress->country ?? '') }}" required placeholder="United States">
                                @error('country')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="state" style="font-weight: 500; font-size: 14px;">State/Region</label>
                                <input type="text" class="form-control" id="state" name="state" value="{{ old('state', $billingAddress->state ?? '') }}" placeholder="California">
                                @error('state')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="zip" style="font-weight: 500; font-size: 14px;">ZIP Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="zip" name="zip" value="{{ old('zip', $billingAddress->zip ?? '') }}" required placeholder="90001">
                                @error('zip')<span class="text-danger small">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="background-color: #0056b3; border-color: #0056b3; box-shadow: none;">
                                {{ isset($billingAddress) ? 'Update' : 'Save' }} Billing Address
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection