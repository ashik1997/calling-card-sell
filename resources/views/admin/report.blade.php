@extends('admin.layouts.app')
@section('title', 'Report')
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
        <h1>Report</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Report</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="card-body">
    @php
    $start_date = date('Y-m-d');
    $end_date = date('Y-m-d');
    $admins = App\Models\User::where('role', 'admin')->get();
    $current_balance = 0;
    $my_sell_amount = 0;
    $reseller_balance = 0;
    $reseller_available_balance = 0;

    $today_reseller_balance = 0;
    $today_my_sell_amount = 0;
    foreach($admins as $key => $admin){
      $current_balance += App\Models\User::reseller_balance($admin->id)-App\Models\User::reseller_balance($admin->id)-App\Models\User::reseller_balance($admin->id);
      $my_sell_amount += App\Models\User::reseller_sell($admin->id);
      $reseller_balance += App\Models\ResellerBalance::where('added_by_id',$admin->id)->sum('amount');
      $t = 0;
      foreach(App\Models\User::where('role', 'reseller')->where('added_by_id', $admin->id)->get() as $key => $reseller){
        $t += App\Models\User::reseller_balance($reseller->id);
      }
      $reseller_available_balance += $t;

      $today_reseller_balance += App\Models\ResellerPayment::whereBetween('created_at', [$start_date, $end_date])->where('added_by_id',$admin->id)->sum('amount');
      $today_my_sell_amount += App\Models\SellCard::where('reseller_id', $admin->id)->whereBetween('created_at', [$start_date, $end_date])->sum('sell_price');
    }
    @endphp
  </div>
  <!-- /.card-body -->
  <div class="row">
    <div class="col-lg-2 col-4">
      <!-- small box -->
      <div class="small-box bg-danger">
        <a href="#" class="small-box-footer">
        <div class="inner">
          <h3>&#2547; {{ $current_balance }}</h3>
          <p>Current balance</p>
        </div>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-4">
      <!-- small box -->
      <div class="small-box bg-primary">
        <a href="#" class="small-box-footer">
        <div class="inner">
          <h3>&#2547; {{ $my_sell_amount }}</h3>
          <p>My sell amount</p>
        </div>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-4">
      <!-- small box -->
      <div class="small-box bg-info">
        <a href="#" class="small-box-footer">
        <div class="inner">
          <h3>&#2547; {{ $reseller_balance }}</h3>
          <p>Reseller balance</p>
        </div>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-4">
      <!-- small box -->
      <div class="small-box bg-success">
        <a href="#" class="small-box-footer">
        <div class="inner">
          <h3>&#2547; {{ $reseller_available_balance }}</h3>
          <p>Reseller available balance</p>
        </div>
        </a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- ./row -->
  <h3>Today section</h3>
  <div class="row">
    <div class="col-lg-2 col-4">
      <!-- small box -->
      <div class="small-box bg-info">
        <a href="#" class="small-box-footer">
        <div class="inner">
          <h3>&#2547; {{ $today_reseller_balance }}</h3>
          <p>Reseller balance</p>
        </div>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-4">
      <!-- small box -->
      <div class="small-box bg-success">
        <a href="{{ route('admin.card.sell.history') }}"
           onclick="event.preventDefault();document.getElementById('sell-history-form').submit();" class="small-box-footer">
          <form action="{{ route('admin.card.sell.history') }}" id="sell-history-form" method="post" class="form-inline">
              @csrf
            <input type="hidden" name="start_date" class="form-control" value="{{date('Y-m-d')}}" required>
            <input type="hidden" name="end_date" class="form-control" value="{{date('Y-m-d')}}" required>
          </form>
        <div class="inner">
          <h3>&#2547; {{ $sell_amount = App\Models\SellCard::whereBetween('created_at', [$start_date, $end_date])->sum('sell_price') }}</h3>
          <p>Today sell amount</p>
        </div>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-4">
      <!-- small box -->
      <div class="small-box bg-primary">
        <a href="{{ route('admin.card.sell.history') }}"
           onclick="event.preventDefault();document.getElementById('sell-history-form').submit();" class="small-box-footer">
          <form action="{{ route('admin.card.sell.history') }}" id="sell-history-form" method="post" class="form-inline">
              @csrf
            <input type="hidden" name="start_date" class="form-control" value="{{date('Y-m-d')}}" required>
            <input type="hidden" name="end_date" class="form-control" value="{{date('Y-m-d')}}" required>
          </form>
        <div class="inner">
          <h3>&#2547; {{ $today_my_sell_amount }}</h3>
          <p>Today my sell amount</p>
        </div>
        </a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- ./row -->
  <!-- <h3>My sell card</h3>
  <div class="row">
    @foreach($rate_plans as $key => $rate_plan)
    <div class="col-md-3">
      <div class="card">
        <div class="card-header bg-primary">
          <h3 class="card-title">{{$rate_plan->currency}} {{$rate_plan->amount}}</h3>
          <div class="card-tools">{{App\Models\User::my_sell_card(Auth::user()->id, $rate_plan->id)}} Pce</div>
        </div>
        <div class="card-body">
          <div class="ctr">
            <img class="img-fluid" src="{{asset('frontend/')}}/assets/img/rate_plan/{{$rate_plan->image}}">
            <div class="top-left">{{$rate_plan->amount}} {{$rate_plan->currency}}</div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div> -->
  <!-- /.row -->

  <h3>Available</h3>
  <div class="row">
    @foreach($rate_plans as $key => $rate_plan)
    <div class="col-md-3">
      <div class="card">
        <div class="card-header bg-success">
          <h3 class="card-title">{{$rate_plan->currency}} {{$rate_plan->amount}}</h3>
          <div class="card-tools">{{ App\Models\Card::where('rate_plan_id',$rate_plan->id)->count()-App\Models\User::my_sell_card(Auth::user()->id, $rate_plan->id) }} Pce</div>
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
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    @endforeach
  </div>
  <!-- /.row -->

  <h3>Total sell card</h3>
  <div class="row">
    @foreach($rate_plans as $key => $rate_plan)
    <div class="col-md-3">
      <div class="card">
        <div class="card-header bg-info">
          <h3 class="card-title">{{$rate_plan->currency}} {{$rate_plan->amount}}</h3>
          <div class="card-tools">{{$my_sell_card = App\Models\SellCard::leftJoin('cards', function($join) {
          $join->on('cards.id', '=', 'sell_cards.card_id');
        })
        ->where('cards.rate_plan_id',$rate_plan->id)
        ->select('cards.*')
        ->count() }} Pce</div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="ctr">
            <img class="img-fluid" src="{{asset('frontend/')}}/assets/img/rate_plan/{{$rate_plan->image}}">
            <div class="top-left">{{$rate_plan->amount}} {{$rate_plan->currency}}</div>
          </div>
        </div>
        <!-- /.card-body -->
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