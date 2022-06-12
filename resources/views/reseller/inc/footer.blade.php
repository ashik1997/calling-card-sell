<!-- Main Footer -->
<style type="text/css">
  .nav-link{
    font-weight: bold;
  }
</style>
<footer class="main-footer" style="padding: 0 !important;">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link text-dark" href="{{route('reseller.dashboard')}}" style="width: 25% !important; display: initial !important; float: left; text-align: center;"><i class="fas fa-home"></i><br>Home</a>
      <a class="nav-link text-dark" data-widget="pushmenu" href="#" style="width: 25% !important; display: initial !important;float: right;text-align: center;"><i class="fas fa-bars"></i><br>My Walet</a>
    </li>
  </ul>
    <!-- <strong>Copyright &copy; 2021 <a href="shopnosoftwarefarm.com">Shopno Software Farm</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div> -->
  <!-- Right navbar links -->
  <!-- <ul class="navbar-nav ml-auto">
    <li class="nav-item"><a href="{{route('reseller.report')}}" class="nav-link text-white"><strong>&#2547; {{ App\Models\User::reseller_balance(Auth::user()->id) }}</strong></a></li>
    <li class="nav-item dropdown">
      <a class="nav-link" href="{{route('reseller.notice.list')}}">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">{{ App\Models\Notice::where('status',1)->count() }}</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="{{ route('logout') }}"
         onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i></a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
    </li>
  </ul> -->
</footer>