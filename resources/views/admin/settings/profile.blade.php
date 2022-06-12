@extends('admin.layouts.app')
@section('title', 'Profile')
@section('link')
<!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('backend/')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('backend/')}}/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend/')}}/dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('backend/')}}/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Profile</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- card -->
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible" id="myAlert">
      <a href="" class="close">&times;</a>
      <ul>
      @foreach ($errors->all() as $error)
        <li>
        <strong>Oh sanp!</strong> {{ $error }}
        </li>
      @endforeach
      </ul>
    </div>
    @endif
    <div class="row">
    	<div class="col-sm-6">
    		<div class="card card-default">
        	<div class="card-header">
	            <h3 class="card-title">Profile</h3>
        	</div>
        	<!-- /.card-header -->
        	<form action="{{ route('profile') }}" method="post" enctype="multipart/form-data">
        	@csrf
	        <div class="card-body">
	        	<div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}" placeholder="Enter name">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" placeholder="Enter email">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" name="phone" id="phone" class="form-control" value="{{ Auth::user()->phone }}" placeholder="Enter phone">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                	<label for="address">Address</label>
                  <textarea name="address" id="address" class="" placeholder="Place some text here"
                      style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ Auth::user()->address }}</textarea>
                </div>
                <!-- /.form-group -->
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                  <label for="img">Image (Dimensions: 250x250)</label>
                  <input type="file" name="img" id="img" class="form-control-file" >
                  <br>
                  <img src="{{asset('backend/')}}/dist/img/{{ Auth::user()->img }}" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
	        	</div>
	          <!-- /.row -->
	        </div>
	        <!-- /.card-body -->
	    
        	<div class="card-footer">
        		<button type="submit" name="save" class="btn btn-outline-success btn-lg">Update</button>
        	</div>
        	</form>
        </div>
    	</div>
    	<div class="col-sm-6">
    		<div class="card card-default">
        	<div class="card-header">
	            <h3 class="card-title">Password Change</h3>
        	</div>
        	<form action="{{ route('password-update') }}" method="post" enctype="multipart/form-data">
        	@csrf
	        <div class="card-body">
	        	<div class="row">
					<div class="form-group col-md-6">
						<label for="password" class="col-form-label text-md-right">{{ __('New Password') }}</label>
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

						@error('password')
						<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>

					<div class="form-group col-md-6">
						<label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
					</div>
					<!-- /.col -->
	        	</div>
	            <!-- /.row -->
	        </div>
	        <!-- /.card-body -->
	    
        	<div class="card-footer">
        		<button type="submit" name="save" class="btn btn-outline-info btn-lg">Update</button>
        	</div>
        	</form>
        </div>
    	</div>
    	
    </div>
    </form>
    <!-- /.card -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('script')
<!-- jQuery -->
<script src="{{asset('backend/')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/')}}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo Dailler purposes -->
<script src="{{asset('backend/')}}/dist/js/demo Dailler.js"></script>
<!-- Summernote -->
<script src="{{asset('backend/')}}/plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
@endsection