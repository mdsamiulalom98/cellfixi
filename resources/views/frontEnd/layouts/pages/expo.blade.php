@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>Expo gallery</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->
    
    <!-- ======= CLIENT DESIGN START ======== -->
    <section class="client-photos expo-gallery">
        <div class="container">

            <div class="all-country">
                @foreach ($blogs as $key => $value)
                    <div class="blog-item">
                        <div class="blog-img">
                            <a href="{{ route('blog.details', $value->slug) }}">
                                <img src="{{ asset($value->image) }}" alt="">
                            </a>
                        </div>

                        <div class="blog-content">
                            <a href="{{ route('blog.details', $value->slug) }}">
                                <h4 class="blog-title">{{ $value->title }}</h4>
                                <p>{!! Str::words($value->description, 30, '...') !!}</p>
                            </a>
                            <div class="articale-date">
                                <!-- <div class="blog-times">
                                    <span class="date-time">
                                        {{ $value->created_at ? \Carbon\Carbon::parse($value->created_at)->format('F d, Y') : '' }}
                                    </span>
                                </div> -->
                                <a href="{{ route('blog.details', $value->slug) }}" class="read_more">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>




        </div>
    </section>
    <!-- ======= CLIENT DESIGN END ======== -->
    
    
@endsection
