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
@include('layouts.partials.headersection',['title'=>trans('Create tax')])
@endsection
@section('content')
 <div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>{{ __('Create tax') }}</h4>
      </div>
      <div class="card-body">
        <form class="basicform_with_reset" action="{{ route('seller.taxes.store') }}" method="post">
          @csrf
         

            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('name') }}  </label>
                <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control" required="" name="name">
                </div>
            </div>

            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('value') }}  </label>
                <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control" required="" name="value">
                </div>
            </div>

             <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('switch') }}  </label>
                <div class="col-sm-12 col-md-7">
                    <div class="switch">
                                        <label>
                                            <input name="status"  type="checkbox"  >
                                            <span class="lever switch-col-indigo"></span>
                                        </label>
                                    </div>
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
