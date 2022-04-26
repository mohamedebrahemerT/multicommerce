@extends('layouts.app')
@push('style')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet"/>
@endpush
@section('head')
    @include('layouts.partials.headersection',['title'=> trans('Edit Product')])
@endsection
@section('content')


    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="{{ route('seller.product.update',$info->id) }}" id="productform">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        @if (session()->has('flash_notification.message'))
                            <div class="alert alert-{{ session()->get('flash_notification.level') }}">
                                <button type="button" class="close text-white" data-dismiss="alert" aria-hidden="true">
                                    ×
                                </button>
                                {!! session()->get('flash_notification.message') !!}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-3">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link active"
                                           href="{{ route('seller.product.edit',$info->id) }}"><i
                                                class="fas fa-cogs"></i> {{ __('Item') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('seller/product/'.$info->id.'/price') }}"><i
                                                class="fas fa-money-bill-alt"></i> {{ __('Price') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="{{ url('seller/product/'.$info->id.'/option') }}"><i
                                                class="fas fa-tags"></i> {{ __('Options') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('seller/product/'.$info->id.'/varient') }}"><i
                                                class="fas fa-expand-arrows-alt"></i> {{ __('Variants') }}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('seller/product/'.$info->id.'/image') }}"><i
                                                class="far fa-images"></i> {{ __('Images') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                           href="{{ url('seller/product/'.$info->id.'/inventory') }}"><i
                                                class="fa fa-cubes"></i> {{ __('Inventory') }}</a>
                                    </li>

                                    <!--li class="nav-item">
                                        <a class="nav-link" href="{{ url('seller/product/'.$info->id.'/files') }}"><i
                                                class="fas fa-file"></i> {{ __('Files') }}</a>
                                    </li -->

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('seller/product/'.$info->id.'/seo') }}"><i
                                                class="fas fa-chart-line"></i> {{ __('SEO') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                           href="{{ url('seller/product/'.$info->id.'/express-checkout') }}"><i
                                                class="fas fa-cart-arrow-down"></i> {{ __('Express checkout') }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label>{{ __('Product Name') }} {{__('Arabic')}}</label>
                                    <input type="text" name="title_ar" class="form-control" required=""
                                           value="{{ $info->title_ar }}">
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Product Name') }} {{__('English')}}</label>
                                    <input type="text" name="title_en" class="form-control" required=""
                                           value="{{ $info->title_en }}">
                                </div>
                                {{--							<div class="form-group">--}}
                                {{--								<label>{{ __('Slug') }} {{__('Arabic')}}</label>--}}
                                {{--								<input type="text" name="slug_ar" class="form-control" required="" value="{{ $info->slug_ar }}">--}}
                                {{--							</div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>{{ __('Slug') }} {{__('English')}}</label>--}}
                                {{--                                <input type="text" name="slug_en" class="form-control" required="" value="{{ $info->slug_en }}">--}}
                                {{--                            </div>--}}


                                <div class="form-group">
                                    <label>{{ __('Short Description') }} {{__('Arabic')}}</label>
                                    <textarea class="form-control"
                                              name="excerpt_ar">{{ $content->excerpt->ar ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Short Description') }} {{__('English')}}</label>
                                    <textarea class="form-control"
                                              name="excerpt_en">{{ $content->excerpt->en ?? '' }}</textarea>
                                </div>
                                @if($content != null)
                                    {{ editor(array('title'=>trans('Product Content in arabic'),'name'=>'content_ar','class'=>'content','value'=> $content->content->ar ?? '')) }}
                                    {{ editor(array('title'=>trans('Product Content in english'),'name'=>'content_en','class'=>'content','value'=> $content->content->en ?? '')) }}

                                @endif
                                <div class="form-group">
                                    <label>{{ __('Brand') }}</label>
                                    <select class="form-control" name="brand">
                                        <option value="">-</option>
                                        {{ ConfigCategoryMulti('brand',$cats) }}
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Category') }}</label>
                                    <select multiple class="form-control select2" name="cats[]">
                                        <option value="">-</option>
                                        {{ ConfigCategoryMulti('category',$cats) }}
                                    </select>
                                </div>
                                @if(Auth::user()->shop_type == 4)
                                <div class="form-group">
                                    <label>{{ __('Location') }}</label>
                                    <select  class="form-control select2" name="location_id">
                                        <option value="">-</option>
                                        {{ ConfigCategoryMulti('city',$info->location_id) }}
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>{{ __('Employees') }}</label>
                                    <select multiple class="form-control select2" name="employee_id[]">
                                        <option value="">-</option>
                                        @foreach($employees as $employee)
                                         <option value="{{$employee->id}}" {{$info->employee_id && is_array(json_decode($info->employee_id)) && in_array($employee->id,json_decode($info->employee_id)) ? 'selected' : ''}}>{{$employee->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                 <div class="form-group">
                                    <label>{{ __('branche') }}</label>
                                    <select  class="form-control select2" name="branche_id">
                                        <option value="">-</option>
                                        {{ ConfigCategoryMulti('branches',$info->branche_id) }}
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Time required') }}</label>
                                    <div class="input-group">
                                        <input type="number" step="0.01" min="0" class="form-control form-control-lg" name="time_required" value="{{$info->time_required}}" required="required">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary dropdown-toggle" id="time-type-select" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $info->time_type ? __($info->time_type) : __('minutes') }}   </button>
                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(311px, 40px, 0px);">
                                                <a class="dropdown-item time_type" data-type="minutes" href="javascript:;">{{__('minutes')}}</a>
                                                <a class="dropdown-item time_type" data-type="hours" href="javascript:;">{{__('hours')}}</a>
                                                <a class="dropdown-item time_type" data-type="days" href="javascript:;">{{__('days')}}</a>
                                            </div>
                                        </div>

                                        <input type="hidden" id="time_type" name="time_type" value="{{ $info->time_type ? $info->time_type : 'minutes' }}">

                                    </div>

                                </div>
                                @endif
                       @if(Auth::user()->shop_type == 2)


                         <div class="form-group">
                            <label for="sku">{{ __('expiry_date') }}</label>
                            <input type="date" name="ExpiryDate"  value="{{ $info->ExpiryDate }}" class="form-control">
                        </div>

                @endif

                <div class="form-group">
                    
                                    <label>{{ __('taxs') }}</label>
                                    <select  class="form-control select2" name="tax_id">
                                        <option value="">-</option>
                                        @isset($autoselected)
                            @foreach($taxs as $tax)
                <option value="{{$tax->id}}"  
            @if($autoselected->id == $tax->id ) selected @endif>{{$tax->name}}</option>
                                        @endforeach
                                        @endisset
                    
                                    </select>
                                </div>


                                <div class="form-group">
                    
                                    <label>{{ __('POSBeautyType') }}</label>
                                    <select  class="form-control select2" name="POSBeautyType">
                                        <option value="">-</option>
                                       
     <option value="POSBeautyservice" @if($info->POSBeautyType == 'POSBeautyservice' ) selected @endif >{{__('POSBeautyservice')}} </option>
     <option value="POSBeautyProduct" @if($info->POSBeautyProduct == 'POSBeautyProduct' ) selected @endif  >{{__('POSBeautyProduct')}} </option>
                                        
                    
                                    </select>
                                </div>

                                  <div class="form-group">

                                    <label>
                                        <input type="checkbox" name="taxstatus" @if($info->taxstatus==1) checked=""
                                               @endif class="custom-switch-input sm" value="1">
                                        <span class="custom-switch-indicator"></span>
                                        {{ __('The price includes tax') }}
                                    </label>

                                </div>


                                <div class="form-group">
                                    <label>{{ __('Featured') }}</label>
                                    <select class="form-control" name="featured">
                                        <option value="0"
                                                @if($info->featured==0) selected="" @endif>{{ __('None') }}</option>
                                        <option value="1"
                                                @if($info->featured==1) selected="" @endif>{{ __('Trending products') }}</option>
                                        <option value="2"
                                                @if($info->featured==2) selected="" @endif>{{ __('Best selling products') }}</option>

                                    </select>
                                </div>

                                <div class="form-group">

                                    <label>
                                        <input type="checkbox" name="is_refundable"
                                               @if($info->is_refundable==1) checked=""
                                               @endif class="custom-switch-input sm" value="1">
                                        <span class="custom-switch-indicator"></span>
                                        {{ __('Allow Refund') }}
                                    </label>

                                </div>

                                <div class="form-group">

                                    <label>
                                        <input type="checkbox" name="status" @if($info->status==1) checked=""
                                               @endif class="custom-switch-input sm" value="1">
                                        <span class="custom-switch-indicator"></span>
                                        {{ __('Published') }}
                                    </label>

                                </div>



                                <div class="form-group">
                                    <button class="btn btn-primary basicbtn" type="submit">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

    </div>

    </div>
    </form>

@endsection
@push('js')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/js/form.js?v=1.0') }}"></script>

    <script>
        $('.time_type').click(function(){
            $('#time_type').val($(this).data('type')) ;
            $('#time-type-select').html($(this).html());
        })
    </script>
@endpush
