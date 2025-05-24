@extends('frontEnd.layouts.master')
@section('title', 'Gallery')
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>Photo Gallery</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->
    <!-- ======== -->
    <section class="gallery-section separator home-photos">
        <div class="container">
            
            <div class="row">
                <div class="equipment-inner gallery_inner">
                    <div>
                        <div class="row" id="lightgallery" dir="{{ Session::get('locale') == 'ar' ? 'rtl' : 'ltr' }}">
                            @foreach ($gallery as $key => $value)
                                <div class="col-sm-3" data-src="{{ asset($value->image) }}">
                                    <div class="sample-widget wow fadeInUp" data-wow-duration="1.5s"
                                        data-wow-delay="0.{{ $key }}s">
                                        <div class="equipments-image">
                                            <a href="">
                                                <img src="{{ asset($value->image) }}" alt="" />
                                            </a>
                                            <div class="img_overlay">
                                                <div class="overlay_icon">
                                                    <i class="fa-solid fa-eye"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- gallery End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
