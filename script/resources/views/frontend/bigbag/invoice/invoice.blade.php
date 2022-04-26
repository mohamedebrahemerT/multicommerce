<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{url('public/logo', $general_setting->site_logo)}}" />
    <title>{{$general_setting->site_title}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <style type="text/css">
        * {
            font-size: 14px;
            line-height: 24px;
          
          
            font-family: 'Tajawal', sans-serif;
        }
        .btn {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            display: block;
            text-align: center;
            margin: 7px;
            cursor:pointer;
        }

        .btn-info {
            background-color: #999;
            color: #FFF;
        }

        .btn-primary {
            background-color: #6449e7;
            color: #FFF;
            width: 100%;
        }

        table, th, td {
  border: 1px solid black;
}
  
    </style>
     <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet"> 
  </head>
<body style="font-family: 'Tajawal', sans-serif; direction: rtl;text-align: center;">

<div style="max-width:900px;margin:0 auto">
    @if(preg_match('~[0-9]~', url()->previous()))
        @php $url = '../../pos'; @endphp
    @else
        @php $url = url()->previous(); @endphp
    @endif
    <div class="hidden-print">
        <table style="margin-bottom: -39px; border-style: none;">
            <tr>
                <td><a href="{{url()->previous()}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> {{__('Back')}}</a> </td>
                <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i> {{__('Print')}}</button></td>
            </tr>
        </table>
        <br>
    </div>
    <br>
        
    <div id="receipt-data" style="border: 2px solid #eee;
margin-right: 2%;
margin-left: -2%;padding: 7px;">
        <div class="centered">
            
                <img src="{{ asset('uploads/'.$order->user_id.'/logo.png') }}" height="100" width="100"  style="margin-bottom:8px" >
              <br>
            @php
            $user_id=getUserId();

             $shop_name=App\Useroption::where('key','shop_name')->where('user_id',$user_id)->first();
                    
             $shop_name_ar=App\Useroption::where('key','shop_name_ar')->where('user_id',$user_id)->first();

              $location=App\Useroption::where('key','location')->where('user_id',$user_id)->first();
            $location=json_decode($location->value ?? '');

              @endphp

             

            
            <h3 style="    margin-bottom: -1px;
    margin-top: -14px;
">
        @if(Session::get('locale') == 'ar')  
{{ $shop_name_ar->value ?? '' }}
@else
            	{{ $shop_name->value ?? '' }}
            	

        @endif

            </h3>
            
         {{__('Address')}}  : @if(Session::get('locale') == 'ar')  
{{ $location->address_ar ?? '' }}
@else
{{ $location->address ?? '' }}

        @endif


 

            	
                <br>{{__('Phone')}}: {{ $location->phone ?? '' }}
             
       
       
        <p>{{__('Date')}}:   {{ $order->created_at->format('d-F-Y') }} <br>
            {{ $order->order_no }} :  {{__('order no')}}<br>

                    {{ $order_content->name ?? '' }} : {{__('Name')}}  <br>
                      {{ $order_content->email ?? '' }} :{{__('Email')}}<br>
                    {{__('Phone')}}: {{ $order_content->phone ?? '' }}<br>
                     {{ $order->shipping_info->city->name ?? '' }} : {{__('City')}}<br>
            {{ $order_content->zip_code  ?? ''}} : {{__('Postal Code')}}
                               <br>
        {{ $order_content->address ?? '' }} : {{__('Address')}} 
        </p>
 </div>
         
        <table style="width: 99%;">
            <tbody>
                @foreach($order->order_item as $key=>$orderitem)
                
                <tr>
                    <td colspan="2">
                        {{ $orderitem->term->title }}
                         @php
                        $variations=json_decode($orderitem->info);   
                        @endphp
                         @if(count($variations->attribute) > 0 || count($variations->options) > 0) - @endif
                        @foreach ($variations->attribute ?? [] as $item)
                                
                        <span>{{ __('Variation') }} :</span> <small>{{ $item->attribute->name ?? '' }} - {{ $item->variation->name ?? '' }}</small>
                        @endforeach
                        @foreach ($variations->options ?? [] as $option)
                        <span>{{ __('Options') }} :</span> <small>{{ $option->name ?? '' }}</small>
                        @endforeach
                        <br>
                          
                      {{ $orderitem->amount  }} {{ $currency->currency_icon ?? '' }}    <span  >*</span>  {{ $orderitem->qty }}  <br> 

                       
         
                        
                    </td>
                    <td style="text-align:left;vertical-align:bottom">
                       {{ $orderitem->amount*$orderitem->qty}}
                       {{ $currency->currency_icon ?? '' }}
                    </td>
                </tr>
                              @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">{{__('Subtotal')}}</th>
                    <th style="text-align:left"> @isset($order_content->sub_total)
                        {{ $order_content->sub_total }} {{ $currency->currency_icon ?? '' }}
                        @endisset</th>
                </tr>
                @if($general_setting->invoice_format == 'gst' && $general_setting->state == 1)
                <tr>
                    <td colspan="2">IGST</td>
                    <td style="text-align:left">{{number_format((float)$total_product_tax, 2, '.', '')}}</td>
                </tr>
                @elseif($general_setting->invoice_format == 'gst' && $general_setting->state == 2)
                <tr>
                    <td colspan="2">SGST</td>
                    <td style="text-align:left">total_product_tax</td>
                </tr>
                <tr>
                    <td colspan="2">CGST</td>
                    <td style="text-align:left">total_product_tax</td>
                </tr>
                @endif
                
                <tr>
                    <th colspan="2">{{__('Tax')}}</th>
                    <th style="text-align:left">{{ $order->tax }} {{ $currency->currency_icon ?? '' }}</th>
                </tr>
                
                
                <tr>
                    <th colspan="2">{{__('Order Discount')}}</th>
                    <th style="text-align:left">@isset($order_content->coupon_discount)
                        {{ $order_content->coupon_discount }} {{ $currency->currency_icon ?? '' }}
                        @endisset</th>
                </tr>
               
                @if($order->order_type == 1)
                
                
                 
                <tr>
                    <th colspan="2">{{__('Shipping Cost')}}</th>
                    <th style="text-align:left">{{ $order->shipping }} {{ $currency->currency_icon ?? '' }}</th>
                </tr>
                @endif
                
                <tr>
                    <th colspan="2">{{__('Total')}}</th>
                    <th style="text-align:left">{{ $order->total }} {{ $currency->currency_icon ?? '' }}</th>
                </tr>
                 
            </tfoot>
        </table>
        <table style="width: 875px;">
            <tbody>
                
                <tr style="background-color:#ddd;">
                    <td style="padding: 5px;width:30%">{{__('Payment Status')}}: 
                     @if($order->payment_status==2)
                            <div class="badge">Pending</div>
                            @elseif($order->payment_status==1)
                            <div class="badge">Paid</div>
                            @elseif($order->payment_status==0)
                            <div class="badge">Cancel</div>
                            @elseif($order->payment_status==3)
                            <div class="badge">Incomplete</div>
                            @endif
                        </td>
                    <td style="padding: 5px;width:40%">{{__('Total')}}: {{ $order->total }} {{ $currency->currency_icon ?? '' }}</td>
                    <td style="padding: 5px;width:30%">{{__('Payment method')}}: 
       
       @if(Session::get('locale') == 'ar')  

        {{ $order->payment_method->method->name ?? 'الدفع عند الاستلام ' }} 
             @else
             {{ $order->payment_method->method->name ?? 'COD' }} 

            @endif
        

                    </td>
                </tr>                
               
                <tr><td class="centered" colspan="3">{{__('Thank you for shopping with us. Please come again')}}</td></tr>
                <tr>
                    <td class="centered" colspan="3">
                    
                    <br>
                    <?php echo '<img style="margin-top:10px;" src="data:image/png;base64,' . DNS2D::getBarcodePNG("".domain_info('full_domain')."/user/order/viewQR/".$order->id."", 'QRCODE') . '" alt="barcode"   />';?>    
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- <div class="centered" style="margin:30px 0 50px">
            <small>{{trans('file.Invoice Generated By')}} {{$general_setting->site_title}}.
            {{trans('file.Developed By')}} LionCoders</strong></small>
        </div> -->
    </div>
</div>

<script type="text/javascript">
    function auto_print() {     
        window.print()
    }
    setTimeout(auto_print, 1000);
</script>

</body>
</html>
