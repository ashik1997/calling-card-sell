@extends('admin.layouts.app')
@section('title', 'Voip Rate List')
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
        <h1>Voip Rate</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item">Voip Rate</li>
          <li class="breadcrumb-item active">List</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Voip Rate List</h3>
          <div class="card-tools">
              <a href="{{route('admin.voip.rate.add')}}" class="btn btn-success float-right">Create New Voip Rate</a>
              <a href="{{ route('admin.voip.rate.delete','all') }}" class="btn btn-danger float-right">Delete All Data</a>
           </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
	        <span class="table-responsive">
	          	<table id="example1" class="table table-bordered table-striped">
		            <thead>
			            <tr>
			              <th>#</th>
			              <th>country</th>
			              <th>code</th>
			              <th>rate</th>
			              <th>minute</th>
			              <th>Action</th>
			            </tr>
		            </thead>
		            <tbody>
			            @foreach($sell_voip_rates as $key => $voip_rate)
			            <tr>
			              <td>{{$key+1}}</td>
			              <td>{{$voip_rate->country}}</td>
			              <td>{{$voip_rate->code}}</td>
			              <td contentEditable="true" class="edit" id='rate_<?php echo $voip_rate->id; ?>'>{{$voip_rate->rate}}</td>
			              <td>{{$voip_rate->minute}}</td>
			              <td class="text-center"><a class="btn btn-primary btn-md fa fa-edit" href="{{ route('admin.voip.rate.edit',$voip_rate->id) }}"></a>||<a class="btn btn-danger btn-md fa fa-trash-alt" href="{{ route('admin.voip.rate.delete',$voip_rate->id) }}"></a></td>
			            </tr>
			            @endforeach
		            </tbody>
		            <tfoot>
			            <tr>
			              <th>#</th>
			              <th>country</th>
			              <th>code</th>
			              <th>rate</th>
			              <th>minute</th>
			              <th>Action</th>
			            </tr>
		            </tfoot>
		        </table>
	        </span>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@csrf
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
$(document).ready(function(){

 // Save data
 $(".edit").focusout(function(){
  // $(this).removeClass("editMode");
  var csrf = $("input[name=_token]").val();
  var id = this.id;
  var split_id = id.split("_");
  var field_name = split_id[0];
  var edit_id = split_id[1];
  var value = $(this).text();

  $.ajax({
   url: "{{ route('admin.sell_rate_plan.sell_voip_rate_update') }}",
   type: 'POST',
   data: { _token:csrf, field:field_name, value:value, id:edit_id },
   success:function(response){
     if(response == 1){
        console.log('Save successfully'); 
     }else{
        console.log("Not saved.");
     }
   }
  });
 
 });

});
</script>
@endsection