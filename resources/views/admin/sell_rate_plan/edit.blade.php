@extends('admin.layouts.app')
@section('title', 'Sell Rate Plan')
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
	        <h1 class="m-0 text-dark">Sell Rate Plan</h1>
	      </div><!-- /.col -->
	      <div class="col-sm-6">
	        <ol class="breadcrumb float-sm-right">
	          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
	          <li class="breadcrumb-item"><a href="{{route('admin.sell_rate_plan.list')}}">Sell Rate Plan</a></li>
	          <li class="breadcrumb-item active">Edit</li>
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
		          <h3 class="card-title">Edit Sell Rate Plan</h3>
		          <div class="card-tools">
		            <a href="{{route('admin.sell_rate_plan.list')}}" class="btn btn-primary float-right"><i class="fa fa-arrow-left"></i> Back</a>
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
		        <form action="{{ route('admin.sell_rate_plan.edit',$sell_rate_plan->id) }}" method="post" enctype="multipart/form-data">
		        	@csrf
			        <div class="card-body">
			        	<div class="row">
			          	<div class="col-md-6">
		                <div class="form-group">
		                  <label for="currency">Rate plan name</label>
		                  <input type="text" name="currency" id="bank_name" class="form-control" value="{{$sell_rate_plan->currency}}" placeholder="Enter rate plan name">
		                </div>
		              </div>
		              <div class="col-md-6">
		                <div class="form-group">
		                  <label for="amount">Amount</label>
		                  <input type="number" name="amount" id="amount" class="form-control" value="{{$sell_rate_plan->amount}}" placeholder="Enter amount">
		                </div>
		              </div>
		              <div class="col-md-6">
		                <div class="form-group">
		                  <label for="discount">Discount per unit</label>
		                  <input type="text" name="discount" id="discount" class="form-control" value="{{ $sell_rate_plan->discount }}" placeholder="Enter discount">
		                </div>
		              </div>
		              <div class="col-md-6">
		                <div class="form-group">
		                  <label for="currency_rate">Currency rate</label>
		                  <input type="text" name="currency_rate" id="currency_rate" class="form-control" value="{{$sell_rate_plan->currency_rate}}" placeholder="Enter currency rate">
		                </div>
		              </div>
		              <div class="col-md-6">
		                <div class="form-group">
		                  <label for="how_many_minutes_of_seconds">How many minutes of seconds?</label>
		                  <input type="text" name="how_many_minutes_of_seconds" id="how_many_minutes_of_seconds" class="form-control" value="{{ $sell_rate_plan->how_many_minutes_of_seconds }}" placeholder="Enter how many minutes of seconds?">
		                </div>
		              </div>
		              <div class="col-md-6">
		                <div class="form-group">
		                  <label for="title">Title</label>
		                  <input type="text" name="title" id="title" class="form-control" value="{{$sell_rate_plan->title}}" placeholder="Enter title">
		                </div>
		              </div>
		              <div class="col-md-12">
		                <div class="form-group">
		                  <label for="description">Description</label>
		                  <textarea name="description" id="description" class="textarea" placeholder="Enter description">{{$sell_rate_plan->description}}</textarea>
		                </div>
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
        </div>
      </div><!-- /.row -->
    </section>
    <!-- /.content -->
</div>
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