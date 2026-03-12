@extends('frontend.layouts.master')
@section('title')
    About Us
@endsection
@section('content')
            <!--? slider Area Start-->
        <section class="slider-area slider-area2">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height2">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-11 col-md-12">
                                <div class="hero__caption hero__caption2">
                                    <h1 data-animation="bounceIn" data-delay="0.2s">About us</h1>
                                    <!-- breadcrumb Start-->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <x-home-link />
                                            <li class="breadcrumb-item"><a href="#">About</a></li> 
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

        <!--? About Area-1 Start -->
        <section class="about-area1 fix pt-10 mb-100">
            <div class="support-wrapper align-items-center">
                <div class="left-content1">
                    <div class="about-icon">
                        <img src="{{ ('frontend/assets/img/icon/about.svg') }}" alt="">
                    </div>
                    <!-- section tittle -->
                    <div class="section-tittle section-tittle2 mb-55">
                        <div class="front-text">
                            <h2 class="">{{ @$objectives->title }}</h2>
                            {!! @$objectives->description !!}
                        </div>
                    </div>


                </div>
                <div class="right-content1">
                    <!-- img -->
                    <div class="right-img">
                        <img src="{{ @$objectives->image }}" alt="VRPathshala objectives" style="border-radius: 5px">

                    </div>
                </div>
            </div>
        </section>
        <!-- About Area End -->
        <!--? top subjects Area Start -->

        <!-- top subjects End -->
        <!--? About Area-3 Start -->
        @if ($missions)
                    <section class="about-area3 fix mb-100">
            <div class="support-wrapper align-items-center">
                <div class="right-content3">
                    <!-- img -->
                    <div class="right-img">
                        <img src="{{ @$missions->image }}" alt="VR Pathshala mission" style="border-radius: 5px">
                    </div>
                </div>
                <div class="left-content3">
                    <!-- section tittle -->
                    <div class="section-tittle section-tittle2 mb-20">
                        <div class="front-text">
                            <h2 class="">{{ @$missions->title }}</h2>
                        </div>
                    </div>
                    <div class="single-features">
                        <div class="features-icon">
                            <img src="{{ ('fronend/assets/img/icon/right-icon.svg') }}" alt="">
                        </div>
                        <div class="features-caption">
                            {!! @$missions->description !!}
                        </div>
                    </div>

                </div>
            </div>
        </section>
        @endif

        <!-- About Area End -->
        <!--? Team -->
        <section class="about-area1 fix pt-10 mb-100">
            <div class="support-wrapper align-items-center">
                <div class="left-content1">
                    <div class="about-icon">
                        <img src="{{ ('frontend/assets/img/icon/about.svg') }}" alt="">
                    </div>
                    <!-- section tittle -->
                    <div class="section-tittle section-tittle2 mb-55">
                        <div class="front-text">
                            <h2 class="">{{ @$visions->title }}</h2>
                            {!! @$visions->description !!}
                        </div>
                    </div>

                </div>
                <div class="right-content1">
                    <!-- img -->
                    <div class="right-img">
                        <img src="{{ @$visions->image }}" alt="VRPathshala Visions" style="border-radius: 5px">

                    </div>
                </div>
            </div>
        </section>
        <!-- Services End -->
@endsection