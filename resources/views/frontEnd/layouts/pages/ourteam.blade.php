@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>Our Team</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->
    <!-- ======= PHOTO GALLERY DESIGN START ======== -->
    <section class="home-photos">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="team-member">
            @foreach($ourteam as $key => $value)
                <div class='team-item' 
                     data-image="{{ asset($value->image) }}" 
                     data-name="{{ $value->name }}" 
                     data-designation="{{ $value->designation }}"
                     data-description="{{ $value->description }}"
                     data-bs-toggle="modal" 
                     data-bs-target="#teamModal">
                    <img src="{{ asset($value->image) }}" alt="">
                    <h3>{{ $value->name }}</h3>
                    <h5>{{ $value->designation }}</h5>
                </div>
            
            @endforeach
            </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="teamModal" tabindex="-1" aria-labelledby="teamModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header">
        <h5 class="modal-title" id="teamModalLabel">Team Member</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img id="modalImage" src="" alt="" class="img-fluid mb-3" />
        <h3 id="modalName"></h3>
        <h5 id="modalDesignation"></h5>
        <p id="modalDescription"></p>
      </div>
    </div>
  </div>
</div>

    <!-- ======= PHOTO GALLERY DESIGN END ======== -->

@endsection
@push('script')
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.team-item').forEach(item => {
        item.addEventListener('click', function () {
            const image = this.getAttribute('data-image');
            const name = this.getAttribute('data-name');
            const designation = this.getAttribute('data-designation');
            const description = this.getAttribute('data-description');

            document.getElementById('modalImage').src = image;
            document.getElementById('modalName').textContent = name;
            document.getElementById('modalDesignation').textContent = designation;
            document.getElementById('modalDescription').textContent = description;
        });
    });
});
</script>
@endpush

