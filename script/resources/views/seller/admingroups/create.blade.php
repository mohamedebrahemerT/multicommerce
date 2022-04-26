@extends('layouts.app')
@section('head')
    @include('layouts.partials.headersection',['title'=>__('Admin Group')])
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Create Admin Group') }}</h4>

                </div>
                <div class="card-body">
{!! Form::open(['url'=>url('/seller/StoreGroup'),'id'=>'admingroups','files'=>true,'class'=>'form-horizontal form-row-seperated']) !!}
    <div class="row">
      <div class="form-group col-md-12">
        {!! Form::label('group_name',__('group name'),['class'=>'control-label']) !!}
        {!! Form::text('group_name',old('group_name'),['class'=>'form-control','placeholder'=>__('group name')]) !!}
      </div>
      <div class="col-md-12 col-lg-12">
        <table class="table table-striped table-hover  ">
          <thead>
            <tr>
              <th>{{__('name')}}</th>
              <th>{{__('show')}}</th>
              <th>{{__('create')}}</th>
              <th>{{__('edit')}}</th>
              <th>{{__('delete')}}</th>
            </tr>
          </thead>
          <tbody>
            
            @foreach(require app_path('Http/StoreRouteList.php') as $key=> $value)
            <tr>
              <td>{{ !is_array($value)?__($value):__($key) }}</td>
              <td>
                @if(!is_array($value) || is_array($value) && in_array('read',$value))
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input
                    type="checkbox"
                    class="custom-control-input checkinput {{ $key }}_show"
                    permission_name="{{ $key }}"
                    name="{{ $key }}_show"
                    {{old($key.'_show') == 'yes'?'checked':'' }}
                    value="yes"
                    id="{{ $key }}_show">
                    <label class="custom-control-label" for="{{ $key }}_show"></label>
                  </div>
                </div>
                @endif
              </td>
              <td>
                @if(!is_array($value) || is_array($value) && in_array('create',$value))
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input
                    type="checkbox"
                    class="custom-control-input checkinput {{ $key }}_add"
                    permission_name="{{ $key }}"
                    name="{{ $key }}_add"
                    {{old($key.'_add') == 'yes'?'checked':'' }}
                    value="yes"
                    id="{{ $key }}_add">
                    <label class="custom-control-label" for="{{ $key }}_add"></label>
                  </div>
                </div>
                @endif
              </td>
              <td>
                @if(!is_array($value) || is_array($value) && in_array('update',$value))
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input
                    type="checkbox"
                    class="custom-control-input checkinput {{ $key }}_edit"
                    permission_name="{{ $key }}"
                    name="{{ $key }}_edit"
                    {{old($key.'_edit') == 'yes'?'checked':'' }}
                    value="yes"
                    id="{{ $key }}_edit">
                    <label class="custom-control-label" for="{{ $key }}_edit"></label>
                  </div>
                </div>
                @endif
              </td>
              <td>
                @if(!is_array($value) || is_array($value) && in_array('delete',$value))
                <div class="form-group">
                  <div class="custom-control custom-switch">
                    <input
                    type="checkbox"
                    class="custom-control-input checkinput {{ $key }}_delete"
                    permission_name="{{ $key }}"
                    name="{{ $key }}_delete"
                    {{old($key.'_delete') == 'yes'?'checked':'' }}
                    value="yes"
                    id="{{ $key }}_delete">
                    <label class="custom-control-label" for="{{ $key }}_delete"></label>
                  </div>
                </div>
                @endif
              </td>
            </tr>
            @endforeach

           
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.row -->

    <!-- /.card-body -->
  <div class="card-footer">
    {!! Form::submit(__('save'),['class'=>'btn btn-success btn-flat']) !!}
    {!! Form::close() !!}
  </div>
  
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/form.js') }}"></script>

    <script type="text/javascript">
$(document).ready(function(){
$(document).on('click','.checkinput',function(){
  var permission_name = $(this).attr('permission_name');
  if($('.'+permission_name+'_validation').prop("checked") &&
  $(this).hasClass(permission_name+'_validation')){
    $('.'+permission_name+'_show').prop('checked',true);
    $('.'+permission_name+'_add').prop('checked',true);
    $('.'+permission_name+'_edit').prop('checked',true);
    $('.'+permission_name+'_delete').prop('checked',true);
  }else if(
    !$('.'+permission_name+'_validation').prop("checked") &&
    $(this).hasClass(permission_name+'_validation')){
    $('.'+permission_name+'_show').prop('checked',false);
    $('.'+permission_name+'_add').prop('checked',false);
    $('.'+permission_name+'_edit').prop('checked',false);
    $('.'+permission_name+'_delete').prop('checked',false);
  }else if(!$(this).hasClass(permission_name+'_show') && !$(this).hasClass(permission_name+'_show') && $(this).prop("checked")){
  $('.'+permission_name+'_show').prop('checked',true);
  }else if(
    !$('.'+permission_name+'_add').prop("checked") &&
    !$('.'+permission_name+'_edit').prop("checked") &&
    !$('.'+permission_name+'_delete').prop("checked") &&
    !$('.'+permission_name+'_validation').prop("checked") &&
    !$(this).hasClass(permission_name+'_show')){
    $('.'+permission_name+'_show').prop('checked',false);
  }
});
});
</script>
@endpush



  
