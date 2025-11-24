@section('top_bar')
  <nav class="navbar navbar-default navbar-static-top" style="margin-bottom: 0!important;">
    <div class="nav-bar">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
              <h5 style="color: cornsilk;font-weight:600;font-size:1.5rem;">DIAGNOSTIC EXAM</h5>
          </div>
          <div class="col-md-4">
            <h5 class="text-center" style="color: cornsilk;font-weight:600;font-size:1.5rem;">{{strtoupper($topic->title) }}</h5>
        </div>
          <div class="col-md-4">
            <h5 class="text-right" style="color: cornsilk;font-weight:600;font-size:1.5rem;">Time Left :  <span id="clock"></span></h5>
          </div>
        </div>
      </div>
    </div>
  </nav>
@endsection