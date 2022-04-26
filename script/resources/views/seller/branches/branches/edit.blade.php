@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>trans('Edit Location')])
@endsection
@section('content')
 <div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>{{ __('Edit Location') }}</h4>
      </div>
      <div class="card-body">
        <form class="basicform" action="{{ route('seller.branches.update',$info->id) }}" method="post">
          @csrf
          @method('PUT')
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Title') }}({{ __('Arabic') }})</label>
          <div class="col-sm-12 col-md-7">
            <input type="text" class="form-control" required="" name="title_ar" value="{{ $info->name_ar }}">
          </div>
        </div>
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Title') }}({{ __('English') }})</label>
                <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control" required="" name="title_en" value="{{ $info->name_en }}">
                </div>
            </div>

        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
          <div class="col-sm-12 col-md-7">
            <button class="btn btn-primary basicbtn" type="submit">{{ __('Update') }}</button>
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