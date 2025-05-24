@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>Client</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->
    
    <!-- ======= CLIENT DESIGN START ======== -->
    <section class="client-photos">
        <div class="container">
        <div class="allheader-title">
            <h4> Our All Client </h4>
        </div>
            <div class="row">
                @foreach($ourclient as $key =>$value)
                <div class="col-sm-2 col-6 our-client">
                    <img src="{{ asset($value->image) }}" alt="">
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ======= CLIENT DESIGN END ======== -->
    
    
@endsection
