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
						Contact Us
					</div>
					<div class="d-sm-flex justify-content-sm-center">
						<div class="sub-title white">
							Don’t Hesitate to contact with us for any kind of information
						</div>
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
				<div class="col-md-4 pos-r">
					<div class="contact-box text-center">
						<div class="contact-icon">
							<i class="fa fa-map-marker" aria-hidden="true"></i>
						</div>
						<div class="contact-title">
							Location
						</div>
						<div class="contact-content">
							{{ App\Models\SiteInfo::pluck('address')[0] }}
						</div>
					</div>
					<div class="ct-border"></div>
				</div>
				<div class="col-md-4 pos-r">
					<div class="contact-box text-center" data-aos="fade-up" data-aos-delay="400">
						<div class="contact-icon">
							<i class="fa fa-envelope-open" aria-hidden="true"></i>
						</div>
						<div class="contact-title">
							Phone &#38; Email
						</div>
						<div class="contact-content">
							{{ App\Models\SiteInfo::pluck('phone')[0] }} &#38; {{ App\Models\SiteInfo::pluck('email')[0] }}
						</div>
					</div>
					<div class="ct-border"></div>
				</div>
				<div class="col-md-4 pos-r">
					<div class="contact-box text-center">
						<div class="contact-icon">
							<i class="fa fa-share-alt" aria-hidden="true"></i>
						</div>
						<div class="contact-title">
							Stay in Touch
						</div>
						<div class="contact-content">
							Also find us in social media below
							<div class="socal-media">
								<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
								<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
								<a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
								<a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ========================= 
        Contact Info
     ============================= -->
	<div class="contact-form">
		<div class="container custom-container">
			<div class="row">
				<div class="col-lg-6">
					<form data-aos="fade-left" data-aos-delay="600" action="{{route('contact-send-message')}}" method="post">
						<div class="form-group row">
							<label for="subject" class="col-sm-3 col-form-label d-flex align-items-center">Subject</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="subject" name="subject">
							</div>
						</div>
						<div class="form-group row">
							<label for="email" class="col-sm-3 col-form-label d-flex align-items-center">Email</label>
							<div class="col-sm-8">
								<input type="email" class="form-control" id="email" name="email">
							</div>
						</div>
						<div class="form-group row">
							<label for="message" class="col-sm-3 col-form-label d-flex align-items-center">Message</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="message" name="message">
							</div>
						</div>
						<div class="col-12 col-sm-8 col-md-11 pd-0 text-right">
							<button type="submit" class="btn btn-primary">Send Messages</button>
						</div>
					</form>
				</div>
				<div class="col-lg-6">
					<div data-aos="fade-right" data-aos-delay="600">{!! App\Models\SiteInfo::pluck('map_embed')[0] !!}</div>
				</div>
			</div>
		</div>
	</div>
@endsection
