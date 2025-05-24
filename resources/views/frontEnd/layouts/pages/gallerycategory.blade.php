@extends('frontEnd.layouts.master')
@section('title', 'Product Category')
@section('content')

   <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>Product Category</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->
   <section class="blog_section white_bg">
    <div class="container" style="padding: 25px 15px;">
        <p class="text-justify">
            Al-Muslim produces all kinds of woven outerwear like Transitional jacket, Padded jacket, Bomber jacket like PU leather Jacket &amp; Suede Jacket, Ladies Parka, Trench Coat, Puffer Jacket, Fake down jacket, Mountain parka . as
            well as all type of trouser, skirt, Cargo short/ Long Bermuda, Capri , etc .
        </p>

        <ul class="albums row mt-4">
            @foreach($gallery_cat as $key=>$value)
            <li>
                <div>
                    <a href="{{route('gallery',$value->id)}}">
                        <img src="{{asset($value->gallery->image??'')}}" class="img-responsive" />
                        <p class="album_p text-center">{{$value->name}} ({{$value->gallery_count??0}})</p>
                    </a>
                </div>
            </li>
           @endforeach
        </ul>
    </div>
</section>


@endsection

