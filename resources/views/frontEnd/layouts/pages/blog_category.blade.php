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
    @if($category->description)
    <section class="category_des">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="des__cat"><p>{{$category->description}}</p></div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <section class="blog-page-sections articale-page">
        <div class="container">
            <div class="row">
                @foreach ($category->images as $key => $value)
                    <div class="col-sm-6 mb-4">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="{{ asset($value->image) }}" alt="">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
    </section>
    <section class="blog-page-sectionss articale-page">
        <div class="container">
            <div class="row">
                @foreach ($blogs as $key => $value)
                    <div class="col-sm-3 mb-3">
                        <div class="blog-item">
                            <div class="blog-img">
                                 <img src="{{ asset($value->image) }}" alt="">
                            </div>

                            <div class="blog-content">
                                <h4 class="blog-title">{{ $value->title }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
    </section>

@endsection

