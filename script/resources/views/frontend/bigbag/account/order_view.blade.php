@extends('frontend.bigbag.index')
@section('content')
   <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-content table-responsive py-5">
                        <table class="table order-table-details">
                            <thead>
                                <tr>

                                    <th>{{ __('Order Status') }}</th>
                                    <th>{{ __('Order Id') }}</th>
                                    <th>{{ __('Total Order') }}</th>
                                <td> {{ __('Payment Status') }} </td> 
                                    <th>{{ __('QTY') }}</th>
                                         <th>{{ __('Order Notes') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="status">
                                   
                                     
                                                    @if($info->status=='pending')
                                                        <span
                                                            class="badge badge-warning ">{{ __('Awaiting processing') }}</span>

                                                    @elseif($info->status=='processing')
                                                        <span class="badge badge-primary ">{{ __('Processing') }}</span>

                                                    @elseif($info->status=='ready-for-pickup')
                                                        <span
                                                            class="badge badge-info ">{{ __('Ready for pickup') }}</span>

                                                    @elseif($info->status=='completed')
                                                         <label class="new"></label>
                                                        <span class="badge badge-success ">{{ __('Completed') }}</span>

                                                    @elseif($info->status=='archived')
                                                        <span class="badge badge-danger ">{{ __('Archived') }}</span>
                                                    @elseif($info->status=='canceled')
                                                        <span class="badge badge-danger ">{{ __('Canceled') }}</span>

                                                    @else
                                                        <span class="badge badge-primary ">{{ $info->status }}</span>

                                                    @endif
                                                </address>
                                               
                                    </td>
                                    <td>{{ $info->order_no }}</td>
                                    <td class="totalorder">
                                        <div class="row">
                                            <div class="col"><strong>{{ __('Subtotal') }}</strong></div>
                                            <div class="col"><label for=""> {{ amount_format($order_content->sub_total + $order_content->coupon_discount) }}</label></div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><strong>{{ __('Discount') }}</strong></div>
                                            <div class="col"><label for=""> {{ amount_format($order_content->coupon_discount) }}</label></div>
                                        </div>

                                        <div class="row">
                                            <div class="col"><strong>{{ __('Tax') }}</strong></div>
                                            <div class="col"><label for=""> {{ amount_format($info->tax) }}</label></div>
                                        </div>

                                         <div class="row">
                                            <div class="col"><strong>{{ __('Shipping') }}</strong></div>
                                            <div class="col"><label for="">{{ amount_format($info->shipping) }}</label></div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><strong>{{ __('Total') }}</strong></div>
                                            <div class="col"><label for=""> {{ amount_format($info->total) }}</label></div>
                                        </div>
                                    </td>
                                <td class="status">
               @if($info->payment_status==2)
               <label class="Canceled"></label>
               <span class="badge badge-warning">{{ __('Pending') }}</span>

               @elseif($info->payment_status==1)
               <label class="Completed"></label>
               <span class="badge badge-success">{{ __('Complete') }}</span>


               @elseif($info->payment_status==0)
                     <label class="Canceled"></label>
               <span class="badge badge-danger">{{ __('Cancel') }}</span> 
         
               @elseif($info->payment_status==3)
                  <label class="Canceled"></label> 
               <span class="badge badge-danger">{{ __('Incomplete') }}</span>
            
               @endif
            </td>
                                    <td>{{$info->order_item->count()}}</td>
                                    <td>{{$info->OrderNotes}}</td>

                                </tr>

                            </tbody>
                            <tfoot>
                                
                                  @foreach($info->order_item as $row)
                                            <tr style="text-align: center;">
                                                  <td class="li-product-thumbnail"><a href="#"><img src="{{ asset($row->term->preview->media->url ?? 'uploads/default.png') }}"
                                                alt=""></a>
  

  
 
 
                                            </td>
                                                <td>
                                                    <a href="{{ url('/product/'.$row->term->title.'/'.$row->term->id) }}">{{ Str::limit($row->term->title,50) ?? '' }}</a>
                                                    <br>
                                                    @php
                                                        $variations=json_decode($row->info);
                                                    @endphp
                                                    @foreach ($variations->attribute ?? [] as $item)

                                                        <span></span> <small>{{ $item->attribute->name ?? '' }}
                                                            - {{ $item->variation->name ?? '' }}</small>,
                                                    @endforeach

                                                    @foreach ($variations->options ?? [] as $option)
                                                        <span>{{ __('Option') }} :</span>
                                                        <small>{{ $option->name ?? '' }}</small>,
                                                    @endforeach
                                                    @if($info->status == 'completed' && $info->payment_status == 1)
                                                        <br>
                                                        @foreach ($row->file ?? [] as $file)
                                                            <a href="{{ url($file->url) }}"
                                                               target="_blank">{{ __('Download') }}</a>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ amount_format($row->amount) }}
                                                    × {{ $row->qty }}</td>

                                                <td class="text-right">{{  amount_format($row->amount*$row->qty) }}</td>

                                                <td class="text-right">
                                                    
 

                                              @if($row->is_refundable == 0)
                                        <a href="" class="btn btn-gray d-block mb-2" data-toggle="modal" data-target="#exampleModalCancel_Product{{$row->term->id}}"> {{__('I Dont Need This Product')}}</a>
                                         @endif


                                        <a href="" class="btn btn-gold d-block" data-toggle="modal" data-target="#exampleModalRate{{$row->term->id}}">{{__('Rate Product')}}</a>


                                           <!-- Modal -->
    <div class="modal fade" id="exampleModalRate{{$row->term->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="row">
                        <div class="col-lg-12 col-xs-12">
                            <h3 class="text-center">{{__('Rate Product')}}</h3>
                            <hr>
                            <div class="star-area">
                                <h1>
                                    <i class="fa fa-star gray" aria-hidden="true" id="star_review" data-number="1"></i>
                                    <i class="fa fa-star gray" aria-hidden="true" id="star_review" data-number="2"></i>
                                    <i class="fa fa-star gray" aria-hidden="true" id="star_review" data-number="3"></i>
                                    <i class="fa fa-star gray" aria-hidden="true" id="star_review" data-number="4"></i>
                                    <i class="fa fa-star gray" aria-hidden="true" id="star_review" data-number="5"></i>
                                </h1>
                            </div>
                            <div class="review-area">
             <form method="post" action="{{url('/')}}/make-review/{{$row->term->id}}"  >
                                    @csrf
                           <input type="hidden" name="order_id"   value="{{$info->id}}">


                           <input type="hidden" name="rating" id="star_input" value="0">


                                    <textarea class="form-control" rows="3" style="resize: none" name="comment" required></textarea>
                                    <span class="float-right" style="margin-top:15px;line-height:35px;">
                                        <span id="stars_confirm">
                                        </span>
                                         <input type="hidden" name="name" value="{{ Auth::user()->name }}">
            <input type="hidden" name="email" value="{{ Auth::user()->email }}">
        <input type="hidden" name="id" value="{{$row->term->id}}">
        <input type="hidden" name="order_id" value="{{$info->id}}">
         @php
  $user_id = domain_info('user_id');
 @endphp
             
        <input type="hidden" name="shop_id" value="{{$user_id}}">
                                        <button class="btn btn-success float-right" type="submit"
                                            style="margin-left:20px;">{{__('Submit')}}</button>
                                    </span>
           

                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


      <!-- Modal -->
    <div class="modal fade" id="exampleModalCancel_Product{{$row->term->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="row">
                        <div class="col-lg-12 col-xs-12">
                            <h3 class="text-center" >{{__('Cancel Product')}}</h3>
                            <hr>
                            <h5  @if(Session::get('locale') == 'ar')  style="text-align: right;"  @endif>{{__('Why you will Cancel product ?')}}</h5>
                            <form action="{{url('/')}}/user/order/submit-refund"   method="post">
                                @csrf
                                <!---div class="form-group">
                                    <select name="" id="" class="form-control">
                                        <option value="">Product not good</option>
                                        <option value="">Product not good</option>
                                        <option value="">Product not good</option>
                                    </select>
                                </div -->

                                <input type="hidden" name="productId" value="{{$row->term->id}}">


     <input type="hidden" name="order_no" value="{{ $info->order_no }}">

                                
                                <div class="form-group">
                                    <textarea name="reason" id="" cols="30" rows="3" class="form-control"
                                        placeholder="{{__('reason')}}"></textarea>
                                </div>
                                <button type="submit"   class="btn btn-solid">{{__('Send')}}</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

                                                </td>

                                            </tr>
                                        @endforeach
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
    </section>

   

   


@endsection

@push('js')
    <script>

        function refund(productId, orderId, productName) {
            document.getElementById('order_no').value = orderId;
            if (productId == 0) {
                document.getElementById('productDiv').style.display = "none";
            } else document.getElementById('productName').value = productName;
            document.getElementById('productId').value = productId;
            console.log(productId);
        }

        // function submit_refund() {
        //     alert('submitted');
        // }
    </script>

    <script src="{{ asset('frontend/bigbag/js/checkout.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush
