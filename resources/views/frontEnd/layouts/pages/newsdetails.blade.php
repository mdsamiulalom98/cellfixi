@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>{{ $details->title }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->

    <section class="service-details-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="section-inner">
                        <div class="details-breadcrumb">
                            <ul id="breadcrumbs" class="breadcrumbs">
                                <li class="item-home">
                                    <a class="bread-link bread-home" href="{{ route('home') }}" title="Home">Home</a>
                                </li>
                                <li class="separator separator-home"> <span></span> </li>
                                <li class="item-cat"><a href="{{ route('blogs') }}">Latest Articale</a></li>
                                <li class="separator"> <span></span> </li>
                                <li class="item-current"><span class="bread-current bread-107"
                                        title="Smartwatch Buying Guide with Features to Look For">{{ $details->title }}</span>
                                </li>
                            </ul>
                        </div>

                        <h1>{{ $details->title }}</h1>

                        <div class="service-details-image">
                            <img src="{{ asset($details->image) }}" alt="">
                        </div>

                        <div class="service-details-description">
                            {!! $details->description !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="sidebar-inner">
                        <div class="sidebar-title">
                            <span class="text">
                                <span>Articales Category</span>
                            </span>
                        </div>

                        <div class=articale-list>
                            <div class="articale-inner">
        
                                <div class="articale-item-wrapper">
                                    <ul>
                                        @foreach ($menucategories as $key => $value)
                                            <li class="details-articale">
                                                <div class="articale-item-details">
                                                    <a href="{{ route('category', $value->slug) }}"  rel="nofollow">
                                                        
                                                        <span class="articale-right-details">
                                                            {{ $value->name }}
                                                        </span>
                                                    </a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end-col -->
                    <div class="sidebar-inner">
                        <div class="sidebar-title">
                            <span class="text">
                                <span>Latest Articales</span>
                            </span>
                        </div>

                        <div class="sidebar-item-wrapper">
                            <ul>
                                @foreach ($blogs as $key => $value)
                                    <li>
                                        <div class="item">
                                            <a href="{{ route('news.details', $value->slug) }}"  rel="nofollow">
                                                <span class="left">
                                                    <img loading="lazy"
                                                        src="{{ asset($value->image) }}"
                                                        alt="{{ $value->title }}">
                                                </span>
                                                <span class="right">
                                                    {{ $value->title }}
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- end-col -->
                </div>
            </div>
        </div>
    </section>
@endsection
