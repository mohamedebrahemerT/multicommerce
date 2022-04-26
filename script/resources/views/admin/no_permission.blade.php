 



@extends('layouts.app')
@section('head')
 
@endsection
@section('content')
<div class="row">
  <div class="col-12 mt-2">
    <div class="card">
      <div class="card-body">
        @php
        $url=my_url();
        @endphp

 @if(session()->has('success') )
<div class="alert alert-success" style="text-align: center;font-size:20px;">
  {{session('success')}}
</div>
@endif

<div class="error-page">
    <h2 class="headline text-info">403</h2>
    <div class="error-content">
        <h3><i class="fa fa-exclamation-triangle text-info"></i> {{ __('error_permission_1') }}</h3>
        <p>
          {{ __('error_permission_2') }}
        </p>
         <p> {{ __('error_permission_4') }}
                <br/>

                                          @if(Auth::guard('web')->check())
                          
                <a href="{{ url('/admin/dashboard') }}"> {{ __('error_permission_5') }} </a>
                                            @else
                <a href="{{ url('/dashboardCompanies') }}"> {{ __('error_permission_5') }} </a>
                                            
                                            @endif



            {{ __('error_permission_6') }} </p>

    </div>
</div>
          
     </div>
   </div>
 </div>
</div>
@endsection
