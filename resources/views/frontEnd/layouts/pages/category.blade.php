@extends('frontEnd.layouts.master')
@section('title', $category->meta_title)
@section('content')
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>{{ $category->name }}</h2>
                    </div>
                    <div class="category-breadcrumb d-flex align-items-center justify-content-center">
                        <a href="{{ route('home') }}">Service</a>
                        <span>/</span>
                        <strong>{{ $category->name }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="homeproduct product-section">
        <div class="container">
            <div class="sorting-section">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="category-title-wrapper">
                            <h1>{{ $category->name }} Service</h1>
                            <h2>Choose the model You need to repair</h2>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="category-product {{ $subcategories->total() == 0 ? 'no-product' : '' }}">
                        @forelse($subcategories as $key => $value)
                            <div class="product_item wist_item">
                                <div class="product_item_inner">

                                    <div class="category-img">
                                        <a href="{{ route('subcategory', $value->slug) }}">
                                            <img src="{{ asset($value->image ?? '') }}" alt="{{ $value->name }}" />
                                        </a>
                                    </div>
                                    <div class="category-des">
                                        <div class="category-name">
                                            <a
                                                href="{{ route('product', $value->slug) }}">{{ Str::limit($value->name, 80) }}</a>
                                        </div>
                                    </div>
                                </div>
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
                        {{ $subcategories->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
