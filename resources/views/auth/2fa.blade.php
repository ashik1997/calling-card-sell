<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="{{asset('frontend/')}}/assets/img/{{ App\Models\SiteInfo::pluck('favicon')[0] }}" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('backend/')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('backend/')}}/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('backend/')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend/')}}/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
      <a href="/"><b><img src="{{asset('frontend/')}}/assets/img/{{ App\Models\SiteInfo::pluck('header_logo')[0] }}" alt="" class="img-fluid"></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <!-- <p class="login-box-msg">Enter Google Authenticator Code</p> -->
      @if(Auth::user()->google2fa_secret == '')
      <p class="text-center">{!! $inlineUrl !!}</p>
      <p class="text-center"><img src="{{ $inlineUrl }}"></p>
      @endif
      <form action="{{ route('2fa') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input id="secret_hidden" type="hidden" class="form-control @error('secret_hidden') is-invalid @enderror" name="secret_hidden" value="{{ $secretKey }}" placeholder="Enter code" required>
          <input id="secret" type="text" class="form-control @error('secret') is-invalid @enderror" name="secret" value="{{ old('secret') }}" placeholder="Enter code" required autofocus>
        </div>
        <div class="row">
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('backend/')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/')}}/dist/js/adminlte.min.js"></script>

</body>
</html>