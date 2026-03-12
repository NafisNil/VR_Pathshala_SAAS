<header>
        <!-- Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header ">
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="{{ route('index') }}"><img src="{{ asset('backend/logo/logo_vr.jpg') }}" alt="VR Pathshala" style="max-width:64px; border-radius:5px"></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">                                                                                          
                                                <li class="active" ><a href="{{ route('index') }}">Home</a></li>
                                                <li><a href="{{ route('featureTopics') }}">Featured Topics</a></li>
                                                <li><a href="{{ route('abouts') }}">About</a></li>

                                                <li><a href="{{ route('contact') }}">Contact</a></li>
                                                <!-- Button -->
                                                @if (@Auth::user())
                                                   
                                                    <li class="button-header"><a href="{{ route('user.dashboard') }}" class="btn btn3">{{ @Auth::user()->name }}</a></li>
                                                @else
                                                    <li class="button-header"><a href="{{ route('login.form') }}" class="btn btn3">Log in</a></li>
                                                @endif
                                                
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div> 
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>