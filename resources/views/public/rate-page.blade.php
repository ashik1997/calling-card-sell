@extends('public.layouts.app')
@section('title', 'Rate details')
@section('content')
	<!-- ========================= 
        Country Rate
     ============================= -->
	<section class="country-rate">
		<div class="container custom-container">
			<div class="row">
				<div class="col-12 primary-bg country-rate-form-area">
					<form class="country-form container">
						<div class="row d-md-flex justify-content-md-center">
							<div class="col-12 col-sm-7 col-md-6 col-xl-6">
								<input type="text" class="form-control" placeholder="Where Do You Want To Call?">
							</div>
							<div class="col-12 col-sm-5 col-md-3 col-xl-3 pdl-0">
								<select class="custom-select border-0">
                                    <option selected>Germany(Euro)</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="main-title-box text-center">
						<h1 class="w-bold main-title">
							Pay As You Go Credit
						</h1>
						<div class="title-shap">
							<img src="{{asset('frontend/')}}/img/title-shap.png" class="img-fluid" alt="title shap">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<?php
				$slug = Request::route('slug');
				$country = App\Models\Country::where('name', 'LIKE', $slug)->first();
				$coun = $country->name;
				$voip_rates = App\Models\VoipRate::where('country', 'LIKE', "%$coun%")->get();
				?>
				<div class="country-small-des" style="width: 100%;">
					<div class="country-des d-flex align-items-center">
						<div class="country-img"><img src="{{asset('frontend/')}}/assets/img/country/{{ $country->flag }}" alt=""></div>
						<div class="country-name1">
							<h2>{{$country->name}}</h2>
							<span class="d-none d-md-inline-block">*Last update {{date("F Y", strtotime($country->created_at))}}</span>
						</div>
						<div class="currency ml-auto">
							<select>
                            <option selected>USD</option>
                            <!-- <option>Euro</option> -->
                        </select>
						</div>
					</div>
					<div class="calls-des">
						<h4><span>Calls</span> (No expiry date)</h4>

						<div class="call-package">
							<div class="row no-gutters package-offer package-type">
								<div class="col-4 col-sm-5 col-xl-5 package-name">
									<h5>Carriers</h5>
								</div>
								<div class="col-5 col-sm-4 col-xl-5 package-type-one">
									<h5>Rate</h5>
									<!-- <span>USD</span> -->
								</div>
								<div class="col-3 col-sm-3 col-xl-2 package-type-two">
									<h5>Call</h5>
									<!-- <span>USD</span> -->
								</div>
							</div>
							@foreach($voip_rates as $k => $voip_rate)
							<div class="row no-gutters package-offer">
								<div class="col-4 col-sm-5 col-xl-5 package-name">
									<h5>{{$voip_rate->country}}</h5>
									<span>{{$voip_rate->code}}</span>
								</div>
								<div class="col-5 col-sm-4 col-xl-5 package-types">
									<h5>${{$voip_rate->rate}}/min</h5>
								</div>
								<div class="col-3 col-sm-3 col-xl-2 package-types">
									<h5>{{ round($voip_rate->minute,2)}} min/$100</h5>
								</div>
							</div>
							@endforeach
						</div>

						<p>spacer* A connection fee applies</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ========================= 
        Country Rate
     ============================= -->

	<section id="main-des">
		<div class="container custom-container">
			<div class="row">
				<div class="col-12">
					<div class="main-title-box text-center">
						<h1 class="w-bold main-title">
							Browse All Prices By Country:
						</h1>
						<div class="title-shap">
							<img src="{{asset('frontend/')}}/img/title-shap.png" class="img-fluid" alt="title shap">
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-12">
					<ul class="first-letter text-center">
						<li data-tabs="tab-A" class="active">A</li>
						<li data-tabs="tab-B">B</li>
						<li data-tabs="tab-C">C</li>
						<li data-tabs="tab-D">D</li>
						<li data-tabs="tab-E">E</li>
						<li data-tabs="tab-F">F</li>
						<li data-tabs="tab-G">G</li>
						<li data-tabs="tab-H">H</li>
						<li data-tabs="tab-I">I</li>
						<li data-tabs="tab-J">J</li>
						<li data-tabs="tab-K">K</li>
						<li data-tabs="tab-L">L</li>
						<li data-tabs="tab-N">M</li>
						<li data-tabs="tab-M">N</li>
						<li data-tabs="tab-O">O</li>
						<li data-tabs="tab-P">P</li>
						<li data-tabs="tab-Q">Q</li>
						<li data-tabs="tab-R">R</li>
						<li data-tabs="tab-S">S</li>
						<li data-tabs="tab-T">T</li>
						<li data-tabs="tab-U">U</li>
						<li data-tabs="tab-V">V</li>
						<li data-tabs="tab-W">W</li>
						<li data-tabs="tab-X">X</li>
						<li data-tabs="tab-Y">Y</li>
						<li data-tabs="tab-Z">Z</li>
					</ul>
				</div>

				<?php
				$countries = App\Models\Country::get();
				foreach($countries as $key=> $country){
				$first_char_country = mb_substr($country->name, 0, 1);
				?>
				<!-- {{$first_char_country}} Group -->
				<div class="col-12">
					<?php
					$coun = $country->name;
					$voip_rates = App\Models\VoipRate::where('country', 'LIKE', "%$coun%")->get();
					?>
					<div class="tab-{{$first_char_country}} single-country-des <?php if($first_char_country =='A'){echo 'active'; } ?>">
						<div class="country-name2 d-flex align-items-center">
							<div class="img-box"><img src="{{asset('frontend/')}}/assets/img/country/{{ $country->flag }}" alt="{{$country->name}}"></div>
							<h3 class="country">{{$country->name}}</h3>
							<a href="#" class="btn ml-auto">Buy Now</a>
						</div>
						<?php
						$coun = $country->name;
						$voip_rates = App\Models\VoipRate::where('country', 'LIKE', "%$coun%")->get()
						?>
						<div class="call-price-des">
							
							<div class="des-single">
								<div class="row no-gutters">
									<div class="col-xl-5 col-5">
										<div class="price-type">
											<h2>Pay as you go</h2>
											<span>Carriers</span>
										</div>
									</div>
									<div class="col-xl-5 col-4">
										<div class="price-type">
											<h2>Rate</h2>
											<span>USD</span>
										</div>
									</div>
									<div class="col-xl-1 col-3">
										<div class="price-type">
											<h2>CALLS</h2>
											<span>USD</span>
										</div>
									</div>
								</div>
							</div>
							
							@foreach($voip_rates as $k => $voip_rate)
							<div class="des-single">
								<div class="row no-gutters">
									<div class="col-xl-5 col-5">
										<div class="price-type">
											<h2>{{$voip_rate->country}}</h2>
											<span>{{$voip_rate->code}}</span>
										</div>
									</div>
									<div class="col-xl-5 col-4">
										<div class="price-type price-h">
											<h2>${{$voip_rate->rate}}/min</h2>
										</div>
									</div>
									<div class="col-xl-1 col-3">
										<div class="price-type price-h">
											<h2>{{ round($voip_rate->minute,2)}} min/$100</h2>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						<p>* A connection fee applies</p>
					</div>
				</div>
				<?php 
				}
				?>
			</div>
		</div>
	</section>
@endsection