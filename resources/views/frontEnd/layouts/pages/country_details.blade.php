@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>{{ $details->country_name }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->

    <section class="service-details-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="section-inner">

                        <div class="service-details-image">
                            <img src="{{ asset($details->image) }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="product__name"><h2>{{$details->country_name}}</h2></div>
                    <div class="product__description"><p>{!! $details->description !!}</p></div>
                </div>
            </div>
            <div class="row justify-content-center">
                 <div class="col-sm-8">
                      <div class="main__conta__order">
                          <div class="min__qty__order">
                              <a href="">Minimum Order : {{$details->min_qty}}</a>
                          </div>
                          <div class="whats__number__order">
                              <a href="https://api.whatsapp.com/send?phone={{$details->whats_number}}"> <i class="fa-brands fa-whatsapp"></i> {{$details->whats_number}}</a>
                          </div>
                      </div>    
                 </div>
            </div>
        </div>
    </section>
     
    <section class="blog-page-section articale-page">
        <div class="container">
            <div class="row">
                 <div class="col-sm-12"><div class="recent___product mb-5"><h2>Related Product</h2></div></div>
                @foreach ($recent_country as $key => $value)
                    <div class="col-sm-3 mb-4">
                        <div class="blog-itemss_pro">
                            <div class="blog-imgs_forpro">
                                <a href="{{route('country_details',$value->slug)}}"><img src="{{ asset($value->image) }}" alt=""></a>
                            </div>
                           <div class="abs__datas">
                               <div class="name__of__pro">
                                   <a href="{{route('country_details',$value->slug)}}"><p>{{$value->country_name}}</p></a>
                               </div>
                               <div class="des__for__pro"><p>{!! Str::limit($value->description, 100) !!}</p></div>

                               <div class="button__for__pro"><a href="{{route('country_details',$value->slug)}}">Read More</a></div>
                           </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
    </section>
    
@endsection
