@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>Company Photo Gallery</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->
    
    <!-- ======= PHOTO GALLERY DESIGN START ======== -->
    <section class="home-photos">
        <div class="container">
            <div class="allheader-title">
                <h4> Photo Gallery </h4>
            </div>
            <div class="row" id="lightgallery">
                @foreach($companyphoto as $key => $value)
                <div class="col-sm-6 col-6 photo-gellary" data-src="{{ asset($value->image) }}">
                    <a href="{{ $value->name }}">
                        <img src="{{ asset($value->image) }}" alt="">
                    </a>
                </div>
                @endforeach
            </div>
            <div class="photo-view">
                <a href="{{ route('photogallery') }}">All Photo View</a>
            </div>
        </div>
    </section>
    <!-- ======= PHOTO GALLERY DESIGN END ======== -->
    
    
    
@endsection
