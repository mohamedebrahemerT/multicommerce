<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
table, th, td {
  border: 1px solid black;
}

table {
  width: 100%;
  text-align: center;
}
</style>
</head>

<body>


<div  style="margin:1%">
<div class="row">
    <div class="col-6">
        <img src="{{url('/')}}/uploads/6/logo.png" alt="">
        <br>
        <h5 style="text-align:right">شكرا للتسوق معنا</h5>
        
    </div>

    <div class="col-6">
        <h5 style="text-align:center;">الباركود </h5>
         <table style="direction: rtl;">
              <tr><td>{{__('Invioce')}}</td>  <td>12</td></tr>
              <tr><td> {{__('Ref')}}</td>  <td> </td></tr>
              <tr><td>{{__('Date')}}</td> <td>wed 2021-07-28</td></tr>
              <tr><td>{{__('Time')}}</td> <td>10:35:37</td></tr>
         </table>
        
    </div>

       <div class="col-12">
        <br>
         <table>
             <tr><td colspan="6" style="background-color:#eee">{{__('address')}}</td> </tr>
              <tr><td>{{ $info->customer->phone }}</td> <td>{{__('phone')}}</td> <td>{{ $info->customer->email }}</td> <td>{{__('email')}}</td> <td>{{ $info->customer->name }}</td> <td>{{__('name')}}  </td> </tr>

               
              <tr><td>1</td> <td>Adress ID</td> <td> {{__('cairo')}}</td> <td>city</td> <td>{{__('Egypt')}}</td> <td>{{__('Country')}}</td> </tr>

                <tr><td>+20</td> <td>{{__('Country code')}}</td> <td>{{ $info->customer->mobile }} </td> <td>Mobile</td> <td>{{ $info->customer->id }}</td> <td>{{__('USer ID')}}</td> </tr>

              <tr><td>1</td> <td>{{__('block')}}</td> <td>4 </td> <td>{{__('street')}}</td> <td>...</td> <td>{{__('City')}}</td> </tr>
              
         </table>
        
       </div>


         <div class="col-12">
        <br>
         <table>
             <tr><td colspan="7" style="background-color:#eee">{{__('Order note')}}</td>


              </tr>
              <tr><td>{{__('Total')}}</td><td>{{__('Quantity')}}</td> <td>{{__('price')}}</td>  <td>{{__('Product')}}</td> <td>{{__('images')}}</td> </tr>
                                  @foreach($info->order_item as $row)

               <tr><td> {{ $currency->currency_icon ?? '' }} 50 </td><td> {{ $currency->currency_icon ?? '' }}{{ $row->amount }}
                                                    × {{ $row->qty }}</td> <td> {{ $currency->currency_icon ?? '' }} {{ $row->amount }}</td>  
                <td>
                    {{ Str::limit($row->term->title,50) ?? '' }}

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
                </td> 

                <td>
                    <img class="pic-2" src="{{ asset($row->term->preview->media->url ?? 'uploads/default.png') }}" style="width:100px;height:100px;">
                </td> 
               </tr>

                                        @endforeach


               
             
              
         </table>
        
       </div>

        <div class="col-12">
        <br>
         <table>
             <tr style="background-color:#eee"> <td>{{__('Grand Total')}}</td> <td>{{__('discount')}}</td> <td>{{__('discount')}}</td> <td>{{__('BILLING & SHIPPING')}}</td> <td>{{__('Total')}}</td> <td>{{__('PAyment Method')}}</td> </tr>
          
                 <tr><td> {{ $info->total }}  {{ $currency->currency_icon ?? '' }}</td><td>0.00</td> <td> {{ $currency->currency_icon ?? '' }} {{ $order_content->coupon_discount }}   </td> <td> {{ $currency->currency_icon ?? '' }}  {{ $info->shipping }} </td>   <td> {{ $currency->currency_icon ?? '' }}{{  $info->total }}  </td> <td>{{ $info->payment_method->method->name ?? 'الدفع عند الاستلام ' }}</td> </tr>

               
             
              
         </table>
        
       </div>

       <div class="col-12">
        <br>
         <table>
             <tr style="background-color:#eee">   <td>التوقيع </td> <td>وقت التسليم </td> <td>تاريخ التسليم </td>  </tr>
          
                 <tr><td>.....</td><td>.....</td> <td>...</td>   </tr>

               
             
              
         </table>
        
       </div>
</div>      

    </div>
   <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script-->

</body>
</html>
