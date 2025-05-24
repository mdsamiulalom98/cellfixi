<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') - {{ $generalsetting->name }}</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset($generalsetting->favicon) }}" alt="Websolution IT" />
    <meta name="author" content="Websolution IT" />
    <link rel="canonical" href="" />
    @stack('seo')
    @stack('css')
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/wppagebuilder.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/assets/css/toastr.min.css" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/lightgallery.css" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/twentytwenty.css" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/style.css?v=1.0.18') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/responsive.css?v=1.0.23') }}" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="gotop">
    <header>
        <!-- LOGO & MENU  START -->
        <div class="logo-area" id="navbar_top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="logo-menu">
                            <div class="logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset($generalsetting->dark_logo) }}" alt="">
                                </a>
                            </div>
                            <div class="main-menu">
                                <div class="main__menu__menu">
                                    <ul>
                                        <li><a href="{{ route('home') }}" class="main-menu-link">Home</a></li>
                                        <li><a href="{{ route('about_us') }}" class="main-menu-link">About Us</a></li>
                                        {{--
                                            <li class="dropdown-wrapper"><a href="" class="main-menu-link">About Us</a>
                                            <ul class="custom-dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('profile') }}">Company
                                                        Profile</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('ceomessage') }}">Director
                                                        Message</a>
                                                </li>


                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('certificate') }}">Certificate</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('machine-list') }}">Machine
                                                        List</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('clients') }}">Trusted
                                                        Partner</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item" href="{{ route('ourteam') }}">Our Team</a>
                                                </li>
                                                @foreach ($pages as $key => $value)
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('page', $value->slug) }}">{{ $value->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li> --}}

                                        <li class="dropdown-wrapper">
                                            <a href="" class="main-menu-link">Services</a>
                                            <ul class="custom-dropdown-menu">
                                                @foreach ($categories as $key => $value)
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('category', $value->slug) }}">
                                                            {{ $value->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('blogs') }}" class="main-menu-link">Blog</a>
                                        </li>

                                        {{-- <li><a href="{{ route('sustainability') }}" class="main-menu-link">SUSTAINABILITY</a></li> --}}
                                        <li><a href="{{ route('contact') }}" class="main-menu-link">Contact Us</a></li>

                                    </ul>
                                </div>
                                <div class="main-search">
                                    <form action="{{ route('search') }}">
                                        <button><i class="fa fa-search"></i></button>
                                        <input type="text" placeholder="Search Service..."
                                            class="msearch_keyword msearch_click" name="keyword" />
                                    </form>
                                    <div class="search_result"></div>
                                </div>
                                <div class="booking-button-wrapper">
                                    <a href="">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- LOGO & MENU  END -->
    </header>

    <div class="mobile-header">
        <div class="mobile-logo">
            <div class="menu-logo">
                <a href="{{ route('home') }}"><img src="{{ asset($generalsetting->white_logo) }}" alt=""></a>
            </div>
            <div class="menu-bar">
                <a class="toggle" id="toggle">
                    <span class="bar-one"></span>
                    <span class="bar-two"></span>
                    <span class="bar-three"></span>
                </a>
            </div>
        </div>
    </div>

    <div class="mobile-menu ">
        <div class="mobile-menu-wrap">
            <div class="user-and-notification">
                <div class="mobile-auth">
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">
                                <img src="{{ asset($generalsetting->white_logo) }}" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="mobile-nav">
                <li><a href="{{ route('home') }}">Home</a></li>
                {{-- <li>
                    <button class="" type="button" data-bs-toggle="collapse" data-bs-target="#country"
                        aria-expanded="false" aria-controls="country">
                        About Us
                    </button>
                    <div class="collapse" id="country">
                        <ul>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile') }}">Company Profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('ceomessage') }}">Director Message</a>
                            </li>
                            <li>

                            <li>
                                <a class="dropdown-item" href="{{ route('certificate') }}">Certificate</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('machine-list') }}">Machine List</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('clients') }}">Trusted Partner</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('ourteam') }}">Our Team</a>
                            </li>
                            @foreach ($pages as $key => $value)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('page', $value->slug) }}">{{ $value->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li> --}}


                <li class="">
                    <a href="{{ route('about_us') }}">About Us</a>
                </li>
                <li>
                    <button class="" type="button" data-bs-toggle="collapse" data-bs-target="#blog"
                        aria-expanded="false" aria-controls="blog">
                        Services
                    </button>
                    <div class="collapse" id="blog">
                        <ul>
                            @foreach ($categories as $key => $value)
                                <li>
                                    <a class="dropdown-item" href="{{ route('category', $value->slug) }}">
                                        {{ $value->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>

                <li class="">
                    <a href="{{ route('blogs') }}" class="main-menu-link">Blog</a>
                </li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
            </ul>
        </div>
    </div>
    @yield('content')

    <footer class="footer-area">

        <div class="footer-top-area no-print">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="footer-about widget-body">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset($generalsetting->dark_logo) }}" alt="" />
                            </a>
                            <!--<p>{!! Str::words($generalsetting->about_footer, 20, '...') !!}</p>-->

                            <ul class="social_link mt-3">
                                @foreach ($socialicons as $value)
                                    <li>
                                        <a href="{{ $value->link }}"><i class="{{ $value->icon }}"></i></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- col end -->
                    <div class="col-sm-3">
                        <div class="footer-menu extrao-ft-menu">
                            <ul>
                                <li class="title "><a>Quick Links</a></li>
                                <div class="footer-bootom"></div>

                                <li><a href="{{ route('about_us') }}">About Us <i
                                            class="fa-solid fa-angles-right"></i></a></li>
                                {{-- <li><a href="{{ route('sustainability') }}">Sustainability <i
                                            class="fa-solid fa-angles-right"></i></a></li> --}}
                                <li><a href="{{ route('blogs') }}">Blogs <i
                                            class="fa-solid fa-angles-right"></i></a></li>
                                <li> <a class="dropdown-item" href="{{ route('contact') }}">Contact Us <i
                                            class="fa-solid fa-angles-right"></i></a></li>
                                <div class="footer-bootom"></div>

                            </ul>
                        </div>
                    </div>
                    <!-- col end -->
                    <div class="col-sm-3">
                        <div class="footer-menu extrao-ft-menu">
                            <ul>
                                <li class="title"><a>Services</a></li>
                                <div class="footer-bootom"></div>
                                @foreach ($categories as $key => $value)
                                <li><a href="{{ route('category', $value->slug) }}">{{ $value->name }} <i
                                    class="fa-solid fa-angles-right"></i></a></li>
                                @endforeach
                                <div class="footer-bootom"></div>
                            </ul>
                        </div>
                    </div>
                    <!-- col end -->

                    <div class="col-sm-4">
                        <div class="footer-menu extrao-ft-menu">
                            <ul>
                                <li class="title"><a>Address</a></li>
                                <div class="footer-bootom"></div>
                                <p class="mb-2"><strong>Address : </strong>{{ $contact->address }}</p>
                                <p class="mb-2"><strong>Phone : </strong>{{ $contact->phone }} ,
                                    {{ $contact->hotline }}</p>
                                <p><strong>Email : </strong>{{ $contact->email }} , {{ $contact->hotmail }}</p>
                                <div class="footer-bootom"></div>

                            </ul>
                        </div>
                    </div>
                    <!-- col end -->
                </div>
            </div>
        </div>

        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">© {{ date('Y') }} all right reserved By
                        {{ $generalsetting->name }}
                    </div>
                </div>
            </div>
        </div>

        <div class="floating-button" data-bs-toggle="modal" data-bs-target="#contactModal">

            <a href="https://api.whatsapp.com/send?phone={{ $contact->phone }}" target="_blank">
                <span class="icon-circle">
                    <i class="fa-brands fa-whatsapp"></i>
                </span>
                <span class="contact-text">WhatsApp</span>
            </a>

        </div>

        <div class="scrolltop" style="">
            <div class="scroll">
                <i class="fa-solid fa-plane-up"></i>
            </div>
        </div>
        <!-- //.copyright area -->
    </footer>
    <script src="{{ asset('public/frontEnd/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/jquery.event.move.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/lightgalleryl.min.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/jquery.twentytwenty.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/wow.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/script.js') }}"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/toastr.min.js"></script>
    {!! Toastr::message() !!} @stack('script')

    <script>
        new WOW({
            boxClass: 'wow', // Class name that triggers WOW
            animateClass: 'animated', // Animate.css class (default: 'animated')
            offset: 100, // Distance to start animation (px)
            mobile: true, // Trigger animations on mobile
            live: true, // Act on asynchronously loaded content
            callback: function(box) {
                console.log("WOW: animating <" + box.tagName.toLowerCase() + ">");
            }
        }).init();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    document.getElementById('navbar_top').classList.add('fixed-top');
                    // add padding top to show content behind navbar
                    navbar_height = document.querySelector('#navbar_top').offsetHeight;
                    document.body.style.paddingTop = navbar_height + 'px';
                } else {
                    document.getElementById('navbar_top').classList.remove('fixed-top');
                    // remove padding top from body
                    document.body.style.paddingTop = '0';
                }
            });
        });

        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $(".scrolltop:hidden").stop(true, true).fadeIn();
            } else {
                $(".scrolltop").stop(true, true).fadeOut();
            }
        });
        $(function() {
            $(".scroll").click(function() {
                $("html,body").animate({
                    scrollTop: $(".gotop").offset().top
                }, "1000");
                return false;
            });
        });
    </script>
    <script>
        $(window).on('load', function() {
            $(".portfolio-images").twentytwenty({
                before_label: '',
                after_label: '',
                move_slider_on_hover: true,
                move_with_handle_only: true,
                click_to_move: true
            });
        });
    </script>
    @stack('script')
    <script>
        $(".toggle").on("click", function(event) {
            event.stopPropagation();
            $(".mobile-menu").toggleClass("active");
            $(this).toggleClass('show');
        });
    </script>

    <script>
        $('#portfolio').imagesLoaded(function() {
            var $grid = $('.grid').isotope({});
            $('.portfolio-isotop-btn').on('click', 'button', function() {
                $('button').removeClass("active");
                $(this).addClass("active");
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });
            });
            var $grid = $('.portfolio-inner').isotope({
                itemSelector: '.single-portfolio',
                percentPosition: true,
                masonry: {
                    columnWidth: '.single-portfolio'
                }
            });
        });
        // portfolio js end
        $('#lightgallery').lightGallery();
    </script>
    <script>
        $(document).ready(function() {
            $('.count-number').each(function() {
                var $this = $(this);
                var countTo = $this.text().replace('+', ''); // "+" সাইন বাদ দিয়ে সংখ্যা নেওয়া
                $({
                    countNum: 0
                }).animate({
                    countNum: countTo
                }, {
                    duration: 3000, // ১.৫ সেকেন্ড সময়
                    easing: 'swing',
                    step: function() {
                        $this.text(Math.floor(this.countNum) + " +");
                    },
                    complete: function() {
                        $this.text(this.countNum + " +");
                    }
                });
            });
        });
    </script>
</body>

</html>
