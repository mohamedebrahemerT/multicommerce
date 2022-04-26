@extends('layouts.app')
@section('head')
    @include('layouts.partials.headersection',['title'=>trans('review')])
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('review') }}</h4>

                </div>
                <div class="card-body">

                    <form class="basicform_with_reload" action="{{ route('seller.review.update',$Review->id) }}" method="Review">
                       
  @csrf
          @method('PUT')
                        <div class="form-group row mb-4">
                            <label
                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('comment') }}  </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" required="" name="comment" value="{{$Review->comment}}">
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
