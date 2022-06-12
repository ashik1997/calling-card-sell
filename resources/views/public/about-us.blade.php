@extends('public.layouts.app')
@section('title', 'Privacy & Policy')
@section('content')
	<!-- ========================= 
        Slider Section
     ============================= -->
	<div class="breadcome">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="col-md-10 col-lg-8 col-lg-10 text-center">
					<div class="breadcome-title white">
						About Us
					</div>
					<div class="d-sm-flex justify-content-sm-center">
						<div class="sub-title white"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ========================= 
        Contact Info
     ============================= -->
	<div class="contact-info">
		<div class="container">
			<div class="row">
			    <div class="col-sm-12">
			      <h2>{{ App\Models\About::pluck('title')[0] }}</h2><br>
			      <div class="row">
			        <div class="col-sm-6">
			          <img src="{{asset('frontend/')}}/assets/img/{{ App\Models\About::pluck('image')[0] }}" class="img-responsive" alt="" style="width: 100% !important;">
			        </div>
			        <div class="col-sm-6">
			          {!! App\Models\About::pluck('video')[0] !!}
			        </div>
			      </div>
			      <p>{!! App\Models\About::pluck('description')[0] !!}</p>
			    </div>
			</div>
		</div>
	</div>
@endsection