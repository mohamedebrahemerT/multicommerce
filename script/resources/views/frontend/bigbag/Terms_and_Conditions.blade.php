@extends('frontend.bigbag.index')
@section('content')
       <section class="bg-light">
        <!-- about wrapper start -->
        <div class="about-us-wrapper pt-5 pb-4">
            <div class="container">
                <div class="row">
                    <!-- About Text Start -->
                    <div class="col-lg-12 order-last order-lg-first">
                        <div class="about-text-wrap">
                         <h2>  {{__('Terms_and_Conditions')}} </h2>
                            <p>
                                @php
  $user_id = domain_info('user_id');
 
                    @endphp                

         

             

            

            @if(Session::get('locale') == 'ar') 
            @if(App\Useroption::where('user_id',$user_id)->where('key','Terms_and_Conditions_ar')->first())                          
 {!! App\Useroption::where('user_id',$user_id)->where('key','Terms_and_Conditions_ar')->first()->value !!}
            @endif

            @else

@if(App\Useroption::where('user_id',$user_id)->where('key','Terms_and_Conditions_en')->first())


     {!! App\Useroption::where('user_id',$user_id)->where('key','Terms_and_Conditions_en')->first()->value !!}
     @endif




            @endif
                                 

                            </p>
                        </div>
                    </div>
                    <!-- About Text End -->
                    <!-- About Image Start -->
                    
                    <!-- About Image End -->
                </div>
            </div>
        </div>
        <!-- about wrapper end -->
    </section>


@endsection
