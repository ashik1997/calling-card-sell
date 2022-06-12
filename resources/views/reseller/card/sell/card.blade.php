@extends('reseller.layouts.app')
@section('title', 'New Card Sell ')
@section('link')
<meta name="description" content="Piyofon Express<br>
						{{$card->rate_plan->currency}} {{$card->rate_plan->amount}}<br>
						User: {{$card->user}}<br>
						Pass: {{$card->pin}}<br>
						Using video link: <br>
						Android dailer: <br>
						ISO dailer: <br>
						Windows dailer: <br>">
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
	  color: #000;
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
	  top: 70%;
	  left: 0%;
	  right: 0%;
	  transform: translate(0%, 0%);
	}
	.card-border{
		padding: 10px 0;
    background: #fff;
    border-radius: 25px;
	}
</style>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-6">
      @if(!empty($successMsg))
        <div class="alert alert-success"> {{ $successMsg }}</div>
      @endif
      <div class="card">
        <div class="card-header bg-success">
          <h3 class="card-title">{{$card->rate_plan->currency}} {{$card->rate_plan->amount}}</h3>
          <div class="card-tools bg-success">
            <div class="card-tools">
            <a href="{{route('reseller.card.sell_rate_plan')}}" class="btn btn-custom btn-sm"><i class="fa fa-shopping-bag"></i> New Buy</a>
          </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
	        <div class="ctr">
	          <img class="img-fluid" src="{{asset('frontend/')}}/assets/img/rate_plan/{{$card->rate_plan->image2}}">
	          <div class="top-left" style="color:#fff">{{$card->rate_plan->amount}} {{$card->rate_plan->currency}}</div>
	          <div class="centered card-border">User: {{$card->user}} | Pass: {{$card->pin}} </div>
	        </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
					<div class="row" id="printableArea">
						<!-- Font Awesome -->
						<link rel="stylesheet" href="{{asset('backend/')}}/plugins/fontawesome-free/css/all.min.css">
						<!-- Ionicons -->
						<link rel="stylesheet" href="{{asset('backend/')}}/ionicons/2.0.1/css/ionicons.min.css">
						<!-- Theme style -->
						<link rel="stylesheet" href="{{asset('backend/')}}/dist/css/adminlte.min.css">
						<!-- Google Font: Source Sans Pro -->
						<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
						<div class="col-md-12">
							<div class="card card-body">
								Piyofon Express<br>
								Rate: {{$card->rate_plan->currency}} {{$card->rate_plan->amount}}<br>
								User: {{$card->user}}<br>
								Pass: {{$card->pin}}<br>
								Using video link: <br>
								Android dailer: <br>
								ISO dailer: <br>
								Windows dailer: 
							</div>
						</div>
					</div>
					<div class="row">
						<div class="card card-body">
							<table>
								<tr>
									<td><a class="btn btn-info btn-sm text-white" onclick="CopyToClipboard('printableArea')"><i class="fa fa-copy"></i> Copy</a></td>
									<td class="text-center"><a class="btn btn-info btn-sm text-white" onclick="PrintElem('printableArea')"><i class="fa fa-print"></i> Print</a></td>
									<td><a class="btn btn-info btn-sm text-white float-sm-right"><i class="fa fa-share-alt"></i> Share</a></td>
								</tr>
							</table>
							<!-- <div class="row">
								<div class="col-md-4 col-xs-4"></div>
								<div class="col-md-4 col-xs-4"><center><a class="btn btn-info btn-sm text-white" onclick="PrintElem('printableArea')">Print</a></center></div>
								<div class="col-md-4 col-xs-4"><a class="btn btn-info btn-sm text-white float-sm-right">Share</a></div>
							</div> -->
						</div>
					</div>
	        <div class="row">
            <div class="col-md-12">
            	<div class="card card-body">
                <div class='vuukle-powerbar'></div>
                <script>
                  var VUUKLE_CONFIG = {
                    apiKey: 'c5dbcce6-70ba-4b0b-839f-d6a1d978d1e9',
                    articleId: '{{$card->id}}',
                  };
                  // ⛔️ DON'T EDIT BELOW THIS LINE
                  (function() {
                    var d = document,
                      s = d.createElement('script');
                    s.src = 'https://cdn.vuukle.com/platform.js';
                    (d.head || d.body).appendChild(s);
                  })();
                </script>
              </div>
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
<script type="text/javascript">
function PrintElem(elem){
  var mywindow = window.open('', 'PRINT', 'height=1000,width=1000');
  mywindow.document.write(document.getElementById(elem).innerHTML);

  mywindow.document.close(); // necessary for IE >= 10
  mywindow.focus(); // necessary for IE >= 10*/

  mywindow.print();
  // mywindow.close();

  return true;
}
function CopyToClipboard(containerid) {
  if (document.selection) {
    var range = document.body.createTextRange();
    range.moveToElementText(document.getElementById(containerid));
    range.select().createTextRange();
    document.execCommand("copy");
  } else if (window.getSelection) {
    var range = document.createRange();
    range.selectNode(document.getElementById(containerid));
    window.getSelection().addRange(range);
    document.execCommand("copy");
    // alert("Text has been copied, now paste in the text-area")
  }
}
</script>
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