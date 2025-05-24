@extends('frontEnd.layouts.master') 
@section('title', 'Messages') 
@section('content')
<!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>Message</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
 <!-- PAGE TITLE END -->
<section class="ceo__message wow zoomIn" data-wow-duration="1.5s"
data-wow-delay="0.4s">
    <div class="col-md-12">
    <div class="owner-message container">
        <div class="row">
            @foreach($ceomessage as $key=>$value)
            <div class="col-sm-12"> 
                <div class="message__items">
                    <div class="message__image">
                   <img src="{{asset($value->image)}}" alt="">
               </div>
                <div class="message__data">
                    <p>
                       <strong>{{$value->name}}</strong><br />
                        {{$value->designation}}<br />
                    </p>
                    <h2 class="title">{{$value->title}}</h2>
                    <div class="messge-description">
                        <p>
                            {!! $value->description !!}
                        </p>
                    </div>
                    <div class="inner-social-icon">
                        <ul>
                            @foreach ($socialicons as $value)
                            <li>
                               <a href="{{$value->link}}"><i class="{{$value->icon}}"></i></a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                </div>  
            </div>
            
            @endforeach
        </div>
    </div>
</div>
</section>
@endsection
