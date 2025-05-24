@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>{{ $details->title }}</h2>
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
                    <div class="section-inner">
                        <div class="details-breadcrumb">
                            <ul id="breadcrumbs" class="breadcrumbs">
                                <li class="item-home">
                                    <a class="bread-link bread-home" href="{{ route('home') }}" title="Home">Home</a>
                                </li>
                                <li class="separator separator-home"> <span></span> </li>
                                <li class="item-cat"><a href="{{ route('course') }}">Course</a></li>
                                <li class="separator"> <span></span> </li>
                                <li class="item-current"><span class="bread-current bread-107"
                                        title="Smartwatch Buying Guide with Features to Look For">{{ $details->title }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="service-details-image">
                            <img src="{{ asset($details->image) }}" alt="">
                        </div>
                        <div class="course-title">
                            <h1>{{ $details->title }}</h1>
                        </div>

                        <div class="service-details-description">
                            {!! $details->description !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="sidebar-inner">
                        <div class="sidebar-title">
                            <span class="text">
                                <span>Course Details</span>
                            </span>
                        </div>

                        <div class="sidebar-item-wrapper">
                            <ul>
                                <li>
                                    <div class="item">
                                        <div class="course-details">
                                            <ul class="full-details">
                                                <li><i class="fas fa-signal"></i> <span>Level</span><p>{{ $details->level }}</p></li>
                                                <li><i class="fa-solid fa-layer-group"></i> <span>Platform</span><p>{{ $details->platform }}</p></li>
                                                <li><i class="fas fa-book"></i> <span>Lectures</span><p>{{ $details->lectures }}</p></li>
                                                <li><i class="fas fa-clock"></i> <span>Duration</span><p>{{ $details->duration }}</p></li>
                                                <li><i class="fas fa-user"></i> <span>Enrolled</span><p>{{ $details->enroll }} Students</p></li>
                                                <li><i class="fa-solid fa-bangladeshi-taka-sign"></i> <span>Course Fee</span><p>{{ $details->coursefee }} TK</p></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end-col -->
            <div class="row">
                <div class="mentor-header">
                    <img src="{{ asset($details->mentors->image) }}" alt="Profile Picture">
                    <div class="mentor-details">
                        <h2>{{ $details->mentors->name }}</h2>
                        <p>{{ $details->mentors->designation }}</p>
                    </div>
                    <div class="mentor-update">
                        <strong>Latest Update</strong>
                        <p>{{ $details->mentors->updated_at ? \Carbon\Carbon::parse($details->mentors->updated_at)->format('F d, Y') : '' }}</p>
                    </div>
                </div>

                <div class="contact-section">
                    <div class="contact-form">
                        <h2>Contact Now</h2>
                        <form action="{{ route('bookingcontact') }}" method="POST">
                            @csrf
                            <input type="hidden" name="service" value="{{ $details->id }}">
                            <div class="row">
                                <div class="form-group mb-3 col-sm-6">
                                    <input type="text" id="mentor-contact" class="form-control" name="name"
                                        required="" placeholder="Your Name">
                                </div>
                                <div class="form-group mb-3 col-sm-6">
                                    <input type="email" id="mentor-contact" class="form-control" name="email"
                                        required="" placeholder="Your Email">
                                </div>
                                <div class="form-group mb-3 col-sm-6">
                                    <input type="text" id="mentor-contact" class="form-control" name="phone"
                                        required="" placeholder="Phone Number">
                                </div>
                                <div class="form-group mb-3 col-sm-6">
                                    <input type="text" id="mentor-contact" class="form-control" name="subject"
                                        required="" placeholder="Subject">
                                </div>
                                <div class="form-group mb-3">
                                    <textarea name="message" id="mentor-contact" class="form-control extra-area" placeholder="Your Message"></textarea>
                                </div>
                                <div class="new">
                                    <button type="submit" class="btn-submit d-block">Submit</button>
                                </div>
                                </div>
                        </form>
                    </div>
                    <div class="contact-info">
                        <h2>Contact Information</h2>
                        <ul>
                            <li><i class="fas fa-map-marker-alt"></i>
                                <div class="mentor-contact-info">
                                    <strong>Location</strong><br><span>{{ $contact->address }} </span>
                                </div>
                            </li>
                            <li><i class="fas fa-envelope"></i>
                                <div class="mentor-contact-info">
                                    <strong>Email</strong><br><span>{{ $contact->email }}</span>
                                </div>
                            </li>
                            <li><i class="fas fa-phone"></i>
                                <div class="mentor-contact-info">
                                    <strong>Mobile</strong><br><span>{{ $contact->hotline }}</span>
                                </div>
                            </li>
                        </ul>
                        <h3>Flow Us</h3>
                        <div class="social-links">
                            @foreach ($socialicons as $key => $value)
                            <a href="{{ $value->link }}"><i class="{{ $value->icon }}"></i></a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>






        </div>
    </section>
@endsection
