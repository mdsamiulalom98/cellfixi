@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@push('seo')
    <meta name="app-url" content="" />
    <meta name="robots" content="index, follow" />
    <meta name="description" content="{{ $generalsetting->meta_description }}" />
    <meta name="keywords" content="{{ $generalsetting->meta_keyword }}" />
    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $generalsetting->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="{{ asset($generalsetting->white_logo) }}" />
    <meta property="og:description" content="{{ $generalsetting->meta_description }}" />
    <!-- LightGallery CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery-bundle.min.css" />
@endpush
@section('content')
    <style>
        svg {
            height: 130px;
            width: 130px;
        }

        .success-ratio-section {
            margin-top: 50px;
        }

        .success-ratio {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .circle {
            position: relative;
            width: 143px;
            height: 130px;
        }

        svg {
            transform: rotate(-90deg);
        }

        circle {
            fill: none;
            stroke-width: 10;
            stroke-linecap: round;
            transition: stroke-dashoffset 2s ease-in-out;
        }

        .text {
            position: absolute;
            top: 50%;
            left: 46%;
            transform: translate(-50%, -50%);
            font-size: 15px;
            font-weight: bold;
            text-align: center;
        }

        .cursor {
            display: inline-block;
            font-weight: bold;
            font-size: 1em;
            background-color: #fff;
            animation: blink 0.7s steps(2, start) infinite;
            width: 2px;
            height: 30px;
        }

        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
    <!-- SLIDER SECTION START -->
    <section class="slider-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 order-sm-1 order-2">
                    <div class="slider-title">
                        <p>Professional</p>
                        <div id="text-container">
                            @foreach ($sliders as $key => $value)
                                <div class="text-line">{{ $value->title }}</div>
                            @endforeach
                        </div>

                        <div class="slider-buttons">
                            <a href="{{ route('about_us') }}" class="slider-btn white-button">About Us</a>
                            <a href="{{ route('contact') }}" class="slider-btn transparent-button">Contact Us</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 order-sm-2 order-1">
                    <div class="main-slider owl-carousel owl-theme">
                        @foreach ($sliders as $key => $value)
                            <div class="slider-item">
                                <a href="{{ $value->link }}">
                                    <img src="{{ asset($value->image) }}" alt="" />
                                </a>
                            </div>
                            <!-- slider item -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="ceoModal" tabindex="-1" aria-labelledby="ceoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="" class="img-fluid mb-3">
                    <h5 id="modalName"></h5>
                    <p id="modalDesignation" class="mb-1 text-muted"></p>
                    <p id="modalDescription"></p>
                </div>
            </div>
        </div>
    </div>

    <section class="sub__cat__front__view">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="cat__image__title">
                        <h2>Service Category</h2>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="main__sec__subcat_front">
                        @foreach ($image_cat as $key => $value)
                            <div class=" wow animate__bounceIn" data-wow-duration="0.6s"
                                data-wow-delay="{{ $key * 0.1 }}s">

                                <div class="item__subcat ">
                                    <div class="subcat__image"><a href="{{ route('category', $value->slug) }}"><img
                                                src="{{ asset($value->image) }}" alt=""></a></div>
                                    <div class="subcat__name"><a href="{{ route('category', $value->slug) }}">
                                            <p>{{ $value->name }}</p>
                                        </a></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- about starts -->
    <section class="about-us">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 wow animate__bounceIn" data-wow-duration="1s">
                    <div class="about__image">
                        <img src="{{ asset($about->image) }}" alt="">

                    </div>
                </div>
                <div class="col-sm-6 wow animate__bounceIn" data-wow-duration="1s">
                    <div class="about__content__wrapper">
                        <div class="about__title">
                            <h2>{!! $about->title !!}</h2>
                            <h2>{!! $about->subtitle !!}</h2>
                        </div>
                        <hr>
                        <div class="about__content">
                            <p>{!! $about->description !!}</p>
                            <div class="about-button-wrapper">
                                <a href="{{ route('about_us') }}">
                                    About Us
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="service-counter-wrapper">
                <div class="row">
                    @foreach ($counters as $key => $value)
                        <div class="col-sm-3 wow animate__bounceIn" data-wow-duration="1s"
                            data-wow-delay="{{ $key * 0.1 }}s">
                            <div class="service-stat-item">
                                <div class="service-item-image">
                                    <img src="{{ asset($value->image) }}" alt="{{ $value->title }}" class="">
                                </div>
                                <h2 class="">{{ $value->counter }}+</h2>
                                <h3 class="">{{ $value->title }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- about ends -->
    <section class="our-promise-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="content">
                        <div class="title wow animate__bounceIn" data-wow-duration="1s"
                                        data-wow-delay="{{ $key * 0.3 }}s">
                            <h2>{!! $our_promise->title !!}</h2>
                        </div>
                        <hr>
                        <div class="description wow animate__bounceIn" data-wow-duration="1s"
                                        data-wow-delay="{{ $key * 0.3 }}s">
                            {!! $our_promise->description !!}
                        </div>
                        <div class="success-rate-wrapper">
                            @foreach ($success_rates as $key => $value)
                                <div class="success-rate-item wow animate__bounceIn" data-wow-duration="1s"
                                        data-wow-delay="{{ $key * 0.3 }}s" style="width: {{ $value->count }}%" >
                                    <strong>{{ $value->title }}</strong>
                                    <span>{{ $value->count }}%</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="image wow animate__bounceIn" data-wow-duration="1s"
                                        data-wow-delay="{{ $key * 0.3 }}s">
                        <img src="{{ asset($our_promise->image) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about ends -->
    <section class="service-quality-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="service-item-wrapper">
                        @foreach ($service_items as $key => $value)
                            @if ($loop->index >= 2)
                                @break
                            @endif
                            <div class="service-item wow animate__bounceIn" data-wow-duration="1s"
                                data-wow-delay="{{ $key * 0.3 }}s">
                                <div class="image">
                                    <img src="{{ asset($value->image) }}" alt="">
                                </div>
                                <div class="title">
                                    <h3>{{ $value->title }}</h3>
                                </div>
                                <div class="description">
                                    <p>{!! $value->description !!}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="content wow animate__bounceIn" data-wow-duration="1s"
                                        data-wow-delay="{{ $key * 0.3 }}s">
                        <div class="title">
                            <h2>{!! $service_quality->title !!}</h2>
                        </div>
                        <hr>
                        <div class="description">
                            {!! $service_quality->description !!}
                        </div>
                        <div class="link-button">
                            <a href="{{ route('category', $service_quality->link) }}">
                                View More
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="service-item-wrapper">
                        @foreach ($service_items as $key => $value)
                            @if ($loop->index < 2)
                                @continue
                            @endif
                            <div class="service-item wow animate__bounceIn" data-wow-duration="1s"
                                data-wow-delay="{{ $key * 0.3 }}s">
                                <div class="image">
                                    <img src="{{ asset($value->image) }}" alt="">
                                </div>
                                <div class="title">
                                    <h3>{{ $value->title }}</h3>
                                </div>
                                <div class="description">
                                    <p>{!! $value->description !!}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- about ends -->
    <!-- about ends -->
    <!-- about ends -->

    <section class="home-page-products">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h3>All Service</h3>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="category-list-wrapper">
                        <ul>
                            @foreach ($categories as $key => $value)
                                <li class="{{ $loop->first ? 'active' : '' }}">
                                    <a href="{{ route('category', $value->slug) }}">
                                        {{ $value->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="product-list-wrapper">
                        @foreach ($products as $key => $value)
                            <div class="product_item wist_item wow animate__fadeIn" data-wow-duration="1s"
                                data-wow-delay="{{ $key * 0.1 }}s">
                                @include('frontEnd.layouts.partials.product')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="best-feature-section">
        <div class="container">
            <div class="row">
                <div class="section-title">
                    <h3><span>{{ $generalsetting->name }}</span> Best Features</h3>
                </div>
            </div>
            <div class="row">
                @foreach ($best_features as $key => $value)
                    <div class="col-sm-4 wow animate__bounceIn" data-wow-duration="1s"
                        data-wow-delay="{{ $key * 0.3 }}s">
                        <div class="best-feature-item">
                            <div class="image">
                                <div class="feature-reveal wow animate__backInUp" data-wow-duration="0.5s"></div>
                                <img src="{{ asset($value->image) }}" alt="">
                            </div>
                            <div class="title">
                                <h3>{{ $value->title }}</h3>
                            </div>
                            <div class="description">
                                {!! $value->description !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="how-work-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-11">
                    <div class="section-title">
                        <h3>How <span>{{ $generalsetting->name }}</span> Works</h3>
                    </div>
                    <div class="how-work-container">
                        <div class="how-work-items-wrapper wow animate__bounceIn" data-wow-duration="1s"
                            data-wow-delay="{{ $key * 0.3 }}s">
                            @foreach ($how_works as $key => $value)
                                @if ($loop->index >= 3)
                                    @break
                                @endif
                                <div class="how-work-item  ">
                                    <div class="image">
                                        <div class="feature-reveal wow animate__backInUp" data-wow-duration="0.5s"></div>
                                        <img src="{{ asset($value->image) }}" alt="">
                                    </div>
                                    <div class="content">

                                        <div class="index">
                                            <h2>
                                                {{ $key + 1 }}
                                            </h2>
                                        </div>
                                        <div class="title">
                                            <h3>{{ $value->title }}</h3>
                                        </div>
                                        <div class="description">
                                            {!! $value->description !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="how-work-items-wrapper second-wrapper wow animate__bounceIn" data-wow-duration="1s"
                            data-wow-delay="{{ $key * 0.3 }}s">
                            @foreach ($how_works as $key => $value)
                                @if ($loop->index < 3 || $loop->index > 4)
                                    @continue
                                @endif
                                <div class="how-work-item">
                                    <div class="image">
                                        <div class="feature-reveal wow animate__backInUp" data-wow-duration="0.5s"></div>
                                        <img src="{{ asset($value->image) }}" alt="">
                                    </div>
                                    <div class="content">

                                        <div class="index">
                                            <h2>
                                                {{ $key + 1 }}
                                            </h2>
                                        </div>
                                        <div class="title">
                                            <h3>{{ $value->title }}</h3>
                                        </div>
                                        <div class="description">
                                            {!! $value->description !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="how-work-items-wrapper third-wrapper wow animate__bounceIn" data-wow-duration="1s"
                            data-wow-delay="{{ $key * 0.3 }}s">
                            @foreach ($how_works as $key => $value)
                                @if ($loop->index < 5)
                                    @continue
                                @endif
                                <div class="how-work-item">
                                    <div class="image">
                                        <div class="feature-reveal wow animate__backInUp" data-wow-duration="0.5s"></div>
                                        <img src="{{ asset($value->image) }}" alt="">
                                    </div>
                                    <div class="content">

                                        <div class="index">
                                            <h2>
                                                {{ $key + 1 }}
                                            </h2>
                                        </div>
                                        <div class="title">
                                            <h3>{{ $value->title }}</h3>
                                        </div>
                                        <div class="description">
                                            {!! $value->description !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if ($whychooseinfo)
        <section class="why-choose-us">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            @foreach ($whychoose as $key => $value)
                                <div class="col-sm-6">
                                    <div class="why-choose-item wow animate__bounceIn" data-wow-duration="1s"
                                        data-wow-delay="{{ $key * 0.3 }}s">
                                        <div class="image-wrapper">
                                            <div class="image">
                                                <img src="{{ asset($value->image) }}">
                                            </div>
                                        </div>
                                        <div class="content">
                                            <h3>{{ $value->title }}</h3>
                                            <p>{!! $value->description !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- <section class="corporet__video__presentation">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="corporate__video_title">
                        <h3>CORPORATE VIDEO PRESENTATION OF AMG </h3>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="corporate_video">
                        @foreach ($videos as $key => $value)
                            <div class="video_items wow animate__bounceIn" data-wow-duration="1.5s"
                                data-wow-delay="0.{{ $key }}s">
                                <iframe src="https://www.youtube.com/embed/{{ $value->video }}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- ============MOST POPULAR COUNTRY-DESING START ================= -->
    {{-- <div class="brand-carousel-area" style="background-image: url('{{ asset('public/frontEnd/images/bu.jpg') }}');">
        <div class="container">
            <div class="common-heading">
                <h5>Trusted Parnter</h5>
            </div>
            <div class="brand-carousel-inner" id="brandCarousels">
                @foreach ($brands as $key => $value)
                    <div class="membership-item">
                        <div class="membership-image">
                            <a href="">
                                <img src="{{ asset($value->image) }}" alt="">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div> --}}
    {{-- <section class="awards">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="certificate__header">
                        <div class="main__ser_title">
                            <h2 class="section-title text-white">AWARD & CERTIFICATIONS</h2>
                        </div>
                        <div class="certificate__view__all"><a href="{{ route('certificate') }}">View All</a></div>
                    </div>
                </div>
            </div>
            <div class="row" id="lightgallery">
                @foreach ($certificate as $key => $value)
                    <div class="col-sm-4" data-src="{{ asset($value->image) }}">
                        <div class="certificate">
                            <a href=""> <img src="{{ asset($value->image) }}" alt=""></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section> --}}
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const items = document.querySelectorAll('.message__item');

            items.forEach(item => {
                item.addEventListener('click', function() {
                    const image = this.getAttribute('data-image');
                    const name = this.getAttribute('data-name');
                    const designation = this.getAttribute('data-designation');
                    const description = this.getAttribute('data-description');

                    document.getElementById('modalImage').src = image;
                    document.getElementById('modalName').innerText = name;
                    document.getElementById('modalDesignation').innerText = designation;
                    document.getElementById('modalDescription').innerText = description;

                    const modal = new bootstrap.Modal(document.getElementById('ceoModal'));
                    modal.show();
                });
            });
        });
    </script>


    <!-- LightGallery JS -->
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/lightgallery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/zoom/lg-zoom.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/thumbnail/lg-thumbnail.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            lightGallery(document.getElementById('lightgallery'), {
                selector: '.item__subcat',
                plugins: [lgZoom, lgThumbnail],
                speed: 500,
            });
        });
    </script>
    <script>
        const lines = document.querySelectorAll('#text-container .text-line');
        let currentIndex = 0;

        function showNextLine() {
            lines.forEach(line => line.classList.remove('active'));
            lines[currentIndex].classList.add('active');

            currentIndex = (currentIndex + 1) % lines.length;
        }

        // Initial show
        showNextLine();

        // Change every 2 seconds
        setInterval(showNextLine, 2000);
    </script>
@endpush
