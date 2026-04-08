@extends('frontend.layouts.master')
@section('title')
    Index
@endsection
@section('content')
    <!--? slider Area Start-->
        <section class="slider-area " style="background-image: url({{ @$sliders->image }});">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 col-md-12">
                                <div class="hero__caption">
                                    <h1 data-animation="fadeInLeft" data-delay="0.2s">{{ @$sliders->title }}</h1>
                                    <p data-animation="fadeInLeft" data-delay="0.4s">{{ @$sliders->subtitle }}</p>
                                    <a href="#" class="btn hero-btn" data-animation="fadeInLeft" data-delay="0.7s">Join for Free</a>
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
            </div>
        </section>
        <!-- ? services-area -->
        <div class="services-area">
            <div class="container">
                <div class="row justify-content-sm-center">
                    @foreach ($benefits as $item)
                        <div class="col-lg-4 col-md-6 col-sm-8">
                            <div class="single-services mb-30">
                                <div class="features-icon">
                                    <img src="{{ asset($item->icon) }}" alt="{{ $item->name }}" style="max-width:60px; border-radius:5px">
                                </div>
                                <div class="features-caption">
                                    <h3>{{ $item->name }}</h3>
                                    <p>{!! $item->short_description !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Courses area start -->
        <div class="courses-area section-padding40 fix mt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Our featured experiments</h2>
                        </div>
                    </div>
                </div>
                <div class="courses-actives">
                    @foreach ($feature_topics as $item)
                                            <!-- Single -->
                    <div class="properties pb-20">
                        <div class="properties__card">
                            <div class="properties__img overlay1">
                                <a href="#"><img src="{{ $item->image }}" alt="{{ $item->name }}" style="max-width:360px;max-height:360px; "></a>
                            </div>
                            <div class="properties__caption">
                                <p>{{ $item->contentType->name }}</p>
                                <h3><a href="#">{{ $item->title }}</a></h3>
                                <p>{!! $item->short_description !!}</p>

                                </p>
                                <div class="properties__footer d-flex justify-content-between align-items-center">
                                    <div class="restaurant-name">
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half"></i>
                                        </div>
                                        <p><span>{{ $item->rating }}</span> based on {{ $item->total_reviews }}</p>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- Single -->
                    @endforeach


                </div>
            </div>
        </div>
        <!-- Courses area End -->
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
                            <p>{!! @$objectives->description !!}</p>
                        </div>
                    </div>

                </div>
                <div class="right-content1">
                    <!-- img -->
                    <div class="right-img">
                        <img src="{{ @$objectives->image }}" alt="Crosscheck Objective" style="max-width:720px;max-height:550;border-radius:5px">
                        
                    </div>
                </div>
            </div>
        </section>
        <!-- About Area End -->
        <!--? top subjects Area Start -->
        {{-- <div class="topic-area section-padding40">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Explore top subjects</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="assets/img/gallery/topic1.png" alt="">
                                <div class="topic-content-box">
                                    <div class="topic-content">
                                        <h3><a href="#">Programing</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="assets/img/gallery/topic2.png" alt="">
                                <div class="topic-content-box">
                                    <div class="topic-content">
                                        <h3><a href="#">Programing</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="assets/img/gallery/topic3.png" alt="">
                                <div class="topic-content-box">
                                    <div class="topic-content">
                                        <h3><a href="#">Programing</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="assets/img/gallery/topic4.png" alt="">
                                <div class="topic-content-box">
                                    <div class="topic-content">
                                        <h3><a href="#">Programing</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="assets/img/gallery/topic5.png" alt="">
                                <div class="topic-content-box">
                                    <div class="topic-content">
                                        <h3><a href="#">Programing</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="assets/img/gallery/topic6.png" alt="">
                                <div class="topic-content-box">
                                    <div class="topic-content">
                                        <h3><a href="#">Programing</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="assets/img/gallery/topic7.png" alt="">
                                <div class="topic-content-box">
                                    <div class="topic-content">
                                        <h3><a href="#">Programing</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-topic text-center mb-30">
                            <div class="topic-img">
                                <img src="assets/img/gallery/topic8.png" alt="">
                                <div class="topic-content-box">
                                    <div class="topic-content">
                                        <h3><a href="#">Programing</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="section-tittle text-center mt-20">
                            <a href="courses.html" class="border-btn">View More Subjects</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- top subjects End -->
        <!--? About Area-3 Start -->
        @if ($missions)
        <section class="about-area3 fix mb-100">
            <div class="support-wrapper align-items-center">
                <div class="right-content3">
                    <!-- img -->
                    <div class="right-img">
                        <img src="{{ @$missions->image }}" alt="Crosscheck Mission" style="max-width:720px;max-height:550;border-radius:5px">
                    </div>
                </div>
                <div class="left-content3">
                    <!-- section tittle -->
                    <div class="section-tittle section-tittle2 mb-20">
                        <div class="front-text">
                            <h2 class="">{{@$missions->title}}</h2>
                        </div>
                    </div>
                    <div class="single-features">
                        <div class="features-icon">
                            <img src="{{('frontend/assets/img/icon/right-icon.svg')}}" alt="">
                        </div>
                        <div class="features-caption">
                            {!! $missions->description !!}
                        </div>
                    </div>

                </div>
            </div>
        </section>
        @endif

        <!-- plan Area start -->
        <div class="courses-area section-padding40 fix ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Subscription Plan</h2>
                        </div>
                    </div>
                </div>
                <div class="courses-actives">
                    @foreach ($plan as $item)
                                            <!-- Single -->
                    <div class="properties pb-20">
                        <div class="properties__card">

                            <div class="properties__caption">
                                <p>${{ $item->price }}</p>
                                <h3><a href="#">{{ $item->name }}</a></h3>
                                <h5>{{$item->duration}} days</h5>
                                <p>{!! $item->description !!}</p>
                                @if ($subscription && $subscription->plan_id == $item->id && $subscription->expires_at > now())
                                    <span class="badge badge-success">Subscribed</span>
                                @elseif ($subscription && $subscription->plan_id != $item->id )
                                    <span class="badge badge-warning">Subscribed to another plan</span>
                                @else
                                 <a href="{{ route('buy.subscription', $item->id) }}" class="btn hero-btn" >Subscribe Now</a>
                                @endif
                               
                           

                            </div>

                        </div>
                    </div>
                    <!-- Single -->
                    @endforeach


                </div>
            </div>
        </div>
        <!-- plan Area End -->

        <!-- About Area End -->
        <!--? Team -->
        {{-- <section class="team-area section-padding40 fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Community experts</h2>
                        </div>
                    </div>
                </div>
                <div class="team-active">
                    <div class="single-cat text-center">
                        <div class="cat-icon">
                            <img src="assets/img/gallery/team1.png" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="services.html">Mr. Urela</a></h5>
                            <p>The automated process all your website tasks.</p>
                        </div>
                    </div>
                    <div class="single-cat text-center">
                        <div class="cat-icon">
                            <img src="assets/img/gallery/team2.png" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="services.html">Mr. Uttom</a></h5>
                            <p>The automated process all your website tasks.</p>
                        </div>
                    </div>
                    <div class="single-cat text-center">
                        <div class="cat-icon">
                            <img src="assets/img/gallery/team3.png" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="services.html">Mr. Shakil</a></h5>
                            <p>The automated process all your website tasks.</p>
                        </div>
                    </div>
                    <div class="single-cat text-center">
                        <div class="cat-icon">
                            <img src="assets/img/gallery/team4.png" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="services.html">Mr. Arafat</a></h5>
                            <p>The automated process all your website tasks.</p>
                        </div>
                    </div>
                    <div class="single-cat text-center">
                        <div class="cat-icon">
                            <img src="assets/img/gallery/team3.png" alt="">
                        </div>
                        <div class="cat-cap">
                            <h5><a href="services.html">Mr. saiful</a></h5>
                            <p>The automated process all your website tasks.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- Services End -->
        <!--? About Area-2 Start -->
        
        <!-- About Area End -->

        <!-- Download Banner Area Start -->
        <section class="download-banner-area" style="background-image: url('{{ asset(@$quest_links->image) }}'); background-size: cover; background-position: center; padding: 100px 0; background-color: #f7f7f7;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-8">
                        <div class="section-tittle text-center" style="background-color:rgba(247, 247, 247, 0.8); padding: 30px; border-radius: 10px;">
                            <h2>Get Started With Our App</h2>
                            <p style="font-size: 18px; margin-bottom: 30px;">Download our application to get the best experience and access all features directly from your device.</p>
                            <a href="{{ @$quest_links->link }}" class="btn hero-btn" >Download Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Download Banner Area End -->
@endsection