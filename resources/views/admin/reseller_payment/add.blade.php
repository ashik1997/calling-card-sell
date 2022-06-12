@extends('admin.layouts.app')
@section('title', 'Payment')
@section('link')
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('backend/')}}/plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('backend/')}}/ionicons/2.0.1/css/ionicons.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('backend/')}}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('backend/')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('backend/')}}/dist/css/adminlte.min.css">

<!-- summernote -->
<link rel="stylesheet" href="{{asset('backend/')}}/plugins/summernote/summernote-bs4.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Payment</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Payment</a></li>
          <li class="breadcrumb-item active">Add New</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-6">
    	<!-- card -->
      <div class="card card-default">
      	<div class="card-header bg-info">
          <h3 class="card-title">Payment</h3>
          <div class="card-tools">
            <a href="{{route('admin.reseller_payment.list')}}" class="btn btn-primary float-right"><i class="fa fa-arrow-left"></i> Back</a>
          </div>
      	</div>
      	<!-- /.card-header -->
      	@if ($errors->any())
        <div class="alert alert-danger alert-dismissible" id="myAlert">
          <a href="" class="close">&times;</a>
          <ul>
          @foreach ($errors->all() as $error)
            <li>
            <strong>Oh sanp!</strong> {{ $error }}
            </li>
          @endforeach
          </ul>
        </div>
        @endif
        <form action="{{ route('admin.reseller_payment.add') }}" method="post" enctype="multipart/form-data">
        	@csrf
	        <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" onchange="due_cal()" class="form-check-input" name="payment_type" value="payment" checked="">Payment
                    </label>
                  </div>
                </div>
              </div>
              @if(isset($_GET['reseller_id']))
              <input type="hidden" name="reseller_id" id="reseller_id" class="form-control" value="{{$_GET['reseller_id']}}" placeholder="">
              @else
              <div class="col-md-12">
                <div class="form-group">
                  <label for="reseller_id">Reseller</label>
                  <select name="reseller_id" id="reseller_id" class="form-control select2 select2-hidden-accessible" onchange="due_cal()" style="width: 100%;" required="required">
                    <option value="">Select one</option>
                    @foreach(App\Models\User::where('role','reseller')->where('added_by_id', Auth::user()->id)->get() as $key=>$reseller)
                    <option @if(isset($_GET['reseller_id']) && $reseller->id==$_GET['reseller_id']) {{ __('selected') }} @elseif(isset($_GET['reseller_id']) && $reseller->id!=$_GET['reseller_id']) disabled @endif  value="{{ $reseller->id }}">{{ $reseller->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              @endif
              <div class="col-md-12">
                <div class="form-group">
                  <label for="current_balance">Current balance</label>
                  <input type="text" name="current_balance" id="current_balance" class="form-control" disabled="" placeholder="">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="previous_due">Previous due</label>
                  <input type="text" name="previous_due" id="previous_due" class="form-control" disabled="" placeholder="">
                </div>
              </div>
              <div class="col-md-12" id="paid_amount_hide_show">
                <div class="form-group">
                  <label for="paid_amount">Paid amount</label>
                  <input type="text" name="paid_amount" id="paid_amount" class="form-control" onkeyup="due_cal()" value="0" placeholder="Enter paid amount">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="note">Note</label>
                  <input type="text" name="note" id="note" class="form-control" value="" placeholder="Enter note">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="payment_date">Payment date</label>
                  <input type="date" name="payment_date" id="payment_date" class="form-control" value="{{date('Y-m-d')}}" placeholder="Enter payment date">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="due">Due</label>
                  <input type="text" name="due" id="due" class="form-control text-danger" value="{{old('due')}}" disabled="disabled" placeholder="Due">
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
	        <!-- /.card-body -->
        	<div class="card-footer">
        		<button type="submit" name="save" class="btn btn-success btn-lg">Save</button>
        	</div>
        </form>
      </div>
      <!-- /.card -->
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('script')
<!-- jQuery -->
<script src="{{asset('backend/')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/')}}/plugins/select2/js/select2.full.min.js"></script>
<script src="{{asset('backend/')}}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('backend/')}}/dist/js/demo.js"></script>
<!-- Summernote -->
<script src="{{asset('backend/')}}/plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    due_cal();
    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })
  function due_cal(){
    let paid_amount = $("#paid_amount").val();
    if(paid_amount==''){
      paid_amount = 0;
    }
    let reseller_id = $("#reseller_id").val();
    let csrf = $("input[name='_token']").val();
    $.ajax({
     type: "POST",
     url: "{{route('admin.due_balance_by_reseller_id')}}",
     dataType: 'json',
     data: {
      id:reseller_id,
      _token: csrf
     }, // serializes the form's elements.
     success: function(data)
     {
      console.log(data);
      $("#previous_due").val(data[0]);
      var payment_type = $('input[name=payment_type]:checked').val();
      // alert(payment_type);
      $("#current_balance").val(parseFloat(data[1]));
      if (payment_type=='payment') {
        $("#due").val(parseFloat(data[0])-parseFloat(paid_amount));
        $("#paid_amount_hide_show").show();
        $("#add_balance_hide_show").hide();
      }
     }
    });
  }
</script>
@endsection