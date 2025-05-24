@extends('frontEnd.layouts.master')
@section('title', 'Company Profile')

@push('css')
  <!-- Turn.js CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/turn.js@4.1.0/dist/turn.min.css">
@endpush

@section('content')
<section class="custom-breadcrumb">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title">
          <h2>Company Profile</h2>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <!-- Container for the FlipBook -->
        <div id="flipbook" class="sample-container"></div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('script')
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Turn.js -->
  <script src="https://cdn.jsdelivr.net/npm/turn.js@4.1.0/dist/turn.min.js"></script>

  <!-- PDF.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

  <script>
    $(document).ready(function () {
      const pdfUrl = "{{ asset($profile->pdf) }}";  // Your PDF file URL
      const container = $('#flipbook');

      // Load the PDF using PDF.js
      pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
        let pagesCount = pdf.numPages;
        
        // Iterate through each page and render it as an image
        for (let i = 1; i <= pagesCount; i++) {
          pdf.getPage(i).then(function(page) {
            const scale = 1.5;  // Scale factor to adjust image size
            const viewport = page.getViewport({ scale: scale });

            // Create a canvas element to render the page
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.width = viewport.width;
            canvas.height = viewport.height;

            // Render the page to the canvas
            page.render({
              canvasContext: context,
              viewport: viewport
            }).promise.then(function() {
              // Convert the canvas to an image
              const img = document.createElement('img');
              img.src = canvas.toDataURL();

              // Add the image to the flipbook container
              container.append('<div class="page"><img src="' + img.src + '" /></div>');

              // Initialize the flipbook after the last page is rendered
              if (i === pagesCount) {
                container.turn({
                  width: 800,
                  height: 600,
                  autoCenter: true
                });
              }
            });
          });
        }
      });
    });
  </script>
@endpush

