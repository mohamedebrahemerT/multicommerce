<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>   {{ $order_content->name ?? '' }} مرحبا   </title>
</head>
<body style="background-color: #f5f5f5; margin: 0; padding: 30px 0; direction: rtl; text-align: right;">
<table align="center" width="600" callspacing="0" cellpadding="0" style="margin-top: 0; max-width: 600px; width: 100%;border-spacing: 0;">
    <tbody>
    <tr>
        <td style="padding: 30px 30px 0; text-align: center;">
             @php
         $user_id = domain_info('user_id');
 
                                        @endphp
            <img src="{{url('/')}}/uploads/{{$user_id}}/logo.png" alt="App Name">
        </td>
    </tr>
    </tbody>
</table>
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-spacing: 0;">
    <tr>
        <td></td>
        <td width="600">
            <table width="600" callspacing="0" cellpadding="0" style="margin-top: 30px; width: 600px; max-width: 600px; border-spacing: 0;">
                <thead>

   @php
  $user_id = domain_info('user_id');
 
                                    
      if(App\Useroption::where('user_id',$user_id)->where('key','theme_color')->first())
      {
        $theme_color= App\Useroption::where('user_id',$user_id)->where('key','theme_color')->first()->value;
      }
              
@endphp
          
                <tr @isset($theme_color) style="background-color:{{$theme_color}}"  @endisset>
                    <th align="center" colspan="2" class="top-border" style="margin:0; padding:0;  border-radius: 30px 30px 0 0; text-align: center;" valign="top">
                        <img src="assets/email/images/round-top-blue.png'" alt="" width="100%">
                        <h3 class="text-large" style="color: #fff; font-family: Arial; font-size: 24px; margin-bottom: 20px; margin-top: 0;">
                            <b>    @if($order->status=='pending')
                <label class="Canceled"></label> 
               <span class="badge badge-warning">{{ __('Pending') }}</span>
   
               @elseif($order->status=='processing')
               <span class="badge badge-primary">

             عملينا العزيز طلبك رقم {{ $order->order_no }} أصبح قيد التنفيذ
             </span>

               @elseif($order->status=='ready-for-pickup')
               <span class="badge badge-info">
                 عملينا العزيز طلبك رقم {{ $order->order_no }} تم شحنه وفي الطريق إليك
               </span>

               @elseif($order->status=='completed')
                    <label class="Completed"></label>
               <span class="badge badge-success">
                 عملينا العزيز طلبك رقم {{ $order->order_no }} وصل إليك وتم إستلامه
               </span>

               @elseif($order->status=='archived')
               <span class="badge badge-warning">{{ __('Archived') }}</span>
               @elseif($order->status=='canceled')
               <span class="badge badge-danger">
                 عميلنا العزيز نأسف لخبارك بأن طلبك رقم {{ $order->order_no }} قد تم إلغاؤه
               </span>

               @else
               <span class="badge badge-info">{{ $order->status }}</span>

               @endif  </b>
                        </h3>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="bottom-border" style="background-color: #fff;padding: 30px 30px 0;">
                        <table cellpadding="10">
                             
                            <tr>
                                <td width="180">
                                    <strong> تاريخ الطلب :</strong>
                                </td>
                                <td>
                               {{ $order->created_at->format('d-F-Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td width="180">
                                    <strong>{{__('Payment status')}}:</strong>
                                </td>
                                <td>
                                     @if($order->payment_status==2)
               <label class="Canceled"></label>
               <span class="badge badge-warning">{{ __('Pending') }}</span>

               @elseif($order->payment_status==1)
               <label class="Completed"></label>
               <span class="badge badge-success">{{ __('Complete') }}</span>


               @elseif($order->payment_status==0)
                     <label class="Canceled"></label>
               <span class="badge badge-danger">{{ __('Cancel') }}</span> 
         
               @elseif($order->payment_status==3)
                  <label class="Canceled"></label> 
               <span class="badge badge-danger">{{ __('Incomplete') }}</span>
            
               @endif
                                </td>
                            </tr>

                            
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" class="bottom-border" style="background-color: #fff; border-radius: 0 0 30px 30px;">
                        <img src="assets/email/images/round-bottom.png" alt="">
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
        <td></td>
    </tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-spacing: 0;">
    <tr>
        <td></td>
        <td width="600">
            <table class="table-footer" style="margin-top: 30px; width: 600px; max-width: 600px;">
                <tbody>
                 
                  <tr>
                    <td align="center" style="padding: 30px 30px 0; padding-top: 0px;">
                        <p style="color: #626262; font-family: Arial; font-size: 12px; line-height: 100%; margin: 0 0 18px; margin-bottom: 30px; padding: 0; text-align: center;">

                           هي عبارة عن منصة تجارية مبتكرة وفريدة من نوعها عبر الإنترنت ، تم إنشاؤها من الألف إلى الياء وصممها خبراء الصناعة ، مما يجعل من السهل شراء وبيع المنتجات المختلفة.
                        </p>
                        <p style="color: #626262; font-family: Arial; font-size: 12px; line-height: 100%; margin: 0 0 18px; margin-bottom: 30px; padding: 0; text-align: center;"> 
                            إذا كنت تواجه أي مشكلة أو تريد مزيد من المعلومات من فضلك قم بزيارة موقعنا والتواصل معنا وسوف يقوم القسم المختص بالرد عليكم في أقرب وقت.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding: 30px 30px 0; padding-top: 0px;">
                        <p style="color: #626262; font-family: Arial; font-size: 12px; line-height: 100%; margin: 0 0 18px; margin-bottom: 30px; padding: 0; text-align: center;">
                            <a href="{{url('/')}}" style="color: #00aeef; font-size: 12px; text-decoration: none;">الرئيسية   </a>
                            .
                            <a href="{{url('/')}}/contact" style="color: #00aeef; font-size: 12px; text-decoration: none;"> 
اتصل بنا
</a>
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
        <td></td>
    </tr>
</table>

</body>
</html>
