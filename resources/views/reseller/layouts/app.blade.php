<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" type="image/x-icon" href="{{asset('frontend/')}}/assets/img/{{ App\Models\SiteInfo::pluck('favicon')[0] }}" />
  <title>Reseller | @yield('title')</title>
  @yield('link')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script type="text/javascript">
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 2000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })
  </script>
  <style type="text/css">
    .swal2-popup {
      padding: 8px !important;
    }
    .swal2-header {
      padding: 0 !important;
    }
    .swal2-image {
      margin: 0 auto !important;
    }
    [class*=sidebar-dark-]{
      background-color: #e9ecef !important;
    }
    [class*=sidebar-dark-] .user-panel a:hover{
      color:#000
    }
    [class*=sidebar-dark-] .sidebar a {
        color: #000;
        font-weight: bold;
    }
    [class*=sidebar-dark] .brand-link {
        border-bottom: 1px solid #4b545c;
        color: #000;
    }
    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
        background-color: #dee2e6;
        color: #282121;
    }
    .content-wrapper {
        background: #e9ecef;
    }
    .nav-sidebar>.nav-item {
        border-bottom: 1px solid #0000002b;
    }
    [class*=sidebar-dark-] .sidebar a {
        color: #282121;
    }
    .bg-info {
        background-color: #fff !important;
        color: #000 !important;
    }
    .btn-custom {
        color: #001f3f;
        background-color: #fbcdbd;
        border-color: #fbcdbd;
        box-shadow: none;
        border-radius: 25px;
        font-weight: bold;
    }
    [class*=sidebar-dark-] .nav-sidebar>.nav-item.menu-open>.nav-link, [class*=sidebar-dark-] .nav-sidebar>.nav-item:hover>.nav-link, [class*=sidebar-dark-] .nav-sidebar>.nav-item>.nav-link:focus {
        background-color: rgba(255,255,255,.1);
        color: #282121cc;
    }
  </style>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition sidebar-mini">
<div id="app">
  <div class="wrapper">
  @if(Session::has('flash_success'))
    {!! session('flash_success') !!}
  @endif
  @include('reseller.inc.navbar')

  @include('reseller.inc.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  @include('reseller.inc.footer')
</div>
<!-- ./wrapper -->
</div>

<!-- REQUIRED SCRIPTS -->

@yield('script')
</body>

</html>