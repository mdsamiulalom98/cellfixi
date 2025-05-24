@extends('frontEnd.layouts.master')
@section('title',  $events->name)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>{{ $events->name }}</h2>
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
                                <li class="item-cat"><a href="">Course</a></li>
                                <li class="separator"> <span></span> </li>
                                <li class="item-current"><span class="bread-current bread-107"
                                        title="Smartwatch Buying Guide with Features to Look For">{{ $events->name }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="service-details-image">
                            <div class="service-item-img">
                               <iframe width="560" height="315" 
                                src=https://www.youtube.com/embed/{{$events->video}}?autoplay=0&mute=1" 
                                title="YouTube video player" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                allowfullscreen>
                            </iframe>
                            </div>
                        </div>
                        <div class="course-title">
                            <h1>{{ $events->name }}</h1>
                        </div>

                        <div class="service-details-description">
                            {!! $events->description !!}
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
                                                <li><i class="fas fa-signal"></i> <span>Level</span><p>{{ $events->level }}</p></li>
                                                <li><i class="fa-solid fa-layer-group"></i> <span>Platform</span><p>{{ $events->platform }}</p></li>
                                                <!-- <li><i class="fas fa-book"></i> <span>Lectures</span><p>{{ $events->lectures }}</p></li> -->
                                                <li><i class="fas fa-clock"></i> <span>Duration</span><p>{{ $events->duration }}</p></li>
                                                <li><i class="fas fa-user"></i> <span>Enrolled</span><p>{{ $events->enroll }} Students</p></li>
                                                <li><i class="fa-solid fa-bangladeshi-taka-sign"></i> <span>Course Fee</span><p>{{ $events->coursefee }} TK</p></li>
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


<section class="events__register mt-3 mb-3">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="contact-form">
                    <h2>{{ $events->name }} <strong>For Events!</strong></h2>
                    <form action="{{route('event.data.save')}}" method="POST">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $events->id }}">
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
            </div>
        </div>
    </div>
</section>
@endsection