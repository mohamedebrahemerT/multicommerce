@extends('frontend.bigbag.index')

 
@section('content')
 
<section class="section mb-100">
<div class="container">
            <div class="row justify-content-center">
        <div class="col-md-8 rightAly" style="margin-bottom: 95px;">
            <div class="card">

                  @if(session('success'))
   <div class="alert alert-success ">
   {{session('success')}}

     </div>
   @endif

          @if(session('danger'))
   <div class="alert alert-danger ">
   {{session('danger')}}

     </div>
   @endif
                <div class="card-header">{{__('verify')}}</div>

                    <form method="post" action="{{url('/')}}/postverfiy_user">

                    	    <div class="card-body">
                	  <div class="form-group row">
                	     @csrf
                            <label for="code" class="col-md-4 col-form-label text-md-right">
                                {{__('code')}}
                            </label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control" name="code" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{__('verify')}}
                                  
                                </button>
                            </div>
                        </div>
                    	<br>
                    </form>
                    <div class="curd-footer">
                    	

                        <form method="post" action="{{url('/')}}/request_new_code_user">
                       @csrf
                            
                        <input type="hidden" name="new_email" value="{{$user->email}}">
                        <input type="hidden" name="new_phone" value="{{$user->phone}}">
                  
                        <input type="submit" class="btn btn-primary" name="new_code" value="{{__('Send New Code')}}"> 
                        </form>
                    </div>
                
      </div>
    
      </div>

  </div>



       
</div>
</section>	
@endsection