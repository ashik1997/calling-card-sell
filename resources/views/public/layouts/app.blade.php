<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>{{ App\Models\SiteInfo::pluck('site_name')[0] }}</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @include('public.inc.style-sheet')
</head>

<body class="home-page-two">
  <div id="app">
    @if(Session::has('flash_success'))
      {!! session('flash_success') !!}
    @endif
    @include('public.inc.nav')

    @yield('content')
    
    @include('public.inc.footer')
    @include('public.inc.script')
  </div>
</body>

</html>


