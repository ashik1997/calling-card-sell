@extends('reseller.layouts.app')
@section('title', 'Card Sell List')
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
    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-info">
          <h3 class="card-title">Card Sell List</h3>
          <div class="card-tools">
            <a href="{{route('reseller.card.stock')}}" class="btn btn-custom float-right">New Sell</a>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <span class="table-responsive">
            <table id="example2" class="table table-sm table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>Sell rate plan</th>
                <th>User</th>
                <th>Pin</th>
                <th>Rate</th>
                <th>Sell price</th>
                <th>Sell by</th>
                <th>Sell date</th>
              </tr>
              </thead>
              <tbody>
              @foreach($card_sells as $key => $sell_card)
              @php
              $rate=App\Models\RatePlan::findOrFail($sell_card->card->rate_plan_id);
              $sell_rate_plan = App\Models\SellRatePlan::findOrFail($sell_card->card->sell_rate_plan_id);
              @endphp
              <tr>
                <td>{{$key+1}}</td>
                <td>@if($sell_rate_plan){{$sell_rate_plan->currency}}/{{$sell_rate_plan->title}}@endif</td>
                <td>{{$sell_card->card->user}}</td>
                <td>{{$sell_card->card->pin}}</td>
                <td>{{$rate->currency}} {{$rate->amount}}</td>
                <td>{{$sell_card->sell_price}}</td>
                <td>{{$sell_card->user->name}}</td>
                <td>{{date('d/m/Y', strtotime($sell_card->created_at))}}</td>
              </tr>
              @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>#</th>
                <th>Sell rate plan</th>
                <th>User</th>
                <th>Pin</th>
                <th>Rate</th>
                <th>Sell price</th>
                <th>Sell by</th>
                <th>Sell date</th>
              </tr>
              </tfoot>
            </table>
            {{ $card_sells->links("pagination::bootstrap-4") }}
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
  function confirmation() {
    event.preventDefault();
    var urlToRedirect = event.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
    console.log(urlToRedirect); // verify if this is the right URL
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.replace(urlToRedirect);
      }
    })
  }
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