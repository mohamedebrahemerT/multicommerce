                       <div class='row'>
                     <div class='col-md-12 mt-2'>
                                     
                                    </div>

                       @foreach($products as $product)
       
          <div class="col-md-6 col-lg-3">
                             <div class="card">
         <img class="card-img-top" src="{{asset($product->preview->media->url ?? 'uploads/default.png')}}" height="100em">
                     <div class="card-body p-2">
                 <p class="font-weight-normal">
                           {{ $product->title}}
                         </p>
                                      {{ $product->price->price.' '.__('SAR') }}
                                            </div>
                                            <div class="card-footer p-1">
 @if($product->stock->stock_status == 1 and  $product->stock->stock_qty !== 0 )

 
 <a id="Removeshop" href="javascript:;" class="btn btn-block btn-dark add-to-cart"><span style="display:none;">{{$product->id }}</span><i class="fa fa-plus"></i>اضافة </a>

   @else

                 
                    {{ __('out of stock') }}

                             @endif 
 </div>
  </div>
  </div>
 @endforeach
 
                                                                  
                                                                                                              
                                                            </div>
                        