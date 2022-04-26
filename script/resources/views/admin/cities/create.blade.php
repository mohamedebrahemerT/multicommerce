@extends('layouts.app')
@section('head')
    @include('layouts.partials.headersection',['title'=>trans('cities')])
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Create cities') }}</h4>

                </div>
                <div class="card-body">

                    <form class="basicform_with_reload" action="{{ route('admin.cities.store') }}" method="post">
                       

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Name') }} ({{ __('Arabic') }})</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" required="" name="name_ar">
                            </div>
                        </div>

                         <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Name') }} ({{ __('English') }})</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" required="" name="name_en">
                            </div>
                        </div>

                          <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('country') }}  </label>
                            <div class="col-sm-12 col-md-7">
                                {{ Form::select('country_id',App\Models\country::pluck('name_ar','id'),old('country_id'),['class'=>'form-control',"placeholder"=>"........"] )  }}
                            </div>
                        </div>
                             
 
                    


              
        

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary basicbtn" type="submit">{{ __('Save') }}</button>
                            </div>
                        </div>

                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/form.js') }}"></script>
@endpush
