@extends('admin.layouts.app')
@section('title', 'All Reseller')
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
        <h1>All Reseller</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item">All Reseller</li>
          <li class="breadcrumb-item active">List</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-info">
          <h3 class="card-title">All Reseller</h3>
          <div class="card-tools">
            <a href="{{route('admin.reseller.add')}}" class="btn btn-primary float-right">Add New</a>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <span class="table-responsive">
            <table id="example1" class="table table-bordered table-sm">
              <thead>
              <tr>
                <th>#</th>
                <th>Action</th>
                <th>Active status</th>
                <th>Reseller info</th>
                <th>Purchase</th>
                <th>Paid</th>
                <th>Due</th>
                <th>C Balance</th>
              </tr>
              </thead>
              <tbody>
              @foreach($resellers as $key => $reseller)
              <tr>
                <td>{{$key+1}}</td>
                <td>
                  <span class="">
                    <a class="btn btn-primary btn-sm fa fa-edit" href="{{ route('admin.reseller.edit',$reseller->id) }}"> Edit</a><br>
                     <a onclick="confirmation(event)" class="btn btn-danger btn-sm fa fa-trash-alt" href="{{ route('admin.reseller.delete',$reseller->id) }}"></a> 
                    <!-- <a class="btn btn-success btn-sm" href="{{ route('admin.reseller_payment.add') }}?reseller_id={{$reseller->id}}" title="due payment"><i class="fa fa-plus"></i> Due payment</a><br>
                    <a class="btn btn-info btn-sm" href="{{ route('admin.reseller_balance.add') }}?reseller_id={{$reseller->id}}" title="add balance"><i class="fa fa-plus"> Add balance</i></a><br> -->
                    <a class="btn btn-danger btn-sm" href="{{route('admin.reseller.report',$reseller->id)}}" title="report"><i class="fa fa-eye"></i> Profile</a>
                  </span>
                </td>
                <td>
                  <label class="switch">
                    <input type="checkbox" onclick="user_status({{$reseller->id}})" 
                    @if ($reseller->status==1) checked @endif>
                    <span class="slider round"></span>
                  </label>
                </td>
                <td>
                  <?php if (!empty($reseller->img)&&file_exists('backend/dist/img/'.$reseller->img)): ?>
                  <img src="{{asset('backend/')}}/dist/img/{{ $reseller->img }}" height="40" width="40" alt=""><br>  
                  <?php endif ?>
                  Name: {{$reseller->name}}<br>
                  Email: {{$reseller->email}}<br>
                  Phone: {{$reseller->phone}}<br>
                  Discount: {{$reseller->discount}}<br>
                  Address: {{$reseller->address}}<br>
                  Parent: {{App\Models\User::where('added_by_id', $reseller->added_by_id)->pluck('name')[0]}}
                </td>
                <td>{{ App\Models\User::reseller_sell($reseller->id) }}</td>
                <td>{{ App\Models\User::reseller_paid($reseller->id) }}</td>
                <td>{{ App\Models\User::reseller_due($reseller->id) }}</td>
                <td>{{ App\Models\User::reseller_balance($reseller->id) }}</td>
              </tr>
              @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>#</th>
                <th>Action</th>
                <th>Active status</th>
                <th>Reseller info</th>
                <th>Purchase</th>
                <th>Paid</th>
                <th>Due</th>
                <th>C Balance</th>
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
function confirmation(ev) {
  ev.preventDefault();
  var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
  // console.log(urlToRedirect); // verify if this is the right URL
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
      window.location.href = urlToRedirect;
    }
  })
}
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
function user_status(id){
  let csrf = $("input[name='_token']").val();
  $.ajax({
    url: "{{route('admin.reseller.status.update')}}",
    type: 'POST',
    data: { user_id:id, _token: csrf },
    success: function(response){
      if(response == 1){
        Toast.fire({
          icon: 'success',
          title: 'Reseller activated'
        })
      }else if(response == 0){
        Toast.fire({
          icon: 'success',
          title: 'Reseller deactivated'
        })
      }
    }
  });
}
</script>
@endsection