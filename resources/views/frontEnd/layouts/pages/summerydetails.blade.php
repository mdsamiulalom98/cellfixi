@extends('frontEnd.layouts.master')
@section('title',  $details->name)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>{{ $details->name }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- PAGE TITLE END -->
    <section class="service-details-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
				    <div class="contact-form">
				        <form action="{{route('booksummeryorder.save')}}" method="POST">
				            @csrf
				            <div class="card">
				                <div class="card-header">
				                    <h6 class="check-position">Fill in the details and click on the "Confirm Order" button</h6>
				                </div>
				                <div class="card-body">
				                    <div class="row">
				                        <input type="hidden" name="book_id" value="{{ $details->id }}" />

				                        <div class="col-sm-12">
						                    <div class="form-group mb-3">
						                        <label for="name" class="mb-2"><i class="fa-solid fa-user"></i> Full Name *</label>
						                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="" required />
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
						                        <label for="phone" class="mb-2"><i class="fa-solid fa-phone"></i> Mobile Number *</label>
						                        <input
						                            type="text"
						                            minlength="11"
						                            id="number"
						                            maxlength="11"
						                            pattern="0[0-9]+"
						                            title="please enter number only and 0 must first character"
						                            title="Please enter an 11-digit number."
						                            id="phone"
						                            class="form-control @error('phone') is-invalid @enderror"
						                            name="phone"
						                            value="{{ old('phone') }}"
						                            placeholder=""
						                            required
						                        />
						                        @error('phone')
						                        <span class="invalid-feedback" role="alert">
						                            <strong>{{ $message }}</strong>
						                        </span>
						                        @enderror
						                    </div>
						                </div>
						                <!-- col-end -->
						                <div class="col-sm-12">
						                    <div class="form-group mb-3">
						                        <label for="address" class="mb-2"><i class="fa-solid fa-map"></i> Full Address *</label>
						                        <input type="address" id="address" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="" value="{{ old('address') }}" required />
						                        @error('email')
						                        <span class="invalid-feedback" role="alert">
						                            <strong>{{ $message }}</strong>
						                        </span>
						                        @enderror
						                    </div>
						                </div>
						                <div class="col-sm-12">
	                                        <div class="form-group mb-3">
	                                            <label for="area" class="mb-2"><i class="fa-solid fa-truck"></i> Delivary Area  *</label>

	                                            <select type="area" id="area"
	                                                class="form-control @error('area') is-invalid @enderror" name="area"
	                                                required>
	                                                @foreach ($shippingcharge as $key => $value)
	                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
	                                                @endforeach
	                                            </select>
	                                            @error('area')
	                                                <span class="invalid-feedback" role="alert">
	                                                    <strong>{{ $message }}</strong>
	                                                </span>
	                                            @enderror
	                                        </div>
	                                    </div>
	                                    <!-- col-end -->

				                        <div class="new">
				                            <button type="submit" class="btn-submit d-block">Order Now</button>
				                        </div>
				                    </div>
				                </div>
				            </div>
				        </form>
				    </div>
				</div>



                <div class="col-sm-4">
                    <div class="sidebar-inner">
                        <div class="sidebar-title">
                            <span class="text">
                                <span>Book Details</span>
                            </span>
                        </div>

                        <div class="sidebar-item-wrapper">
                            <ul>
                                <li>
                                    <div class="item">
                                        <div class="course-details">
                                            <ul class="full-details">
                                                
                                                <li><i class="fa-solid fa-layer-group"></i> <span>Book Name</span><p>{{ $details->name }}</p></li>
                                                <li><i class="fa-solid fa-bangladeshi-taka-sign"></i> <span>Amount</span><p>{{ $details->price }} TK</p></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
