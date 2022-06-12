@extends('public.layouts.app')
@section('title', 'Privacy & Policy')
@section('content')
  <!-- ========================= 
        Slider Section
     ============================= -->
  <div class="breadcome">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-md-10 col-lg-8 col-lg-10">
          <div class="breadcome-title white text-center">
            Privacy & Policy
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ========================= 
        Faq Section
     ============================= -->
  <section class="faq">
    <div class="container">
      <div class="row d-md-flex justify-content-md-center">
        <div class="col-12 col-md-12">
          {!! $privacy_policy !!}
        </div>
      </div>
    </div>
  </section>
@endsection
