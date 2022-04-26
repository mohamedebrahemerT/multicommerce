@extends('frontend.bigbag.index')
@section('content')
 
     <section class="bg-light">
        <div class="container">
            <div class="row">
                   <div class="col-lg-3">
                    <div class="products-section accountDetails">
                        <div class="media border-bottom">
                    @if(Auth::user()->image == '0')
                    <img src="{{ url('/')}}/uploads/{{ Auth::user()->id }}/photo.png" class="mr-2" alt="photo here">
                     @else
 <img src="{{ url('/') }}/frontend/bigbag/images/profile.jpg" class="mr-2" alt="photo here">
                     @endif
                              <!--div class="media-body">
                                <h6 class="mt-0">{{ Auth::user()->name }}</h6>
                            <a href="/user/logout">{{__('logout')}}</a>
                            </div -->
                        </div>
                        <div class="accountDetailsList">
                            <ul>
                                <li><a href="{{url('/')}}/user/dashboard"><span
                                            class="ti-user mr-2"></span>
                                            {{__('Account Details')}} </a></li>
                                <li><a href="{{url('/')}}/user/orders"><span class="ti-files mr-2"></span>
                                        {{__('Orders')}}</a></li>
                                <li  ><a href="{{url('/')}}/user/addresses"><span class="ti-location-pin mr-2"></span>
                                        {{__('Addresses')}}</a></li>
                                <li><a href="{{url('/')}}/user/payment"><i class="ti-credit-card mr-2"></i>{{__('Payment Cards')}}</a>
                                </li>
                                 <li class="active"><a href="{{url('/')}}/user/reviews"><i class="ti-credit-card mr-2"></i>{{__('reviews')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                 <div class="col-lg-9">
                       <h3 class="text-center">{{__('reviews')}}</h3>
                 

 

               <div class="row" style="background-color: #fff;padding: 5px">
                           
         @foreach(App\Models\Review::where('user_id',auth()->user()->id)->get() as $Review )
                            
                      <div  class="col-lg-6" >

                        @php

         $info = App\Term::where('type', 'product')->where('status', 1)->with('medias', 'content', 'categories', 'brands', 'seo', 'price', 'options', 'stock','preview')->findorFail($Review->term_id);

                        @endphp

  <a href="{{url('/')}}/product/{{$info->slug}}/{{$info->id}}"> 
            <img src="{{ asset($info->preview->media->url ?? 'uploads/default.png') }}"
                                            alt="Generic placeholder image" style="width: 100;height: 100px">
                                                </a>



                                        <div class="media-body">
                                            <h6>
                            <a href="{{url('/')}}/product/{{$info->slug}}/{{$info->id}}"> 
                                               {{$info->title}}
                                                </a>
                                                </h6>
                                                 <span>
                                            

{{$Review->created_at}}
                                        </span>
                                            <p>

                {{ \Illuminate\Support\Str::limit($Review->comment, 20, $end='...') }}

                                             
                                            </p>

                    
                           
  <a href="#" data-toggle="modal"
                                    data-target="#exampleModaladdresses{{$Review->id}}"><span class="ti-pencil-alt mr-3"></span></a>

                                     <a href="{{url('/')}}/DeleteReview/{{$Review->id}}" ><i class="fa fa-times" aria-hidden="true"></i></a>
                                        </div>
                                    </div>


                                <!------------------------------------------------------------------------------------------->
 <!-- Modal -->
    <div class="modal fade" id="exampleModaladdresses{{$Review->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="row">
                        <div class="col-lg-12 col-xs-12">
                            <h3 class="text-center">{{__('comment')}}</h3>
                            <hr>
                            <form action="{{url('/')}}/user/make-review_edit" method="post">
                                @csrf
                                <input type="hidden" name="Review_id" value="{{$Review->id}}">
                                <div class="checkbox-form">
                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>{{__('comment')}} <span class="required">*</span></label>
                         <input placeholder="" type="text" name="comment" value="{{$Review->comment}}"  />
                                            </div>
                                        </div>

                                    
                                   
                                     
 

    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                    </div>
                                    <button  type="submit">{{__('Save')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<!------------------------------------------------------------------------------------------->


                                        @endforeach
                                    </div>
                                 



                              
                           
                        </div>
                             
                         
                     
 
 </div>

                </div>
            </div>
    </section>

   <br><br>
  
    @push('js')
           <script type="text/javascript">
              // alert('test');
           </script>
    @endpush

@endsection
