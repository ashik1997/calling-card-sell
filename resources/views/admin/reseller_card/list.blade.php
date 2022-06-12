@extends('admin.layouts.app')
@section('title', 'Reseller Card List')
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
        <h1>Reseller Card</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item">Reseller Card</li>
          <li class="breadcrumb-item active">List</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header bg-info">
          <h3 class="card-title">Reseller Card List</h3>
          <div class="card-tools">
            <a href="{{route('admin.reseller_card.add')}}" class="btn btn-primary float-right">Add New</a>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <spna class="table-responsive">
            <table id="example2" class="table table-sm table-bordered">
              <thead>
              <tr>
                <th>#</th>
                <th>Reseller info</th>
                <th>Added by</th>
                <th>Rate plan</th>
                <th>OTY</th>
                <th>Added date</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach($reseller_cards as $key => $reseller_card)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$reseller_card->reseller->name}}</td>
                <td>{{$reseller_card->added_by->name}}</td>
                <td>{{$reseller_card->rate_plan->currency}} {{$reseller_card->rate_plan->amount}}</td>
                <td>{{$reseller_card->qty}}</td>
                <td>{{$reseller_card->created_at->format('d/m/Y, h:i A')}}</td>
                <td class="bt-group"><a class="btn btn-primary btn-sm fa fa-edit" href="{{ route('admin.reseller_card.edit',$reseller_card->id) }}"></a><a class="btn btn-danger btn-sm fa fa-trash-alt" href="{{ route('admin.reseller_card.delete',$reseller_card->id) }}"></a></td>
              </tr>
              @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>#</th>
                <th>Reseller info</th>
                <th>Added by</th>
                <th>Rate plan</th>
                <th>OTY</th>
                <th>Added date</th>
                <th>Action</th>
              </tr>
              </tfoot>
            </table>
            {{ $reseller_cards->links("pagination::bootstrap-4") }}
          </spna>
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
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
@endsection