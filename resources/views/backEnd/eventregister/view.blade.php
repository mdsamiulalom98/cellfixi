@extends('backEnd.layouts.master')
@section('title', 'Events View')
@section('css')
    <link href="{{ asset('public/backEnd') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backEnd') }}/assets/libs/summernote/summernote-lite.min.css" rel="stylesheet"
        type="text/css" />
@endsection
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('events.index') }}" class="btn btn-primary rounded-pill">Manage</a>
                    </div>
                    <h4 class="page-title">Events View</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
             <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>SL</th>
                        <td>1</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>demo</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$edit_data->phone}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$edit_data->email}}</td>
                    </tr>
                    <tr>
                        <th>Subject</th>
                        <td>{{$edit_data->subject}}</td>
                    </tr>
                    <tr>
                        <th>Message</th>
                        <td>{{$edit_data->message}}</td>
                    </tr>
                </tbody>
            </table>

            <div class="text-start mt-3">
                        <h4 class="font-13 text-uppercase">Upcomming Events Detaiils :</h4>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Event Name</th>
                        <td>{{$edit_data->event_des->name}}</td>
                    </tr>
                    <tr>
                        <th>Duration</th>
                        <td>{{$edit_data->event_des->duration}}</td>
                    </tr>
                    <tr>
                        <th>Level</th>
                        <td>{{$edit_data->event_des->level}}</td>
                    </tr>
                    <tr>
                        <th>Learner </th>
                        <td>{{$edit_data->event_des->enroll}}</td>
                    </tr>
                    <tr>
                        <th>Location </th>
                        <td>{{$edit_data->event_des->location}}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{!! $edit_data->event_des->description !!}</td>
                    </tr>
                </tbody>
            </table>
            </div>
            
            </div>
        </div>
    </div>
@endsection



@section('script')
    <script src="{{ asset('public/backEnd/') }}/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-validation.init.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-advanced.init.js"></script>
    <!-- Plugins js -->
    <script src="{{ asset('public/backEnd/') }}/assets/libs//summernote/summernote-lite.min.js"></script>
    <script>
        $(".summernote").summernote({
            placeholder: "Enter Your Text Here",

        });
    </script>
@endsection
