@extends('frontend.beauty.layouts.app')
@section('content')
 <!-- inner page banner -->
        <div class="dlab-bnr-inr overlay-primary" style="background-image:url({{ asset('frontend/beauty/images/banner/bnr1.jpg')}});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">{{__('Order Status')}} </h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
														<li><a href="{{url('/')}}">{{__('Home')}} </a></li>

							<li>{{__('Order Status')}}</li>
						</ul>
					</div>
					<!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
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
