@extends("layouts.guest")

@section("content")
  <section class="page_505 d-flex align-items-center justify-content-center text-center h-100vh">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="four_zero_four_bg">
            <h1 class="font-weight-bold text-monospace">403</h1>
          </div>
          <div class="contant_box_505">
            <h3 class="h2">Page not pound.</h3>
            <p>The server encountered something unexpected that didn't allow it to complete the request.<br>
              We apologize. You can go back to main page:</p>
            <a href="{{ url("/") }}" class="btn btn-success mt-3">Dashboard</a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection