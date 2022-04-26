@extends('layouts.app')
@section('head')
    @include('layouts.partials.headersection',['title'=>trans('counteries')])
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Create counteries') }}</h4>

                </div>
                <div class="card-body">

                    <form class="basicform_with_reload" action="{{ route('admin.counteries.store') }}" method="post">
                       

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
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('currency') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" required="" name="currency">
                            </div>
                        </div>

					<div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('code') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" required="" name="code">
                            </div>
                        </div>

                      <!--div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('logo') }}</label>
          <div class="col-sm-12 col-md-7">
           <input type="file" name="logo" accept="image/*" class="form-control">
          </div>
        </div -->


              
        

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
