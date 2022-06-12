@extends('reseller.layouts.app')
@section('title', 'Reseller Payment List')
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
        <div class="card-header bg-info">
          <!-- <h3 class="card-title">Reseller Payment List</h3> -->
          <div class="card-tools">
            <a href="{{route('reseller.reseller_payment.add')}}" class="btn btn-custom float-right">Add New</a>
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
              $total=0;
              @endphp
              @foreach($reseller_payments as $key => $reseller_payment)
              @php
              $total+=$reseller_payment->amount;
              @endphp
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$reseller_payment->reseller->name}}</td>
                <td>{{$reseller_payment->added_by->name}}</td>
                <td>{{$reseller_payment->amount}}</td>
                <td>{{$reseller_payment->payment_date}}</td>
                <td>{{$reseller_payment->created_at->format('d/m/Y, h:i A')}}</td>
                <td>{{$reseller_payment->note}}</td>
              </tr>
              @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th colspan="3">Total</th>
                <th colspan="4">{{$total}}</th>
              </tr>
              </tfoot>
            </table>
            {{ $reseller_payments->links("pagination::bootstrap-4") }}
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
      "order": [[ 0, "desc" ]]
    });
  });
</script>
@endsection