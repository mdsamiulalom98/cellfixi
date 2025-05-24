@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>Appointment</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->

    

    <section class="section-padding about-section">
        <div class="container">
           <div class="col-sm-12">
               <div class="appointment_head">
                   <h2>Book an Appointment Now</h2>
                   <p>Free Counseling</p>
               </div>
               <div class="appointment_inner">
                   <form action="{{route('appointment_submit')}}" method="POST">
                    @csrf
                       <div class="row">

                           <div class="col-sm-6">
                               <div class="form-group">
                                   <label for="name">Your Name</label>
                                   <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required>
                               </div>
                           </div>

                           <div class="col-sm-6">
                               <div class="form-group">
                                   <label for="phone">Phone Number</label>
                                   <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number" required>
                               </div>
                           </div>

                           <div class="col-sm-6">
                               <div class="form-group">
                                   <label for="email">Email</label>
                                   <input type="text" name="email" id="email" class="form-control" placeholder="Email Address" required>
                               </div>
                           </div>

                           <div class="col-sm-6">
                               <div class="form-group">
                                   <label for="address">Your current location?</label>
                                   <input type="text" name="address" id="address" class="form-control" placeholder="Your current location" required>
                               </div>
                           </div>

                           <div class="col-sm-12">
                               <div class="form-group">
                                   <label for="education">Last Education details</label>
                                   <textarea name="education" id="education" class="form-control" placeholder="Write your Institution Name, Subject/Group, Passing Year & Result" required></textarea>
                               </div>
                           </div>


                           <div class="col-sm-12">
                               <div class="form-group">
                                   <label for="ielts">IELTS Score/others Language Test (if any)</label>
                                   <input type="text" name="ielts" id="ielts" class="form-control" placeholder="Test score or N/A">
                               </div>
                           </div>

                           <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="interested_program">Interested Program</label>
                                    <div class="custom-select-wrapper">
                                        <i class="fa-solid fa-angle-down select-icon"></i>
                                        <select name="interested_program" id="interested_program" class="form-control custom-select">
                                            <option value=""></option>
                                            <option value="1">Bachelor</option>
                                            <option value="2">Masters</option>
                                            <option value="3">PhD</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="interested_country">Interested Country</label>
                                    <div class="custom-select-wrapper">
                                        <i class="fa-solid fa-angle-down select-icon"></i>
                                        <select name="interested_country" id="interested_country" class="form-control custom-select" required>
                                            <option value=""></option>
                                            @foreach($allcountry as $key=>$value)
                                            <option value="{{$value->id}}">{{$value->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                           <div class="col-sm-12">
                               <div class="form-group text-center">
                                  <button type="submit">Submit Now</button> 
                               </div>
                           </div>


                       </div>
                   </form>
               </div>
           </div>
        </div>
    </section>
    


@endsection
