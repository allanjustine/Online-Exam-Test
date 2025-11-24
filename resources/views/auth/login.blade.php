@extends('layouts.app')

@section('head')
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script>
    window.Laravel =  <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
  </script>
@endsection

@section('content')
  <div class="">
    <div class="container">
      @if (Session::has('error'))
        <div class="alert alert-danger sessionmodal">
          {{session('error')}}
        </div>
      @endif
        <div class="login-page">
          <div class="row">
            <div class="col-md-8">
              <center><img src="{{asset('/images/vectors/smct logo.png')}}" class="img-responsive" width="75%" alt="Strong Moto Centrum"></center>
              <br>
              <center><img src="{{asset('/images/vectors/loginvector.svg')}}" class="img-responsive" alt="Strong Moto Centrum"/></center>
            </div>
          <div class="col-md-4">
          <h4 style="margin-top:15%">Sign In</h4>
        <br>
        <form class="form login-form" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label class="" for="email">Email Address</label>
              <input id="email" type="email"name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="email">Password</label>
            <input id="password" type="password" name="password" required>
            @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <div class="checkbox remember-me">
              <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
              </label>
               Remember Me
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-wave">
                Login
            </button>
          </div>
          <div class="form-group text-center">
            <a href="{{url('/password/reset')}}" title="Forgot Password">Forgot Password?</a>
          </div>
        </form>
      </div>
      </div>
        </div>
    </div>
  </div>    
@endsection

@section('scripts')
  <script>
    $(function () {
      $( document ).ready(function() {
         $('.sessionmodal').addClass("active");
         setTimeout(function() {
             $('.sessionmodal').removeClass("active");
        }, 4500);
      });
    });
  </script>
@endsection
