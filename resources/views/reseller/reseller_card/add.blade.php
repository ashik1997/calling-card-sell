@extends('reseller.layouts.app')
@section('title', 'Add New Reseller Card')
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

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-6">
    	<!-- card -->
      <div class="card card-default">
      	<div class="card-header bg-info">
          <!-- <h3 class="card-title">Add New Reseller Card</h3> -->
          <div class="card-tools">
            <a href="{{route('reseller.reseller_card.list')}}" class="btn btn-custom float-right"><i class="fa fa-arrow-left"></i> Back</a>
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
        <form action="{{ route('reseller.reseller_card.add') }}" method="post" enctype="multipart/form-data">
        	@csrf
	        <div class="card-body">
	        	<div class="row">
	        		<div class="col-md-6">
                <div class="form-group">
                  <label for="reseller_id">Reseller</label>
                  <select name="reseller_id" id="reseller_id" class="form-control select2  select2-hidden-accessible" style="width: 100%;" required="required">
                  	<option value="">Select one</option>
                  	@foreach(App\Models\User::where('role','reseller')->where('added_by_id', Auth::user()->id)->get() as $key=>$reseller)
                  	<option @if(isset($_GET['reseller_id']) && $reseller->id==$_GET['reseller_id']) {{ __('selected') }} @endif  value="{{ $reseller->id }}">{{ $reseller->name }}</option>
                  	@endforeach
                  </select>
                </div>
              </div>
	        		<div class="col-md-6">
                <div class="form-group">
                  <label for="rate_plan_id">Rate Plan <span id="available_qty" style="color: red;"></span></label>
                  <select name="rate_plan_id" id="rate_plan_id" class="form-control" onchange="bill_cal();available_card()" required="required">
                  	@foreach(App\Models\RatePlan::all() as $key=>$rate_plan)
                  	<option value="{{ $rate_plan->id }}">{{ $rate_plan->currency }} {{ $rate_plan->amount }}</option>
                  	@endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="qty">QTY</label>
                  <input type="number" name="qty" id="qty" class="form-control" onkeyup="bill_cal()" min="???" max="???" value="{{old('qty')}}"  placeholder="Enter qty" required="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="total_bill">Total bill</label>
                  <input type="text" name="total_bill" id="total_bill" class="form-control" value="{{old('total_bill')}}" disabled="disabled" placeholder="Total bill">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="paid_amount">Paid paid amount</label>
                  <input type="text" name="paid_amount" id="paid_amount" class="form-control" onkeyup="bill_cal()" value="{{old('paid_amount')}}" placeholder="Enter paid amount">
                </div>
              </div>
              <div class="col-md-6">
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
    available_card();
    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })
  function bill_cal(){
    let total_bill =  0;
    let qty = $("#qty").val();
    if (qty=='') {
      qty = 0;
    }
    let paid_amount = $("#paid_amount").val();
    if (paid_amount=='') {
      paid_amount = 0;
    }
    let rate_plan_id = $("#rate_plan_id").val();
    let csrf = $("input[name='_token']").val();
    $.ajax({
     type: "POST",
     url: "{{route('reseller.get_rate_plan_by_id')}}",
     data: {
      id:rate_plan_id,
      _token: csrf
     }, // serializes the form's elements.
     success: function(data)
     {
      let rate = data['amount']; // show response from the php script.
      // console.log(rate);
      total_bill = (qty*rate);
      // console.log(total_bill);
      $("#total_bill").val(total_bill);
      $("#due").val(total_bill-paid_amount);
     }
   });
    
  }
  function available_card(){
    let rate_plan_id = $("#rate_plan_id").val();
    let csrf = $("input[name='_token']").val();
    $.ajax({
     type: "POST",
     url: "{{route('reseller.available.card')}}",
     data: {
      rate_plan_id:rate_plan_id,
      _token: csrf
     }, // serializes the form's elements.
     success: function(data)
     {
      // console.log(data);
      $("#available_qty").html(' (Available '+data+' )');
       $("#qty").attr({
         "max" : data,        // substitute your own
         "min" : 1          // values (or variables) here
      });
     }
    });
  }
</script>
@endsection