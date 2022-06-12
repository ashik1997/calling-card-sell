@extends('admin.layouts.app')
@section('title', 'Add New Banner')
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
	        <h1 class="m-0 text-dark">Banner</h1>
	      </div><!-- /.col -->
	      <div class="col-sm-6">
	        <ol class="breadcrumb float-sm-right">
	          <li class="breadcrumb-item"><a href="#">Home</a></li>
	          <li class="breadcrumb-item"><a href="#">Banner</a></li>
	          <li class="breadcrumb-item active">Add New</li>
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
      <div class="card card-default">
      	<div class="card-header">
          <h3 class="card-title">Add New</h3>
          <div class="card-tools">
            <a href="{{route('admin.popup-banner.list')}}" class="btn btn-success float-right"><i class="fa fa-arrow-left"></i> Back</a>
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
        <form action="{{ route('admin.popup-banner.add') }}" method="post" enctype="multipart/form-data">
        	@csrf
	        <div class="card-body">
	        	<div class="row">
	              <div class="col-md-6">
	                <div class="form-group">
	                  <label for="title">Title</label>
	                  <input type="text" name="title" id="title" class="form-control" value="" placeholder="Enter title">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                  <label for="cta_text">CTA text</label>
	                  <input type="text" name="cta_text" id="cta_url" class="form-control" value="" placeholder="Enter cta text">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                  <label for="cta_url">CTA url</label>
	                  <input type="url" name="cta_url" id="cta_url" class="form-control" value="" placeholder="Enter cta url">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                  <label for="image">Banner (Dimensions: 400x400)</label>
	                  <input type="file" name="image" id="image" class="form-control-file" >
	                </div>
	                <!-- /.form-group -->
	              </div>
	              <div class="col-sm-6">
	                <div class="form-group">
	                  <label for="description">Description</label>
	                  <textarea name="description" id="description" class="" placeholder="Place some text here"
                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
	                </div>
	                <!-- /.form-group -->
	              </div>
	              <!-- /.col -->
	        	</div>
	            <!-- /.row -->
	        </div>
	        <!-- /.card-body -->
	    
        	<div class="card-footer">
        		<button type="submit" name="save" class="btn btn-success btn-lg">Save</button>
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