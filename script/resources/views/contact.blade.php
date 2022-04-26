@extends('main.app')
@section('content')
<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <span class="text-white">{{ __('Contact Us') }}</span>
          <h1 class="text-capitalize mb-5 text-lg">{{ __('Get in Touch') }}</h1>
        </div>
      </div>
    </div>
  </div>
</section>


@if(Cache::has('site_info'))
@php
$info=Cache::get('site_info','');
@endphp
<section class="section contact-info pb-0">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6">
        <div class="contact-block mb-4 mb-lg-0">
          <i class="icofont-live-support"></i>
          <h5>{{__('Call Us')}}</h5>
           {{ $info->phone1 ?? '' }}
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="contact-block mb-4 mb-lg-0">
          <i class="icofont-support-faq"></i>
          <h5>{{__('Email Us')}}</h5>
               
               <a href="mailto:{{ $info->email1 ?? '' }}">{{ $info->email1 ?? '' }}</a>.<br>
        </div>
      </div>
      <div class="col-lg-4 col-md-12">
        <div class="contact-block mb-4 mb-lg-0">
          <i class="icofont-location-pin"></i>
          <h5>{{__('Location')}}</h5>
                     <a href="https://www.google.com/maps/place/%D8%A7%D9%84%D9%85%D9%84%D8%B2%D8%8C+%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6+%D8%A7%D9%84%D8%B3%D8%B9%D9%88%D8%AF%D9%8A%D8%A9%E2%80%AD/@24.6646434,46.752887,14z/data=!3m1!4b1!4m5!3m4!1s0x3e2f0424ff2e530f:0x36529ba249766c8f!8m2!3d24.6624446!4d46.7287761"> {{ $info->address ?? '' }}</a> 


        </div>
      </div>
    </div>
  </div>
</section>
@endif

<section class="contact-form-wrap section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
         @if(session()->has('success') )
<div class="alert alert-success" style="text-align: center;font-size:20px;">
  {{session('success')}}
</div>
@endif


@if(session()->has('danger') )
<div class="alert alert-danger" style="text-align: center;font-size:20px;">
  {{session('danger')}}
</div>
@endif

@if ($errors->any())
  <div class="alert alert-danger" style="text-align: center;">
      @foreach ($errors->all() as  $value)
        <p>{{ $value }}</p>
      @endforeach
  </div>
@endif


 


          <form action="{{ route('send_mail') }}" method="post" class="basicform_with_reset contact__form">
              @csrf
          <!-- form message -->


          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <input name="name" id="name"   required type="text" class="form-control" placeholder="{{__('Your Full Name')}}">
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <input name="email" id="email"  type="email" class="form-control" placeholder="{{__('Your Email Address')}}" required>
              </div>
            </div>

          </div>

          <div class="form-group-2 mb-4">
            <textarea name="message" id="message" class="form-control" rows="8" placeholder="{{ __('Your Message') }}" required></textarea>
          </div>

          <div>
            <input class="btn btn-main btn-round-full" name="submit" type="submit" value="{{__('Send Messege')}}"></input>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>



@endsection
@push('js')
 
@endpush
