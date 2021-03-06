@extends('layouts.app')
@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-colorpicker.min.css') }}">
@endpush
@section('head')
    @include('layouts.partials.headersection',['title'=>trans('Site Settings')])
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Site Settings') }}</h4><br>

                </div>
                <div class="card-body">
                    <form class="basicform" action="{{ route('admin.site_settings.update') }}" method="post">
                        @csrf

                        @php
            $name=$info->name;

          $name = json_decode($name);
                        @endphp

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Site Name') }} {{__('Arabic')}}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="site_name_ar" class="form-control"
                                       value="{{ $name->ar ?? '' }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Site Name') }} {{__('English')}}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="site_name_en" class="form-control"
                                       value="{{ $name->en ?? '' }}">
                            </div>
                        </div>

                           <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('basic_colors_1') }}  </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="color" name="basic_colors_1" class="form-control"
                                       value="{{ $info->basic_colors_1 ?? '' }}">
                            </div>
                        </div>

                         <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('basic_colors_2') }}  </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="color" name="basic_colors_2" class="form-control"
                                       value="{{ $info->basic_colors_2 ?? '' }}">
                            </div>
                        </div>

                         <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('footerbackground') }}  </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="color" name="footerbackground" class="form-control"
                                       value="{{ $info->footerbackground ?? '' }}">
                            </div>
                        </div>




                         <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('footercolors') }}  </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="color" name="footercolors" class="form-control"
                                       value="{{ $info->footercolors ?? '' }}">
                            </div>
                        </div>

                         <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('btnbackground') }}  </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="color" name="btnbackground" class="form-control"
                                       value="{{ $info->btnbackground ?? '' }}">
                            </div>
                        </div>

                         <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('MenuBackgroundPicture') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="file" name="MenuBackgroundPicture" class="form-control"  >
                            </div>
                        </div>

                         <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('MenuBackgroundPicture') }} (en)</label>
                            <div class="col-sm-12 col-md-7">
                        <input type="file" name="MenuBackgroundPicture_en" class="form-control"  >
                            </div>
                        </div>



                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Site Description') }} {{__('Arabic')}}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="site_description_ar" class="form-control"
                                       placeholder="short description" maxlength="200"
                                       value="{{ $info->site_description->ar ?? '' }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Site Description') }} {{__('English')}}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="site_description_en" class="form-control"
                                       placeholder="short description" maxlength="200"
                                       value="{{ $info->site_description->en ?? '' }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('terms') }} {{__('English')}}</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea class="form-control" name="terms_en" id="terms_en">{!! $terms->en ?? '' !!}</textarea>
                                {{--                                {{ editor(array('title'=>'','id'=>'terms_en' ,'name'=>'terms_en','class'=>'content','value'=> $terms->en ?? '')) }}--}}
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('terms') }} {{__('Arabic')}}</label>
                            <div class="col-sm-12 col-md-7 text-right" dir="rtl">
                                <textarea class="form-control" name="terms_ar" id="terms_ar">{!! $terms->ar ?? '' !!}</textarea>
                                {{--                                {{ editor(array('title'=>'','id'=>'terms_ar','name'=>'terms_ar','class'=>'content','value'=> $terms->ar ?? '')) }}--}}
                            </div>
                        </div>


                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Contact Mail 1') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="email" name="email1" class="form-control"
                                       value="{{ $info->email1 ?? '' }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Contact Mail 2') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="email" name="email2" class="form-control"
                                       value="{{ $info->email2 ?? '' }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Contact Phone 1') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="phone1" class="form-control" value="{{ $info->phone1 ?? '' }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Contact Phone 2') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="phone2" class="form-control" value="{{ $info->phone2 ?? '' }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Country') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="country" class="form-control"
                                       value="{{ $info->country ?? '' }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Zip Code') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="number" name="zip_code" class="form-control"
                                       value="{{ $info->zip_code ?? '' }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('State') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="state" class="form-control" value="{{ $info->state ?? '' }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('city') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="city" class="form-control" value="{{ $info->city ?? '' }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('address') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="address" class="form-control"
                                       value="{{ $info->address ?? '' }}">
                            </div>
                        </div>


                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Currency Icon') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" step="any" name="currency_icon" class="form-control"
                                       value="{{ $currency_info->currency_icon ?? '' }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Currency Name') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" step="any" name="currency_name" class="form-control"
                                       value="{{ $currency_info->currency_name ?? '' }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Currency Possition') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control" name="currency_possition">
                                    <option value="left"
                                            @if($currency_info->currency_possition=='left') selected="" @endif>{{ __('Left') }}</option>
                                    <option value="right"
                                            @if($currency_info->currency_possition=='right') selected="" @endif>{{ __('Right') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Order Prefix') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="order_prefix" class="form-control"
                                       value="{{ $order_prefix->value ?? '' }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('facebook url') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="facebook" class="form-control"
                                       value="{{ $info->facebook ?? '' }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('twitter url') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="twitter" class="form-control"
                                       value="{{ $info->twitter ?? '' }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('linkedin url') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="linkedin" class="form-control"
                                       value="{{ $info->linkedin ?? '' }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('instagram url') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="instagram" class="form-control"
                                       value="{{ $info->instagram ?? '' }}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('youtube url') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="youtube" class="form-control"
                                       value="{{ $info->youtube ?? '' }}">
                            </div>
                        </div>


                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Logo') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="file" name="logo" class="form-control" accept=".png">
                                   <img src="{{ asset('uploads/logo/logo.png') }}" alt="" class="img-fluid" style="width: 205px;height: 50px;">
                      
                            </div>

                       
                         
                         
                      


                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Logo') }} {{ __('en') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="file" name="logo_en" class="form-control" accept=".png">
                                 <img src="{{ asset('uploads/logo/logo_en.png') }}" alt="" class="img-fluid" style="width: 205px;height: 50px;">
                            </div>

                               
                        </div>


                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Footer Logo') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="file" name="footer_logo" class="form-control" accept=".png">
                                 <img src="{{ asset('uploads/logo/footer_logo.png') }}" alt="" class="img-fluid" style="width: 205px;height: 50px;">
                            </div>

                               
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Footer Logo') }} {{ __('en') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="file" name="footer_logo_en" class="form-control" accept=".png">
                                 <img src="{{ asset('uploads/logo/footer_logo_en.png') }}" alt="" class="img-fluid" style="width: 205px;height: 50px;">
                            </div>
                            
                        </div>

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Favicon') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="file" name="favicon" accept=".ico" class="form-control">
                                   <img src="{{ asset('uploads/favicon/favicon.ico') }}" alt="" class="img-fluid" style="width: 205px;height: 50px;">
                            </div>
                         


                        </div>
                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Site Color') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="site_color" class="form-control colorpickerinput"
                                       value="{{ $info->site_color ?? '' }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('Automatic Order Approved After Payment Success') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control" name="auto_order">
                                    <option value="yes"
                                            @if($auto_order->value ?? '' == 'yes') selected @endif>{{ __('Yes') }}</option>
                                    <option value="no"
                                            @if($auto_order->value ?? '' == 'no') selected @endif>{{ __('No') }}</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary basicbtn" type="submit">{{ __('Save') }}</button>
                                <br>
                                <small>{{ __('Note:') }} </small> <small
                                    class="text-danger mt-4">{{ __('After You Update Settings The Action Will Work After 5 Minutes') }}</small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="{{ asset('assets/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/form.js') }}"></script>
@endpush
