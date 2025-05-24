@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>About Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->


    <!-- ABOUT US START -->
    <section class="section-padding about-section">
        <div class="container">
            @foreach ($about as $key => $value)
                <div class="row justify-content-center">
                    <div class="col-sm-6">
                        <div class="about-content">
                            <h3>{{ $value->title }}</h3>
                            <div>{!! $value->description !!}</div>
                        </div>
                    </div>
                    <!-- col end -->
                    <div class="col-sm-6">
                        <div class="about-image">
                            <img src="{{ asset($value->image) }}" alt="">
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row">
                @foreach ($mission as $key => $value)
                    <div class="col-sm-6 mt-5">
                        <div class="mission-vision">
                            <h3>{{ $value->title }}</h3>
                            <div>{!! $value->description !!}</div>
                        </div>
                    </div>
                     <div class="col-sm-6 mt-5">
                        <div class="about-image">
                            <img src="{{ asset($value->image) }}" alt="">
                        </div>
                    </div>
                @endforeach
                @foreach ($vision as $key => $value)
                    <div class="col-sm-6 mt-5">
                        <div class="about-image">
                            <img src="{{ asset($value->image) }}" alt="">
                        </div>
                    </div>
                    <div class="col-sm-6 mt-5">
                        <div class="mission-vision">
                            <h3>{{ $value->title }}</h3>
                            <div>{!! $value->description !!}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ABOUT US END -->


@endsection
