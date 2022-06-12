@extends('public.layouts.app')
@section('title', 'Rates')
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
            @foreach(App\Models\Country::get() as $key=>$country)
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
              <div class="country-rate-box white-bg ad-m wow fadeInUp">
                @if(!empty($country->mark))
                <div class="ribbon"><span>{{ $country->mark }}</span></div>
                @endif
                <div class="media">
                  <div class="country-img-box pd-0 col-5 col-xl-6">
                    <img class="mr-3 img-fluid" src="{{asset('frontend/')}}/assets/img/country/{{ $country->flag }}" alt="{{ $country->name }}">
                  </div>
                  <div class="media-body">
                    <h4 class="mt-0">{{ $country->name }}</h4>
                    {{ $country->note }}
                    <a class="d-block base" href="rate/{{$country->name}}">More <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
		</div>
	</section>


@endsection