@extends('admin.layouts.app')
@section('title', 'Add new Demo Dailler')
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
	        <h1 class="m-0 text-dark">Demo Dailler</h1>
	      </div><!-- /.col -->
	      <div class="col-sm-6">
	        <ol class="breadcrumb float-sm-right">
	          <li class="breadcrumb-item"><a href="#">Home</a></li>
	          <li class="breadcrumb-item"><a href="#">Demo Dailler</a></li>
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
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
        	<div class="card-header">
	            <h3 class="card-title">Add New Demo Dailler</h3>
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
	        <form action="{{ route('demo-dailler-new') }}" method="post" enctype="multipart/form-data">
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
		                  <label for="opcode">OP Code</label>
		                  <input type="text" name="opcode" id="opcode" class="form-control" value="" placeholder="Enter opcode">
		                </div>
		              </div>
		              <div class="col-md-6">
		                <div class="form-group">
		                  <label for="link">Link</label>
		                  <input type="text" name="link" id="link" class="form-control" value="" placeholder="Enter link">
		                </div>
		              </div>
		              <div class="col-md-6">
		                <div class="form-group">
		                  <label for="dailler_id">Dialler</label>
		                  <select class="form-control" name="dailler_id" id="dailler_id">
		                  @foreach(App\Models\Dailler::get() as $key => $dailler)
			              <option value="{{$dailler->id}}">{{$dailler->name}}</option>
			              @endforeach
		                  </select>
		                </div>
		              </div>
		              
		              <div class="col-md-6">
		                <div class="form-group">
		                  <label for="banner">Banner (Dimensions: 250x250)</label>
		                  <input type="file" name="banner" id="banner" class="form-control-file" >
		                </div>
		                <!-- /.form-group -->
		              </div>
		              <!-- /.col -->
		        	</div>
		            <!-- /.row -->

		            <h5><i class="fas fa-edit" aria-hidden="true"></i> Description</h5>
		            <hr>
		            <div class="row">
		              <div class="col-12 col-sm-12">
		                <div class="form-group">
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