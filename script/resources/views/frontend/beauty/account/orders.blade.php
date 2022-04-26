@extends('frontend.beauty.layouts.app')
@section('content')
 <div class="dlab-bnr-inr overlay-primary" style="background-image:url({{ asset('frontend/beauty/images/banner/bnr1.jpg')}});">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">{{__('Orders')}}  </h1>
                    <!-- Breadcrumb row -->
                    <div class="breadcrumb-row">
                        <ul class="list-inline">
                                                        <li><a href="{{url('/')}}">{{__('Home')}} </a></li>

                            <li>{{__('Orders')}} </li>
                        </ul>
                    </div>
                    <!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <br>
        
   <section class="bg-light">
        <div class="container">
            <div class="row">
                   <div class="col-lg-3">
                    <div class="products-section accountDetails">
                        <div class="media border-bottom">
                    <img src="{{url('/')}}/frontend/bigbag/images/profile.jpg" class="mr-2" alt="...">
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
                                <li  class="active"><a href="{{url('/')}}/user/orders"><span class="ti-files mr-2"></span>
                                        {{__('Orders')}}</a></li>
                                <li><a href="{{url('/')}}/user/addresses"><span class="ti-location-pin mr-2"></span>
                                        {{__('Addresses')}}</a></li>
                                <li><a href="{{url('/')}}/user/payment"><i class="ti-credit-card mr-2"></i>{{__('Payment Cards')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-lg-9">
                    <div class="wrap-account-details mt-30">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="country-select clearfix">
                                    <select class="nice-select wide">
                                        <option data-display="Month">{{__('Month')}}</option>
                                        <option value="uk">{{__('Year')}}</option>
                                        <option value="rou">{{__('Day')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 ml-auto">
                                <div class="country-select clearfix">
                                    <select class="nice-select wide Status">
                     <option data-display="Status">{{__('Status')}}</option>
                            <option value="pending">{{__('pending')}}</option>
                         <option value="processing">{{__('processing')}}</option>
         <option value="ready-for-pickup">{{__('ready-for-pickup')}}</option>
         <option value="completed">{{__('completed')}}</option>
         <option value="canceled">{{__('canceled')}}</option>
         <option value="archived">{{__('archived')}}</option>
                                         

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>

                                            <th>{{ __('Order Id') }}</th>
            <th>{{__('Total')}}</th>
            <th>{{ __('Payment Mode') }}</th>
            <th>{{ __('Payment Status') }}</th>
            <th>{{ __('Order Status') }}</th>
            <th>{{ __('View') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        

                                        @foreach($orders as $row)
         <tr>
            <td><a href="{{ url('/user/order/view',$row->id) }}">{{ $row->order_no }}</a></td>
            <td>{{ amount_format($row->total) }}</td>
            @if(Session::get('locale') == 'ar')  

            <td>{{ $row->payment_method->method->name ?? 'الدفع عند الاستلام ' }}</td>
             @else
            <td>{{ $row->payment_method->method->name ?? 'COD' }}</td>

            @endif

            <td class="status">
               @if($row->payment_status==2)
               <label class="Canceled"></label>
               <span class="badge badge-warning">{{ __('Pending') }}</span>

               @elseif($row->payment_status==1)
               <label class="Completed"></label>
               <span class="badge badge-success">{{ __('Complete') }}</span>


               @elseif($row->payment_status==0)
                     <label class="Canceled"></label>
               <span class="badge badge-danger">{{ __('Cancel') }}</span> 
         
               @elseif($row->payment_status==3)
                  <label class="Canceled"></label> 
               <span class="badge badge-danger">{{ __('Incomplete') }}</span>
            
               @endif
            </td>
            <td class="status">
               @if($row->status=='pending')
                <label class="Canceled"></label> 
               <span class="badge badge-warning">{{ __('Pending') }}</span>
   
               @elseif($row->status=='processing')
               <span class="badge badge-primary">{{ __('Processing') }}</span>

               @elseif($row->status=='ready-for-pickup')
               <span class="badge badge-info">{{ __('Ready for pickup') }}</span>

               @elseif($row->status=='completed')
                    <label class="Completed"></label>
               <span class="badge badge-success">{{ __('Completed') }}</span>

               @elseif($row->status=='archived')
               <span class="badge badge-warning">{{ __('Archived') }}</span>
               @elseif($row->status=='canceled')
               <span class="badge badge-danger">{{ __('Canceled') }}</span>

               @else
               <span class="badge badge-info">{{ $row->status }}</span>

               @endif

            </td>
            <td ><a href="{{ url('/user/order/view',$row->id) }}"><i class="fa fa-eye"></i></a></td>
         </tr>
         @endforeach
                                         
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    @push('js')


    
<script type="text/javascript">
            $('.Status').on('change',function() {

                 var id = $(this).val();
                  
             if (id == 'pending') 
             {
    window.location.href = '{{ url("user/orders/pending") }}'


             }
             else if (id == 'processing') 
             {
    window.location.href = '{{ url("user/orders/processing") }}'

             }
             else if (id == 'ready-for-pickup') 
             {
    window.location.href = '{{ url("user/orders/ready-for-pickup") }}'

             }

             else if (id == 'completed') 
             {
    window.location.href = '{{ url("user/orders/completed") }}'

             }
              else if (id == 'canceled') 
             {
    window.location.href = '{{ url("user/orders/canceled") }}'

             }
              else if (id == 'archived') 
             {
    window.location.href = '{{ url("user/orders/archived") }}'

             }
             else
             {
    window.location.href = '{{ url("user/orders") }}'

             }
             
              
  
   

});
        </script>

    

    
  
    
 

    @endpush
@endsection