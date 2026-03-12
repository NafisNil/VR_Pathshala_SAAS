@extends('frontend.layouts.master')
@section('title')
    Content Rating
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
                                    <h1 data-animation="bounceIn" data-delay="0.2s">Content Rating</h1>
                                    <!-- breadcrumb Start-->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <x-home-link />
                                            <li class="breadcrumb-item"><a href="#">Content Rating</a></li> 
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
                    <h3 class="mb-4" style="font-weight: 600;">Rate Content</h3>
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('submit-content-rating') }}" method="POST">
                        @csrf
                        
                        <div class="form-group mb-4">
                            <label for="feature_topic_id" style="font-weight: 500;" class="ml-5">Select Content</label>
                            <select class="form-control" id="feature_topic_id" name="feature_topic_id" style="border-radius: 4px; border: 1px solid #ced4da; padding: 10px 15px;" required>
                                <option value="" selected disabled>Select a topic</option>
                                @foreach($feature_topic as $topic)
                                    <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                @endforeach
                            </select>
                            @error('feature_topic_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="rating" style="font-weight: 500;" class="ml-5">Rating</label>
                            <select class="form-control" id="rating" name="rating" style="border-radius: 4px; border: 1px solid #ced4da; padding: 10px 15px;" required>
                                <option value="" selected disabled>Select rating</option>
                                <option value="5">5 - Excellent (⭐⭐⭐⭐⭐)</option>
                                <option value="4">4 - Very Good (⭐⭐⭐⭐)</option>
                                <option value="3">3 - Good (⭐⭐⭐)</option>
                                <option value="2">2 - Fair (⭐⭐)</option>
                                <option value="1">1 - Poor (⭐)</option>
                            </select>
                            @error('rating')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>



                        <button type="submit" class="btn btn-primary mt-3" style="background-color: #b33969; border-color: #b33969; padding: 12px 30px; font-weight: 600; letter-spacing: 0.5px;">SUBMIT RATING</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection