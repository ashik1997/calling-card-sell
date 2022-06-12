@extends('admin.layouts.app')
@section('title', 'Country List')
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
        <h1>Country</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item">Country</li>
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
          <h3 class="card-title">Country List</h3>
          <div class="card-tools">
            <a href="{{route('admin.country.add')}}" class="btn btn-success float-right">New Country</a>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <span class="table-responsive">
            <table id="example1" class="table table-bordered table-sm" width="100%">
              <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Note</th>
                <th>Mark</th>
                <th>Flag</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach($countrys as $key => $country)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$country->name}}</td>
                <td>{{$country->note}}</td>
                <td>{{$country->mark}}</td>
                <td><img src="{{asset('frontend/')}}/assets/img/country/{{ $country->flag }}" height="80" width="120" alt=""></td>
                <td><a class="btn btn-primary btn-md fa fa-edit" href="{{ route('admin.country.edit',$country->id) }}"></a><a class="btn btn-danger btn-md fa fa-trash-alt" href="{{ route('admin.country.delete',$country->id) }}"></a></td>
              </tr>
              @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Note</th>
                  <th>Mark</th>
                  <th>Flag</th>
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
// $(document).on('click', '.delete', function (e) {
//     e.preventDefault();
//     Swal.fire({
// 	  title: 'Are you sure?',
// 	  text: "You won't be able to revert this!",
// 	  icon: 'warning',
// 	  showCancelButton: true,
// 	  confirmButtonColor: '#3085d6',
// 	  cancelButtonColor: '#d33',
// 	  confirmButtonText: 'Yes, delete it!'
// 	}).then((result) => {
// 	  if (result.isConfirmed) {
// 	    Swal.fire(
// 	      'Deleted!',
// 	      'Your file has been deleted.',
// 	      'success'
// 	    )
// 	  }
// 	})
// });
</script>
@endsection