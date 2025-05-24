@extends('frontEnd.layouts.master')
@section('title', 'CSR')
@section('content')
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>CSR</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @foreach ($csr as $key => $value)
    @if($value->description)
    <section class="category_des">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="des__cat"><p>{{$value->description}}</p></div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @endforeach
    <section class="blog-page-section articale-page">
        <div class="container">
            <div class="row">
                @foreach ($csr as $key => $value)
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
@endsection

