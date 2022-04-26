@extends('main.app')
@section('content')
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