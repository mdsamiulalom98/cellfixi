@extends('frontEnd.layouts.master') 
@section('title', 'Video') 
@section('content')
<!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>Videos</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->
<!-- ======== -->
<section class="home-photos">
    <div class="container">
        <div class="row">
                <div class="video__all_items">
                        @foreach($videos as $key => $value)
                            <div class="col-sm-4">
                                <div class="video_item wow zoomIn" data-wow-duration="1.5s" data-wow-delay="0.{{ $key }}s">
                                    <iframe width="560" height="315"
                                        src="https://www.youtube.com/embed/{{ $value->video }}"
                                        title="YouTube video player"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        @endforeach
                </div>
        </div>
    </div>
</section>
@endsection




