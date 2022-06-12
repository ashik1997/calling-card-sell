@extends('admin.layouts.app')
@section('title', 'Card Stock')
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
<style type="text/css">
	.ctr {
	  position: relative;
	  text-align: center;
	  color: white;
	  font-weight: bold;
	  font-size: 24px;
	}
	/* Top left text */
	.top-left {
	  position: absolute;
	  top: 8px;
	  left: 16px;
	}
</style>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Card Stock</h1>
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
  	@foreach($rate_plans as $key => $rate_plan)
    @php
      $card = App\Models\Card::
      where('rate_plan_id',$rate_plan->id)->
      where('sell_rate_plan_id',$_GET['sell_rate_plan_id'])
      ->count();
      $sell_card = 0;
      foreach(App\Models\User::where('role', 'reseller')->where('added_by_id', Auth::user()->id)->get() as $key => $reseller){
        $sell_card += App\Models\Card::leftJoin('sell_cards', function($join) {
          $join->on('cards.id', '=', 'sell_cards.card_id');
        })
        ->join('rate_plans', 'rate_plans.id', '=', 'cards.rate_plan_id')
        ->where('sell_cards.reseller_id',$reseller->id)
        ->where('cards.rate_plan_id',$rate_plan->id)
        ->where('cards.sell_rate_plan_id',$_GET['sell_rate_plan_id'])
        ->select('cards.*')
        ->count();
      }
    @endphp
    <div class="col-md-4">
      <div class="card">
        <div class="card-header bg-success">
          <h3 class="card-title">{{$rate_plan->currency}} {{$rate_plan->amount}}</h3>
          <div class="card-tools">Available {{$card-$sell_card}} Pce</div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
	        <div class="ctr">
	          <img class="img-fluid" src="{{asset('frontend/')}}/assets/img/rate_plan/{{$rate_plan->image}}">
	          <div class="top-left">{{$rate_plan->amount}} {{$rate_plan->currency}}</div>
	        </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
	        <a href="{{route('admin.card.sell',$rate_plan->id)}}?sell_rate_plan_id={{$_GET['sell_rate_plan_id']}}" class="btn btn-success btn-lg float-left"><i class="fa fa-shopping-bag"></i> Buy now</a>
	        <a href="https://www.youtube.com/watch?v=WNM7_TqjrCY" class="btn btn-info btn-lg float-right"><i class="fa fa-play"></i> Video</a>
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
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