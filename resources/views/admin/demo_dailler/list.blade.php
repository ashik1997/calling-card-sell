@extends('admin.layouts.app')
@section('title', 'Demo Dailler List')
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
        <h1>Demo Dailler</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item">Demo Dailler</li>
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
          <h3 class="card-title">Demo Dailler List</h3>
          <div class="card-tools">
              <a href="{{route('demo-dailler-new')}}" class="btn btn-success float-right">Create New Demo Dailler</a>
           </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Link</th>
              <th>OP Code</th>
              <th>Description</th>
              <th>Banner</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($demo_dailler as $key => $d_dailler)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$d_dailler->title}}</td>
              <td>{{$d_dailler->link}}</td>
              <td>{{$d_dailler->opcode}}</td>
              <td>{!!$d_dailler->description!!}</td>
              <td><img src="{{asset('frontend/')}}/assets/img/demo_dailler/{{ $d_dailler->banner }}" height="150" width="150" alt=""></td>
              <td><a class="btn btn-primary btn-md fa fa-edit" href="{{ route('demo-dailler-edit',$d_dailler->id) }}"></a>||<a class="btn btn-danger btn-md fa fa-trash-alt" href="{{ route('demo-dailler-delete',$d_dailler->id) }}"></a></td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Link</th>
              <th>OP Code</th>
              <th>Description</th>
              <th>Banner</th>
              <th>Action</th>
            </tr>
            </tfoot>
          </table>
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
<!-- AdminLTE for demo Dailler purposes -->
<script src="{{asset('backend/')}}/dist/js/demo Dailler.js"></script>
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