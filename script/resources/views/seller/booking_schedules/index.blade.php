@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>trans('Booking schedule')])
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>{{ __('Booking options') }}</h4>
      </div>
      <div class="card-body">
        <form class="basicform" action="{{ route('seller.booking_options.update',$booking_options->id) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row">

            <div class="form-group col-md-6 col-12 row mb-4 align-self-start">
              <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12" >{{ __('Multi-Tasking Employee') }}</label>
              <span>{{__('Assign employee to more than one task at a time')}}</span>
              <div class="col-sm-12 col-md-12">
                  <label>
                      <input type="checkbox" name="multy_tasking_employee" @if($booking_options->multy_tasking_employee==1) checked=""
                              @endif class="custom-switch-input sm" value="1">
                      <span class="custom-switch-indicator"></span>
                      
                  </label>
              </div>
            </div>
            <div class="form-group col-md-6 col-12 row mb-4 align-self-start">
              <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12" >{{ __('Limit Booking') }}</label>
              <span>{{__('Maximum number of bookings for per customer per day (0 for unlimited)')}}</span>
              <div class="col-sm-12 col-md-12">
                    <input type="number" min="0" step="1" class="form-control" required="" name="limit_booking" value="{{ $booking_options->limit_booking }}">
              </div>
            </div>
            <div class="form-group col-md-6 col-12 row mb-4 align-self-start">
              <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12" >{{ __('Allow Employee Selection') }}</label>
              <span>{{__('Allow employee selection to customers while booking')}}</span>
              <div class="col-sm-12 col-md-12">
                  <label>
                      <input type="checkbox" name="allow_employee_selection" @if($booking_options->allow_employee_selection==1) checked=""
                              @endif class="custom-switch-input sm" value="1">
                      <span class="custom-switch-indicator"></span>
                      
                  </label>
              </div>
            </div>

            <div class="form-group col-md-6 col-12 row mb-4 align-self-start">
              <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12" >{{ __('Disable Slot Duration As Per Service Duration') }}</label>
              <span>{{__('Booking time will be calculated based on selected service')}}</span>
              <div class="col-sm-12 col-md-12">
                  <label>
                      <input type="checkbox" id="disable_slot_duration" name="disable_slot_duration" @if($booking_options->disable_slot_duration==1) checked=""
                              @endif class="custom-switch-input sm" value="1">
                      <span class="custom-switch-indicator"></span>
                      
                  </label>
              </div>
              <div class="col-sm-12 col-md-12  row form-group disable_slot_duration_values d-none">
                <div class="custom-control custom-radio mx-2">
									<input id="sum" name="disable_slot_duration_values" value="sum" type="radio" class="custom-control-input"  @if($booking_options->disable_slot_duration_values=='sum') checked
                              @endif  required>
									<label class="custom-control-label" for="sum">{{ __('sum') }}</label>
								</div>
                <div class="custom-control custom-radio mx-2">
                  <input id="avg" name="disable_slot_duration_values" value="avg" type="radio" class="custom-control-input"  @if($booking_options->disable_slot_duration_values=='avg') checked
                              @endif  required>
                  <label class="custom-control-label" for="avg">{{ __('avg') }}</label>
                </div>
        
                <div class="custom-control custom-radio mx-2">
                    <input id="min" name="disable_slot_duration_values" value="min" type="radio" class="custom-control-input"  @if($booking_options->disable_slot_duration_values=='min') checked
                                @endif  required>
                    <label class="custom-control-label" for="min">{{ __('min') }}</label>
                </div>
                <div class="custom-control custom-radio mx-2">
                    <input id="max" name="disable_slot_duration_values" value="max" type="radio" class="custom-control-input"  @if($booking_options->disable_slot_duration_values=='max') checked
                                @endif  required>
                    <label class="custom-control-label" for="max">{{ __('max') }}</label>
                </div>
                <div class="col-12 alert alert-info" role="alert" id="info-msg">
                  Sum of duration of all selected service will be count as booking time...!
                </div>
                <div class="col-12 alert alert-warning" role="alert">
                  All payment methods will disabled from front end payment page.
                </div>
							</div>
            </div>

          </div>
          

          <div class="form-group row col-12  mb-4">
            <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12"></label>
            <div class="col-sm-12 col-md-7">
              <button class="btn btn-primary basicbtn" type="submit">{{ __('Update') }}</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 mt-2">
    <div class="card">
      <div class="card-body">
        @php
        $url=my_url();
        @endphp
 
          <h3>{{__('Booking schedule')}}</h3>
          <div class="table-responsive">
            <table class="table table-striped table-hover text-center table-borderless">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{ __('Day') }}</th>
                  <th>{{ __('Open time') }}</th>
                  <th>{{ __('Close time') }}</th>
                  <th>{{ __('Allow booking?') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($booking_schedules as $key => $row)
                <tr id="row{{ $row->id }}">
                  <td>{{$key +1 }}</td>
                  <td>{{ $row->day  }}</td>
                  <td>{{ $row->open_time  }}</td>
                  <td>{{ $row->close_time  }}</td>
                  <td>@if($row->allow_booking==1) <span class="badge badge-success  badge-sm">{{__('Yes')}}</span> @else <span class="badge badge-danger  badge-sm">{{__('No')}}</span> @endif</td>
                  
                  <td>
                    <a href="{{ route('seller.booking_schedule.edit',$row->id) }}" class="btn btn-primary btn-sm text-center"><i class="far fa-edit"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>#</th>
                  <th>{{ __('Day') }}</th>
                  <th>{{ __('Open time') }}</th>
                  <th>{{ __('Close time') }}</th>
                  <th>{{ __('Allow booking?') }}</th>
                  <th>{{ __('Action') }}</th>
               </tr>
             </tfoot>
           </table>
            
         </div>
       
     </div>
   </div>
 </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
<script>

  if ($('#disable_slot_duration').is(':checked')) {
    $('.disable_slot_duration_values').removeClass('d-none') ;
  }else{
    $('.disable_slot_duration_values').addClass('d-none') ;
  }
  $('#disable_slot_duration').change(function(){
    if ($(this).is(':checked')) {
      $('.disable_slot_duration_values').removeClass('d-none') ;
    }else{
      $('.disable_slot_duration_values').addClass('d-none') ;
    }
     
  })
</script>
@endpush
