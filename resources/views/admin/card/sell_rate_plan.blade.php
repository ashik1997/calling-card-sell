@extends('admin.layouts.app')
@section('title', 'Sell Rate Plan')
@section('link')
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('backend/')}}/plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('backend/')}}/ionicons/2.0.1/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('backend/')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('backend/')}}/dist/css/adminlte.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Sell Rate Plan</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item">Card</li>
          <li class="breadcrumb-item active">Stock</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
  	@foreach($sell_rate_plans as $key => $sell_rate_plan)
    <div class="col-md-4">
    	<a href="{{route('admin.card.stock')}}?sell_rate_plan_id={{$sell_rate_plan->id}}" class="text-dark">
			<div class="card">
				<div class="card-header" style="background-color: #8bc34a;">
					<h3 class="card-title">{{$sell_rate_plan->currency}}</h3>
          @if($sell_rate_plan->discount>0)
          <div class="card-tools bg-warning">
            Discount per $ {{ $sell_rate_plan->discount }} tk
          </div>
          @endif
				</div>
				<!-- /.card-header -->
				<div class="card-body">
				  <h5>{{$sell_rate_plan->title}}</h5>
				  <p>{!!$sell_rate_plan->description!!}</p>
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<a class="btn btn-success btn-block text-white" href="{{route('admin.card.stock')}}?sell_rate_plan_id={{$sell_rate_plan->id}}">কার্ড কিনতে এখানে ক্লিক করুন </a>
				</div>
			</div>
			<!-- /.card -->
		</a>
    </div>
    <!-- /.col -->
    @endforeach
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@endsection
@section('script')

<!-- jQuery -->
<script src="{{asset('backend/')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="{{asset('backend/')}}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{asset('backend/')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/')}}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('backend/')}}/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
@endsection