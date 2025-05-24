@extends('frontEnd.layouts.master')
@section('title', 'Sustainability')
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2> Sustainability</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->
    
     <!-- ======= B2B GALLERY DESIGN START ======== -->
     <section class="our__technology__section">
    <div class="container">
        @foreach($sustainability  as $key => $value)
            <div class="row align-items-center mb-4">
                @if($key % 2 == 0)
                    <div class="col-sm-6">
                        <div class="left__data_technology">
                            <img src="{{ asset($value->image) }}" alt="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="right__data_technology">
                            <div class="title__for__tech"><h2>{{ $value->name }}</h2></div>
                            <div class="des__for__tech">{!! $value->description !!}</div>
                        </div>
                    </div>
                @else
                    <div class="col-sm-6 order-sm-2">
                        <div class="left__data_technology">
                            <img src="{{ asset($value->image) }}" alt="">
                        </div>
                    </div>
                    <div class="col-sm-6 order-sm-1">
                        <div class="right__data_technology">
                            <div class="title__for__tech"><h2>{{ $value->name }}</h2></div>
                            <div class="des__for__tech">{!! $value->description !!}</div>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</section>

    <!-- ======= B2B GALLERY DESIGN END ======== -->
    
    
    
@endsection
