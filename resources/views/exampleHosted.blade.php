@extends('frontend.layouts.master')

@section('title', 'Hosted Payment - VR Pathshala')

@section('content')
<div class="container" style="padding: 50px 0;">
    <div class="py-5 text-center">
        <h2>Hosted Payment - VR Pathshala</h2>
        {{-- <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. We have provided this sample form for understanding Hosted Checkout Payment with VR Pathshala.</p> --}}
    </div>
    
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill">3</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h4 class="my-0">{{ $plan['name'] }}</h4>
                            
                    </div>
                    <span class="text-muted">{{ $plan['price'] }}</span>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (BDT)</span>
                    <strong>{{ $plan['price'] }} TK</strong>
                </li>
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form action="{{ url('/pay') }}" method="POST" class="needs-validation">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="firstName">Full name</label>
                        <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder=""
                               value="{{ @$user->name }}" required>

                        <input type="hidden" name="total_amount" value="{{ $plan['price'] }}">
                        <input type="hidden" name="plan_id" value="{{ $plan['id'] }}">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        @error('customer_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="mobile">Mobile(Optional)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+88</span>
                        </div>
                        <input type="text" name="customer_mobile" class="form-control" id="mobile" placeholder="Mobile"
                               value="{{ @$billing_address->mobile }}" required>
                        @error('customer_mobile')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email <span class="text-muted"></span></label>
                    <input type="email" name="customer_email" class="form-control" id="email"
                           placeholder="you@example.com" value="{{ @$user->email }}" required>
                    @error('customer_email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
             
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" name="customer_address" class="form-control" id="address"  placeholder="1234 Main St"
                           value="{{ @$billing_address->address_line1 }}" required>
                    @error('customer_address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                    <input type="text" name="customer_address2" class="form-control" id="address2" placeholder="Apartment or suite" value="{{ @$billing_address->address_line2 }}">
                    @error('customer_address2')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <select class="custom-select w-100" id="country" name="country" required>
                            <option value="">Choose...</option>
                            <option value="Bangladesh">Bangladesh</option>
                        </select>
                        @error('customer_country')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <select class="custom-select w-100" id="state" name="state" required>
                            <option value="">Choose...</option>
                            <option value="Dhaka">Dhaka</option>
                        </select>
                        @error('customer_state')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" name="customer_zip" class="form-control" id="zip" name="zip" placeholder="" value="{{ @$billing_address->zip }}" required>
                        @error('customer_zip')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <hr class="mb-4">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="same-address">
                    {{-- <input type="hidden" value="1200" name="amount" id="total_amount" required/> --}}
                    <label class="custom-control-label" for="same-address">Shipping address is the same as my billing
                        address</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="save-info">
                    <label class="custom-control-label" for="save-info">Save this information for next time</label>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout (Hosted)</button>
            </form>
        </div>
    </div>
</div>
@endsection
