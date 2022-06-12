@extends('admin.layouts.app')
@section('title', 'Sell Rate Plan List')
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
<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }

  .switch input { 
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #2196F3;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
</style>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Sell Rate Plan</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item">Sell Rate Plan</li>
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
        <div class="card-header bg-info">
          <h3 class="card-title">Sell Rate Plan List</h3>
          <div class="card-tools">
            <a href="{{route('admin.sell_rate_plan.add')}}" class="btn btn-primary float-right">Add New</a>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <span class="table-responsive">
            <table id="example1" class="table table-sm table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>Rate plan name</th>
                <th>Amount</th>
                <th>Discount per unit</th>
                <th>Currency rate</th>
                <th>How many minutes of seconds?</th>
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach($sell_rate_plans as $key => $sell_rate_plan)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$sell_rate_plan->currency}}</td>
                <td>{{$sell_rate_plan->amount}}</td>
                <td>{{$sell_rate_plan->discount}}</td>
                <td>{{$sell_rate_plan->currency_rate}}</td>
                <td>{{$sell_rate_plan->how_many_minutes_of_seconds}}</td>
                <td>{{$sell_rate_plan->title}}</td>
                <td>{!!$sell_rate_plan->description!!}</td>
                <td class="bt-group">
                  <a class="btn btn-success btn-sm" href="{{ route('admin.sell_rate_plan.sell_voip_rate_add',$sell_rate_plan->id) }}">Add voip rate</a>
                  <a class="btn btn-primary btn-sm fa fa-edit" href="{{ route('admin.sell_rate_plan.edit',$sell_rate_plan->id) }}"></a>
                  <!-- <a class="btn btn-danger btn-sm fa fa-trash-alt" href="{{ route('admin.sell_rate_plan.delete',$sell_rate_plan->id) }}"></a> -->
                  <label class="switch">
                    <input type="checkbox" onclick="status({{$sell_rate_plan->id}})" 
                    @if ($sell_rate_plan->status==1) checked @endif>
                    <span class="slider round"></span>
                  </label>
                </td>
              </tr>
              @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>#</th>
                <th>Rate plan name</th>
                <th>Amount</th>
                <th>Discount per unit</th>
                <th>Currency rate</th>
                <th>How many minutes of seconds?</th>
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
              </tfoot>
            </table>
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
function status(id){
  let csrf = $("input[name='_token']").val();
  $.ajax({
    url: "{{route('admin.sell_rate_plan.status.update')}}",
    type: 'POST',
    data: { sell_rate_plan_id:id, _token: csrf },
    success: function(response){
      if(response == 1){
        Toast.fire({
          icon: 'success',
          title: 'Sell rate plan activated'
        })
      }else if(response == 0){
        Toast.fire({
          icon: 'success',
          title: 'Sell rate plan deactivated'
        })
      }
    }
  });
}
</script>
@endsection