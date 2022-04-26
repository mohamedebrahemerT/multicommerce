

 <a  style="display: none;" id="test1" href="javascript:void(0)" data-tip="{{__('Quick View')}}" data-toggle="modal" data-target="#exampleModal"><i
                                            class="ti-eye"></i></a>
  
   

    @push('js')

   
            
  <script type="text/javascript">
      $(document).on('click','#QuickView',function(){
              var text =$(this).text();
              text=text.toString();
                    var id= text;
        $.ajax({
            url:"{{url('/QuickView')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:text,

           },
            dataType:"json",
            beforeSend:function(){
                      
                      
            },
            success:function(data)
            {
                
   $('.exampleModal_title').html(data.title);
   $('.exampleModal_price_detail').html(data.exampleModal_price_detail);
   $('.color_variant').html(data.color_variant);
   $('.content').html(data.content);
   $('.productbuttons').html(data.productbuttons);
   $('.sizebox').html(data.sizebox);
   $('.quick_view_img').html(data.quick_view_img);


     document.getElementById('test1').click();
  // $('#test1')[0].click();
            }
        });
             return false;
    
                    
                     
                    });
  </script>
    @endpush

@php
  $user_id = domain_info('user_id');
 
                                    
      if(App\Useroption::where('user_id',$user_id)->where('key','before_footer')->first())
      {
        $before_footer= App\Useroption::where('user_id',$user_id)->where('key','before_footer')->first()->value;
      }
              
@endphp






  <section class="footer-shipping py-5"  @isset($before_footer) style="background-color:{{$before_footer}}"  @endisset>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <img src="{{url('/')}}/frontend/bigbag/images/footer/1.png" alt="">
                    <h6>{{__('Secure Payment Methods')}}</h6>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <img src="{{url('/')}}/frontend/bigbag/images/footer/2.png" alt="">
                    <h6>{{__('24/7 Customer Support')}}</h6>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <img src="{{url('/')}}/frontend/bigbag/images/footer/3.png" alt="">
                    <h6>{{__('Easy Return Policy')}}</h6>
                </div>
            </div>
        </div>
    </section>


 @php
  $user_id = domain_info('user_id');
 
                                    
      if(App\Useroption::where('user_id',$user_id)->where('key','footer')->first())
      {
        $footer= App\Useroption::where('user_id',$user_id)->where('key','footer')->first()->value;
      }
              
@endphp





 <footer    @isset($footer) style="background-color:{{$footer}}"  @endisset
 >
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="footer-contant">
                        <div class="footer-logo">
                            <img src="{{url('/')}}/uploads/{{$user_id}}/logo_footer.png" alt="" style="width:141px;height:49px">
                        </div>
                        <p>

            @if(Session::get('locale') == 'ar')  

                         @if(App\Useroption::where('user_id', domain_info('user_id'))->where('key', 'shop_description_ar')->first())
        
             {{ $shop_description_ar=App\Useroption::where('user_id', domain_info('user_id'))->where('key', 'shop_description_ar')->first()->value}}
                   @endif
                              
 
                         @else

                           @if(App\Useroption::where('user_id', domain_info('user_id'))->where('key', 'shop_description')->first())
        
             {{ $shop_description=App\Useroption::where('user_id', domain_info('user_id'))->where('key', 'shop_description')->first()->value}}
                   @endif
                   

                         @endif
  
 
 
                        </p>
                        <div class="footer-social">
       


                   @if(Cache::has(domain_info('user_id').'socials'))
                   @php
                   $socials=json_decode(Cache::get(domain_info('user_id').'socials',[]));


                   @endphp
                            <ul>
                    @foreach($socials as $key => $value)
                                
                                <li><a href="{{ url($value->url) }}"><i class="{{ $value->icon }}" aria-hidden="true"></i></a></li>
                     @endforeach

                                 
                            </ul>
                   @endif



                        </div>
                    </div>
                </div>
                  <div class="col-md-3">
                    <div class="sub-title">
                        <div class="footer-title">
                            <h4>{{__('my account')}}</h4>
                        </div>
                        <div class="footer-contant">
                            <ul>
                                  @if(Auth::check())
                                <li><a href="{{url('/')}}/user/logout">{{__('logout')}}</a></li>
@else
 <li><a href="{{url('/')}}/user/login">
                                {{__('Login/Register')}}</a></li>
@endif
                               

                                <li><a href="{{url('/')}}/user/dashboard">{{__('Account Details')}}</a></li>
                                <li><a href="{{url('/')}}/user/orders">{{__('Orders')}}</a></li>
                                <li><a href="{{url('/')}}/user/addresses">{{__('Addresses')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="sub-title">
                        <div class="footer-title">
                            <h4>{{__('other links')}}</h4>
                        </div>
                        <div class="footer-contant">
                            <ul>
                                <li><a href="{{url('/')}}/Goods_Return_Policy">{{__('Goods Return Policy')}} </a></li>

                                <li><a href="{{url('/')}}/Terms_and_Conditions">{{__('Terms and Conditions')}} </a></li>
                                    <li><a href="{{url('/')}}/contact">{{__('Contact us')}} </a></li>
                                 
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="sub-title">
                        <div class="footer-title">
                            <h4>{{__('store information')}}</h4>
                        </div>
                        <div class="footer-contant">

                             @php
  $locations=Cache::get(domain_info('user_id').'location',''); 

   $locations = json_decode($locations, true);
    
 @endphp

                      @isset($locations)
             
                            <ul class="contact-list">
                               

                      @isset($locations['address'])
                                <li>

                                    <i class="ti-location-pin mr-2"></i>
                                    {{__('address')}}

            @if(Session::get('locale') == 'ar')  
            @isset($locations['address_ar'])
                                      {{$locations['address_ar']}}
                                @endisset
                                      
                                    @else
  {{$locations['address']}}
                                    @endif
 

                                </li>
                                @endisset
                      @isset($locations['phone'])

                                <li><i class="ti-mobile mr-2"></i>{{__('Call Us')}}:
 
  {{$locations['phone']}}
 
    

                                </li>
                                @endisset

                      @isset($locations['email'])

                                <li><i class="ti-email mr-2"></i>{{__('Email Us')}}: <a href="#">
                                

 
  {{$locations['email']}}

                                </a></li>
                                @endisset

                            </ul>

                                @endisset


                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
       if(App\Useroption::where('user_id', domain_info('user_id'))->where('key', 'shop_name')->first())
        {
              $shop_name=App\Useroption::where('user_id', domain_info('user_id'))->where('key', 'shop_name')->first()->value;
        }

       
        @endphp


        @php
       if(App\Useroption::where('user_id', domain_info('user_id'))->where('key', 'shop_name_ar')->first())
        {
              $shop_name_ar=App\Useroption::where('user_id', domain_info('user_id'))->where('key', 'shop_name_ar')->first()->value;
        }

       
        @endphp
        <div class="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="footer-end">
                            <p><i class="fa fa-copyright" aria-hidden="true"></i>
     
                            {{__('All Rights Reserved') }}  
                            @if(Session::get('locale') == 'ar')  

          @isset($shop_name_ar)
         {{$shop_name_ar}}
        @endisset

@else

        @isset($shop_name)
         {{$shop_name}}
        @endisset

        @endif   <a href="{{ domain_info('full_domain') }}"> {{ domain_info('full_domain') }} ©2021



                        </p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="payment-card-bottom">
                            <ul>
                                <li>
                                    <a href="#"><img src="{{url('/')}}/frontend/bigbag/images/footer/visa.png" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="{{url('/')}}/frontend/bigbag/images/footer/mastercard.png" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="{{url('/')}}/frontend/bigbag/images/footer/paypal.png" alt=""></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="quick-view-img">

                      <span class="quick_view_img"></span>
          

                            </div>
                        </div>
                        <div class="col-lg-6 rtl-text">
                            <div class="product-right">
                 <h2 class="exampleModal_title"></h2>


                               <span class="exampleModal_price_detail"></span>


                <span class="color_variant"></span>

                                <div class="border-product">
                                        <h6 class="product-title">
                   {{__('product details')}}
                                    </h6>

                                        <p class="content">
                                            
                                        </p>
                                    </div>
                                <div id="selectSize" class="addeffect-section product-description border-product">


                   <span class="sizebox"> </span>
                                    


                                    <h6 class="product-title">{{ __('quantity') }}</h6>
                                     <div class="qty-box">
                                <div class="input-group"><span class="input-group-prepend"><button type="button"
                                            class="btn quantity-left-minus" data-type="minus" data-field=""><i
                                                class="ti-angle-left"></i></button> </span>
                                    <input type="text" name="qty" class="form-control input-number" value="1">
                                    <span class="input-group-prepend"><button type="button"
                                            class="btn quantity-right-plus" data-type="plus" data-field=""><i
                                                class="ti-angle-right"></i></button></span>
                                </div>
                            </div>
                                </div>
                               <span class="productbuttons"></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>




   <script src="{{url('/')}}/frontend/bigbag/external/jquery-3.5.1.slim.min.js">
    </script>

    <script src="{{url('/')}}/frontend/bigbag/external/bootstrap.bundle.min.js" >
    </script>

    <!-- jquery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- slick js-->
    <script src="{{url('/')}}/frontend/bigbag/external/slick.min.js"></script>

    <!--Sm Clean-->
    <script src="{{url('/')}}/frontend/bigbag/external/jquery.smartmenus.min.js"></script>

    <!--scroll to top-->
    <script src="{{url('/')}}/frontend/bigbag/js/scrollUp.min.js"></script>

    <!--Price Range-->
    <script src="{{url('/')}}/frontend/bigbag/external/ion.rangeSlider.min.js"></script>

    <!-- notify bootstrap-->
    <script src="{{url('/')}}/frontend/bigbag/js/bootstrap-notify.min.js"></script>

    <!--venobox-->
    <script src="{{url('/')}}/frontend/bigbag/external/venobox/1.9.3/venobox.min.js"></script>

    <!-- script js-->
    <script src="{{url('/')}}/frontend/bigbag/js/script.js"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--script type="text/javascript">
 Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Your work has been saved',
  showConfirmButton: false,
  timer: 1500
})
</script -->
    @stack('js')
{{ load_footer() }}

   @yield('extra-css')
   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>






  <script type="text/javascript">
      $(document).on('click','#RemoveCartFromHome',function(){

       
         

              var text =$(this).text();

              text=text.toString();


                 
                    var xxxx= text;
var newStr = xxxx.substring(0, xxxx.length - 1);   

      
                     


        $.ajax({
            url:"{{url('/RemoveCartFromHome')}}",
            method:"POST",
           data :{
            _token:'{{ csrf_token() }}',
            id:text,

           },
            dataType:"json",
            beforeSend:function(){
                      $('.cart_sucess').html('');
                      $('.cc').addClass('hidden');
                  $('.loading-save-c').removeClass('hidden');

                  ///////////////////////////////

                  //////////////////////////////////
                      
            },
            success:function(data)
            {
                   $('.loading-save-c').addClass('hidden');
                Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: '{{__("Item has been removed!")}}',
  showConfirmButton: false,
  timer: 1500
})
             
             $('.cart_sucess').html(data.success); 

       var base_url=$('#base_url').val();
   $('.cart_total_top').html(data.subtotal);
   $('#cart_total').html(data.total);
   $('.cart_qty_cls').html(data.count);


          window.location.reload();

  


            }
        });
             return false;
    
                    
                     
                    });
  </script>


</body>

</html>