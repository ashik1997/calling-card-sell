@extends('admin.layouts.app')
@section('title', 'Add New Minute For Country')
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
        <h1 class="m-0 text-dark">Minute For Country</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Minute For Country</a></li>
          <li class="breadcrumb-item active">Add New</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-6">
    	<!-- card -->
      <div class="card card-default">
      	<div class="card-header bg-info">
          <h3 class="card-title">Add New Minute For Country</h3>
          <div class="card-tools">
            <a href="{{route('admin.minute.list')}}" class="btn btn-primary float-right"><i class="fa fa-arrow-left"></i> Back</a>
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
        <form action="{{ route('admin.minute.add') }}" method="post" enctype="multipart/form-data">
        	@csrf
	        <div class="card-body">
	        	<div class="row">
	        		<div class="col-md-6">
                <div class="form-group">
                  <label for="rate_plan_id">Rate Plan</label>
                  <select name="rate_plan_id" id="rate_plan_id" class="form-control" required="required">
                  	<option value="">Select one</option>
                  	@foreach(App\Models\RatePlan::all() as $key=>$rate_plan)
                  	<option value="{{ $rate_plan->id }}">{{ $rate_plan->currency }} {{ $rate_plan->amount }}</option>
                  	@endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="minute">Minute</label>
                  <input type="text" name="minute" id="minute" class="form-control" value="{{old('minute')}}" placeholder="Enter minute">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="country">Country</label>
                  <input type="text" name="country" id="country" class="form-control" value="{{old('country')}}" placeholder="Enter country">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="country_code">Country code</label>
                  <input type="text" name="country_code" id="country_code" class="form-control" value="{{old('country_code')}}" placeholder="Enter country code">
                </div>
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
    </div>
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
@endsection