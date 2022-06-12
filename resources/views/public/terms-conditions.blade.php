@extends('public.layouts.app')
@section('title', 'Terms & Conditions')
@section('content')
  <!-- ========================= 
        Slider Section
     ============================= -->
  <div class="breadcome">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-md-10 col-lg-8 col-lg-10">
          <div class="breadcome-title white text-center">
            Terms & Conditions
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
          {!! $terms_conditions !!}
        </div>
      </div>
    </div>
  </section>
@endsection