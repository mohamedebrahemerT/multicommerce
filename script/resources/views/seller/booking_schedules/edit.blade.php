@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>trans('Booking schedule')])
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>{{ __('Edit Booking schedule') }}</h4>
      </div>
      <div class="card-body">
        <form class="basicform" action="{{ route('seller.booking_schedule.update',$booking_schedule->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <h4>{{$booking_schedule->day}}</h4>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Open time') }}</label>
            <div class="col-sm-12 col-md-7">
              <input type="time" class="form-control" required="" name="open_time" value="{{ $booking_schedule->open_time }}">
            </div>
          </div>
          <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Close time') }}</label>
              <div class="col-sm-12 col-md-7">
                  <input type="time" class="form-control" required="" name="close_time" value="{{ $booking_schedule->close_time }}">
              </div>
          </div>
          <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" >{{ __('Slot duration') }}</label>
              <div class="col-sm-12 col-md-7">
                  <input type="number" min="0" step="1" class="form-control" required="" name="slot_duration" value="{{ $booking_schedule->slot_duration }}">
              </div>
              <span>{{__('minutes')}}</span>
          </div>
            
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Allow booking') }}</label>
            <div class="col-sm-12 col-md-7">
              <select class="form-control selectric" name="allow_booking">
                <option value="1" @if($booking_schedule->allow_booking==1) selected="" @endif>{{ __('Yes') }}</option>
                <option value="0"  @if($booking_schedule->allow_booking==0) selected="" @endif>{{ __('No') }}</option>

              </select>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Allow multiple booking') }}</label>
            <div class="col-sm-12 col-md-7">
              <select class="form-control selectric" name="allow_multiple_booking">
                <option value="1" @if($booking_schedule->allow_multiple_booking==1) selected="" @endif>{{ __('Yes') }}</option>
                <option value="0"  @if($booking_schedule->allow_multiple_booking==0) selected="" @endif>{{ __('No') }}</option>
              </select>
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Maximum Number of Booking Allowed') }} </label>
            <div class="col-sm-12 col-md-7">
              <input type="number" min="0" step="1" class="form-control" required="" name="max_booking_allowed" value="{{ $booking_schedule->max_booking_allowed }}">
              <span style="color:blue">{{__('Set 0 for unlimited number of bookings')}}</span> 
            </div>
          </div>
       
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}</label>
            <div class="col-sm-12 col-md-7">
              <select class="form-control selectric" name="status">
                <option value="1" @if($booking_schedule->status==1) selected="" @endif>{{ __('Active') }}</option>
                <option value="0"  @if($booking_schedule->status==0) selected="" @endif>{{ __('Deactivate') }}</option>
              </select>
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
