@extends('reseller.layouts.app')
@section('title', 'Reseller List')
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
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-info">
          <!-- <h3 class="card-title">Reseller List</h3> -->
          <div class="card-tools">
            <a href="{{route('reseller.reseller.add')}}" class="btn btn-custom float-right">Add New</a>
          </div>
        </div>
        @foreach($resellers as $key => $reseller)
              <tr>
                <td>{{$key+1}}</td>
                <td>
                  <span class="">
                    <a class="btn btn-primary btn-sm fa fa-edit" href="{{ route('reseller.reseller.edit',$reseller->id) }}"> Edit</a><br>
                    <!-- <a class="btn btn-danger btn-sm fa fa-trash-alt" onclick="confirmation(event)" href="{{ route('reseller.reseller.delete',$reseller->id) }}"></a><br> -->
                    <a class="btn btn-success btn-sm" href="{{ route('reseller.reseller_payment.add') }}?reseller_id={{$reseller->id}}" title="due payment"><i class="fa fa-plus"></i> Due payment</a><br>
                    <a class="btn btn-info btn-sm" href="{{ route('reseller.reseller_balance.add') }}?reseller_id={{$reseller->id}}" title="add balance"><i class="fa fa-plus"></i> Add balance</a><br>
                    <a class="btn btn-danger btn-sm" href="{{route('reseller.reseller.report',$reseller->id)}}" title="report"><i class="fa fa-eye"></i> Profile</a>
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
                  Address: {{$reseller->address}}
                </td>
                <td>{{ App\Models\User::reseller_sell($reseller->id) }}</td>
                <td>{{ App\Models\User::reseller_paid($reseller->id) }}</td>
                <td>{{ App\Models\User::reseller_due($reseller->id) }}</td>
                <td>{{ App\Models\User::reseller_balance($reseller->id) }}</td>
              </tr>
              @endforeach
              <!-- /.card-header -->
        
          @foreach($resellers as $key => $reseller)
            <div class="card-body">
              <table style="width: 100%;">
                <thead>
                  <tr>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td title="email">{{$reseller->email}}</td>
                    <td title="balance">{{ App\Models\User::reseller_balance($reseller->id) }}</td>
                  </tr>
                  <tr>
                    <td title="phone">{{$reseller->phone}}</td>
                    <td title="due">{{ App\Models\User::reseller_due($reseller->id) }}</td>
                  </tr>
                  <tr>
                    <td title="discount">{{$reseller->discount}}</td>
                    <td>{{ App\Models\User::reseller_due($reseller->id) }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          @endforeach
        
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
    url: "{{route('reseller.reseller.status.update')}}",
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