@extends('backEnd.layouts.master')
@section('title','Booking list')
@section('css')
<link href="{{asset('public/backEnd')}}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title"> List</h4>
            </div>
        </div>
    </div>  
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card text-center">
                <div class="card-body">
                    
                    

                    <a href="tel:{{$profile->phone}}" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Call</a>
                    <a href="mailto:{{$profile->email}}" class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Email</a>

                    <div class="text-start mt-3">
                        <h4 class="font-13 text-uppercase">About :</h4>
                        <table class="table">
                            <tbody>
                            <tr class="text-muted mb-2 font-13">
                                <td>Full Name </td>
                                <td class="ms-2">{{$profile->name}}</td>
                            </tr>

                            <tr class="text-muted mb-2 font-13">
                                <td>Mobile </td>
                                <td class="ms-2">{{$profile->phone}}</td>
                            </tr>
                            <tr class="text-muted mb-2 font-13">
                                <td>Email </td> 
                                <td class="ms-2">{{$profile->email}}</td>
                            </tr>

                            <tr class="text-muted mb-1 font-13">
                                <td>Subject </td> 
                                <td class="ms-2">{{$profile->subject}}</td>
                            </tr>
                            <tr class="text-muted mb-1 font-13">
                                <td>Message </td> 
                                <td class="ms-2">{{$profile->message}}</td>
                            </tr>
                            
                            </tbody>
                        </table>
                    </div>
                    <!-- =============================================== -->
                    @if($profile->course != NULL)
                    <div class="text-start mt-3">
                        <h4 class="font-13 text-uppercase">Course Detaiils :</h4>
                        <table class="table">
                            <tbody>
                                <img src="{{asset($profile->course->image)}}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                            <tr class="text-muted mb-2 font-13">
                                <td>Course Name </td>
                                <td class="ms-2">{{$profile->course->title}}</td>
                            </tr>

                            <tr class="text-muted mb-2 font-13">
                                <td>lectures </td>
                                <td class="ms-2">{{$profile->course->lectures}}</td>
                            </tr>
                            <tr class="text-muted mb-2 font-13">
                                <td>duration </td> 
                                <td class="ms-2">{{$profile->course->duration}}</td>
                            </tr>

                            <tr class="text-muted mb-1 font-13">
                                <td>level </td> 
                                <td class="ms-2">{{$profile->course->level}}</td>
                            </tr>
                            <tr class="text-muted mb-1 font-13">
                                <td>Enroll </td> 
                                <td class="ms-2">{{$profile->course->enroll}}</td>
                            </tr>
                            <tr class="text-muted mb-1 font-13">
                                <td>description </td> 
                                <td class="ms-2">{!! $profile->course->description !!}</td>
                            </tr>
                            
                            </tbody>
                        </table>
                    </div>
                    @endif
                    <!--============-->
                </div>
            </div> <!-- end card -->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

</div> <!-- container -->

</div> <!-- content -->
@endsection


@section('script')
<script src="{{asset('public/backEnd/')}}/assets/libs/parsleyjs/parsley.min.js"></script>
<script src="{{asset('public/backEnd/')}}/assets/js/pages/form-validation.init.js"></script>
<script src="{{asset('public/backEnd/')}}/assets/libs/select2/js/select2.min.js"></script>
<script src="{{asset('public/backEnd/')}}/assets/js/pages/form-advanced.init.js"></script>
@endsection