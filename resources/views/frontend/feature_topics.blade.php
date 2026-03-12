@extends('frontend.layouts.master')
@section('title')
    Featured Topics
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
                                    <h1 data-animation="bounceIn" data-delay="0.2s">Featured Topics</h1>
                                    <!-- breadcrumb Start-->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <x-home-link />
                                            <li class="breadcrumb-item"><a href="#">Featured Topics</a></li> 
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
        <!-- Courses area start -->
        <div class="courses-area section-padding40 fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Our Featured Topics</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($feature_topics as $item)
                    <div class="col-lg-4">
                        <div class="properties properties2 mb-30">
                            <div class="properties__card">
                                <div class="properties__img overlay1">
                                    <a href="#"><img src="{{ $item->image }}" alt=""></a>
                                </div>
                                <div class="properties__caption">
                                    <p>{{ $item->contentType->name }}</p>
                                    <h3><a href="#">{{ $item->name }}</a></h3>
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
                    </div>
                    @endforeach


                </div>

            </div>
        </div>
        <!-- Courses area End -->

@endsection