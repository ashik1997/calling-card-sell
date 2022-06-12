<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('dashboard')}}" class="brand-link">
    <!-- <img src="{{asset('backend/')}}/dist/img/{{ Auth::user()->img }}" alt="" class="brand-image img-circle elevation-3"
         style="opacity: .8"> -->
    <span class="brand-text font-weight-light">{{ App\Models\SiteInfo::pluck('site_name')[0] }}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('backend/')}}/dist/img/{{ Auth::user()->img }}" class="img-circle elevation-2" alt="">
      </div>
      <div class="info">
        <a href="{{route('profile')}}" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
          <a href="{{route('dashboard')}}" class="nav-link @if(Route::current()->getName() == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.list')}}" class="nav-link 
          @if(Route::current()->getName() == 'admin.list') active @endif
         ">
            <i class="nav-icon fas fa-user"></i>
            <p>Admin</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.reseller.list')}}" class="nav-link 
          @if(Route::current()->getName() == 'admin.reseller.list') active @endif
          @if(Route::current()->getName() == 'admin.reseller.add') active @endif">
            <i class="nav-icon fas fa-users"></i>
            <p>Reseller</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.rate_plan.list')}}" class="nav-link 
          @if(Route::current()->getName() == 'admin.rate_plan.list') active @endif
          @if(Route::current()->getName() == 'admin.rate_plan.add') active @endif">
            <i class="nav-icon fas fa-dollar"></i>
            <p>Dollar plan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.sell_rate_plan.list')}}" class="nav-link 
          @if(Route::current()->getName() == 'admin.sell_rate_plan.list') active @endif
          @if(Route::current()->getName() == 'admin.sell_rate_plan.add') active @endif">
            <i class="nav-icon fas fa-money-check"></i>
            <p>Sell rate plan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.minute.list')}}" class="nav-link 
          @if(Route::current()->getName() == 'admin.minute.list') active @endif
          @if(Route::current()->getName() == 'admin.minute.add') active @endif">
            <i class="nav-icon fas fa-clock"></i>
            <p>Minute</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.card.list')}}" class="nav-link 
          @if(Route::current()->getName() == 'admin.card.list') active @endif
          @if(Route::current()->getName() == 'admin.card.add') active @endif">
            <i class="nav-icon fas fa-money-check"></i>
            <p>All card</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.card.sell_rate_plan')}}" class="nav-link 
          @if(Route::current()->getName() == 'admin.card.sell_rate_plan') active @endif">
            <i class="nav-icon fas fa-shopping-bag"></i>
            <p>Buy card</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.card.sell.history')}}" class="nav-link 
          @if(Route::current()->getName() == 'admin.card.sell.history') active @endif">
            <i class="nav-icon fas fa-history"></i>
            <p>Sell history</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.reseller_payment.list')}}" class="nav-link 
          @if(Route::current()->getName() == 'admin.reseller_payment.list') active @endif
          @if(Route::current()->getName() == 'admin.reseller_payment.add') active @endif">
            <i class="nav-icon fas fa-history"></i>
            <p>Payment history</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.reseller_balance.list')}}" class="nav-link 
          @if(Route::current()->getName() == 'admin.reseller_balance.list') active @endif
          @if(Route::current()->getName() == 'admin.reseller_balance.add') active @endif">
            <i class="nav-icon fas fa-plus"></i>
            <p>Add balance </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.report')}}" class="nav-link 
          @if(Route::current()->getName() == 'admin.report') active @endif">
            <i class="nav-icon fas fa-chart-bar"></i>
            <p>Report</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.banner.list')}}" class="nav-link 
          @if(Route::current()->getName() == 'admin.banner.list') active @endif
          @if(Route::current()->getName() == 'admin.banner.add') active @endif">
            <i class="nav-icon fas fa-images"></i>
            <p>Banner</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.popup-banner.list')}}" class="nav-link 
          @if(Route::current()->getName() == 'admin.popup-banner.list') active @endif
          @if(Route::current()->getName() == 'admin.popup-banner.add') active @endif">
            <i class="nav-icon fas fa-images"></i>
            <p>Popup banner</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.service.list')}}" class="nav-link @if(Route::current()->getName() == 'admin.service.list') active @endif">
            <i class="fas fa-briefcase nav-icon"></i>
            <p>Service</p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="{{route('admin.portfolio.list')}}" class="nav-link @if(Route::current()->getName() == 'admin.portfolio.list') active @endif">
            <i class="far fa-id-badge nav-icon"></i>
            <p>Portfolio</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('dailler-list')}}" class="nav-link @if(Route::current()->getName() == 'dailler-list') active @endif">
            <i class="fas fa-phone-alt nav-icon"></i>
            <p>Dailler</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('demo-dailler-list')}}" class="nav-link @if(Route::current()->getName() == 'demo-dailler-list') active @endif">
            <i class="fas fa-phone-alt nav-icon"></i>
            <p>Demo dailler</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.voip.rate.list')}}" class="nav-link @if(Route::current()->getName() == 'admin.voip.rate.list') active @endif">
            <i class="fas fa-phone-alt nav-icon"></i>
            <p>Voip rate</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.notice.list')}}" class="nav-link @if(Route::current()->getName() == 'admin.notice.list') active @endif">
            <i class="fas fa-bell nav-icon"></i>
            <p>Notice</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('contact-list')}}" class="nav-link @if(Route::current()->getName() == 'contact-list') active @endif">
            <i class="nav-icon fas fa-address-book"></i>
            <p>Contacts</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.country.list')}}" class="nav-link @if(Route::current()->getName() == 'admin.country.list') active @endif">
            <i class="fas fa-flag nav-icon"></i>
            <p>Country</p>
          </a>
        </li>
        <li class="nav-item has-treeview 
        @if(Route::current()->getName() == 'site-info') menu-open @endif
        @if(Route::current()->getName() == 'about-info') menu-open @endif
        @if(Route::current()->getName() == 'admin.service.list') menu-open @endif
         ">
          <a href="#" class="nav-link @if(Route::current()->getName() == 'site-info') active @endif">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Settings
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('site-info')}}" class="nav-link @if(Route::current()->getName() == 'site-info') active @endif">
                <i class="fas fa-globe nav-icon"></i>
                <p>Site info</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('about-info') }}" class="nav-link @if(Route::current()->getName() == 'about-info') active @endif">
                <i class="far fa-address-card nav-icon"></i>
                <p>About info</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>