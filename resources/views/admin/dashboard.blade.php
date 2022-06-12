@extends('admin.layouts.app')
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
  p{
    margin-bottom: 2px !important;
  }
</style>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard </li>
        </ol>
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
        <div class="small-box bg-info">
          <a href="{{route('profile')}}" class="small-box-footer">
            <div class="inner">
              <h3><i class="ion ion-person"></i></h3>
              <p>Profile</p>
            </div>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-2 col-4">
        <!-- small box -->
        <div class="small-box bg-warning">
          <a href="{{route('admin.reseller.list')}}" class="small-box-footer">
            <div class="inner">
              <h3><i class="ion ion-person-add"></i></h3>
              <p>Reseller</p>
            </div>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <!-- <div class="col-lg-2 col-4">
        <div class="small-box bg-primary">
          <a href="{{route('admin.reseller_card.list')}}" class="small-box-footer">
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
        <div class="small-box bg-success">
          <a href="{{route('admin.card.sell_rate_plan')}}" class="small-box-footer">
            <div class="inner">
              <h3><i class="ion ion-bag"></i></h3>
              <p>Buy card</p>
            </div>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-2 col-4">
        <!-- small box -->
        <div class="small-box bg-info">
          <a href="{{route('admin.card.sell.history')}}" class="small-box-footer">
            <div class="inner">
              <h3><i class="ion ion-stats-bars"></i></h3>
              <p>Sell history</p>
            </div>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-2 col-4">
        <!-- small box -->
        <div class="small-box bg-danger">
          <a href="{{route('admin.rate_plan.list')}}" class="small-box-footer">
          <div class="inner">
            <h3><i class="ion ion-pie-graph"></i></h3>
            <p>Rate plan</p>
          </div>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-2 col-4">
        <!-- small box -->
        <div class="small-box bg-warning">
          <a href="{{route('admin.minute.list')}}" class="small-box-footer">
          <div class="inner">
            <h3><i class="ion ion-clock"></i></h3>
            <p>Minute</p>
          </div>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-2 col-4">
        <!-- small box -->
        <div class="small-box bg-primary">
          <a href="{{route('admin.card.list')}}" class="small-box-footer">
            <div class="inner">
              <h3><i class="ion ion-card"></i></h3>
              <p>Card</p>
            </div>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-2 col-4">
        <!-- small box -->
        <div class="small-box bg-success">
          <a href="{{route('admin.reseller_payment.list')}}" class="small-box-footer">
          <div class="inner">
            <h3><i class="ion ion-cash"></i></h3>
            <p>Payment</p>
          </div>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-2 col-4">
        <!-- small box -->
        <div class="small-box bg-info">
          <a href="{{route('admin.report')}}" class="small-box-footer">
          <div class="inner">
            <h3><i class="fas fa-chart-bar"></i></h3>
            <p>Report</p>
          </div>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-2 col-4">
        <!-- small box -->
        <div class="small-box bg-danger">
          <a href="{{route('site-info')}}" class="small-box-footer">
          <div class="inner">
            <h3><i class="ion ion-settings"></i></h3>
            <p>Settings</p>
          </div>
          </a>
        </div>
      </div>
      <!-- ./col -->
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