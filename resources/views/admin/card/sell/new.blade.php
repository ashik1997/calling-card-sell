@extends('admin.layouts.app')
@section('title', 'New Card Sell ')
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
  /* Centered text */
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>New Card Sell</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item">Card</li>
          <li class="breadcrumb-item active">Rate Plan</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-success">
          <h3 class="card-title">কার্ডটি কিনতে নিচের কন্ফার্ম বাটনে ক্লিক করুন ।</h3>
          <div class="card-tools">
            <a href="{{route('admin.card.sell_rate_plan')}}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
	        <div class="ctr">
	          <img class="img-fluid" src="{{asset('frontend/')}}/assets/img/rate_plan/{{$card->image}}">
	          <div class="top-left">{{$card->amount}} {{$card->currency}}</div>
	        </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="row">
            <div class="col-md-12">
              <a href="{{route('admin.card_by_id',$card->id)}}?sell_rate_plan_id={{$_GET['sell_rate_plan_id']}}" class="btn btn-success btn-lg float-left"><i class="fa fa-check"></i> Confirm</a>
              <a class="btn btn-info btn-lg float-right" data-toggle="collapse" href="#collapseDetails" role="button" aria-expanded="false" aria-controls="collapseDetails"><i class="fa fa-clock"></i> Minute details</a>
            </div>
          </div>
	        <div class="row">
            <div class="col-md-12">
              <div class="collapse" id="collapseDetails">
                <div class="card card-body">
                  <table class="table-bordered">
                    <tr>
                      <td>Country</td>
                      <td>Code</td>
                      <td>Minute</td>
                    </tr>
                    @php
                    $sell_rate_plan = App\Models\SellRatePlan::where('id', $_GET['sell_rate_plan_id'])->first();
                    $sell_voip_rates = App\Models\SellVoipRate::where('sell_rate_plan_id', $_GET['sell_rate_plan_id'])->get();
                    
                    @endphp
                    @foreach($sell_voip_rates as $key => $voip_rate)
                    @php
                    $total_minute = $sell_rate_plan->currency_rate*100/$voip_rate->rate;
                    $real_second = $total_minute*60;
                    $how_many_seconds_per_minutes = $real_second/$sell_rate_plan->how_many_minutes_of_seconds;
                    @endphp
                    <tr>
                      <td>{{$voip_rate->country}}</td>
                      <td>{{$voip_rate->code}}</td>
                      <td><?php echo round($how_many_seconds_per_minutes, 2); ?></td>
                    </tr>
                    @endforeach

                    <!-- @foreach(App\Models\MinuteForCountry::where('rate_plan_id', $card->rate_plan_id)->get() as $key => $mfc)
                    <tr>
                      <td>{{$mfc->country}}</td>
                      <td>{{$mfc->country_code}}</td>
                      <td>{{$mfc->minute}}</td>
                    </tr>
                    @endforeach -->
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-footer -->
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
</script>
@endsection