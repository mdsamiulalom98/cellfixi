@extends('frontEnd.layouts.master')
@section('title', $subcategory->meta_title)
@section('content')
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>{{ $subcategory->name }}</h2>
                    </div>
                    <div class="category-breadcrumb d-flex align-items-center justify-content-center">
                        <a href="{{ route('home') }}">Home</a>
                        <span>/</span>
                        <strong>{{ $subcategory->name }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="homeproduct product-section">
        <div class="container">
            <div class="sorting-section">
                <div class="row">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="category-title-wrapper">
                                <h1>{{ $subcategory->name }} Service</h1>
                                <h2>Choose the model You need to repair</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 ">
                    <div class="service-item-sidebar">
                        <div class="back">
                            <a href="javascript:history.back()"><i class="fa fa-chevron-left"></i>Back</a>
                            <button class="d-sm-none d-inline-block" id="subcategoryToggle">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                        <div class="items" id="">
                            <ul>
                                @foreach ($subcategories as $key => $value)
                                    <li class="{{ request()->url() == route('subcategory', $value->slug) ? 'active' : '' }}">
                                        <a href="{{ route('subcategory', $value->slug) }}">{{ $value->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 ">
                    <div class="category-product {{ $products->total() == 0 ? 'no-product' : '' }}">
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
@push('script')
<script>
    $(document).ready(function () {
      $('#subcategoryToggle').off('click').on('click', function () {
        $('.service-item-sidebar .items').toggleClass('active');
        console.log('Toggled');
      });
    });


</script>
@endpush
