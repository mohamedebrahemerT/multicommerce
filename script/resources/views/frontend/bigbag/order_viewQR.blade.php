
        
        
        <!DOCTYPE html>
        <html web-base-url="https://mochasa.accerps.com">
            <head>

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

       
        @endphp                   <meta charset="utf-8"/>
                <meta name="viewport" content="initial-scale=1"/>
                <title> @if(Session::get('locale') == 'ar')  

          @isset($shop_name_ar)
         {{$shop_name_ar}}
        @endisset

@else

        @isset($shop_name)
         {{$shop_name}}
        @endisset

        @endif</title>
                <link type="text/css" rel="stylesheet" href="/web/content/8087-b5e49ba/web.report_assets_common.css"/>
                <script type="text/javascript" src="https://mochasa.accerps.com/web/content/8066-a01426f/web.assets_common.js"></script>
                <script type="text/javascript" src="https://mochasa.accerps.com/web/content/8082-b5e49ba/web.report_assets_common.js"></script>
            
            
        </head>
            <body class="container">
                <div id="wrapwrap">
                    <main>
                     
            
            
<div class="page" style="font-size:20pt;">
                        <p><b>Seller:</b> 

        @if(Session::get('locale') == 'ar')  

          @isset($shop_name_ar)
         {{$shop_name_ar}}
        @endisset

@else

        @isset($shop_name)
         {{$shop_name}}
        @endisset

        @endif
                         </p>
                        <p><b>VAT:</b> {{rand(1,1000000000000000)}} </p>
                        <p><b>Time Stamp:</b> {{ $info->created_at->format('d-F-Y') }}    </p>
                        <p><b>VAT Total:</b> <span class="oe_currency_value">{{$info->tax}}</span> SR </p>
                        <p><b>Total (with VAT):</b> <span class="oe_currency_value">{{$info->total}}</span> SR </p>
                    </div>

        
        
                    </main>
                </div>
            </body>
        </html>
    
    
    

 