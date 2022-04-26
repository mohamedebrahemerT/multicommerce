@extends('layouts.app')
@section('content')

@if(Auth::user()->status == 2 || Auth::user()->status == 3)
<div class="row mt-3">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <p>
          {{ __('Dear,') }} <b>{{ Auth::user()->name }}</b>{{ __('Your Account Currently') }} <b class="text-danger"> @if(Auth::user()->status == 2) {{ __('Suspened') }} @elseif(Auth::user()->status == 3) {{ __('Pending') }} @endif </b> {{ __('Mode And Also Disabled All Functionality If You Are Not Complete Your Payment Please Complete Your Payment From') }} <a href="{{ route('merchant.plan') }}">{{ __('Here') }}</a> {{ __('Or Also Contact With Support Team') }}
        </p>
      </div>
    </div>
  </div>
</div>
@endif
<div class="row">
  <div class="col-lg-4 col-md-4 col-sm-12">
    <div class="card card-statistic-2">
      <div class="card-stats">
        <div class="card-stats-title">{{ __('Order Statistics') }} -
          <div class="dropdown d-inline">
            <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month" id="orders-month">{{ Date('F') }}</a>
            <ul class="dropdown-menu dropdown-menu-sm">
              <li class="dropdown-title">{{ __('Select Month') }}</li>
              <li><a href="#" class="dropdown-item month @if(Date('F')=='January') active @endif" data-month="January" >{{ __('January') }}</a></li>
              <li><a href="#" class="dropdown-item month @if(Date('F')=='February') active @endif" data-month="February" >{{ __('February') }}</a></li>
              <li><a href="#" class="dropdown-item month @if(Date('F')=='March') active @endif" data-month="March" >{{ __('March') }}</a></li>
              <li><a href="#" class="dropdown-item month @if(Date('F')=='April') active @endif" data-month="April" >{{ __('April') }}</a></li>
              <li><a href="#" class="dropdown-item month @if(Date('F')=='May') active @endif" data-month="May" >{{ __('May') }}</a></li>
              <li><a href="#" class="dropdown-item month @if(Date('F')=='June') active @endif" data-month="June" >{{ __('June') }}</a></li>
              <li><a href="#" class="dropdown-item month @if(Date('F')=='July') active @endif" data-month="July" >{{ __('July') }}</a></li>
              <li><a href="#" class="dropdown-item month @if(Date('F')=='August') active @endif" data-month="August" >{{ __('August') }}</a></li>
              <li><a href="#" class="dropdown-item month @if(Date('F')=='September') active @endif" data-month="September" >{{ __('September') }}</a></li>
              <li><a href="#" class="dropdown-item month @if(Date('F')=='October') active @endif" data-month="October" >{{ __('October') }}</a></li>
              <li><a href="#" class="dropdown-item month @if(Date('F')=='November') active @endif" data-month="November" >{{ __('November') }}</a></li>
              <li><a href="#" class="dropdown-item month @if(Date('F')=='December') active @endif" data-month="December" >{{ __('December') }}</a></li>
            </ul>
          </div>
        </div>
        <div class="card-stats-items">
          <div class="card-stats-item">
            <div class="card-stats-item-count" id="pending_order"></div>
            <div class="card-stats-item-label">{{ __('Pending') }}</div>
          </div>

          <div class="card-stats-item">
            <div class="card-stats-item-count" id="completed_order"></div>
            <div class="card-stats-item-label">{{ __('Completed') }}</div>
          </div>

          <div class="card-stats-item">
            <div class="card-stats-item-count" id="shipping_order"></div>
            <div class="card-stats-item-label">{{ __('Processing') }}</div>
          </div>
        </div>
      </div>
      <div class="card-icon shadow-primary bg-primary">
        <i class="fas fa-archive"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>{{ __('Total Orders') }}</h4>
        </div>
        <div class="card-body" id="total_order">

        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-12">
    <div class="card card-statistic-2">
      <div class="card-chart">
        <canvas id="sales_of_earnings_chart" height="80"></canvas>
      </div>
      <div class="card-icon shadow-primary bg-primary">
        <i class="fas fa-dollar-sign"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>{{ __('Total Sales Of Earnings') }} - {{ date('Y') }}</h4>
        </div>
        <div class="card-body" id="sales_of_earnings">
            <img src="{{ asset('uploads/loader.gif') }}">
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-12">
    <div class="card card-statistic-2">
      <div class="card-chart">
        <canvas id="total-sales-chart" height="80"></canvas>
      </div>
      <div class="card-icon shadow-primary bg-primary">
        <i class="fas fa-shopping-bag"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>{{ __('Total Sales') }} - {{ date('Y') }}</h4>
        </div>
        <div class="card-body" id="total_sales">
            <img src="{{ asset('uploads/loader.gif') }}" class="loads">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-12 col-xl-9">

   
    <div class="row">
        <div class="col-12 col-md-6">

            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">

                            <h6 class="text-uppercase text-muted mb-2">{{ __('Today\'s Total Sales') }}</h6>

                            <span class="h2 mb-0" id="today_total_sales"><img src="{{ asset('uploads/loader.gif') }}"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">

            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">

                            <h6 class="text-uppercase text-muted mb-2">{{ __('Today\'s Orders') }}</h6>

                            <span class="h2 mb-0" id="today_order"><img src="{{ asset('uploads/loader.gif') }}"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">

            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">

                            <h6 class="text-uppercase text-muted mb-2">{{ __('Yesterday') }}</h6>

                            <span class="h2 mb-0" id="yesterday_total_sales"><img src="{{ asset('uploads/loader.gif') }}"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">

            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">

                            <h6 class="text-uppercase text-muted mb-2">{{ __('7 days') }}</h6>

                            <span class="h2 mb-0" id="last_seven_days_total_sales"><img src="{{ asset('uploads/loader.gif') }}"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">

            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">

                            <h6 class="text-uppercase text-muted mb-2">{{ __('This Month') }}</h6>

                            <span class="h2 mb-0" id="monthly_total_sales"><img src="{{ asset('uploads/loader.gif') }}"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">

            <div class="card">
               <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">

                        <h6 class="text-uppercase text-muted mb-2">{{ __('Last Month') }}</h6>

                        <span class="h2 mb-0" id="last_month_total_sales"><img src="{{ asset('uploads/loader.gif') }}"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="col-12 col-xl-3">
    <div class="row">
        <div class="col-12">
            <div class="card mt-4">
                <div class="card-header">

                    <h4 class="card-header-title plan_name" ></h4>

                    <span class="badge badge-soft-secondary plan_expire"></span>
                    <img src="{{ asset('uploads/loader.gif') }}"  class="plan_load">
                </div>
                <div class="card-header">

                    <h4 class="card-header-title">{{ __('Storage usage') }}</h4>

                    <span class="badge badge-soft-secondary" id="storage_used"><img src="{{ asset('uploads/loader.gif') }}"  class="storrage_used"></span>
                </div>
                <div class="card-header">

                    <h4 class="card-header-title">{{ __('Products') }}</h4>

                    <span class="badge badge-soft-secondary posts_used"><img src="{{ asset('uploads/loader.gif') }}"  class="product_used"></span>
                </div>
                 <div class="card-header">

                    <h4 class="card-header-title">{{ __('Pages') }}</h4>

                    <span class="badge badge-soft-secondary pages"> <img src="{{ asset('uploads/loader.gif') }}"  class="product_used"></span>
                </div>

            </div>

          
        </div>

    </div>
</div>
</div>
 <div class="row">

 <div class="col-lg-6">

            <div class="card">
                <div class="card-header">

                    <h4 class="card-header-title">{{ __('Products Limit') }} <span><span class="text-danger posts_created"></span>/<span class="product_capacity"> </span></span></h4>
                </div>
                <div class="card-body">

                    <div class="sparkline-pie-product d-inline"></div>
                </div>
            </div>
            
           
        </div>

        <div class="col-lg-6">
           <div class="card">
                <div class="card-header">

                    <h4 class="card-header-title">{{ __('Storage Uses') }} <span><span class="text-danger storage_used"></span>/<span class="storage_capacity"> </span></span></h4>
                </div>
                <div class="card-body">

                     <div class="sparkline-pie-storage d-inline"></div>

                </div>
            </div>
          
        </div>
 
             
           </div>

           <div class="row">
            <div class="col-lg-12">
              <h5>{{ __('top 10 orders') }}</h5>
                <div class="card">
      <div class="card-header">
              @php
            $user_id = getUserId();

        $orders =  App\Order::where('user_id', $user_id)->take(10)->orderBy('id','desc')->get();

              @endphp
               <table id="example" class="table table-hover table-nowrap card-table text-center">
                            <thead>
                                <tr>
                                     
                                    <th class="text-left" >{{ __('Order') }}</th>
                                    <th >{{ __('Date') }}</th>
                                    <th>{{ __('Customer') }}</th>
                                    <th class="text-right">{{ __('Order total') }}</th>
                                    <th>{{ __('Payment') }}</th>
                                    <th>{{ __('Fulfillment') }}</th>
                             
                                    <th class="text-right">{{ __('Invoice') }}</th>
                                </tr>
                            </thead>
                            <tbody class="list font-size-base rowlink" data-link="row">
                                @foreach($orders as $key => $row)
                                <tr>
                                   
                                    <td class="text-left">
                                        <a href="{{ route('seller.order.show',$row->id) }}">{{ $row->order_no }}</a>
                                    </td>
                                    <td><a href="{{ route('seller.order.show',$row->id) }}">{{ $row->created_at->format('d-F-Y') }}</a></td>
                                    <td>@if($row->customer_id !== null)<a href="{{ route('seller.customer.show',$row->customer_id) }}">{{ $row->customer->name }}</a> @else {{ __('Guest User') }} @endif</td>
                                    <td >{{ amount_format($row->total) }}</td>
                                    <td>
                                        @if($row->payment_status==2)
                                        <span class="badge badge-warning">{{ __('Pending') }}</span>

                                        @elseif($row->payment_status==1)
                                        <span class="badge badge-success">{{ __('Complete') }}</span>

                                        @elseif($row->payment_status==0)
                                        <span class="badge badge-danger">{{ __('Cancel') }}</span> 
                                        @elseif($row->payment_status==3)
                                        <span class="badge badge-danger">{{ __('Incomplete') }}</span> 

                                        @endif
                                    </td>
                                    <td>
                                        @if($row->status=='pending')
                                        <span class="badge badge-warning">{{ __('Awaiting processing') }}</span>
                                        
                                        @elseif($row->status=='processing')
                                        <span class="badge badge-primary">{{ __('Processing') }}</span>

                                        @elseif($row->status=='ready-for-pickup')
                                        <span class="badge badge-info">{{ __('Ready for pickup') }}</span>

                                        @elseif($row->status=='completed')
                                        <span class="badge badge-success">{{ __('Completed') }}</span>

                                        @elseif($row->status=='archived')
                                        <span class="badge badge-warning">{{ __('Archived') }}</span>
                                        @elseif($row->status=='canceled')
                                        <span class="badge badge-danger">{{ __('Canceled') }}</span>
                                        
                                        @else
                                        <span class="badge badge-info">{{ $row->status }}</span>

                                        @endif
                                    </td>

                                  
                                    <td><a href="{{ route('seller.invoice',$row->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-file-invoice"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                              <tfoot>
                                <tr>
                                  
                               
                                    <th class="text-left" >{{ __('Order') }}</th>
                                    <th >{{ __('Date') }}</th>
                                    <th>{{ __('Customer') }}</th>
                                    <th class="text-right">{{ __('Order total') }}</th>
                                    <th>{{ __('Payment') }}</th>
                                    <th>{{ __('Fulfillment') }}</th>
                                 
                                    <th class="text-right">{{ __('Invoice') }}</th>
                                </tr>
                            </tfoot>
                        </table>
              
            </div>
            </div>
            </div>
             
           </div>
     
     <div class="col-lg-8 col-md-12 col-12 col-sm-12">
     <div class="card">
      <div class="card-header">

        <h4 class="card-header-title">{{ __('Earnings performance') }} <img src="{{ asset('uploads/loader.gif') }}" height="20" id="earning_performance"></h4>
        <div class="card-header-action">
          <select class="form-control" id="perfomace">
            <option value="7">{{ __('Last 7 Days') }}</option>
            <option value="15">{{ __('Last 15 Days') }}</option>
            <option value="30">{{ __('Last 30 Days') }}</option>
            <option value="365">{{ __('Last 365 Days') }}</option>
          </select>
        </div>
      </div>
      <div class="card-body">
        <canvas id="myChart" height="100"></canvas>
      </div>
    </div>
  </div>

<input type="hidden" id="base_url" value="{{ url('/') }}">
<input type="hidden" id="site_url" value="{{ url('/') }}">
<input type="hidden" id="dashboard_static" value="{{ route('seller.dashboard.static') }}">
<input type="hidden" id="dashboard_perfomance" value="{{ url('/seller/dashboard/perfomance') }}">
<input type="hidden" id="dashboard_order_statics" value="{{ url('/seller/dashboard/order_statics') }}">
<input type="hidden" id="gif_url" value="{{ asset('uploads/loader.gif') }}">
<input type="hidden" id="month" value="{{ date('F') }}">
@endsection
@push('js')
<script src="{{ asset('assets/js/chart.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/seller/dashboard.js') }}"></script>
@endpush
