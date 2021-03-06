@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
@endpush
@section('head')
@include('layouts.partials.headersection',['title'=> trans('Employee')])
@endsection
@section('content')
<div class="row">
	<div class="col-lg-9">
		<div class="card">
			<div class="card-body">
				<h4>{{ __('Edit Employee') }}</h4>
				<form method="post" action="{{ route('seller.users.update',$user->id) }}" class="basicform">
                    @csrf
                    @method('PUT')
					<div class="pt-20">
						@php
						if(app()->getLocale() == 'ar'){

                            $arr['title']= 'الاسم';
							$arr['id']= 'name';
							$arr['type']= 'text';
							$arr['placeholder']= 'الاسم';
							$arr['name']= 'name';
							$arr['is_required'] = true;
							$arr['value']=$user->name;
							echo  input($arr);

							$arr['title']= 'البريد الالكتروني';
							$arr['id']= 'email';
							$arr['type']= 'email';
							$arr['placeholder']= 'البريد الالكتروني';
							$arr['name']= 'email';
							$arr['is_required'] = true;
							$arr['value']=$user->email;
							echo  input($arr);

							$arr['title']= 'رقم الموبايل';
							$arr['id']= 'mobile';
							$arr['type']= 'text';
							$arr['placeholder']= 'رقم الموبايل';
							$arr['name']= 'mobile';
							$arr['is_required'] = true;
							$arr['value']=$user->mobile;
							echo  input($arr);
						   
							$arr['title']= 'كلمة المرور';
							$arr['id']= 'password';
							$arr['type']= 'password';
							$arr['placeholder']= 'كلمة المرور';
							$arr['name']= 'password';
							$arr['is_required'] = false;
							echo  input($arr);

							$arr['title']= 'تاكيد كلمة المرور';
							$arr['id']= 'password_confirmation';
							$arr['type']= 'password';
							$arr['placeholder']= 'تاكيد كلمة المرور';
							$arr['name']= 'password_confirmation';
							$arr['is_required'] = false;
							echo  input($arr);
                        }else{
							$arr['title']= 'Name';
                           $arr['id']= 'name';
                           $arr['type']= 'text';
                           $arr['placeholder']= 'Enter Name';
                           $arr['name']= 'name';
                           $arr['is_required'] = true;
						   $arr['value']=$user->name;
                           echo  input($arr);

                           $arr['title']= 'Email';
                           $arr['id']= 'email';
                           $arr['type']= 'email';
                           $arr['placeholder']= 'Enter Email';
                           $arr['name']= 'email';
                           $arr['is_required'] = true;
						   $arr['value']=$user->email;
                           echo  input($arr);

                           $arr['title']= 'mobile';
                           $arr['id']= 'mobile';
                           $arr['type']= 'text';
                           $arr['placeholder']= ' mobile';
                           $arr['name']= 'mobile';
                           $arr['is_required'] = true;
						   $arr['value']=$user->mobile;
                           echo  input($arr);

						    $arr['title']= 'كلمة المرور';
							$arr['id']= 'password';
							$arr['type']= 'password';
							$arr['placeholder']= 'كلمة المرور';
							$arr['name']= 'password';
							$arr['is_required'] = false;
							echo  input($arr);

							$arr['title']= 'تاكيد كلمة المرور';
							$arr['id']= 'password_confirmation';
							$arr['type']= 'password';
							$arr['placeholder']= 'تاكيد كلمة المرور';
							$arr['name']= 'password_confirmation';
							$arr['is_required'] = false;
							echo  input($arr);
                        }
                        @endphp
                          <div class="form-group">
                               <label class="control-label">{{__('Assign Roles')}}</label>

                <select name="group_id" class="form-control">
                    @foreach(App\Models\AdminGroup::where('admin_id',Auth()->user()->id)->get() as $AdminGroup)
                    <option value="{{$AdminGroup->id}}"   @if($AdminGroup->id == $user->group_id) selected="" @endif >
                      
                               {{$AdminGroup->group_name}} 
                                 
                    </option>
                    @endforeach
                    
                </select>
          </div>

						<div class="form-group">
                            <label for="services">{{ __('Services') }}</label>
                                <select  name="services[]" id="services" class="form-control w-100 select2" multiple>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}" {{ in_array( $service->id,$user->services()->pluck('terms.id')->toArray() )  ? 'selected' : '' }}>{{ $service->title }}</option>
                                    @endforeach
                                </select>
                        </div>

                          @if(Auth::user()->shop_type == 4)
<div class="form-group">
                                    <label>{{ __('branche') }}</label>
                                    <select  class="form-control select2" name="branche_id">
                                        <option value="">-</option>
                                        {{ ConfigCategoryMulti('branches',$user->branche_id) }}
                                    </select>
                                </div>
                                @endif




						<div class="form-group ">
							<label for="image">{{ __('Thumbnail') }}</label>
							<input type="file" id="image" name="file" accept="image/*" class="form-control">
							
							@if($user->image)
							<img src="{{asset($user->image)}}" alt="" width="150px" class="mt-2" >
							@endif
						</div>
						
                        <div class="form-group"> 
                        <label>{{ __('Status') }}</label>
                        <select name="status" class="form-control">
                            <option value="1" @if($user->status==1) selected @endif>Active</option>
                            <option value="0"  @if($user->status==0) selected @endif>Deactive</option>

                        </select>
                        </div>


					</div>
				</div>
			</div>

		</div>
		<div class="col-lg-3">
			<div class="single-area">
				<div class="card">
					<div class="card-body">
						<h5>{{ __('Publish') }}</h5>
						<hr>
						<div class="btn-publish">
							<button type="submit" class="btn btn-primary col-12 basicbtn"><i class="fa fa-save"></i> {{ __('Save') }}</button>
						</div>
					</div>
				</div>
			</div>

	</div>


</form>
@endsection
@push('js')
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush
