@extends('admin.layouts.app')
@section('title', 'Reseller Balance List')
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
        <h1>Reseller Balance</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item">Reseller Balance</li>
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
        <div class="card-header">
          <h3 class="card-title">Reseller Balance List</h3>
          <div class="card-tools">
            <form action="{{ route('admin.reseller_balance.list') }}" method="post" class="form-inline">
              @csrf
              <input type="date" name="start_date" class="form-control" required>
              <input type="date" name="end_date" class="form-control" required>
              <input type="submit" name="submit" class="btn btn-danger" value="search">
              <a href="{{route('admin.reseller_balance.add')}}" class="btn btn-primary float-right">Add New</a>
            </form>
            
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
                <th>Paid amount</th>
                <th>Payment date</th>
                <th>Added date</th>
                <th>Note</th>
              </tr>
              </thead>
              <tbody>
              @php
              $total = 0;
              $reseller_balances = json_decode($reseller_balances,true);
              @endphp
              @foreach($reseller_balances as $key => $reseler_balance)
              @php
              $total += $reseler_balance['amount'];
              @endphp
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$reseler_balance['reseller_name']}}</td>
                <td>{{$reseler_balance['added_by_name']}}</td>
                <td>{{$reseler_balance['amount']}}</td>
                <td>{{$reseler_balance['payment_date']}}</td>
                <td>{{$reseler_balance['created_at']}}</td>
                <td>{{$reseler_balance['note']}}</td>
              </tr>
              @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th colspan="3">Total</th>
                <th colspan="4">{{ $total }}</th>
              </tr>
              </tfoot>
            </table>
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
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "order": [[ 0, "desc" ]]
    });
  });
</script>
@endsection