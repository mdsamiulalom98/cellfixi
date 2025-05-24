@extends('backEnd.layouts.master')
@section('title', 'Service Edit')
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
                        <a href="{{ route('service.index') }}" class="btn btn-primary rounded-pill">Manage</a>
                    </div>
                    <h4 class="page-title">Service Edit</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('service.update') }}" method="POST" class="row" data-parsley-validate=""
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $edit_data->id }}" name="hidden_id">
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="category_id" class="form-label">Mentor Select *</label>
                                    <select class="form-control select2-multiple @error('link') is-invalid @enderror"
                                        name="category_id" data-toggle="select2" data-placeholder="Choose ..." required>
                                        <optgroup>
                                            <option value="">Select..</option>
                                            @foreach ($blogcategory as $value)
                                                <option value="{{ $value->id }}"
                                                    @if ($edit_data->category_id == $value->id) selected @endif>{{ $value->name }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col end -->
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Title *</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" value="{{ $edit_data->title }}" id="title" required="">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="level" class="form-label">Level Name *</label>
                                    <input type="text" class="form-control @error('level') is-invalid @enderror"
                                        name="level" value="{{ $edit_data->level }}" id="level" required="">
                                    @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="lectures" class="form-label">Lectures Count *</label>
                                    <input type="number" class="form-control @error('lectures') is-invalid @enderror"
                                        name="lectures" value="{{ $edit_data->lectures }}" id="lectures" required="">
                                    @error('lectures')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="duration" class="form-label">Duration Time *</label>
                                    <input type="text" class="form-control @error('duration') is-invalid @enderror"
                                        name="duration" value="{{ $edit_data->duration }}" id="duration" required="">
                                    @error('duration')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label for="enroll" class="form-label">Enroll Students *</label>
                                    <input type="number" class="form-control @error('enroll') is-invalid @enderror"
                                        name="enroll" value="{{ $edit_data->enroll }}" id="enroll" required="">
                                    @error('enroll')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->

                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label for="coursefee" class="form-label">Course Fee *</label>
                                    <input type="number" class="form-control @error('coursefee') is-invalid @enderror"
                                        name="coursefee" value="{{ $edit_data->coursefee }}" id="coursefee" required="">
                                    @error('coursefee')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->

                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label for="platform" class="form-label">Platform ( Online / Offline ) *</label>
                                    <input type="text" class="form-control @error('platform') is-invalid @enderror"
                                        name="platform" value="{{ $edit_data->platform }}" id="platform" required="">
                                    @error('platform')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->


                            <div class="col-sm-4 mb-3">
                                <div class="form-group">
                                    <label for="image" class="form-label">Image *</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        name="image" value="{{ $edit_data->image }}" id="image">
                                    <img src="{{ asset($edit_data->image) }}" alt="" class="edit-image">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col end -->
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="short_description" class="form-label">Short Description*</label>
                                    <textarea type="text" class="summernote form-control @error('short_description') is-invalid @enderror" name="short_description"
                                        rows="6"  id="short_description" required="">{{ $edit_data->short_description }}</textarea>
                                    @error('short_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->

                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="description" class="form-label">Description*</label>
                                    <textarea class="summernote form-control @error('description')  is-invalid @enderror" name="description" rows="6"
                                        id="description" required="">{!! $edit_data->description !!}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                           

                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="status" class="d-block">Status</label>
                                    <label class="switch">
                                        <input type="checkbox" value="1" name="status"
                                            @if ($edit_data->status == 1) checked @endif>
                                        <span class="slider round"></span>
                                    </label>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col end -->
                            <div>
                                <input type="submit" class="btn btn-success" value="Submit">
                            </div>

                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
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

<script>
    $(document).ready(function() {
        var serialNumber = 1;
        $(".increment_btn").click(function() {
            var html = $(".clone_variable").html();
            var newHtml = html.replace(/stock\[\]/g, "stock[" + serialNumber + "]");
            $(".variable_product").after(newHtml);
            serialNumber++;
        });
        $("body").on("click", ".remove_btn", function() {
            $(this).parents(".increment_control").remove();
            serialNumber--;
        });
    });
</script>
@endsection
