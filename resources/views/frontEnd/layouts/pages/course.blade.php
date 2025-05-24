@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>Courses</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->
    
    <!-- COURSES SECTION START -->
    <section class="service-section section-padding">
        <div class="container">
            <div class="allheader-title">
                <h4>ALL COURSES </h4>
            </div>
            <div class="row">
                @foreach ($service_all as $key => $value)
                    <div class="col-sm-4">
                        <div class="service-item">
                            <a href="{{ route('service.details', $value->slug) }}" class="service-title">{{ $value->title }}</a>
                            <div class="service-item-img">
                                <a href="{{ route('service.details', $value->slug) }}">
                                    <img src="{{ asset($value->image) }}" alt="">
                                </a>
                            </div>
                            <div class="service-item-content">
                                <!-- <p>{!! $value->short_description !!}</p> -->
                                <ul>
                                    <li>
                                        <p><i class="fa-regular fa-clock"></i><strong>duration</strong> {{$value->duration}}</p>
                                    </li>
                                    <li>
                                        <p><i class="fa-solid fa-certificate"></i><strong>certificate</strong> on completion</p>
                                    </li>
                                    <li>
                                        <p><i class="fa-solid fa-chart-line"></i><strong>Lavel</strong> {{$value->level}}</p>
                                    </li>
                                    <li>
                                        <p><i class="fa-solid fa-layer-group"></i><strong>Platform</strong> {{$value->platform}} </p>
                                    </li>
                                </ul>
                            </div>
                            <div class="course-price">
                                <div class="course-name">
                                    <p> Course Fee</p>
                                </div>
                                <div class="course-amount">
                                    <p>TK. {{ $value->coursefee}}</p>
                                </div>
                            </div>
                            <div class="main-order-btn">
                                <div class="learn-more">
                                    <a href="{{ route('service.details', $value->slug) }}">Learn More</a>
                                </div>
                                <div class="enrol-now">
                                    <a href="{{ route('service.details', $value->slug) }}">Enroll Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- COURCES SECTION END -->
    
    
@endsection
