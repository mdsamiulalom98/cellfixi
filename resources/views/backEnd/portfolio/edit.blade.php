@extends('backEnd.layouts.master')
@section('title', 'Mission Vission Edit')
@section('css')
    <link href="{{ asset('public/backEnd') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backEnd') }}/assets/summernote-lite/summernote-lite.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('portfolios.index') }}"
                            class="btn btn-primary waves-effect waves-light btn-sm rounded-pill">Manage</a>
                    </div>
                    <h4 class="page-title">Read Summery of a Book Edit</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('portfolios.update') }}" method="POST" class=row
                            data-parsley-validate="" enctype="multipart/form-data" name="editForm">
                            @csrf
                            <input type="hidden" value="{{ $edit_data->id }}" name="id">

                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Book Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ $edit_data->name }}" id="name" required="">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="price" class="form-label">Price *</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        name="price" value="{{ $edit_data->price }}" id="price" required="">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="image_one" class="form-label">Book Image *</label>
                                    <input type="file" class="form-control @error('image_one') is-invalid @enderror "
                                        name="image_one" value="{{ old('image_one') }}" id="image_one">
                                    @error('image_one')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <img style="height: 60px; width: auto; margin-top: 20px" src="{{ asset($edit_data->image_one) }}" alt="">
                            </div>
                            <!-- col end -->
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="image_two" class="form-label">Book Pdf *</label>
                                    <input type="file" class="form-control @error('image_two') is-invalid @enderror" 
                                           name="image_two" 
                                           value="{{ old('image_two') }}" 
                                           id="image_two" 
                                           accept=".pdf"> <!-- Only PDF files allowed -->
                                    @error('image_two')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- Display preview if file is not a PDF -->
                                @if (pathinfo($edit_data->image_two, PATHINFO_EXTENSION) !== 'pdf')
                                    <img style="height: 60px; width: auto; margin-top: 20px" src="{{ asset($edit_data->image_two) }}" alt="">
                                @else
                                    <p style="margin-top: 20px;">Uploaded File: {{ basename($edit_data->image_two) }}</p>
                                @endif
                            </div>
                            <!-- col end -->


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
    <script src="{{ asset('public/backEnd/') }}/assets/libs/select2/js/select2.min.js"></script>

    <script src="{{ asset('public/backEnd/') }}/assets/summernote-lite/summernote-lite.js"></script>

    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-advanced.init.js"></script>

    <script type="text/javascript">
        document.forms['editForm'].elements['blogcategory_id'].value = "{{ $edit_data->blogcategory_id }}"
    </script>

    <script>
        $('.summernote').summernote({
            height: 250,
            callbacks: {
                // Clear all formatting of the pasted text
                onPaste: function(e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData(
                        'Text');
                    e.preventDefault();
                    setTimeout(function() {
                        document.execCommand('insertText', false, bufferText);
                    }, 300);

                }
            }
        });
    </script>
@endsection
