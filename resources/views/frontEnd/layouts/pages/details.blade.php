@extends('frontEnd.layouts.master')
@section('title', $details->meta_title)
@section('content')

    <section class="details-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="details-image">
                        <img src="{{ asset($details->image) }}" alt="">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="details-content">
                        <h2>{{ $details->name }}</h2>
                        <p>{{ $details->short_description }}</p>
                        <a href="#bookingForm">Book Now</a>
                    </div>
                </div>
                <div class="col-sm-12 mt-5">
                    <div class="details-content">
                        <p>{!! $details->description !!}</p>

                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="details-booking" id="bookingForm">
                        <h2>Book an Appointment</h2>
                        <form action="{{ route('booking.save') }}" method="POST" class="row" data-parsley-validate=""
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $details->id }}">
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label"> Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" id="name" required />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->

                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="phone" class="form-label">Phone Number </label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ old('phone') }}" id="phone" />
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col end -->
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" id="email" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="address" class="form-label">Address *</label>
                                    <textarea name="address" rows="9" class="summernote form-control @error('address') is-invalid @enderror"
                                        required></textarea>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <!--variable product  end-->
                            <div class="col-sm-12 mb-3">
                                <div class="form-group">
                                    <label for="description" class="form-label">Description *</label>
                                    <textarea name="description" rows="9" class="summernote form-control @error('description') is-invalid @enderror"
                                        required></textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- col end -->
                            <div>
                                <input type="submit" class="btn btn-success" value="Submit" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
