@extends('admin.layouts.app')
@section('title', 'Edit voip rate')
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
	        <h1 class="m-0 text-dark">voip rate</h1>
	      </div><!-- /.col -->
	      <div class="col-sm-6">
	        <ol class="breadcrumb float-sm-right">
	          <li class="breadcrumb-item"><a href="#">Home</a></li>
	          <li class="breadcrumb-item"><a href="#">voip rate</a></li>
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
      	<div class="card-header">
            <h3 class="card-title">Edit voip rate</h3>
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
        <form action="{{ route('admin.voip.rate.edit',$voip_rate->id) }}" method="post" enctype="multipart/form-data">
        	@csrf
	        <div class="card-body">
	        	<div class="row">
	              <div class="col-md-6">
	                <div class="form-group">
	                  <label for="country">country</label>
	                  <input type="text" name="country" id="country" class="form-control" value="{{$voip_rate->country}}" placeholder="Enter country">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                  <label for="code">code</label>
	                  <input type="text" name="code" id="code" class="form-control" value="{{$voip_rate->code}}" placeholder="Enter code">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                  <label for="rate">rate</label>
	                  <input type="text" name="rate" id="rate" class="form-control" value="{{$voip_rate->rate}}" placeholder="Enter rate">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                  <label for="minute">minute</label>
	                  <input type="text" name="minute" id="minute" class="form-control" value="{{$voip_rate->minute}}" placeholder="Enter minute">
	                </div>
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