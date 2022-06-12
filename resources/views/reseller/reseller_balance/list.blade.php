@extends('reseller.layouts.app')
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
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <!-- <h3 class="card-title">Reseller Balance List</h3> -->
          <div class="card-tools">
            <form action="{{ route('reseller.reseller_balance.list') }}" method="post" class="form-inline">
              @csrf
              <input type="date" name="start_date" class="form-control" required>
              <input type="date" name="end_date" class="form-control" required>
              <input type="submit" name="submit" class="btn btn-danger" value="search">
              <a href="{{route('reseller.reseller_balance.add')}}" class="btn btn-custom float-right">Add New</a>
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
              @endphp
              @foreach($reseller_balances as $key => $reseller_balance)
              @php
              $total += $reseller_balance->amount;
              @endphp
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$reseller_balance->reseller->name}}</td>
                <td>{{$reseller_balance->added_by->name}}</td>
                <td>{{$reseller_balance->amount}}</td>
                <td>{{$reseller_balance->payment_date}}</td>
                <td>{{$reseller_balance->created_at->format('d/m/Y, h:i A')}}</td>
                <td>{{$reseller_balance->note}}</td>
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