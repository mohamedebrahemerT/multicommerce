@extends('frontend.bigbag.index')
@section('content')
           <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>{{ $info->title }}</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{__('home')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $info->title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">          
          <h1 class="text-capitalize mb-5 text-lg">{{ $info->title }}</h1>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section mb-100">
<div class="container">
            @php

      $data=$info->content->value ;
      $data = json_decode($data, true);
       

 @endphp

           @if( app()->getLocale() == "ar")
    
         {{$data['ar']}}
@else
     
         {{$data['en']}}
@endif


 



       
</div>
</section>  

        

@endsection
