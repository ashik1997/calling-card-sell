@extends('reseller.layouts.app')
@section('title', 'Dashboard')
@section('link')
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{asset('backend/')}}/plugins/fontawesome-free/css/all.min.css">
<!-- IonIcons -->
<link rel="stylesheet" href="{{asset('backend/')}}/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('backend/')}}/dist/css/adminlte.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<style type="text/css">
  .btn-none{
    background: none;
    color: inherit;
    border: none;
    padding: 0;
    font: inherit;
    cursor: pointer;
    outline: inherit;
    color: blue;
  }
  .btn-none:focus {
    outline: none;
  }
  .bg-info{
    background: none !important;
  }
</style>

@endsection
@section('content')
@php
$added_by_id = Auth::user()->added_by_id;
$ads_by = App\Models\User::where('id', $added_by_id)->where('role', 'admin')->get();
@endphp

@if (count($ads_by)>0)
<script type="text/javascript">
  Swal.fire({
    imageUrl: `https://piyofon.com/frontend/assets/img/popup_banner/{{ App\Models\PopupBanner::orderBy('id', 'desc')->pluck('banner')[0] }}`,
    imageWidth: 600,
    imageHeight: 400,
    imageAlt: 'Ads',
    text: `{{ App\Models\PopupBanner::orderBy('id', 'desc')->pluck('title')[0] }}`,
    showClass: {
      popup: 'animate__animated animate__fadeInDown'
    },
    hideClass: {
      popup: 'animate__animated animate__fadeOutUp'
    },
    showCancelButton: false,
    showConfirmButton: false,
    showCloseButton: true
  })
</script>
@endif
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <!-- <h1 class="m-0 text-dark">Dashboard </h1> -->
      </div><!-- /.col -->
      <div class="col-sm-6">
        <!-- <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard </li>
        </ol> -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-2 col-4">
        <!-- small box -->
        <div class="">
          <a href="{{route('reseller.reseller.list')}}" class="small-box-footer">
            <div class="inner">
              <h3><img src="{{ asset('backend/') }}/dist/img/icon/icon/reseller.png" style="height: auto;width: 100% !important;"></h3>
              <p class="text-center text-dark" style="font-weight: bold;">Reseller</p>
            </div>
          </a>
        </div>
        
      </div>
      <!-- ./col -->
      <!-- <div class="col-lg-2 col-4">
        <div class="small-box bg-primary">
          <a href="{{route('reseller.reseller_card.list')}}" class="small-box-footer">
            <div class="inner">
              <h3><i class="ion ion-card"></i></h3>
              <p>Reseller card</p>
            </div>
          </a>
        </div>
      </div> -->
      <!-- ./col -->
      <div class="col-lg-2 col-4">
        <!-- small box -->
        <div class="">
          <a href="{{route('reseller.card.sell_rate_plan')}}" class="small-box-footer">
            <div class="inner">
              <h3><img src="{{ asset('backend/') }}/dist/img/icon/icon/buy_card.png" style="height: auto;width: 100% !important;"></h3>
              <p class="text-center text-dark" style="font-weight: bold;">Buy card</p>
            </div>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-2 col-4">
        <!-- small box -->
        <div class="">
          <a href="{{route('reseller.card.sell.history')}}" class="small-box-footer">
            <div class="inner">
              <h3><img src="{{ asset('backend/') }}/dist/img/icon/icon/sell_history.png" style="height: auto;width: 100% !important;"></h3>
              <p class="text-center text-dark" style="font-weight: bold;">Sell history</p>
            </div>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-2 col-4">
        <!-- small box -->
        <div class="">
          <a href="{{route('reseller.reseller_balance.list')}}" class="small-box-footer">
          <div class="inner">
            <h3><img src="{{ asset('backend/') }}/dist/img/icon/icon/add_balance.png" style="height: auto;width: 100% !important;"></h3>
            <p class="text-center text-dark" style="font-weight: bold;">Add balance</p>
          </div>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-2 col-4">
        <div class="">
          <a href="{{route('reseller.reseller_payment.list')}}" class="small-box-footer">
          <div class="inner">
            <h3><img src="{{ asset('backend/') }}/dist/img/icon/icon/payment.png" style="height: auto;width: 100% !important;"></h3>
            <p class="text-center text-dark" style="font-weight: bold;">Payment</p>
          </div>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-2 col-4">
        <!-- small box -->
        <div class="">
          <a href="{{route('reseller.report')}}" class="small-box-footer">
          <div class="inner">
            <h3><img src="{{ asset('backend/') }}/dist/img/icon/icon/report.png" style="height: auto;width: 100% !important;"></h3>
            <p class="text-center text-dark" style="font-weight: bold;">Report</p>
          </div>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-2 col-4">
        <!-- small box -->
        <div class="">
          <a href="{{route('reseller.profile')}}" class="small-box-footer">
            <div class="inner">
              <h3><img src="{{ asset('backend/') }}/dist/img/icon/icon/profile.png" style="height: auto;width: 100% !important;"></h3>
              <p class="text-center text-dark" style="font-weight: bold;">Profile</p>
            </div>
          </a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <div class="row">
      <div class="col-lg-12 col-12">
        <img src="{{asset('frontend/')}}/assets/img/{{ App\Models\SiteInfo::pluck('ad_banner')[0] }}" style="height: auto;width: 100% !important;">
      </div>
    </div>
    <!-- /.row -->
  </div>
<!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection
@section('script')
<!-- jQuery -->
<script src="{{asset('backend/')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('backend/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="{{asset('backend/')}}/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('backend/')}}/plugins/chart.js/Chart.min.js"></script>
<script src="{{asset('backend/')}}/dist/js/demo.js"></script>
<script src="{{asset('backend/')}}/dist/js/pages/dashboard3.js"></script>
@endsection