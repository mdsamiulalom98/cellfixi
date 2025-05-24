@extends('frontEnd.layouts.master')
@section('title', 'Search')
@section('content')
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>{{ $search }}</h2>
                    </div>
                    <div class="category-breadcrumb d-flex align-items-center justify-content-center">
                        <a href="{{ route('home') }}">Home</a>
                        <span>/</span>
                        <strong>{{ $search }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="homeproduct product-section">
        <div class="container">
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="category-product ">
                        @forelse($products as $key => $value)
                            <div class="product_item wist_item">
                                @include('frontEnd.layouts.partials.product')
                            </div>
                        @empty
                            <div class="no-found">
                                <img src="{{ asset('public/frontEnd/images/not-found.png') }}" alt="">
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="custom_paginate">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
