@extends('frontEnd.layouts.master')
@section('title', 'Machine List')
@section('content')
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>Machine List</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @foreach ($machine as $key => $value)
    @if($value->description)
    <section class="category_des">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="des__cat"><p>{!!$value->description!!}</p></div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @endforeach
    <section class="blog-page-section articale-page">
        <div class="container">
            <div class="row">
                @foreach ($machine as $key => $value)
                  @if($value->image)
                    <div class="col-sm-6 mb-4">
                        <div class="blog-item">
                            <div class="blog-img">
                                <img src="{{ asset($value->image) }}" alt="">
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
            
        </div>
    </section>
@endsection

