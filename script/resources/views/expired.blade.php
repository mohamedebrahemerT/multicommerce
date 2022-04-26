@extends('main.app')
@section('content')
 
<section class="section mb-100">
<div class="container">
            

                <h1 style="text-align:center"> 
                   Domain:
  @if($Domain->status==1) <span class="badge badge-success">{{ __('Active') }}</span>
                    @elseif($Domain->status==0) <span class="badge badge-danger">{{ __('Trash') }}</span>
                    @elseif($Domain->status==2) <span class="badge badge-danger">{{ __('Expired') }}</span>
                     @elseif($Domain->status==3) <span class="badge badge-warning">{{ __('Requested') }}</span>
                    @endif

 </h1>

       
</div>
</section>	
@endsection