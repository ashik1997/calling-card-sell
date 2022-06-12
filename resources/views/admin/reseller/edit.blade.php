@extends('admin.layouts.app')
@section('title', 'Edit Reseller')
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
        <h1 class="m-0 text-dark">Reseller</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('admin.reseller.list')}}">Reseller</a></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default">
    	<div class="card-header bg-info">
        <h3 class="card-title">Edit Reseller</h3>
        <div class="card-tools">
          <a href="{{route('admin.reseller.list')}}" class="btn btn-primary float-right"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    	</div>
    	<!-- /.card-header -->
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
      <form action="{{ route('admin.reseller.edit',$reseller->id) }}" method="post" enctype="multipart/form-data">
      	@csrf
        <div class="card-body">
        	<div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" value="{{ $reseller->name }}">
								@error('name')
								<span class="invalid-feedback" role="alert">
								  <strong>{{ $message }}</strong>
								</span>
								@enderror
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" value="{{ $reseller->email }}">
								@error('email')
								<span class="invalid-feedback" role="alert">
								  <strong>{{ $message }}</strong>
								</span>
								@enderror
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone" value="{{ $reseller->phone }}">
								@error('phone')
								<span class="invalid-feedback" role="alert">
								  <strong>{{ $message }}</strong>
								</span>
								@enderror
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="discount">How much money at 1 dollar discount?</label>
                <input type="text" name="discount" id="discount" class="form-control" value="{{ $reseller->discount }}" placeholder="Enter discount">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="password-confirm">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
              	<label for="address">Address</label>
                <textarea name="address" id="address" class="" placeholder="Place some text here" style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $reseller->address }}</textarea>
              </div>
              <!-- /.form-group -->
            </div>
            
            <div class="col-md-4">
              <div class="form-group">
                <label for="img">Image (Dimensions: 250x250)</label>
                <input type="file" name="img" id="img" class="form-control-file">
                <br>
                  <img src="{{asset('backend/')}}/dist/img/{{ $reseller->img }}" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
        	</div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->
      	<div class="card-footer">
      		<button type="submit" name="save" class="btn btn-success btn-lg">Update</button>
      	</div>
      </form>
    </div>
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
<!-- AdminLTE for demo purposes -->
<script src="{{asset('backend/')}}/dist/js/demo.js"></script>
<!-- Summernote -->
<script src="{{asset('backend/')}}/plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
@endsection