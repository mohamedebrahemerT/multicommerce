@extends('frontend.bigbag.index')
@section('content')
       <section class="bg-light">
        <!-- about wrapper start -->
        <div class="about-us-wrapper pt-5 pb-4">
            <div class="container">
                <div class="row">
                    <!-- About Text Start -->
                    <div class="col-lg-6 order-last order-lg-first">
                        <div class="about-text-wrap">
                         <h2>  {{__('About us')}} </h2>
                            <p>
                                @php
  $user_id = domain_info('user_id');
 @endphp
                                    

            

            



            @if(Session::get('locale') == 'ar')  

                 @if(App\Useroption::where('user_id',$user_id)->where('key','about_ar')->first())

                              {!! $about_ar= App\Useroption::where('user_id',$user_id)->where('key','about_ar')->first()->value !!}
            @endif

            @else

            @if(App\Useroption::where('user_id',$user_id)->where('key','about_en')->first())

                              {!! $about_en= App\Useroption::where('user_id',$user_id)->where('key','about_en')->first()->value !!}
            @endif

            @endif
                                 

                            </p>
                        </div>
                    </div>
                    <!-- About Text End -->
                    <!-- About Image Start -->
                    <div class="col-lg-5 col-md-10">
                        <div class="about-image-wrap">
                            <img class="img-fluid" src="{{url('/')}}/uploads/{{$user_id}}/about_photo.png" alt="About Us" />
                        </div>
                    </div>
                    <!-- About Image End -->
                </div>
            </div>
        </div>
        <!-- about wrapper end -->
    </section>


@endsection
