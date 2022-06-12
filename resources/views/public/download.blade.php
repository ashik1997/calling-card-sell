@extends('public.layouts.app')
@section('title', '')
@section('content')
	<!-- ========================= 
        Slider Section
     ============================= -->
	<div class="breadcome">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="col-md-10 col-lg-8 col-lg-10">
					<div class="breadcome-title white text-center">
						We’ve got an app for you
					</div>
					<div class="breadcome-list-group d-md-flex justify-content-md-between">
						<ul class="list-group">
							<li class="list-group-item bg-none white pd-0 border-0">High quality calls</li>
							<li class="list-group-item bg-none white pd-0 border-0">SMS text messaging</li>
						</ul>
						<ul class="list-group">
							<li class="list-group-item bg-none white pd-0 border-0">Rate finder</li>
							<li class="list-group-item bg-none white pd-0 border-0">Instant credit track</li>
						</ul>
						<ul class="list-group">
							<li class="list-group-item bg-none white pd-0 border-0">Sync your address book</li>
							<li class="list-group-item bg-none white pd-0 border-0">Automatic switch between Wifi and 3G</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ========================= 
        Apps Link Section
     ============================= -->
	<div class="apps-link-box-area">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-md-12">
					<div class="app-link-box-title text-center" data-aos="fade-up" data-aos-delay="200">
						Download For Desktop
						<div class="subtitle">PC/Laptop/Mac/Linux</div>
					</div>
					<div class="apps-link-box">
						<div class="container">
							<div class="row">
								<div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3 text-center d-flex align-items-end  justify-content-center" data-aos="zoom-in" data-aos-delay="200">
									<div class="app-content ">
										<img class="img-fluid" src="{{asset('frontend/')}}/img/download-icon-1.png" alt="download-icon-1">
										<div class="d-block">
											<button type="button" class="btn btn-primary pd-0">Download</button>
										</div>
									</div>
								</div>
								<div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3 text-center d-flex align-items-end  justify-content-center" data-aos="zoom-in" data-aos-delay="400">
									<div class="app-content ">
										<img class="img-fluid" src="{{asset('frontend/')}}/img/download-icon-2.png" alt="download-icon-2">
										<div class="d-block">
											<button type="button" class="btn btn-primary pd-0">Download</button>
										</div>
									</div>
								</div>
								<div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3 text-center d-flex align-items-end  justify-content-center" data-aos="zoom-in" data-aos-delay="600">
									<div class="app-content">
										<img class="img-fluid" src="{{asset('frontend/')}}/img/download-icon-3.png" alt="download-icon-3">
										<div class="d-block">
											<button type="button" class="btn btn-primary pd-0">Download</button>
										</div>
									</div>
								</div>
								<div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3 text-center d-flex align-items-end  justify-content-center" data-aos="zoom-in" data-aos-delay="800">
									<div class="app-content">
										<img class="img-fluid" src="{{asset('frontend/')}}/img/download-icon-4.png" alt="download-icon-4">
										<div class="d-block">
											<button type="button" class="btn btn-primary pd-0">Download</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="app-link-box-title text-center" data-aos="fade-up" data-aos-delay="200">
						Download For Mobile
						<div class="subtitle">PC/Laptop/Mac/Linux</div>
					</div>
					<div class="apps-link-box">
						<div class="container">
							<div class="row">
								<div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3 text-center d-flex align-items-end  justify-content-center" data-aos="zoom-in" data-aos-delay="200">
									<div class="app-content ">
										<img class="img-fluid" src="{{asset('frontend/')}}/img/download-icon-5.png" alt="download-icon-5">
										<div class="d-block">
											<button type="button" class="btn btn-primary pd-0">Download</button>
										</div>
									</div>
								</div>
								<div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3 text-center d-flex align-items-end  justify-content-center" data-aos="zoom-in" data-aos-delay="400">
									<div class="app-content ">
										<img class="img-fluid" src="{{asset('frontend/')}}/img/download-icon-6.png" alt="download-icon-6">
										<div class="d-block">
											<button type="button" class="btn btn-primary pd-0">Download</button>
										</div>
									</div>
								</div>
								<div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3 text-center d-flex align-items-end  justify-content-center" data-aos="zoom-in" data-aos-delay="600">
									<div class="app-content ">
										<img class="img-fluid" src="{{asset('frontend/')}}/img/download-icon-7.png" alt="download-icon-7">
										<div class="d-block">
											<button type="button" class="btn btn-primary pd-0">Download</button>
										</div>
									</div>
								</div>
								<div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3 text-center d-flex align-items-end  justify-content-center" data-aos="zoom-in" data-aos-delay="800">
									<div class="app-content ">
										<img class="img-fluid" src="{{asset('frontend/')}}/img/download-icon-8.png" alt="download-icon-8">
										<div class="d-block">
											<button type="button" class="btn btn-primary pd-0">Download</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="app-link-box-title text-center" data-aos="fade-up" data-aos-delay="200">
						Download For Tab
						<div class="subtitle">PC/Laptop/Mac/Linux</div>
					</div>
					<div class="apps-link-box">
						<div class="container">
							<div class="row d-flex justify-content-center">
								<div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3 text-center d-flex align-items-end  justify-content-center" data-aos="zoom-in" data-aos-delay="200">
									<div class="app-content ">
										<img class="img-fluid" src="{{asset('frontend/')}}/img/download-icon-9.png" alt="download-icon-9">
										<div class="d-block">
											<button type="button" class="btn btn-primary pd-0">Download</button>
										</div>
									</div>
								</div>
								<div class="col-6 col-sm-3 col-md-3 col-lg-3 col-xl-3 text-center d-flex align-items-end  justify-content-center" data-aos="zoom-in" data-aos-delay="400">
									<div class="app-content ">
										<img class="img-fluid" src="{{asset('frontend/')}}/img/download-icon-10.png" alt="download-icon-10">
										<div class="d-block">
											<button type="button" class="btn btn-primary pd-0">Download</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
@endsection
