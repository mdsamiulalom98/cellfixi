@extends('frontEnd.layouts.master')
@section('title', $category->meta_title)
@section('content')

   <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>{{ $category->name }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->

    <section class="blog-page-section articale-page">
        <div class="container">
            <div class="row">
                @foreach ($data as $key => $value)
                    <div class="col-sm-4">
                        <div class="blog-item">
                            <div class="blog-img">
                                <a href="{{route('immigration_details',$value->slug)}}">
                                    <img src="{{ asset($value->image) }}" alt="">
                                </a>
                            </div>

                            <div class="blog-content">
                                <a href="{{route('immigration_details',$value->slug)}}">
                                    <h4 class="blog-title">{{ $value->title }}</h4>
                                    <h6>{!! Str::limit(strip_tags($value->description), 150, '...') !!}</h6>
                                </a>
                                <div class="articale-date">
                                    <a href="{{route('immigration_details',$value->slug)}}" class="read_more">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
    </section>


    

@endsection

