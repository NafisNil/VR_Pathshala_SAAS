<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> @yield('title') | {{config('app.name')}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/logo/logo_vr.jpg') }}">

	<!-- CSS here -->
	<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/assets/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/progressbar_barfiller.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/gijgo.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animated-headline.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/assets/css/magnific-popup.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/assets/css/fontawesome-all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/assets/css/themify-icons.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/assets/css/slick.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/assets/css/nice-select.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
</head>
<body>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('backend/logo/logo_vr.jpg') }}" alt="VR Pathshala">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start-->


    <main class="login-body" style="background-image: url('{{ asset('frontend/authenticationBackground.jpg') }}')">
        @include('backend.sessionMsg')
        <!-- Login Admin -->
        @yield('content')
        <!-- /end login form -->
    </main>


    <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="{{ asset('frontend/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <!-- Jquery Mobile Menu -->
    <script src="{{ asset('frontend/assets/js/jquery.slicknav.min.js') }}"></script>

    <!-- Video bg -->
    <script src="{{ asset('frontend/assets/js/jquery.vide.js') }}"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/slick.min.js') }}"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/animated.headline.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.js') }}"></script>

    <!-- Date Picker -->
    <script src="{{ asset('frontend/assets/js/gijgo.min.js') }}"></script>
    <!-- Nice-select, sticky -->
    <script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.sticky.js') }}"></script>
    <!-- Progress -->
    <script src="{{ asset('frontend/assets/js/jquery.barfiller.js') }}"></script>
    
    <!-- counter , waypoint,Hover Direction -->
    <script src="{{ asset('frontend/assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/hover-direction-snake.min.js') }}"></script>

    <!-- contact js -->
    <script src="{{ asset('frontend/assets/js/contact.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.form.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/mail-script.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.ajaxchimp.min.js') }}"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="{{ asset('frontend/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    
    </body>
</html>