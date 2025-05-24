@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>News</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->

    <section class="blog-page-section">
        <div class="container">
            <div class="row">
                @foreach ($blogs as $key => $value)
                    <div class="col-sm-4">
                        <div class="blog-item">
                            <div class="blog-img">
                                <a href="{{ route('news.details', $value->slug) }}">
                                    <img src="{{ asset($value->image) }}" alt="">
                                </a>
                                <div class="blog-time">
                                    <span
                                        class="date">{{ $value->created_at ? \Carbon\Carbon::parse($value->created_at)->format('d') : '' }}</span>
                                    <span
                                        class="month">{{ $value->created_at ? \Carbon\Carbon::parse($value->created_at)->format('M') : '' }}</span>
                                </div>
                            </div>

                            <div class="blog-content">
                                <a href="{{ route('news.details', $value->slug) }}">
                                    <h4 class="blog-title">{{ $value->title }}</h4>
                                </a>
                                <a href="{{ route('news.details', $value->slug) }}" class="read_more">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
