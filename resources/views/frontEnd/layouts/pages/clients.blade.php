@extends('frontEnd.layouts.master') 
@section('title', 'TRUSTED PARTNER') 
@section('content')
<!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>TRUSTED PARTNER</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="brand-carousel-area" style="background-image: url('{{asset('public/frontEnd/images/bu.jpg')}}');">
        <div class="container">
           
            <div class="brand-carousel-inner" id="brandCarousels">
                @foreach ($brands as $key => $value)
                    <div class="membership-item">
                        <div class="membership-image">
                            <a href="">
                              <img src="{{ asset($value->image) }}" alt="">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
      </div>
@endsection
