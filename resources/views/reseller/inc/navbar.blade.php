<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background: url('/backend/dist/img/bg-top.jpg');background-repeat: no-repeat;background-size: 100% 100%;">
    <!-- Left navbar links -->
    <!-- <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul> -->

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->
    @if(Route::current()->getName() == 'reseller.dashboard')
    <ul class="navbar-nav" style="margin-left: auto;">
      <li class="nav-item text-center">
        <img src="{{asset('frontend/')}}/assets/img/{{ App\Models\SiteInfo::pluck('header_logo')[0] }}" alt="" class="img-fluid">
        <br>
        <a class="text-center text-white">{{Auth::user()->name}}</a>
        <br>
        <a href="{{route('reseller.report')}}" class="nav-link text-center" style="border-radius: 20px;border-radius: 20px;
    background: #fff;"><strong>{{ App\Models\User::reseller_balance(Auth::user()->id) }} Tk.</strong></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- <li class="nav-item"><a href="{{route('reseller.report')}}" class="nav-link text-white"><strong>&#2547; {{ App\Models\User::reseller_balance(Auth::user()->id) }}</strong></a></li> -->
      <li class="nav-item dropdown">
        <a class="nav-link text-white" href="{{route('reseller.notice.list')}}">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{ App\Models\Notice::where('status',1)->count() }}</span>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('logout') }}"
           onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i></a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
      </li> -->
    </ul>
    @else
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item text-center">
        <a class="text-center text-white" style="font-weight: bold;">@yield('title')</a>
      </li>
    </ul>
    @endif
</nav>
<!-- /.navbar -->