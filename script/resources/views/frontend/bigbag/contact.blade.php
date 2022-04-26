@extends('frontend.bigbag.index')
@section('content')
         <section class="bg-light">
        <!-- Begin Contact Main Page Area -->
        <div class="contact-main-page py-4">


            <div class="container">
                <div class="row">
                    <div class="col-lg-5 offset-lg-1 col-md-12 order-1 order-lg-2">
                        <div class="contact-page-side-content">
                            <h3 class="contact-page-title">{{__('Contact Us')}}</h3>
    @php
  $locations=Cache::get(domain_info('user_id').'location',''); 

   $locations = json_decode($locations, true);
    
 @endphp
  @isset($locations)
 
                            <div class="single-contact-block">
                      @isset($locations['address'])

                                <h4>{{__('address')}}</h4>
                                <p> {{$locations['address']}}</p>
                                @endisset

                            </div>
                            <div class="single-contact-block">
                      @isset($locations['phone'])

                                <h4>{{__('phone')}}</h4>
                                <p>{{$locations['phone']}}</p>
                                @endisset

                            </div>
                      @isset($locations['email'])

                            <div class="single-contact-block last-child">
                                <h4>{{__('email')}}</h4>
                                <p>{{$locations['email']}}</p>
                            </div>
                                @endisset

                                @endisset
                              

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                        <div class="contact-form-content pt-sm-55 pt-xs-55">
                            <h3 class="contact-page-title">{{__('How may we help you?')}}</h3>
                            <div class="contact-form">
     <form id="contact-form" action="{{url('/')}}/sent-mail" method="post"  >
        @csrf
                                    <div class="form-group">
                                        <label>{{__('Your Name')}}<span class="required">*</span></label>
                                        <input type="text" name="name" id="customername" required >
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('Your Email')}} <span class="required">*</span></label>
                                        <input type="email" name="email" id="customerEmail" required>
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('Subject')}}</label>
                                        <input type="text" name="contactSubject" id="contactSubject" required>
                                    </div>
                                    <div class="form-group mb-30">
                                        <label>{{__('Your Message')}}</label>
                                        <textarea name="message" id="contactMessage"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" value="submit" id="submit" class="li-btn-3"
                                            name="submit" onclick="ClearFields();">{{__('send')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="col-lg-12  ">
    @php
  $user_id = domain_info('user_id');
if(App\Useroption::where('user_id',$user_id)->where('key','google_map_link')->first())
{ 
              $google_map_link= App\Useroption::where('user_id',$user_id)->where('key','google_map_link')->first()->value;
}
@endphp
               
               <iframe src="@isset($google_map_link){{$google_map_link}}@endisset"   style="border:0;" allowfullscreen="" loading="lazy" width="1100" height="200"></iframe>

                        
                    </div>
            </div>
        </div>
        <!-- Contact Main Page Area End Here -->

        
    </section>
 
 
@endsection
@push('js')
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush