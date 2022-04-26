@extends('layouts.app')
@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-colorpicker.min.css') }}">
@endpush
@section('head')
    @include('layouts.partials.headersection',['title'=>trans('Cpanel Credentials')])
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Cpanel Credentials') }}</h4><br>

                </div>
                <div class="card-body">
                    <form class="basicform" action="{{ route('admin.CpanelCredentials.update') }}" method="post">
                        @csrf

                   

                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('domain1') }}  </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="domain" class="form-control"
                                       value="{{ $info->domain ?? '' }}">
                            </div>
                        </div>

                         <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('url') }}  </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="url" class="form-control"
                                       value="{{ $info->url ?? '' }}">
                            </div>
                        </div>

                         <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('username') }}  </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="username" class="form-control"
                                       value="{{ $info->username ?? '' }}">
                            </div>
                        </div>

                         <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('password') }}  </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="password" class="form-control"
                                       value="{{ $info->password ?? '' }}">
                            </div>
                        </div>

                         <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> {{ __('port') }}  </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" name="port" class="form-control"
                                       value="{{ $info->port ?? '' }}">
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
