<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('reseller.dashboard')}}" class="brand-link text-center">
    <!-- <img src="{{asset('backend/')}}/dist/img/{{ Auth::user()->img }}" alt="" class="brand-image img-circle elevation-3"
         style="opacity: .8"> -->
    <span class="brand-text font-weight-light">{{ App\Models\SiteInfo::pluck('site_name')[0] }}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('backend/')}}/dist/img/{{ Auth::user()->img }}" class="img-circle elevation-2" alt="">
      </div>
      <div class="info">
        <a class="d-block">{{ Auth::user()->name }} &nbsp;&nbsp;<span style="float: right;"><i class="fa fa-edit"></i></span></a>
      </div>
    </div> -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
          <a href="{{route('reseller.dashboard')}}" class="nav-link @if(Route::current()->getName() == 'reseller.dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt" style="color: #df5629;"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('reseller.reseller.list')}}" class="nav-link 
          @if(Route::current()->getName() == 'reseller.reseller.list') active @endif
          @if(Route::current()->getName() == 'reseller.reseller.add') active @endif">
            <i class="nav-icon fas fa-users" style="color: #df5629;"></i>
            <p>Reseller</p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="{{route('reseller.reseller_card.list')}}" class="nav-link 
          @if(Route::current()->getName() == 'reseller.reseller_card.list') active @endif
          @if(Route::current()->getName() == 'reseller.reseller_card.add') active @endif">
            <i class="nav-icon fas fa-money-check"></i>
            <p>Reseller card</p>
          </a>
        </li> -->
        <li class="nav-item">
          <a href="{{route('reseller.card.sell_rate_plan')}}" class="nav-link 
          @if(Route::current()->getName() == 'reseller.card.sell_rate_plan') active @endif">
            <i class="nav-icon fas fa-shopping-bag" style="color: #df5629;"></i>
            <p>Buy card</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('reseller.card.sell.history')}}" class="nav-link 
          @if(Route::current()->getName() == 'reseller.card.sell.history') active @endif">
            <i class="nav-icon fa fa-chart-bar" style="color: #df5629;"></i>
            <p>Sell history</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('reseller.reseller_payment.list')}}" class="nav-link 
          @if(Route::current()->getName() == 'reseller.reseller_payment.list') active @endif
          @if(Route::current()->getName() == 'reseller.reseller_payment.add') active @endif">
            <i class="nav-icon fas fa-history" style="color: #df5629;"></i>
            <p>Payment history</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('reseller.reseller_balance.list')}}" class="nav-link 
          @if(Route::current()->getName() == 'reseller.reseller_balance.list') active @endif
          @if(Route::current()->getName() == 'reseller.reseller_balance.add') active @endif">
            <i class="nav-icon fas fa-plus" style="color: #df5629;"></i>
            <p>Add balance</p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="{{route('reseller.report')}}" class="nav-link 
          @if(Route::current()->getName() == 'reseller.report') active @endif">
            <i class="nav-icon fas fa-chart-bar" style="color: #df5629;"></i>
            <p>Report</p>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"
             onclick="event.preventDefault();document.getElementById('logout-form').submit();">
             <i class="nav-icon fas fa-sign-out-alt" style="color: #df5629;"></i>
             <p> Logout</p>
           </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </li>

        <li class="nav-item">
          <a href="{{route('home')}}" class="nav-link 
          @if(Route::current()->getName() == 'home') active @endif">
            <i class="nav-icon fas fa-globe" style="color: #df5629;"></i>
            <p>Website</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>