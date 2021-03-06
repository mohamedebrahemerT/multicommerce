@extends('main.app')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet"/>
<style type="text/css">
    .main-content {
     position: relative;
}
 .main-content .owl-theme .custom-nav {
     position: absolute;
     top: 20%;
     left: 0;
     right: 0;
}
 .main-content .owl-theme .custom-nav .owl-prev, .main-content .owl-theme .custom-nav .owl-next {
     position: absolute;
     height: 100px;
     color: inherit;
     background: none;
     border: none;
     z-index: 100;
}
 .main-content .owl-theme .custom-nav .owl-prev i, .main-content .owl-theme .custom-nav .owl-next i {
     font-size: 2.5rem;
     color: #cecece;
}
 .main-content .owl-theme .custom-nav .owl-prev {
     left: 0;
}
 .main-content .owl-theme .custom-nav .owl-next {
     right: 0;
}
</style>

    <!-- Slider Start -->

    @if(app()->getLocale() == 'ar')

    <section class="banner" style="background-image: url('uploads/Background/MenuBackgroundPicture.png') !important;">

        @else
             <section class="banner" style="background-image: url('uploads/Background/MenuBackgroundPicture_en.png') !important;">

    @endif

        <div class="container">
            <div class="row">
                <div class="slider-thumb"></div>
                <div class="col-lg-6 col-md-12 col-xl-7">
                    <div class="block">
                        <div class="divider mb-3"></div>


                        <span class="text-uppercase text-sm letter-spacing wow fadeInDown"
                        data-wow-delay="0.01s">{{ json_decode($header->title,true)[$locale] ?? '' }}</span>
                        <h1 class="mb-3 mt-3 wow fadeInDown"
                            data-wow-delay="0.08s">{{ json_decode($header->highlight_title,true)[$locale] ?? '' }}</h1>

                        <p class="mb-4 pr-5 wow fadeInDown"
                           data-wow-delay="1.00s">{{ json_decode($header->description,true)[$locale] ?? '' }}</p>
                        <div class="btn-container  wow fadeInDown " data-wow-delay="2.00s">
                            <a href="#priceing" class="btn btn-main-2 btn-icon btn-round-full">{{ __('Get Start Now') }}
                                <i class="icofont-simple-right ml-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="feature-block d-lg-flex">
                        <div class="feature-item mb-5 mb-lg-0 wow fadeInUp" data-wow-delay="1.05s">
                            <div class="feature-icon mb-4">
                            <!-- <i class="{{ $about_1->preview }}"></i> -->
                                <img src="../uploads/upload.svg" alt="">
                            </div>
                            <h4 class="mb-3">{{ json_decode($about_1->title,true)[$locale] ?? '' }}</h4>
                            <p class="mb-4">{{ json_decode($about_1->description,true)[$locale] ?? '' }}</p>
                            @if(!empty($about_1->btn_text) && !empty( $about_1->btn_link))
                                <a href="#priceing"
                                   class="btn btn-main btn-round-full">{{ json_decode($about_1->btn_text,true)[$locale] ?? '' }}</a>
                            @endif
                        </div>

                        <div class="feature-item mb-5 mb-lg-0 wow fadeInUp" data-wow-delay="1.50s">
                            <div class="feature-icon mb-4">
                            <!-- <i class="{{ $about_2->preview }}"></i> -->
                                <img src="../uploads/shopping-cart.svg" alt="">
                            </div>


                            <h4 class="mb-3">{{ json_decode($about_2->title,true)[$locale] ?? '' }}</h4>
                            <p class="mb-4">{{ json_decode($about_2->description,true)[$locale] ?? '' }}</p>
                            @if(!empty($about_2->btn_text) && !empty($about_2->btn_link))
                                <a href="#priceing"
                                   class="btn btn-main btn-round-full">{{ json_decode($about_2->btn_text,true)[$locale] ?? '' }}</a>
                            @endif
                        </div>

                        <div class="feature-item mb-5 mb-lg-0 wow fadeInUp" data-wow-delay="2.00s">
                            <div class="feature-icon mb-4">
                            <!-- <i class="{{ $about_3->preview }}"></i> -->
                                <img src="../uploads/startup.svg" alt="">
                            </div>

                            <h4 class="mb-3">{{ json_decode($about_3->title,true)[$locale] ?? '' }}</h4>
                            <p class="mb-4">{{ json_decode($about_3->description,true)[$locale] ?? '' }}</p>
                            @if(!empty($about_3->btn_text) && !empty($about_3->btn_link))
                                <a href="#priceing"
                                   class="btn btn-main btn-round-full">{{ json_decode($about_3->btn_text,true)[$locale] ?? '' }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-sm-6">
                    <div class="about-img  wow fadeInRight">

                        <img src="{{ $ecom_features->top_image }}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="about-content pl-4 mt-4 mt-lg-0  wow fadeInLeft">
                        <h2 class="title-color">{{ json_decode($ecom_features->area_title,true)[$locale] ?? '' }}</h2>
                        <p class="mt-4 mb-5">{{ json_decode($ecom_features->description,true)[$locale] ?? '' }}</p>
                        @if(!empty($ecom_features->btn_link) && !empty($ecom_features->btn_text))
                            <a href="{{ url($ecom_features->btn_link) }}"
                               class="btn btn-main-2 btn-round-full btn-icon">{{ json_decode($ecom_features->btn_text,true)[$locale] ?? '' }}
                                <i class="icofont-simple-right ml-3"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section ">
        <div class="container">
            <div class="cta position-relative">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter-stat  wow fadeInDown">
                            <i class="pe-7s-smile"></i>
                            <span class="h3">{{ $counter_area->happy_customer ?? '' }}</span>
                            <p>{{ __('Happy Customers') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter-stat wow fadeInDown">
                            <i class="pe-7s-star"></i>
                            <span class="h3">{{ $counter_area->total_reviews ?? '' }}</span>+
                            <p>{{ __('Total Reviews') }}</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter-stat wow fadeInDown">
                            <i class="pe-7s-global"></i>
                            <span class="h3">{{ $counter_area->total_domain ?? '' }}</span>+
                            <p>{{ __('Total Domains') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter-stat wow fadeInDown">
                            <i class="pe-7s-users"></i>
                            <span class="h3">{{ $counter_area->community_member ?? '' }}</span>+
                            <p>{{ __('Community Members') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section service" id="service">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 text-center">
                    <div class="section-title">
                        <h2>{{ __('features_title') }}</h2>
                        <div class="divider mx-auto my-4"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($features as $row)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="service-item mb-4  wow fadeInDown">
                            <div class="icon d-flex align-items-center">
                                <img src="{{ asset($row->preview->content ?? '') }}" height="80">
                                <h4 class="mt-3 mb-3">{{ $row->name }}</h4>
                            </div>
                            <div class="content">
                                @if(app()->getLocale() == "ar")
                                    <p class="mb-4">{{ $row->excerpt->content_ar ?? '' }}</p>
                                @else
                                    <p class="mb-4">{{ $row->excerpt->content_en ?? '' }}</p>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


 

  <section class="section clients gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section-title text-center">
                        <h2>{{ __('gallery_title') }}</h2>
                        <div class="divider mx-auto my-4"></div>
{{--                        <p>{{ __('brand_area_description') }}</p>--}}
                    </div>
                </div>
            </div>
        </div>


 <div class="container">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
  @foreach($brands as  $key =>  $row)

    <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}"  @if($key == 1) class="active"  @endif></li>
  @endforeach
   
  </ol>
  <div class="carousel-inner">
  @foreach($latest_gallery as $key => $row)
    <div class="carousel-item  @if($key == 1) active @endif">
           
                   <img class="d-block w-100" src="{{ asset($row->preview->content)}}" style="width: 200px;height: 200px"  alt="Picture {{$key}}"> 
                
    </div>
  @endforeach
    


  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
                
            </div>
 




 
</section>


    <section class="section gray-bg" id="priceing">
        <div class="container">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="section-title text-center">
                            <h2>{{ __('Pricing') }}</h2>
                            <div class="divider mx-auto my-4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END -->
            <div class="row text-center align-items-end plan_list  wow fadeInUp">
                <!-- Pricing Table-->
                @foreach($plans as $row)
                    <div class="col-lg-4 mb-5 mb-lg-0  @if($row->featured == 0) priceing @endif">
                        <div class="bg-white p-5 rounded-lg  @if($row->featured == 1) shadow @endif ">
                            <h1 class="h6 text-uppercase font-weight-bold mb-4">{{ $row->name }}</h1>
                            <h2 class="h1 font-weight-bold">{{ amount_format($row->price) }}</h2>
                            <span
                                class="font-weight-bold">@if($row->days == 365) {{__('Yearly')}} @elseif($row->days == 30)
                                    {{__('Monthly')}} @else {{ $row->days }}  {{__('Days')}} @endif</span>
                            <ul class="list-unstyled my-5 text-small text-left font-weight-normal">
                                <li class="mb-3">
                                    <i class="fa fa-check mr-2 text-success"></i> {{ __('Products Limit') }}
                                    <b>{{ $row->product_limit }}</b>
                                </li>
                                <li class="mb-3">
                                    <i class="fa fa-check mr-2 text-success"></i> {{ __('Storage Limit') }}
                                    <b>{{ number_format($row->storage) }}MB</b>
                                </li>
                                <li class="mb-3">
                                    @if($row->custom_domain == 1)
                                        <i class="fa fa-check mr-2 text-success"></i>
                                        {{ __('Use your custom domain') }}
                                    @else
                                        <i class="fa fa-times mr-2 text-danger"></i>
                                        <del>{{ __('Use your custom domain') }}</del>
                                    @endif
                                </li>
                                <li class="mb-3">
                                    @if($row->custom_domain == 1)
                                        <i class="fa fa-check mr-2 text-success"></i>
                                        {{ __('Use subdoamin or custom domain') }}
                                    @else
                                        <i class="fa fa-check mr-2 text-success"></i>
                                        {{ __('Use subdoamin only') }}
                                    @endif
                                </li>
                                <li class="mb-3">
                                    <i class="fa fa-check mr-2 text-success"></i> {{ __('Inventory Management') }}
                                </li>
                                <li class="mb-3">
                                    <i class="fa fa-check mr-2 text-success"></i> {{ __('POS System') }}
                                </li>
                                <li class="mb-3">
                                    <i class="fa fa-check mr-2 text-success"></i> {{ __('Customer Panel') }}
                                </li>
                                <li class="mb-3">
                                    <i class="fa fa-check mr-2 text-success"></i>{{ __('Google Analytics') }}
                                </li>
                                <li class="mb-3">
                                    <i class="fa fa-check mr-2 text-success"></i>{{ __('Google Tag Manager (GTM)') }}
                                </li>
                                <li class="mb-3">
                                    <i class="fa fa-check mr-2 text-success"></i>{{ __('Facebook Pixel') }}
                                </li>
                                <li class="mb-3">
                                    <i class="fa fa-check mr-2 text-success"></i>{{ __('Whatsapp Api') }}
                                </li>
                                <li class="mb-3">
                                    <i class="fa fa-check mr-2 text-success"></i>{{ __('SEO Sitemap') }}
                                </li>
                                <li class="mb-3">
                                    <i class="fa fa-check mr-2 text-success"></i>{{ __('Multi Language') }}
                                </li>
                                <li class="mb-3">
                                    <i class="fa fa-check mr-2 text-success"></i>{{ __('Image Optimization') }}
                                </li>
                            </ul>
                            <a href="{{ route('merchant.form',$row->id) }}"
                               class="btn site_color text-white btn-block p-2 shadow rounded-pill" >{{ __('Start With') }}
                                (<b>{{ $row->name }}</b>)</a>
                        </div>
                    </div>
            @endforeach
            <!-- END -->
            </div>
        </div>
    </section>
    <section class="section testimonial-2 " style="direction: ltr">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section-title text-center">
                        <h2>{{ __('review_title') }}  </h2>
                        <div class="divider mx-auto my-4"></div>
                        <p>{{ __('review_description') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 testimonial-wrap-2">
                    @foreach($testimonials as $row)
                        <div class="testimonial-block style-2  gray-bg">
                            <i class="icofont-quote-right"></i>

                            <div class="testimonial-thumb">
                                <img
                                    src="https://ui-avatars.com/api/?name={{ $row->name ?? '' }}&background=random&length=1&color=#fff"
                                    alt="" class="img-fluid">
                            </div>

                            <div class="client-info ">
                                <h4>{{ $row->name ?? '' }}</h4>
{{--                                @dd($row->name);--}}
                                <span>{{ $row->slug ?? '' }}</span>
                                <p>
                                    @if(app()->getLocale()=="ar")
                                        {{ $row->excerpt->content_ar }}
                                    @else
                                        {{ $row->excerpt->content_en }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>


    <!--section class="section clients gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section-title text-center">
                        <h2>{{ __('brand_area_title') }}</h2>
                        <div class="divider mx-auto my-4"></div>
{{--                        <p>{{ __('brand_area_description') }}</p>--}}
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row clients-logo">
                @foreach($brands as $row)
                    <div class="col-lg-2">
                        <div class="client-thumb">
                            <a href="{{ $row->name }}" target="_blank"> <img src="{{ asset($row->preview->content)}}"
                                                                             height="50" alt="" class="img-fluid"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section  --->



 

  <section class="section clients gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section-title text-center">
                        <h2>{{ __('brand_area_title') }}</h2>
                        <div class="divider mx-auto my-4"></div>
{{--                        <p>{{ __('brand_area_description') }}</p>--}}
                    </div>
                </div>
            </div>
        </div>

            <div class="container">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
  @foreach($brands as  $key =>  $row)

    <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}"  @if($key == 1) class="active"  @endif></li>
  @endforeach
   
  </ol>
  <div class="carousel-inner">
  @foreach($brands as  $key =>  $row)
    <div class="carousel-item  @if($key == 1) active @endif">
           
                   <img class="d-block w-100" src="{{ asset($row->preview->content)}}" style="width: 200px;height: 200px"  alt="Picture {{$key}}"> 
                
    </div>
  @endforeach
    


  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
                
            </div>
 
 

 

 


</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script type="text/javascript">
    $('.main-content .owl-carousel').owlCarousel({
    stagePadding: 50,
    loop: true,
    margin: 10,
    autoplay: true,
    navigation: true,
    nav: true,
    navText: [
        '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        '<i class="fa fa-angle-right" aria-hidden="true"></i>'
    ],
    navContainer: '.main-content .custom-nav',
    responsive:{
        0:{
            items: 1
        },
        600:{
            items: 3
        },
        1000:{
            items: 5
        }
    }
});
</script>

@endsection
