  <!-- ========================= 
        Header Information
     ============================= -->
  <!-- Login -->
  <header class="header-info brand-bg">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 d-flex align-items-center justify-content-center justify-content-md-start">
          <div class="bonus-offer white w-bold">
            Refer Your Friend, <span class="focus-text d-inline">Get 10%</span> Bonus Credit
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-center justify-content-md-end">
          <nav>
            <ul class="nav button_menu">
              @if (Route::has('login'))
                @auth
                  @if(Auth::user()->role=='admin')
                  <li class="nav-item"><a class="btn btn-outline-primary nav-btn" href="{{route('dashboard')}}">{{Auth::user()->name}}</a></li>
                  <li class="nav-item">
                    <a class="btn btn-outline-primary nav-btn" href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                  </l class="nav-item"i>
                  @elseif(Auth::user()->role=='reseller')
                  <li class="nav-item"><a class="btn btn-outline-primary nav-btn" href="{{route('reseller.dashboard')}}">{{Auth::user()->name}}</a></li>
                  <li class="nav-item">
                    <a class="btn btn-outline-primary nav-btn" href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                  </li>
                  @endif
                @else
                <li class="nav-item">
                  <button type="button" class="btn btn-outline-primary nav-btn" data-toggle="modal" data-target="#header-login">Log In</button>
                </li>
                @endauth
              @endif
              <li class="nav-item">
                <button type="button" class="btn btn-outline-primary nav-btn" data-toggle="modal" data-target="#header-free-trial">Free Trial</button>
              </li>
              <li class="nav-item">
                <button type="button" class="btn btn-outline-primary nav-btn" data-toggle="modal" data-target="#header-card">Buy Credit</button>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </header>
  <div class="custom-login-modal">
    <div class="modal fade" id="header-login">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h5 class="modal-title" id="exampleModalLabel">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('custom-login') }}" method="post" class="text-center">
              @csrf
              <div class="input-group mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="User email" autofocus>
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">
                      {{ __('Remember Me') }}
                    </label>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <button type="submit" class="btn btn-outline-primary nav-btn custom-login-modal-btn">LOGIN</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Free Trial -->
  <div class="custom-credit-modal">
    <div class="modal fade" id="header-free-trial">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form data-aos="fade-left" data-aos-delay="600" action="{{route('contact-send-message')}}" method="post">
            @csrf
            <div class="form-group row">
              <label for="subject" class="col-sm-4 col-form-label d-flex align-items-center">Subject</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="subject" name="subject">
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-4 col-form-label d-flex align-items-center">Email</label>
              <div class="col-sm-8">
                <input type="email" class="form-control" id="email" name="email">
              </div>
            </div>
            <div class="form-group row">
              <label for="message" class="col-sm-4 col-form-label d-flex align-items-center">Message</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="message" name="message">
              </div>
            </div>
            <div class="col-md-12 text-right">
              <button type="submit" class="btn btn-outline-primary nav-btn custom-login-modal-btn">Send Messages</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Credit -->
  <div class="custom-credit-modal">
    <div class="modal fade" id="header-card">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="row">
                <div class="col-md-12 pd-0">
                  <div class="d-flex justify-content-between">
                    <div class="master-card card-active">
                      <div class="media dropdown align-items-xl-center mrl-0">
                        <div class="check-box-img">
                          <img class="img-fluid none" src="{{asset('frontend/')}}/img/tick-mark.png" alt="tick mark">
                        </div>
                        <div class="media-body">
                          <img class="img-fluid card-img" src="{{asset('frontend/')}}/img/card-icon.png" alt="card icon">
                          <p class="mr-0 white">Credit Card</p>
                        </div>
                      </div>
                      <div class="card-available">
                        <div class="d-flex">
                          Accepted Card Types:
                          <div class="card-available-img">
                            <a href="#"><img src="{{asset('frontend/')}}/img/card-icon-1.png" alt=""></a>
                            <a href="#"><img src="{{asset('frontend/')}}/img/card-icon-2.png" alt=""></a>
                            <a href="#"><img src="{{asset('frontend/')}}/img/card-icon-3.png" alt=""></a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="master-card">
                      <div class="media dropdown align-items-center  mrr-0">
                        <div class="check-box-img">
                          <img class="img-fluid none" src="{{asset('frontend/')}}/img/tick-mark.png" alt="tick mark">
                        </div>
                        <div class="media-body d-flex">
                          <img class="img-fluid paypal-card-img" src="{{asset('frontend/')}}/img/paypal.png" alt="card icon">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <form class="text-center currency-form">
              <div class="form-group">
                <input type="text" class="form-control " placeholder="User Name">
              </div>
              <div class="form-group d-flex header-currency">
                <input type="text" class="form-control" placeholder="Credit Amount">
                <div class="custom-select-currency">
                  <select class="custom-select">
                      <option selected>USD</option>
                      <option value="1">POUNDS</option>
                      <option value="1">BDT</option>
                  </select>
                </div>
              </div>
              <button type="button" class="btn btn-outline-primary nav-btn custom-login-modal-btn">submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ========================= 
        Main Nav
     ============================= -->
  <nav>
    <div class="container">
      <div class="row">
        <div class="col-4 col-sm-3 col-md-2 col-lg-2 col-xl-2 d-flex justify-content-center">
          <div class="logo">
            <a href="/">
                <img src="{{asset('frontend/')}}/assets/img/{{ App\Models\SiteInfo::pluck('header_logo')[0] }}" class="img-fluid" alt="Logo">
            </a>
          </div>
        </div>

        <div class="col-6 col-sm-7 col-md-9 col-lg-9 col-xl-9 display_menu d-md-flex justify-content-md-end align-items-md-center dis-off">
          <div class="d-none d-md-inline-block">
            <ul class="nav link_menu">
              <li class="nav-item">
                <a class="nav-link btn btn-primary" href="{{route('download')}}">Apps</a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn btn-primary" href="{{route('rates')}}">USD Rate</a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn btn-primary" href="{{route('contact-us')}}">Help</a>
              </li>
            </ul>
          </div>
          <div class="social-media-link d-none d-md-block">
            <a href="#"><img src="{{asset('frontend/')}}/img/social-media-icon-radius-1.png" alt="social-media"></a>
            <a href="https://www.facebook.com/piyofone"><img src="{{asset('frontend/')}}/img/social-media-icon-radius-2.png" alt="social-media"></a>
            <a href="https://www.instagram.com/piyofonexpress/?hl=en"><img src="{{asset('frontend/')}}/img/social-media-icon-radius-3.png" alt="social-media"></a>
          </div>

          <div class="dropdown header-top-lan-dropdown d-md-flex align-items-md-center d-none d-md-block">
            <button class="btn btn-secondary dropdown-toggle header-top-lan-btn" type="button" id="header-info-lan-btn">
                <span class="d-md-none">
                    <i class="fa fa-globe" aria-hidden="true"></i>
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                </span>
                <span class="d-md-block d-none text-capitalize w-light">
                    <i class="fa fa-globe" aria-hidden="true"></i> Language <i class="fa fa-angle-down" aria-hidden="true"></i>
                </span>
            </button>
            <div class="dropdown-menu country-name">
              <button class="dropdown-item" type="button">Algeria</button>
              <button class="dropdown-item" type="button">Bahrain</button>
              <button class="dropdown-item" type="button">Bangladesh</button>
              <button class="dropdown-item" type="button">Somalia</button>
            </div>
          </div>


        </div>
        <div class="col-2 col-sm-2 align-items-md-right sm-ml-auto col-md-1 col-lg-1 col-xl-1 pd-0 d-md-flex justify-content-md-end align-items-md-center">
          <div class="off-canvas in-2">
            <!-- <a class="nav-link btn btn-primary pd-0" href="#"><i class="fa fa-bars" aria-hidden="true"></i></a> -->

            <div id="push_sidebar">
              <span class="nav_trigger">
                <i class="fa fa-navicon"></i>
              </span>
              <br>
              <ul class="list-unstyled">
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="{{route('rates')}}">USD Rate</a></li>
                <li><a href="{{route('download')}}">Download</a></li>
                <li><a href="{{route('reseller.dashboard')}}">Reseller</a></li>
                <li><a href="{{route('faq')}}">Faq</a></li>
                <li><a href="{{route('terms-conditions')}}">Terms&Condition</a></li>
                <li><a href="{{route('privacy-policy')}}">Privacy&Policy</a></li>
                <li><a href="{{route('about-us')}}">About us</a></li>
                <li><a href="{{route('contact-us')}}">Contact us</a></li>
              </ul>
            </div>
            <span class="nav_trigger">
              <i class="fa fa-navicon"></i>
            </span>
          </div>
        </div>

      </div>
    </div>
  </nav>

