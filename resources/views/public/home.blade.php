@extends('public.layouts.app')
@section('title', 'Home')

@section('content')
<!-- ========================= 
        Slider Section
     ============================= -->
  <section class="main-slider">
    <div class="container">
      <div class="row  justify-content-md-between">

        <div class="col-3 col-sm-4 col-md-4 col-lg-5 col-xl-5 d-flex align-items-end">
          <ul id="scene" class="scene wow fadeInUp">
            <li class="layer" data-depth="0.50"><img src="{{asset('frontend')}}/img/slider-img-2.png" class="img-fluid main-slider-img" alt="phone muckup"></li>
          </ul>
        </div>

        <div class="col-9 col-sm-8 col-md-7 col-lg-7 col-xl-7 white d-flex align-items-center">
          <div class="slider-content-box wow fadeInUp" data-wow-delay=".4s">
            <h1 class="white slider-title">
              <span class="slider-subtitle d-block">If Emergency</span> We are here to dial for although
            </h1>
            <p class="d-none d-md-block slider-content">{{ App\Models\SiteInfo::pluck('short_about')[0] }}</p>
            <a href="{{route('reseller.dashboard')}}" class="btn btn-3 btn-3e icon-arrow-right">
              <p class="pos-r white">Join Now</p>
            </a>
            <a href="https://piyofon.com/frontend/CallingCardApp-0_2_debug.apk" class="btn btn-3 btn-3e icon-arrow-right mr-0">
              <p class="pos-r white">Download</p>
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>


  <!-- ========================= 
        Country Rate
     ============================= -->
  <section class="country-rate">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 primary-bg country-rate-form-area wow fadeInUp" data-wow-delay=".8s">
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
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="row">
            @foreach(App\Models\Country::whereNotNull('mark')->take(4)->get() as $key=>$country)
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
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center country-rate-btn wow fadeInUp" data-wow-delay=".2s">
              <a href="{{route('rates')}}" class="btn btn-3 btn-3e icon-arrow-right">See All Prices</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========================= 
        Feature
     ============================= -->
  <section class="feature">
    <div class="container custom-container">
      <div class="row">
        <div class="col-12">
          <div class="main-title-box text-center wow fadeInUp">
            <h1 class="w-bold main-title">
              <span class="d-block main-subtitle brand w-light-i">Apps Feature</span> Get Your Dialer App
            </h1>
            <div class="title-shap">
              <img src="{{asset('frontend')}}/img/title-shap.png" class="img-fluid" alt="title shap">
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 ph-mackup">
          <ul id="get_app_tow" class="scene wow fadeInUp">
            <li class="layer" data-depth="0.60"><img src="{{asset('frontend')}}/img/ph-mackup.png" class="img-fluid" alt="phone mackup"></li>
          </ul>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 d-flex align-items-end">
          <div class="feature-content-box brand-bg wow fadeInUp">
            <div class="feature-content white">
              There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour the majority
            </div>
            <div class="feature-category container">
              <div class="row">
                <?php 
                $daillers = App\Models\Dailler::get();
                $no_of_dailler = count($daillers);
                ?>
                @foreach($daillers as $key=>$dailler)
                <div class="col-12 col-md-4 col-xl-3 pd-0 text-center wow fadeInUp" data-wow-delay=".{{$key+2}}s">
                  <div class="feature-category-box feature-hover-left">
                    <div class="card d-block bg-none border-0 text-center @if($no_of_dailler==$key+1) before-none @endif">
                      <img src="{{asset('frontend/')}}/assets/img/dailler/{{ $dailler->img }}" alt="">
                      <div class="card-body text-center">
                        <h5 class="white w-bold">{{$dailler->name}}</h5>
                      </div>
                    </div>
                    <?php
                    $dailler_id = $dailler->id;
                    $demo_daillers = App\Models\DemoDailler::where('dailler_id', $dailler_id)->get();
                    $no_of_demo_dailler = count($demo_daillers);
                    if($no_of_demo_dailler>0){
                    ?>
                    <div class="d-flex justify-content-center">
                      <div class="feature-hover pos-a">
                        <div class="triangle d-block d-md-none"></div>
                        @foreach($demo_daillers as $k=>$demo_dailler)
                        <div class="apps-box text-center @if($no_of_demo_dailler==$k+1) before-none @endif">
                          <div class="triangle d-none d-md-block"></div>
                          <a href="{{$demo_dailler->link}}">
                            <img src="{{asset('frontend/')}}/assets/img/demo_dailler/{{ $demo_dailler->banner }}" alt="" class="apps-big-icon" style="height: 25px;width: 25px;">
                            <!-- <i class="fa fa-windows apps-big-icon" aria-hidden="true"></i> -->
                            <span class="apps-company-name d-block">
                              {{$demo_dailler->title}}
                              <i class="fa fa-download" aria-hidden="true"></i>
                            </span>
                          </a>
                        </div>
                        @endforeach
                        <!-- <div class="apps-box text-center">
                          <div class="triangle d-none d-md-block"></div>
                          <a href="{{$dailler->note}}">
                              <i class="fa fa-windows apps-big-icon" aria-hidden="true"></i>
                              <span class="apps-company-name d-block">
                                  Windows
                                  <i class="fa fa-download" aria-hidden="true"></i>
                              </span>
                          </a>
                        </div>
                        <div class="apps-box text-center">
                          <a href="{{$dailler->note}}">
                              <i class="fa fa-apple apps-big-icon" aria-hidden="true"></i>
                              <span class="apps-company-name d-block">
                                  Mac
                                  <i class="fa fa-download" aria-hidden="true"></i>
                              </span>
                          </a>
                        </div>
                        <div class="apps-box text-center before-none">
                          <a href="{{$dailler->note}}">
                              <i class="fa fa-linux apps-big-icon" aria-hidden="true"></i>
                              <span class="apps-company-name d-block">
                                  Linux
                                  <i class="fa fa-download" aria-hidden="true"></i>
                              </span>
                          </a>
                        </div> -->
                      </div>
                    </div>
                    <?php
                    }
                    ?>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Container (Services Section) -->
  <section class="testimonial-section" style="padding: 35px 0;">
    <div id="services" class="container text-center">
      <div class="row">
        <div class="col-12">
          <div class="main-title-box text-center wow fadeInUp">
            <h1 class="w-bold main-title">
              <span class="d-block main-subtitle brand w-light-i">Apps Services</span> What We Offer
            </h1>
            <div class="title-shap">
              <img src="{{asset('frontend')}}/img/title-shap.png" class="img-fluid" alt="title shap">
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="margin-top: 20px;">
        @foreach(App\Models\Service::get() as $service)
        <div class="col-md-4">
          <img src="{{asset('frontend/')}}/assets/img/service/{{ $service->img }}" class="logo-small" alt="">
          <h4>{{$service->service_name}}</h4>
          <p>{!!$service->description!!}</p>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  <!-- Container (Portfolio Section) -->
  <section class="testimonial-section" style="padding: 35px 0;">
    <div id="portfolio" class="container text-center bg-grey">
      <div class="row text-center">
        <div class="col-12">
          <div class="main-title-box text-center wow fadeInUp">
            <h1 class="w-bold main-title">
              <span class="d-block main-subtitle brand w-light-i">Apps Portfolio</span> What We Have Created
            </h1>
            <div class="title-shap">
              <img src="{{asset('frontend')}}/img/title-shap.png" class="img-fluid" alt="title shap">
            </div>
          </div>
        </div>
      </div>
      <div class="row text-center" style="margin-top: 20px;">
        @foreach(App\Models\Portfolio::get() as $key=>$portfolio)
        <div class="col-sm-3" style="padding-bottom: 8px;">
          <div class="thumbnail">
            <img src="{{asset('frontend/')}}/assets/img/portfolio/{{ $portfolio->img }}" alt="{{$portfolio->title}}" class="img-responsive" style="width: 100% !important;">
            <p  data-toggle="collapse" data-target="#collapseExample{{$key}}" aria-expanded="false" aria-controls="collapseExample{{$key}}"><strong>{{$portfolio->title}}</strong></p>
            <div class="collapse" id="collapseExample{{$key}}">
              <div class="card card-body">
                <p>{!!$portfolio->description!!}</p>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  <!-- Container (Pricing Section) -->
  <section class="testimonial-section" style="padding: 30px 0;">
    <div id="pricing" class="container">
      <div class="row">
        <div class="col-12">
          <div class="main-title-box text-center wow fadeInUp">
            <h1 class="w-bold main-title">
              <span class="d-block main-subtitle brand w-light-i">Apps Pricing</span> Choose A Payment Plan That Works For You
            </h1>
            <div class="title-shap">
              <img src="{{asset('frontend')}}/img/title-shap.png" class="img-fluid" alt="title shap">
            </div>
          </div>
        </div>
        <style type="text/css">
          .pricing-table-title {
            text-transform: uppercase;
            font-weight: 700;
            font-size: 2.6em;
            color: #FFF;
            margin-top: 15px;
            text-align: left;
            margin-bottom: 25px;
            text-shadow: 0 1px 1px rgba(0,0,0,0.4);
          }

          .pricing-table-title a {
            font-size: 0.6em;
          }

          .clearfix:after {
            content: '';
            display: block;
            height: 0;
            width: 0;
            clear: both;
          }
          /** ========================
           * Contenedor
           ============================*/
          .pricing-wrapper {
            width: 960px;
            margin: 20px auto 0;
          }

          .pricing-table {
            margin: 0 10px;
            text-align: center;
            width: 300px;
            float: left;
            -webkit-box-shadow: 0 0 15px rgba(0,0,0,0.4);
            box-shadow: 0 0 15px rgba(0,0,0,0.4);
            -webkit-transition: all 0.25s ease;
            -o-transition: all 0.25s ease;
            transition: all 0.25s ease;
          }

          .pricing-table:hover {
            -webkit-transform: scale(1.06);
            -ms-transform: scale(1.06);
            -o-transform: scale(1.06);
            transform: scale(1.06);
          }

          .pricing-title {
            color: #FFF;
            background: #e95846;
            padding: 20px 0;
            font-size: 2em;
            text-transform: uppercase;
            text-shadow: 0 1px 1px rgba(0,0,0,0.4);
          }

          .pricing-table.recommended .pricing-title {
            background: #2db3cb;
          }

          .pricing-table.recommended .pricing-action {
            background: #2db3cb;
          }

          .pricing-table .price {
            background: #403e3d14;
            font-size: 3.4em;
            font-weight: 700;
            padding: 20px 0;
            text-shadow: 0 1px 1px rgba(0,0,0,0.4);
          }

          .pricing-table .price sup {
            font-size: 0.4em;
            position: relative;
            left: 5px;
          }

          .table-list {
            background: #FFF;
            color: #403d3a;
          }

          .table-list li {
            font-size: 1.4em;
            font-weight: 700;
            padding: 12px 8px;
          }

          .table-list li:before {
            content: "\f00c";
            font-family: 'FontAwesome';
            color: #3fab91;
            display: inline-block;
            position: relative;
            right: 5px;
            font-size: 16px;
          } 

          .table-list li span {
            font-weight: 400;
          }

          .table-list li span.unlimited {
            color: #FFF;
            background: #e95846;
            font-size: 0.9em;
            padding: 5px 7px;
            display: inline-block;
            -webkit-border-radius: 38px;
            -moz-border-radius: 38px;
            border-radius: 38px;
          }


          .table-list li:nth-child(2n) {
            background: #F0F0F0;
          }

          .table-buy {
            background: #FFF;
            padding: 15px;
            text-align: left;
            overflow: hidden;
          }

          .table-buy p {
            float: left;
            color: #37353a;
            font-weight: 700;
            font-size: 2.4em;
          }

          .table-buy p sup {
            font-size: 0.5em;
            position: relative;
            left: 5px;
          }

          .table-buy .pricing-action {
            float: right;
            color: #FFF;
            background: #e95846;
            padding: 10px 16px;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            font-weight: 700;
            font-size: 1.4em;
            text-shadow: 0 1px 1px rgba(0,0,0,0.4);
            -webkit-transition: all 0.25s ease;
            -o-transition: all 0.25s ease;
            transition: all 0.25s ease;
          }

          .table-buy .pricing-action:hover {
            background: #cf4f3e;
          }

          .recommended .table-buy .pricing-action:hover {
            background: #228799;  
          }

          /** ================
           * Responsive
           ===================*/
           @media only screen and (min-width: 768px) and (max-width: 959px) {
            .pricing-wrapper {
              width: 768px;
            }

            .pricing-table {
              width: 236px;
            }
            
            .table-list li {
              font-size: 1.3em;
            }

           }

           @media only screen and (max-width: 767px) {
            .pricing-wrapper {
              width: 420px;
            }

            .pricing-table {
              display: block;
              float: none;
              margin: 0 0 20px 0;
              width: 100%;
            }
           }

          @media only screen and (max-width: 479px) {
            .pricing-wrapper {
              width: 300px;
            }
          } 
        </style>
        <!-- Contenedor -->
        <div class="pricing-wrapper clearfix">
          @foreach(App\Models\SellRatePlan::where('status',1)->get() as $k => $sell_rate_plan)
          <div class="pricing-table @if($k%2 == 0) recommended @endif">
            <h3 class="pricing-title">{{$sell_rate_plan->title}}</h3>
            <div class="price" style="font-size: 14px">{{$sell_rate_plan->currency}} Discount per $ @if($sell_rate_plan->discount>0)
                  Discount per $ {{ $sell_rate_plan->discount }} tk
                @endif</div>
            <!-- Lista de Caracteristicas / Propiedades -->
            <ul class="table-list">
              {!!$sell_rate_plan->description!!}
            </ul>
            <!-- Contratar / Comprar -->
            <div class="table-buy">
              <a style="font-size: 14px" href="{{route('admin.card.stock')}}?sell_rate_plan_id={{$sell_rate_plan->id}}" class="btn-block text-center pricing-action">কার্ড কিনতে এখানে ক্লিক করুন</a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
  
  <!-- ========================= 
        Testimonial
     ============================= -->
  <section class="testimonial-section" style="padding: 35px 0;">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="main-title-box text-center wow fadeInUp">
            <h1 class="w-bold main-title">
              <span class="d-block main-subtitle brand w-light-i">Dialer App</span> Customers Testimonial
            </h1>
            <div class="title-shap">
              <img src="{{asset('frontend')}}/img/title-shap.png" class="img-fluid" alt="title shap">
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 wow zoomIn">
          <div id="testimonial-parallax-tow" class="scene">
            <div class="layer" data-depth="0.20">
              <div class="testimonial-container pos-r">
                <div class="testimonial-img">
                  <img src="{{asset('frontend')}}/img/testimonial-shap-right.png" class="img-fluid" alt="img icon">
                  <div class="hover-img">
                    <img src="{{asset('frontend')}}/img/testimonial-shap-right-shadow.png" class="img-fluid" alt="img icon">
                  </div>
                </div>
                <div class="testimonial-box pos-r">
                  <div class="testimonial-box-title w-bold">
                    Awesome App
                  </div>
                  <div class="testimonial-box-content">
                    There are many variations of passages of Lorem Ipsum.
                  </div>
                  <div class="author-name">
                    - Jonathone Deo
                  </div>
                  <div class="text-right">
                    <div class="stor">
                      Google Play
                      <div class="wd-star">
                        <i class="fa fa-star primary" aria-hidden="true"></i>
                        <i class="fa fa-star primary" aria-hidden="true"></i>
                        <i class="fa fa-star primary" aria-hidden="true"></i>
                        <i class="fa fa-star primary" aria-hidden="true"></i>
                        <i class="fa fa-star primary" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 wow zoomIn" data-wow-delay=".2s">
          <div id="testimonial-parallax2-tow" class="scene">
            <div class="layer" data-depth="0.20">
              <div class="testimonial-container pos-r">
                <div class="testimonial-img">
                  <img src="{{asset('frontend')}}/img/testimonial-shap-active-left.png" class="img-fluid" alt="img icon">
                  <div class="hover-img">
                    <img src="{{asset('frontend')}}/img/testimonial-shap-active-left-shadow.png" class="img-fluid" alt="img icon">
                  </div>
                </div>
                <div class="testimonial-box">
                  <div class="testimonial-box-title w-bold">
                    Awesome App
                  </div>
                  <div class="testimonial-box-content white">
                    There are many variations of passages of Lorem Ipsum.
                  </div>
                  <div class="author-name white">
                    - Jonathone Deo
                  </div>
                  <div class="text-right">
                    <div class="stor white">
                      Google Play
                      <div class="wd-star">
                        <i class="fa fa-star white" aria-hidden="true"></i>
                        <i class="fa fa-star white" aria-hidden="true"></i>
                        <i class="fa fa-star white" aria-hidden="true"></i>
                        <i class="fa fa-star white" aria-hidden="true"></i>
                        <i class="fa fa-star white" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 wow zoomIn" data-wow-delay=".4s">
          <div id="testimonial-parallax3-tow" class="scene">
            <div class="layer" data-depth="0.50">
              <div class="testimonial-container pos-r">
                <div class="testimonial-img">
                  <img src="{{asset('frontend')}}/img/testimonial-shap-active-right.png" class="img-fluid" alt="img icon">
                  <div class="hover-img">
                    <img src="{{asset('frontend')}}/img/testimonial-shap-right-shadow.png" class="img-fluid" alt="img icon">
                  </div>
                </div>
                <div class="testimonial-box">
                  <div class="testimonial-box-title w-bold">
                    Awesome App
                  </div>
                  <div class="testimonial-box-content white">
                    There are many variations of passages of Lorem Ipsum.
                  </div>
                  <div class="author-name white">
                    - Jonathone Deo
                  </div>
                  <div class="text-right">
                    <div class="stor white">
                      Google Play
                      <div class="wd-star">
                        <i class="fa fa-star white" aria-hidden="true"></i>
                        <i class="fa fa-star white" aria-hidden="true"></i>
                        <i class="fa fa-star white" aria-hidden="true"></i>
                        <i class="fa fa-star white" aria-hidden="true"></i>
                        <i class="fa fa-star white" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 wow zoomIn" data-wow-delay=".6s">
          <div id="testimonial-parallax4-tow" class="scene">
            <div class="layer" data-depth="0.50">
              <div class="testimonial-container pos-r">
                <div class="testimonial-img">
                  <img src="{{asset('frontend')}}/img/testimonial-shap-left.png" class="img-fluid" alt="img icon">
                  <div class="hover-img">
                    <img src="{{asset('frontend')}}/img/testimonial-shap-active-left-shadow.png" class="img-fluid" alt="img icon">
                  </div>
                </div>
                <div class="testimonial-box">
                  <div class="testimonial-box-title w-bold">
                    Awesome App
                  </div>
                  <div class="testimonial-box-content">
                    There are many variations of passages of Lorem Ipsum.
                  </div>
                  <div class="author-name">
                    - Jonathone Deo
                  </div>
                  <div class="text-right">
                    <div class="stor">
                      Google Play
                      <div class="wd-star">
                        <i class="fa fa-star primary" aria-hidden="true"></i>
                        <i class="fa fa-star primary" aria-hidden="true"></i>
                        <i class="fa fa-star primary" aria-hidden="true"></i>
                        <i class="fa fa-star primary" aria-hidden="true"></i>
                        <i class="fa fa-star primary" aria-hidden="true"></i>
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
  </section>

  <!-- ========================= 
        Call To Acton Section
     ============================= -->
  <section class="call-to-action">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-xl-flex align-items-xl-center wow fadeInLeft">
          <div class="call-to-action-box white">
            <h4 class="call-to-action-title white">
              Subscribe to our Newsletter
            </h4>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 d-md-flex align-items-md-center wow fadeInRight">
          <form class="call-to-action-form w-100" action="{{route('contact-send-message')}}" method="post">
            @csrf
            <input class="form-control" id="subject" name="subject" placeholder="Subject" type="hidden">
            <input class="form-control" id="message" name="message" placeholder="Comment" type="hidden">
            <div class="form-group mr-0">
              <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email">
            </div>
            <div class="d-md-flex align-items-md-center d-flex justify-content-center justify-content-md-start">
              <button type="submit" class="btn btn-primary primary-bg">Subscribe</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- ========================= 
        Dialer App
     ============================= -->
  <section class="dialer-app">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 wow fadeInUp">
          <div class="main-title-box text-center">
            <h1 class="w-bold main-title">
              <span class="d-block main-subtitle brand w-light-i">Dialer App</span> How it Works
            </h1>
            <div class="title-shap">
              <img src="{{asset('frontend')}}/img/title-shap.png" class="img-fluid" alt="title shap">
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-10 col-md-6 col-lg-4 wow zoomIn">
          <div class="dialer-app-box">
            <div class="media pos-r">
              <div class="dialer-app-box-img mr-3 align-self-center">
                <img class="img-fluid" src="{{asset('frontend/')}}/img/dialer-app-icon-1.png" alt="Generic placeholder image">
              </div>
              <div class="media-body">
                <h5 class="mt-0 w-bold">Signup</h5>
                <div class="dialer-app-content">There are many variations passages, believable.</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-10 col-md-6 col-lg-4 wow zoomIn">
          <div class="dialer-app-box">
            <div class="media pos-r">
              
              <div class="dialer-app-box-img mr-3 align-self-center">
                <a href="https://piyofon.com/frontend/CallingCardApp-0_2_debug.apk"><img class="img-fluid" src="{{asset('frontend/')}}/img/dialer-app-icon-2.png" alt="Generic placeholder image"></a>
              </div>
              <div class="media-body">
                <h5 class="mt-0 w-bold"><a href="https://piyofon.com/frontend/CallingCardApp-0_2_debug.apk">Download</a></h5>
                <div class="dialer-app-content">There are many variations passages, believable.</div>
              </div>

            </div>
          </div>
        </div>
        <div class="col-12 col-sm-10 col-md-6 col-lg-4 wow zoomIn">
          <div class="dialer-app-box">
            <div class="media pos-r">
              <div class="dialer-app-box-img mr-3 align-self-center">
                <img class="img-fluid" src="{{asset('frontend/')}}/img/dialer-app-icon-3.png" alt="Generic placeholder image">
              </div>
              <div class="media-body">
                <h5 class="mt-0 w-bold">Verify Your Email</h5>
                <div class="dialer-app-content">There are many variations passages, believable.</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center wow fadeInUp">
          <a href="#" class="btn btn-primary dialer-app-btn">Start making free calls</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ========================= 
        Stor Section
     ============================= -->
  <section class="stor-section">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-7 col-xl-8 d-md-flex align-items-md-center wow fadeInLeft" data-wow-delay="200">
          <h4 class="stor-text">
            Get calling card application from these mobile stores:
          </h4>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-5 col-xl-4 d-md-flex align-items-md-center wow fadeInRight" data-wow-delay="200">
          <div class="d-flex justify-content-center">
            <a href="#">
               <img src="{{asset('frontend')}}/img/stor-img-1.gif" class="img-fluid" alt="Stor img">
            </a>
            <a href="https://piyofon.com/frontend/CallingCardApp-0_2_debug.apk">
               <img src="{{asset('frontend')}}/img/stor-img-2.gif" class="img-fluid" alt="Stor img">
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
