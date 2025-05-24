@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>All Articales</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->
    
    <!--========= LATEST ARTICALE SECTION START =========-->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>Latest Articale</h2>
                    </div>
                </div>
            </div>
            <div class="all-articale-category">
                <div class="row">
                    <div class="col-sm-12">
                        <div class=articale-list>
                            <div class="articale-inner">
        
                                <div class="articale-item-wrapper">
                                    <ul>
                                        @foreach ($menucategories as $key => $value)
                                            <li>
                                                <div class="articale-item">
                                                    <a href="{{ route('category', $value->slug) }}"  rel="nofollow">
                                                        
                                                        <span class="articale-right">
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
                </div>
            </div>
            <div class="row">
                @foreach ($blogs as $key => $value)
                    <div class="col-sm-4">
                        <div class="blog-item">
                            <div class="blog-img">
                                <a href="{{ route('blog.details', $value->slug) }}">
                                    <img src="{{ asset($value->image) }}" alt="">
                                </a>
                            </div>

                            <div class="blog-content">
                                <a href="{{ route('blog.details', $value->slug) }}">
                                    <h4 class="blog-title">{{ $value->title }}</h4>
                                    <div class="blog-des">{!! Str::words($value->description, 25, '...') !!}</div>
                                </a>
                                <div class="articale-date">
                                    <div class="blog-times">
                                        <span class="date-time">
                                            {{ $value->created_at ? \Carbon\Carbon::parse($value->created_at)->format('F d, Y') : '' }}
                                        </span>
                                    </div>
                                    <a href="{{ route('blog.details', $value->slug) }}" class="read_more">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--========= LATEST ARTICALE SECTION END ========= -->
@endsection
