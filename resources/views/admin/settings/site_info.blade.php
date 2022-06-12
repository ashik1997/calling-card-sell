@extends('admin.layouts.app')
@section('title', 'Settings')
@section('link')
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('backend/')}}/plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('backend/')}}/ionicons/2.0.1/css/ionicons.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('backend/')}}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('backend/')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
        <h1 class="m-0 text-dark">Settings</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Settings</a></li>
          <li class="breadcrumb-item active">Site info</li>
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
          <h3 class="card-title">Site information</h3>
    	</div>
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

      <form action="{{ route('site-info') }}" method="post" enctype="multipart/form-data">
      	@csrf
        	<!-- /.card-header -->
        <div class="card-body">
        	<div class="row">
        	  
              <div class="col-md-4">
                <div class="form-group">
                  <label for="site_name">Site name</label>
                  <input type="text" name="site_name" id="site_name" class="form-control" value="{{ $site_info->site_name }}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" name="phone" id="phone" class="form-control" value="{{ $site_info->phone }}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control" value="{{ $site_info->email }}">
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="short_about">Short about</label>
                  <textarea name="short_about" id="short_about" class="form-control">{{ $site_info->short_about }}</textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="address">Address</label>
                  <textarea name="address" id="address" class="form-control">{{ $site_info->address }}</textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="map_embed">Map embed (Width: 100%)</label>
                  <textarea name="map_embed" id="map_embed" class="form-control">{!!$site_info->map_embed!!}</textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
        	</div>
            <!-- /.row -->

          <h5><i class="fas fa-flag" aria-hidden="true"></i> Site Logo</h5>
          <hr>
          <div class="row">
            <div class="col-12 col-sm-4">
              <div class="form-group">
                <label>Header logo (Dimensions: 120x50)</label>
                <input type="file" name="header_logo" id="header_logo" class="form-control-file" >
                <img src="{{asset('frontend/')}}/assets/img/{{ $site_info->header_logo }}" height="42" width="117" alt="">
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-4">
              <div class="form-group">
                <label>Footer logo (Dimensions: 120x50)</label>
                <input type="file" name="footer_logo" id="footer_logo" class="form-control-file" >
                <img src="{{asset('frontend/')}}/assets/img/{{ $site_info->footer_logo }}" height="42" width="117" alt="">
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-4">
              <div class="form-group">
                <label>Favicon (Dimensions: 16x16)</label>
                <input type="file" name="favicon" id="favicon" class="form-control-file" >
                <img src="{{asset('frontend/')}}/assets/img/{{ $site_info->favicon }}" height="24" width="24" alt="">
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-4">
              <div class="form-group">
                <label>Add banner (Dimensions: 500x250)</label>
                <input type="file" name="ad_banner" id="ad_banner" class="form-control-file" >
                <img src="{{asset('frontend/')}}/assets/img/{{ $site_info->ad_banner }}" height="125" width="250" alt="">
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="terms_conditions">Terms & Conditions</label>
                <textarea name="terms_conditions" id="terms_conditions" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!!$site_info->terms_conditions!!}</textarea>
              </div>
              <!-- /.form-group -->
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="privacy_policy">Privacy & Policy</label>
                <textarea name="privacy_policy" id="privacy_policy" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!!$site_info->privacy_policy!!}</textarea>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
        </div>
        <!-- /.card-body -->
    
      	<div class="card-footer">
      		<button type="submit" name="update" class="btn btn-outline-success btn-lg">Update</button>
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
<script src="{{asset('backend/')}}/plugins/select2/js/select2.full.min.js"></script>
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