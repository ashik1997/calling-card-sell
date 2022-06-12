@extends('reseller.layouts.app')
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
<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-3">
      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <?php if (!empty($reseller->img)&&file_exists('backend/dist/img/'.$reseller->img)): ?>
            <img class="profile-user-img img-fluid img-circle" src="{{asset('backend/')}}/dist/img/{{ $reseller->img }}" alt="User profile picture"> 
            <?php endif ?>
          </div>

          <h3 class="profile-username text-center">{{$reseller->name}}</h3>

          <p class="text-muted text-center">{{$reseller->role}}</p>

          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              {{$reseller->phone}}
            </li>
            <li class="list-group-item">
              {{$reseller->email}}
            </li>
            <li class="list-group-item">
              {{$reseller->address}}
            </li>
          </ul>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <div class="col-lg-2 col-4">
      <!-- small box -->
      <div class="small-box bg-danger">
        <a href="#" class="small-box-footer">
        <div class="inner">
          <h3>{{ App\Models\User::reseller_balance($reseller->id) }}</h3>
          <p>Current balance</p>
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
          <h3>{{ App\Models\User::reseller_sell($reseller->id) }}</h3>
          <p>Sell amount</p>
        </div>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-4">
      <!-- small box -->
      <div class="small-box bg-success">
        <a href="#" class="small-box-footer">
        <div class="inner">
          <h3>{{ App\Models\User::reseller_paid($reseller->id) }}</h3>
          <p>Paid amount</p>
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
          <h3>{{ App\Models\User::reseller_due($reseller->id) }}</h3>
          <p>Due amount</p>
        </div>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-4">
      <!-- small box -->
      <div class="small-box bg-warning">
        <a href="#" class="small-box-footer">
        <div class="inner">
          @php
          $t = 0;
          foreach(App\Models\User::where('role', 'reseller')->where('added_by_id', $reseller->id)->get() as $key => $reseller){
            $t += App\Models\User::reseller_balance($reseller->id);
          }
          @endphp
          <h3>&#2547; {{ $t }}</h3>
          <p>Reseller available balance</p>
        </div>
        </a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- ./row -->
  
  <h3>Sell card</h3>
  <div class="row">
    @foreach($rate_plans as $key => $rate_plan)
    <div class="col-md-3">
      <div class="card">
        <div class="card-header bg-success">
          <h3 class="card-title">{{$rate_plan->currency}} {{$rate_plan->amount}}</h3>
          <div class="card-tools">{{App\Models\User::my_sell_card($reseller->id, $rate_plan->id)}} Pce</div>
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