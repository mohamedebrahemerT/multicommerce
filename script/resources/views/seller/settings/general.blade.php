@extends('layouts.app')
@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-colorpicker.min.css') }}">
<link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />

<style type="text/css">
    

/* Switch
   ========================================================================== */
.switch,
.switch * {
  -webkit-user-select: none;
  -moz-user-select: none;
  -khtml-user-select: none;
  -ms-user-select: none; }

.switch label {
  cursor: pointer; }

.switch label input[type=checkbox] {
  opacity: 0;
  width: 0;
  height: 0; }

.switch label input[type=checkbox]:checked + .lever {
  background-color: #84c7c1; }

.switch label input[type=checkbox]:checked + .lever:after {
  background-color: #26a69a;
  left: 24px; }

.switch label .lever {
  content: "";
  display: inline-block;
  position: relative;
  width: 40px;
  height: 15px;
  background-color: #818181;
  border-radius: 15px;
  margin-right: 10px;
  -webkit-transition: background 0.3s ease;
  -o-transition: background 0.3s ease;
  transition: background 0.3s ease;
  vertical-align: middle;
  margin: 0 16px; }

.switch label .lever:after {
  content: "";
  position: absolute;
  display: inline-block;
  width: 21px;
  height: 21px;
  background-color: #F1F1F1;
  border-radius: 21px;
  -webkit-box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.4);
  box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.4);
  left: -5px;
  top: -3px;
  -webkit-transition: left 0.3s ease, background .3s ease, -webkit-box-shadow 0.1s ease;
  transition: left 0.3s ease, background .3s ease, -webkit-box-shadow 0.1s ease;
  -o-transition: left 0.3s ease, background .3s ease, box-shadow 0.1s ease;
  transition: left 0.3s ease, background .3s ease, box-shadow 0.1s ease;
  transition: left 0.3s ease, background .3s ease, box-shadow 0.1s ease, -webkit-box-shadow 0.1s ease; }

input[type=checkbox]:checked:not(:disabled) ~ .lever:active::after,
input[type=checkbox]:checked:not(:disabled).tabbed:focus ~ .lever::after {
  -webkit-box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.4), 0 0 0 15px rgba(38, 166, 154, 0.1);
  box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.4), 0 0 0 15px rgba(38, 166, 154, 0.1); }

input[type=checkbox]:not(:disabled) ~ .lever:active:after,
input[type=checkbox]:not(:disabled).tabbed:focus ~ .lever::after {
  -webkit-box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.4), 0 0 0 15px rgba(0, 0, 0, 0.08);
  box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.4), 0 0 0 15px rgba(0, 0, 0, 0.08); }

.switch input[type=checkbox][disabled] + .lever {
  cursor: default; }

.switch label input[type=checkbox][disabled] + .lever:after,
.switch label input[type=checkbox][disabled]:checked + .lever:after {
  background-color: #BDBDBD; }

</style>
@endpush
@section('head')
@include('layouts.partials.headersection',['title'=>trans('Shop Settings')])
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>{{ __('Settings') }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
              <div class="col-12 col-sm-12 col-md-4">
                <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active show" id="home-tab4" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="true">{{__('General')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="false">{{__('Location')}}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact" aria-selected="false">{{__('Others')}}</a>
                </li>
            </ul>
        </div>
        <div class="col-12 col-sm-12 col-md-8">
            <div class="tab-content no-padding" id="myTab2Content">
              <div class="tab-pane fade active show" id="home4" role="tabpanel" aria-labelledby="home-tab4">
                 <form method="post" action="{{ route('seller.settings.store') }}" class="basicform">
                     @csrf
                     <input type="hidden" name="type" value="general">
                     <div class="form-group">
                         <label>{{__('Store Name en')}}</label>
                         <input type="text" name="shop_name" class="form-control" required="" value="{{ $shop_name->value ?? '' }}">
                     </div>

                      <div class="form-group">
                         <label>{{__('Store Name ar')}}</label>
                         <input type="text" name="shop_name_ar" class="form-control" required="" value="{{ $shop_name_ar->value ?? '' }}">
                     </div>

                     <div class="form-group">
                         <label>{{__('Store Description en')}}</label>
                         <textarea class="form-control" required="" name="shop_description">{{ $shop_description->value ?? '' }}</textarea>
                     </div>

                     <div class="form-group">
                         <label>{{__('Store Description ar')}}</label>
                         <textarea class="form-control" required="" name="shop_description_ar">{{ $shop_description_ar->value ?? '' }}</textarea>
                     </div>


 @php
  $user_id = domain_info('user_id');
 @endphp
                                    
 

                        <div class="form-group">
                         <label>{{__('about_ar')}}</label>
                         <textarea class="form-control about_ar" required="" name="about_ar" id="editor">
                             
                        </textarea>
                     </div>

                       <div class="form-group">
                         <label>{{__('about_en')}}</label>
                         <textarea class="form-control about_en" required="" name="about_en" id="editor2">  </textarea>
                     </div>


                    <div class="form-group">
                         <label>{{__('about_photo')}}</label>
                         <input type="file" name="about_photo" accept="image/*" class="form-control">
                    </div>

                     @php
  $user_id = domain_info('user_id');
if(App\Useroption::where('user_id',$user_id)->where('key','google_map_link')->first())
{ 
              $google_map_link= App\Useroption::where('user_id',$user_id)->where('key','google_map_link')->first()->value;
}
@endphp

                    <div class="form-group">
                         <label>{{__('google_map_link')}}</label>
                         <input type="text" name="google_map_link" class="form-control" required="" 
                         value="@isset($google_map_link){{$google_map_link}}@endisset">
                     </div>

                        <div class="form-group">
                         <label>{{__('Terms_and_Conditions_ar')}}</label>
                         <textarea class="form-control" required="" name="Terms_and_Conditions_ar" id="editor3">
                                  

          
                        </textarea>
                     </div>

                       <div class="form-group">
                         <label>{{__('Terms_and_Conditions_en')}}</label>
                         <textarea class="form-control" required="" name="Terms_and_Conditions_en" id="editor4">
                             @if(App\Useroption::where('user_id',$user_id)->where('key','Terms_and_Conditions_en')->first())                          
 {!! App\Useroption::where('user_id',$user_id)->where('key','Terms_and_Conditions_en')->first()->value !!}
            @endif
                         </textarea>
                     </div>

                       <div class="form-group">
                         <label>{{__('Goods_Return_Policy_ar')}}</label>
                         <textarea class="form-control" required="" name="Goods_Return_Policy_ar" id="editor5">
 
                         </textarea>
                     </div>

                       <div class="form-group">
                         <label>{{__('Goods_Return_Policy_en')}}</label>
                         <textarea class="form-control" required="" name="Goods_Return_Policy_en" id="editor6">
                               
                         </textarea>
                     </div>

                     <!--div class="form-group">
                         <label>{{__('Notification & Reply-to Email')}}</label>
                         <input type="email" name="store_email" class="form-control" required="" placeholder="reply@example.com" value="{{ $store_email->value ?? '' }}" >
                     </div -->

                     <div class="form-group">
                         <label>{{__('Order ID Format (Prefix)')}}</label>
                         <input type="text" name="order_prefix" class="form-control" required="" placeholder="#ABC" value="{{ $order_prefix->value ?? ''  }}">
                     </div>
                     <div class="form-group">
                         <label>{{__('Currency Position')}}</label>
                         <select class="form-control" name="currency_position">
                            @if(!empty($currency))
                             <option value="left" @if($currency->currency_position  == 'left') selected="" @endif>{{__('Left')}}</option>
                             <option value="right" @if($currency->currency_position  == 'right') selected="" @endif>{{__('Right')}}</option>
                             @else
                             <option value="left" >{{__('Left')}}</option>
                             <option value="right" >{{__('Right')}}</option>
                             @endif
                         </select>
                     </div>

                     <div class="form-group">
                         <label>{{__('Currency Name en')}}</label>
                         <input type="text" name="currency_name" class="form-control" required="" placeholder="USD" value="{{ $currency->currency_name ?? '' }}">
                     </div>

                      <div class="form-group">
                         <label>{{__('Currency Name ar')}}</label>
                         <input type="text" name="currency_name_ar" class="form-control" required="" placeholder="USD" value="{{ $currency->currency_name_ar ?? '' }}">
                     </div>

                     <div class="form-group">
                         <label>{{__('Currency Icon en')}}</label>
                         <input type="text" name="currency_icon" class="form-control" required="" placeholder="$" value="{{ $currency->currency_icon ?? '' }}">
                     </div>

                      <div class="form-group">
                         <label>{{__('Currency Icon ar')}}</label>
                         <input type="text" name="currency_icon_ar" class="form-control" required="" placeholder="$" value="{{ $currency->currency_icon_ar ?? '' }}">
                     </div>

                     

                    

                     <div class="form-group">
                        <label>{{ __('I will sale (shop type)') }}</label>
                        @php
                        $shop_type=domain_info('shop_type');
                        @endphp
                       <select class="form-control" name="shop_type">
                           <option value="1" @if($shop_type == 1) selected="selected" @endif>{{ __('I will sale physical products') }}</option>
                           <option value="0" @if($shop_type == 0) selected="selected" @endif>{{ __('I will sale digital products') }}</option>
                       </select>
                     </div>

                      <!--div class="form-group">
                         <label>{{__('Languages')}}</label>

                         <select class="form-control select2 col-sm-12" name="lanugage[]" multiple="">
                            @foreach($langlist ?? [] as $key => $row)

                             <option value="{{ $row }},{{ $key }}" @if(in_array($row, $my_languages)) selected="" @endif>{{ $key }}</option>
                             @endforeach
                         </select>
                      </div -->
                       <div class="form-group">
                         <label>{{__('Default Language')}}</label>

                 <select class="form-control col-sm-12" name="local">
                            @foreach($langlist ?? [] as $key => $row)

                             <option value="{{ $key }}" @if($row == $local) selected="" @endif>{{ $row }}</option>
                             @endforeach
                         </select>
                      </div>


                       




                       <div class="div_inpute col-sm-12 col-sm-12 col-md-12 col-lg-12">
                        <label>{{__('taxes')}}</label>
            @foreach($taxs as  $tax)
         <div>
            <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12">
               {!! Form::label('name',__('name')) !!}
            {!! Form::text('name[]',$tax->name,['class'=>'form-control']) !!}

         </div>

         <div class="col-sm-12 col-sm-12 col-md-12 col-lg-12">
               {!! Form::label('value',__('value')) !!}
            {!! Form::text('value[]',$tax->value,['class'=>'form-control']) !!}
            
         </div>

          



         <div class="clearfix"> </div>
                <br>
           <a href="#" class="remove_inpute btn btn-danger"><i class="fa fa-trash"> </i> </a>
           <div class="clearfix"> </div>
                <br>
         </div>
            
            @endforeach
         </div>

           <a href="#" class="add_inpute btn btn-info"><i class="fa fa-plus"> </i> </a>
                <div class="clearfix"> </div>
                <br>


                     <div class="form-group">
                         <button class="btn btn-primary  col-3 basicbtn" type="submit">{{__('Save')}}</button>
                     </div>
                 </form>

             </div>
             <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
                <form method="post" action="{{ route('seller.settings.store') }}" class="basicform">
                    @csrf
                    <input type="hidden" name="type" value="location">
                <!--div class="form-group">
                    <label>{{__('Company')}}</label>
                    <input class="form-control" name="company_name" value="{{ $location->company_name ?? '' }}" type="text" value=""  >
                </div -->
                <div class="form-group">
                    <label>{{__('Address en')}}</label>
                    <input class="form-control" name="address" value="{{ $location->address ?? '' }}" type="text" value="" required="">
                </div>

                <div class="form-group">
                    <label>{{__('Address ar')}}</label>
                    <input class="form-control" name="address_ar" value="{{ $location->address_ar ?? '' }}" type="text" value="" required="">
                </div>

                <!--div class="form-group">
                    <label>{{__('City')}}</label>
                    <input class="form-control" name="city" value="{{ $location->city ?? '' }}" type="text" value="" required="">
                </div -->
                <div class="form-row">
                    <!--div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>{{__('State')}}</label>
                            <input class="form-control" name="state" value="{{ $location->state ?? '' }}" type="text" required="">
                        </div>
                    </div -->
                    <!--div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>{{__('Postal / Zip Code')}}</label>
                            <input class="form-control" name="zip_code" value="{{ $location->zip_code ?? '' }}" type="text" required="" placeholder="1234">
                        </div>
                    </div -->
                </div>
                <hr>
                <div class="form-group">
                    <label>{{__('Email en')}}</label>
                    <input class="form-control" name="email" type="email" value="{{ $location->email ?? '' }}" value="" required="">
                </div>

                 <div class="form-group">
                    <label>{{__('Email ar')}}</label>
                    <input class="form-control" name="email_ar" type="email" value="{{ $location->email_ar ?? '' }}" value="" required="">
                </div>

                <div class="form-group">
                    <label>{{__('Phone')}}</label>
                    <input class="form-control" name="phone" type="number" value="{{ $location->phone ?? '' }}" value="" required="">
                </div>
                <!--div class="form-group">
                    <label>{{__('Invoice Description')}}</label>
                    <textarea class="form-control" name="invoice_description">{{  $location->invoice_description ?? '' }}</textarea>
                </div -->
                <div class="form-group">
                         <button class="btn btn-primary float-right col-3 basicbtn" type="submit">{{__('Save')}}</button>
                     </div>
                 </form>
            </div>
            <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
                <form method="post" action="{{ route('seller.settings.store') }}" class="basicform" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="theme_settings">
                   @csrf
                    <div class="form-group">
                         <label>{{__('Theme Color nav')}}</label>
                         <input type="text" name="theme_color" class="form-control rgcolorpicker" required="" value="{{ $theme_color->value ?? '' }}">
                    </div>

                    <div class="form-group">
                         <label>{{__('Theme Color menue')}}</label>
                         <input type="text" name="theme_color_menue" class="form-control rgcolorpicker" required="" value="{{ $theme_color_menue->value ?? '' }}">
                    </div>

                       <div class="form-group">
                         <label>{{__('Theme Color Available_Offer')}}</label>
                         <input type="text" name="Available_Offer" class="form-control rgcolorpicker" required="" value="{{ $Available_Offer->value ?? '' }}">
                    </div>

                     <div class="form-group">
                         <label>{{__('Theme Color before_footer')}}</label>
                         <input type="text" name="before_footer" class="form-control rgcolorpicker" required="" value="{{ $before_footer->value ?? '' }}">
                    </div>

                      <div class="form-group">
                         <label>{{__('Theme Color footer')}}</label>
                         <input type="text" name="footer" class="form-control rgcolorpicker" required="" value="{{ $footer->value ?? '' }}">
                    </div>


                    <div class="form-group">
                         <label>{{__('Logo')}}</label>

             {{ __('width:141px,height:49px') }} {{ __('logo_header') }} 
                         <input type="file" name="logo" accept="image/*" class="form-control">
                    </div>

                      <div class="form-group">
                         <label>{{__('Logo')}}</label>

                          {{ __('width:141px,height:49px') }} {{ __('footer') }}   {{ __('logo_footer') }} 
                         <input type="file" name="logo_footer" accept="image/*" class="form-control">
                    </div>
                    <div class="form-group">
                         <label>{{__('Favicon')}}</label>
                          {{ __('width:48px,height:48px') }}favicon
                         <input type="file" name="favicon" accept="image/*" class="form-control">
                    </div>

                    <label>{{__('Social Links')}}</label>
                <table class="table table-bordered table-striped" id="user_table">
                 <thead>
                    <tr>
                        <th width="35%">{{__('Url')}}</th>
                        <th width="35%">{{__('Icon Class')}} (<a href="https://fontawesome.com/" target="_blank">{{__('fontawesome')}}</a>)</th>
                        <th width="30%"><button  type="button" name="add" id="add" class="btn btn-success btn-sm">{{__('Add New')}}</button></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($socials ?? [] as $key => $row)

                    <tr>
                        <td><input type="text" name="url[]" class="form-control" required value="{{ $row->url }}" /></td>
                        <td><input type="text" name="icon[]" class="form-control" placeholder="fa fa-facebook" required value="{{ $row->icon }}" /></td>
                        <td><button type="button" name="remove" id="" class="btn btn-danger remove">{{__('Remove')}}</button></td>
                    </tr>

                    @endforeach

                </tbody>

            </table>
                    <div class="form-group">
                         <button class="btn btn-primary float-right col-3 basicbtn" type="submit">{{__('Save')}}</button>
                     </div>
               </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

@endsection
@push('js')
 
   @push('js')
         <script type="text/javascript">
            var x=1;
            $(document).on('click','.add_inpute',function(){

                var max_inpute=10;
                
                if (x < max_inpute) 
                {
                    //$('.div_inpute').append('<h1>test</h1>');

                    $('.div_inpute').append('<div>'+
            '<div class="col-sm-12 col-sm-12 col-md-12 col-lg-12">'+
               '{!! Form::label('name',__('name')) !!}'+
            '{!! Form::text('name[]','',['class'=>'form-control']) !!}'+

         '</div>'+

         '<div class="col-sm-12 col-sm-12 col-md-12 col-lg-12">'+
              ' {!! Form::label('value',__('value')) !!} '+
          '{!! Form::text('value[]','',['class'=>'form-control']) !!}'+
            
         '</div>'+

         


         '<div class="clearfix"> </div>'+
                '<br>'+
           '<a href="#" class="remove_inpute btn btn-danger"><i class="fa fa-trash"> </i>'+ '</a>'+
           '<div class="clearfix"> </div>'+
                '<br>'+
         '</div>');
                    x+=1;
         
                    return false;
                }
            });

            $(document).on('click','.remove_inpute',function(){

                $(this).parent('div').remove();
                x-=1;
                return false;
            });
         </script>



         <script type="text/javascript">
      function update_active(el){
            if(el.checked){
                var status = 'active';
            }
            else{
                var status = 'unactive';
            }
            $.post('url('cities/actived')', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    console.log('daaa = '.data);
                    toastr.success("{{trans('admin.statuschanged')}}");
                }
                else{
                    toastr.error("{{trans('admin.statuschanged')}}");
                }
            });
        }
  </script>
         @endpush
  


<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/form.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/js/color.js') }}"></script>
@endpush
