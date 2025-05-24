@extends('frontEnd.layouts.master')
@section('title', 'Certificate')
@section('content')
<!-- PAGE TITLE START -->
<section class="custom-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title">
                    <h2>Certificate</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- PAGE TITLE END -->
<section class="awards">
    <div class="container">
        
        <div class="row" id="lightgallery">
            @foreach($certificate as $key=>$value)
            <div class="col-sm-4"  data-src="{{ asset($value->image) }}">
                <div class="certificate">
                   <a href=""> <img src="{{asset($value->image)}}" alt=""></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
   
@endsection
