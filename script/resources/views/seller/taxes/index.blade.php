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



@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
    
 <script type="text/javascript">

 	   
      function update_active(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
             $.post('{{ route('seller.taxes.actived') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    console.log('daaa = '.data);
                    toastr.success("{{trans('admin.statuschanged')}}");
                }
                else{
                    toastr.error("{{trans('admin.statuschanged')}}");
                }
            });
        }
  </script>

@endpush

@section('head')
@include('layouts.partials.headersection',['title'=>trans('taxes')])
@endsection
@section('content')
<div class="row">
  <div class="col-12 mt-2">
    <div class="card">
      <div class="card-body">
          <form method="post" action="{{ route('seller.taxes.destroy') }}" class="basicform_with_reload">
            @csrf
            <div class="float-left mb-1">

              <div class="input-group">
                <select class="form-control" name="method">
                  <option value="" >{{ __('Select Action') }}</option>
                  <option value="delete" >{{ __('Delete Permanently') }}</option>

                </select>
                <div class="input-group-append">
                  <button class="btn btn-primary basicbtn" type="submit">{{__('Submit')}}</button>
                </div>
              </div>

            </div>
              <div class="float-right mb-1">

              <a href="{{ route('seller.taxes.create') }}" class="btn btn-primary">{{__('Create tax')}}</a>

            </div>

          <div class="table-responsive">
            <table class="table table-striped table-hover text-center table-borderless">
              <thead>
                <tr>
                  <th><input type="checkbox" class="checkAll"></th>

                  <th>{{ __('Name') }}</th>
                  <th>{{ __('value') }}</th>
                  <th>{{ __('switch') }}</th>

                  <th>{{ __('Date') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($taxes as $tax)
                <tr id="row{{ $tax->id }}">
                  <td><input type="checkbox" name="ids[]" value="{{ $tax->id }}"></td>

                  <td>
    @if(app()->getLocale() == 'ar')

                 {{ $tax->name}}
    @else
                                    {{ $tax->name}}


    @endif

                  </td>

                  <td>{{$tax->value}}</td>
                  <td>
                  	<div class="switch">
                                        <label>
                                            <input name="switch[]" onchange="update_active(this)" value="{{ $tax->id }}" type="checkbox" <?php if($tax->status == 1) echo "checked";?> >
                                            <span class="lever switch-col-indigo"></span>
                                        </label>
                                    </div>
                  </td>

                  <td>{{ $tax->created_at->diffforHumans()  }}</td>
                  <td>
                    <a href="{{ route('seller.taxes.edit',$tax->id) }}" class="btn btn-primary btn-sm text-center"><i class="far fa-edit"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>

           </table>
           {{ $taxes->links('vendor.pagination.bootstrap-4') }}
         </div>
       </form>
     </div>
   </div>
 </div>
</div>
@endsection
