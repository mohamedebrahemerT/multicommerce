<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">
                @if(app()->getLocale() == 'ar')
                    <img src="{{ asset('uploads/logo/logo.png') }}" alt="" class="img-fluid" style="width: 205px;height: 50px;">
                @else
                    <img src="{{ asset('uploads/logo/logo_en.png') }}" alt="" class="img-fluid" style="width: 205px;height: 50px;">
                @endif
            </a>

        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">
                @if(app()->getLocale() == 'ar')
                    <img src="{{ asset('uploads/logo/logo.png') }}" alt="" class="img-fluid" style="width: 205px;height: 50px;">
                @else
                    <img src="{{ asset('uploads/logo/logo_en.png') }}" alt="" class="img-fluid" style="width: 205px;height: 50px;">
                @endif
            </a>
        </div>
        <ul class="sidebar-menu">
            @if(Auth::user()->role_id==1)

                  @if(admin()->user()->rolenew("dashboard_show"))
                    <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="flaticon-dashboard"></i> <span>{{ __('Dashboard') }}</span>
                        </a>
                    </li>
                  @endif

                   @if(admin()->user()->rolenew("Orders_show"))
                    <li class="{{ Request::is('admin/order*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.order.index') }}">
                            <i class="flaticon-note"></i> <span>{{ __('Orders') }}</span>
                        </a>
                    </li>
                  @endif
               

                @php
                    $plan=false;
                @endphp
                @can('plan.create')
                    @php
                        $plan=true;
                    @endphp
                @endcan
                @can('plan.list')
                    @php
                        $plan=true;
                    @endphp
                @endcan
                @if($plan == true)
                   @if(admin()->user()->rolenew("Plans_show"))

                    <li class="dropdown {{ Request::is('admin/plan*') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="flaticon-pricing"></i> <span>{{ __('Plans') }}</span></a>
                        <ul class="dropdown-menu">
                       
                                <li><a class="nav-link {{ Request::is('admin/plan/create') ? 'active' : '' }}"
                                       href="{{ route('admin.plan.create') }}">{{ __('Create') }}</a></li>
                      
                          
                                <li><a class="nav-link {{ Request::is('admin/plan') ? 'active' : '' }}"
                                       href="{{ route('admin.plan.index') }}">{{ __('All Plans') }}</a></li>
                            
                        </ul>
                    </li>
                @endif

                @endif
                   @if(admin()->user()->rolenew("Reports_show"))
              
                    <li class="{{ Request::is('admin/report*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.report') }}">
                            <i class="flaticon-dashboard-1"></i> <span>{{ __('Reports') }}</span>
                        </a>
                    </li>
                     @endif

                   @if(admin()->user()->rolenew("Customers_show"))
              
                    <li class="dropdown {{ Request::is('admin/customer*') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="flaticon-customer"></i> <span>{{ __('All Customers') }}</span></a>
                        <ul class="dropdown-menu">
                          
                                <li><a class="nav-link"
                                       href="{{ route('admin.customer.create') }}">{{ __('Create Customer') }}</a></li>
                         
                           
                                <li><a class="nav-link"
                                       href="{{ route('admin.customer.index') }}">{{ __('All Customers') }}</a></li>
                         
                        
                                <li><a class="nav-link"
                                       href="{{ route('admin.customer.index','type=3') }}">{{ __('Customer Request') }}</a>
                                </li>
                      
                            
                                <li><a class="nav-link"
                                       href="{{ route('admin.customer.index','type=2') }}">{{ __('Suspended Customers') }}</a>
                                </li>
                          
                        </ul>
                    </li>
                     @endif
             

                   @if(admin()->user()->rolenew("counteries_show"))

                    <li class="dropdown {{ Request::is('admin/counteries*') ? 'active' : '' }}">
  <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="flaticon-customer"></i> <span>{{ __('All counteries') }}</span></a>
                        <ul class="dropdown-menu">

                   @if(admin()->user()->rolenew("counteries_show"))

                                <li><a class="nav-link"
                                       href="{{ route('admin.counteries.index') }}">{{ __('All counteries') }}</a></li>
                     @endif
                   @if(admin()->user()->rolenew("cities_show"))

                                         <li><a class="nav-link"
                                       href="{{ route('admin.cities.index') }}">{{ __('cities') }}</a></li>
                     @endif
                   @if(admin()->user()->rolenew("states_show"))

                                         <li><a class="nav-link"
                                       href="{{ route('admin.states.index') }}">{{ __('states') }}</a></li>
                     @endif



                        </ul>
                    </li>
                     @endif
 


                   @if(admin()->user()->rolenew("Domains_show"))
                
                    <li class="dropdown {{ Request::is('admin/domain*') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="flaticon-www"></i>
                            <span>{{ __('Domains') }}</span></a>
                        <ul class="dropdown-menu">
                 
                                <li><a class="nav-link {{ Request::is('admin/domain/create') ? 'active' : '' }}"
                                       href="{{ route('admin.domain.create') }}">{{ __('Create Domain') }}</a></li>
                      
                  
                                <li><a class="nav-link {{ Request::is('admin/domain') ? 'active' : '' }}"
                                       href="{{ route('admin.domain.index') }}">{{ __('All Domains') }}</a></li>
                           
                        </ul>
                    </li>
                     @endif
         

                   @if(admin()->user()->rolenew("cron_show"))
                
                    <li class="{{ Request::is('admin/cron') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.cron.index') }}">
                            <i class="flaticon-task"></i> <span>{{ __('Cron Jobs') }}</span>
                        </a>
                    </li>
                     @endif
                
                   @if(admin()->user()->rolenew("paymentgeteway_show"))
              
                    <li class="{{ Request::is('admin/payment-geteway*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.payment-geteway.index') }}">
                            <i class="flaticon-credit-card"></i> <span>{{ __('Payment Gateways') }}</span>
                        </a>
                    </li>
                     @endif
                 
            
                    <!--li class="{{ Request::is('admin/template') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.template.index') }}">
                            <i class="flaticon-template"></i> <span>{{ __('Templates') }}</span>
                        </a>
                    </li -->
              
                   @if(admin()->user()->rolenew("Pages_show"))
            
                    <li class="dropdown {{ Request::is('admin/page*') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="flaticon-document"></i> <span>{{ __('Pages') }}</span></a>
                        <ul class="dropdown-menu">
                           
                                <li><a class="nav-link"
                                       href="{{ route('admin.page.create') }}">{{ __('Create Pages') }}</a></li>
                             
                           
                                <li><a class="nav-link" href="{{ route('admin.page.index') }}">{{ __('All Pages') }}</a>
                                </li>
                       
                        </ul>
                    </li>
                     @endif

            

           
                    <!--li class="dropdown {{ Request::is('admin/language*') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="flaticon-translation"></i> <span>{{ __('Language') }}</span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link"
                                   href="{{ route('admin.language.create') }}">{{ __('Create language') }}</a></li>
                            <li><a class="nav-link"
                                   href="{{ route('admin.language.index') }}">{{ __('Manage language') }}</a></li>
                        </ul>
                    </li -->
               
                   @if(admin()->user()->rolenew("FrontendSettings_show"))
               
                    <li class="dropdown {{ Request::is('admin/appearance*') ? 'active' : '' }}  {{ Request::is('admin/gallery*') ? 'active' : '' }} {{ Request::is('admin/menu*') ? 'active' : '' }} {{ Request::is('admin/seo*') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="flaticon-settings"></i> <span>{{ __('Appearance') }}</span></a>
                        <ul class="dropdown-menu">
                   @if(admin()->user()->rolenew("FrontendSettings_show"))

                            <li><a class="nav-link"
                                   href="{{ route('admin.appearance.show','header') }}">{{ __('Frontend Settings') }}</a>
                            </li>
                  @endif
                   @if(admin()->user()->rolenew("Gallery_show"))

                            <li><a class="nav-link" href="{{ route('admin.gallery.index') }}">{{ __('Gallery') }}</a>
                            </li>
                  @endif

                   @if(admin()->user()->rolenew("Menu_show"))

                            <li><a class="nav-link" href="{{ route('admin.menu.index') }}">{{ __('Menu') }}</a></li>
                  @endif
                   @if(admin()->user()->rolenew("SEO_show"))


                            <li><a class="nav-link" href="{{ route('admin.seo.index') }}">{{ __('SEO') }}</a></li>
                  @endif

                        </ul>
                    </li>
                  @endif
                   @if(admin()->user()->rolenew("marketing_show"))
                
                    <li class="{{ Request::is('admin/marketing') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.marketing.index') }}">
                            <i class="flaticon-megaphone"></i> <span>{{ __('Marketing Tools') }}</span>
                        </a>
                    </li>
               @endif

                   @if(admin()->user()->rolenew("settings_show"))
                
                    <li class="dropdown {{ Request::is('admin/site-settings*') ? 'active' : '' }} {{ Request::is('admin/system-environment*') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="flaticon-settings"></i> <span>{{ __('Settings') }}</span></a>
                        <ul class="dropdown-menu">
                   @if(admin()->user()->rolenew("settings_show"))
                             
                                <li><a class="nav-link"
                                       href="{{ route('admin.site.settings') }}">{{ __('Site Settings') }}</a></li>
                            
               @endif

                   @if(admin()->user()->rolenew("CpanelCredentials_show"))
                           
                                <li>
                <a class="nav-link"
                                       href="{{ route('admin.site.CpanelCredentials') }}">{{ __('Cpanel Credentials') }}</a></li>
               @endif
                           


                   @if(admin()->user()->rolenew("SystemEnvironment_show"))
                        
                                <li><a class="nav-link"
                                       href="{{ route('admin.site.environment') }}">{{ __('System Environment') }}</a>
                                </li>
               @endif
                          
                        </ul>
                    </li>
               @endif


                   @if(admin()->user()->rolenew("Admins_show"))
               
                    <li class="dropdown {{ Request::is('admin/role*') ? 'active' : '' }} {{ Request::is('admin/users*') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="flaticon-member"></i>
                            <span>{{ __('Admins & Roles') }}</span></a>
                        <ul class="dropdown-menu">

                   @if(admin()->user()->rolenew("Admins_show"))
                            
    <li><a class="nav-link" href="{{url('/')}}/admin/AdminGroup">{{ __('Roles') }}</a>
                                </li>
               @endif
                           


                   @if(admin()->user()->rolenew("AdminGroup_show"))
                        
                                <li><a class="nav-link" href="{{ route('admin.users.index') }}">{{ __('Admins') }}</a>
                                </li>
               @endif
                             
                        </ul>
                    </li>
               @endif
               

            @endif

            @if(Auth::user()->role_id==3)

           
               @if(admin()->user()->rolenew("dashboard_show"))
                        
                            <li class="{{ Request::is('seller/dashboard*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('seller.dashboard') }}">
                        <i class="flaticon-dashboard"></i> <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>     
               @endif
               


  @if(Auth::user()->shop_type == 4 or Auth::user()->shop_type == 2)
                <li class="{{ Request::is('seller/POS*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('/')}}/seller/POSbeauty">
                        <i class="flaticon-credit-card"></i> <span>{{ __('POSbeauty') }}</span>
                    </a>
                </li>

                <li class="{{ Request::is('seller/POS*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('seller.branches.index') }}">
                        <i class="flaticon-dashboard-1"></i> <span>{{ __('branches') }}</span>
                    </a>
                </li>



                @else

               @if(admin()->user()->rolenew("POS_show"))

                 <li class="{{ Request::is('seller/POS*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('/')}}/seller/getPOSShope">
                        <i class="flaticon-credit-card"></i> <span>{{ __('POS') }}</span>
                    </a>
                </li>
                @endif

                @endif


               @if(admin()->user()->rolenew("Orders_show"))

                <li class="dropdown {{ Request::is('seller/order*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="flaticon-note"></i>
                        <span>{{ __('Orders') }}</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ url('/seller/orders/all') }}">{{ __('All Orders') }}</a></li>
                        <li><a class="nav-link" href="{{ url('/seller/orders/canceled') }}">{{ __('Canceled') }}</a>
                        </li>

                    </ul>
                </li>
                @endif




               @if(admin()->user()->rolenew("Refund_show"))

                <li class="dropdown {{ Request::is('seller/refund*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="flaticon-credit-card"></i> <span>{{ __('Refund') }}</span></a>
                    <ul class="dropdown-menu">

                        <li><a class="nav-link" href="{{ route('seller.refund.status' , 'all') }}">{{ __('Refund') }}</a>
                        </li>

         <li><a class="nav-link" href="{{ route('seller.refund.taxes' , 'all') }}">
         {{ __('Refund') }} {{ __('taxes') }} </a>
                        </li>

                    </ul>
                </li>
                @endif
               @if(admin()->user()->rolenew("Products_show"))

                <li class="dropdown {{ Request::is('seller/product*') ? 'active' : '' }} {{ Request::is('seller/inventory*') ? 'active' : '' }} {{ Request::is('seller/category*') ? 'active' : '' }} {{ Request::is('seller/attribute*') ? 'active' : '' }} {{ Request::is('seller/brand*') ? 'active' : '' }} {{ Request::is('seller/coupon*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="flaticon-box"></i>
                        <span>{{accountTranslation('Products',Auth::user()->shop_type, app()->getLocale())}}</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('seller.product.index') }}">{{  accountTranslation('All Products',Auth::user()->shop_type, app()->getLocale()) }}</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('seller.inventory.index') }}">{{ __('Inventory') }}</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('seller.category.index') }}">{{ __('Categories') }}</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('seller.attribute.index') }}">{{ __('Attributes') }}</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('seller.brand.index') }}">{{ __('Brands') }}</a></li>
                        <li><a class="nav-link" href="{{ route('seller.coupon.index') }}">{{ __('Coupons') }}</a></li>
                    </ul>
                </li>
                @endif

               @if(admin()->user()->rolenew("Customers_show"))
                
                    <li class="{{ Request::is('seller/customer*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('seller.customer.index') }}">
                            <i class="flaticon-customer"></i> <span>{{ __('Customers') }}</span>
                        </a>
                    </li>
                @endif 
               @if(admin()->user()->rolenew("Transactions_show"))

                <li class="{{ Request::is('seller/transection*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('seller.transection.index') }}">
                        <i class="flaticon-credit-card"></i> <span>{{ __('Transactions') }}</span>
                    </a>
                </li>
                @endif 


               @if(admin()->user()->rolenew("Reports_show"))


    <li class="dropdown {{ Request::is('seller/report*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="flaticon-dashboard-1"></i> <span>{{ __('Reports') }}</span></a>
                    <ul class="dropdown-menu">

                        <li><a class="nav-link" href="{{ route('seller.report.index') }}">{{ __('Reports') }}</a>
                        </li>

         <li><a class="nav-link" href="{{ route('seller.report.taxes') }}">
         {{ __('Reports') }} {{ __('taxes') }} </a>
                        </li>

                    </ul>
                </li>
                @endif 

               @if(admin()->user()->rolenew("ReviewRatings_show"))


                <li class="{{ Request::is('seller/review*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('seller.review.index') }}">
                        <i class="flaticon-dashboard-1"></i> <span>{{ __('Review & Ratings') }}</span>
                    </a>
                </li>
                @endif 
               @if(admin()->user()->rolenew("Shipping_show"))

                <li class="dropdown {{ Request::is('seller/location*') ? 'active' : '' }} {{ Request::is('seller/shipping*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="flaticon-delivery"></i>
                        <span>{{ __('Shipping') }}</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('seller.location.index') }}">{{ __('locations') }}</a>
                        </li>
                        <li><a class="nav-link"
                               href="{{ route('seller.shipping.index') }}">{{ __('Shipping Price') }}</a></li>
                    </ul>
                </li>
                @endif 
               @if(admin()->user()->rolenew("OfferAds_show"))

                <li class="dropdown {{ Request::is('seller/ads*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="flaticon-megaphone"></i>
                        <span>{{ __('Offer & Ads') }}</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('seller.ads.index') }}">{{ __('Bump Ads') }}</a></li>
                        <li><a class="nav-link"
                               href="{{ route('seller.ads.show','banner') }}">{{ __('Banner Ads') }}</a></li>
                    </ul>
                </li>
                @endif 
               @if(admin()->user()->rolenew("Settings_show"))

                <li class="dropdown {{ Request::is('seller/settings*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="flaticon-settings"></i>
                        <span>{{ __('Settings') }}</span></a>
                    <ul class="dropdown-menu">
                        @if(Auth::user()->shop_type == 4)
                        <li><a class="nav-link" href="{{ route('seller.booking_schedule.index') }}">{{ __('Booking schedule') }}</a>
                        </li>
                        @endif
                        <li><a class="nav-link"
                               href="{{ route('seller.settings.show','shop-settings') }}">{{ __('Shop Settings') }}</a>
                        </li>

                        <li>
                    <a class="nav-link"
                               href="{{url('/')}}/seller/taxes">{{ __('taxes') }}</a>
                        </li>


                        <li><a class="nav-link"
                               href="{{ route('seller.settings.show','payment') }}">{{ __('Payment Options') }}</a></li>
                        <li><a class="nav-link"
                               href="{{ route('seller.settings.show','plan') }}">{{ __('Subscriptions') }}</a></li>

                    </ul>
                </li>
                        @endif

                @if(Auth()->user()->is_admin)
                @can('marketing.tools')
                @endif

               @if(admin()->user()->rolenew("MarketingTools_show"))

                <li class="dropdown {{ Request::is('seller/marketing*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="flaticon-megaphone"></i>
                        <span>{{ __('Marketing Tools') }}</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link"
                               href="{{ route('seller.marketing.show','google-analytics') }}">{{ __('Google Analytics') }}</a>
                        </li>
                        <li><a class="nav-link"
                               href="{{ route('seller.marketing.show','tag-manager') }}">{{ __('Google Tag Manager') }}</a>
                        </li>
                        <li><a class="nav-link"
                               href="{{ route('seller.marketing.show','facebook-pixel') }}">{{ __('Facebook Pixel') }}</a>
                        </li>
                        <li><a class="nav-link"
                               href="{{ route('seller.marketing.show','whatsapp') }}">{{ __('Whatsapp Api') }}</a></li>

                    </ul>
                </li>

                @endif

                @if(Auth()->user()->is_admin)
                @endcan
                @endif
               @if(admin()->user()->rolenew("Calender_show"))

                <li class="{{ Request::is('seller/calender*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('/')}}/seller/calender">
                        <i class="flaticon-calendar"></i> <span>{{ __('Calender') }}</span>
                    </a>
                </li>
                @endif
               @if(admin()->user()->rolenew("Employees_show"))

                <li class="dropdown {{ Request::is('seller/role*') ? 'active' : '' }} {{ Request::is('seller/users*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="flaticon-member"></i><span>{{ __('Employees & Roles') }}</span></a>
                    <ul class="dropdown-menu">

                            <li><a class="nav-link" href="{{ url('/') }}/seller/StoreGroup">{{ __('Roles') }}</a>
                            </li>

                            <li><a class="nav-link" href="{{ route('seller.users.index') }}">{{ __('Employees') }}</a>
                            </li>

                    </ul>
                </li>
                @endif


                @if(Auth()->user()->is_admin)
                @can('site.settings')
                @endif

                <li class="menu-header">{{ __('SALES CHANNELS') }}</li>
               @if(admin()->user()->rolenew("Onlinestore_show"))

                <li class="dropdown {{ Request::is('seller/setting*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="flaticon-shop"></i>
                        <span>{{ __('Online store') }}</span></a>
                    <ul class="dropdown-menu">
                        {{-- <li><a href="{{ route('seller.theme.index') }}">{{ __('Themes') }}</a></li>--}}

                        <!--li><a href="{{ route('seller.menu.index') }}">{{ __('Menus') }}</a></li-->

                        <li><a href="{{ route('seller.page.index') }}">{{ __('Pages') }}</a></li>
                        <li><a href="{{ route('seller.slider.index') }}">{{ __('Sliders') }}</a></li>
                        <li><a href="{{ route('seller.seo.index') }}">{{ __('Seo') }}</a></li>

                    </ul>
                </li>
                @endif
                
                @if(Auth()->user()->is_admin)
                @endcan
                @endif

                <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                    <a href="{{ domain_info('full_domain') }}" class="btn btn-primary btn-lg btn-block btn-icon-split" target="_balnk">
                        <i class="fas fa-external-link-alt"></i>{{ __('Your Website') }}
                    </a>
                </div>
        @endif
    </aside>
</div>
