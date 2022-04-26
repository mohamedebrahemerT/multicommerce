@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>trans('counteries')])
@endsection
@section('content')
<div class="row">
  <div class="col-12 mt-2">
    <div class="card">
      <div class="card-body">
        @php
        $url=my_url();
        @endphp

 @if(session()->has('success') )
<div class="alert alert-success" style="text-align: center;font-size:20px;">
  {{session('success')}}
</div>
@endif


          <form method="post" action="" class="basicform_with_reload">
            @csrf
            
              <div class="float-right mb-1">

              <a href="{{ route('admin.counteries.create') }}" class="btn btn-primary">{{ __('Create counteries') }}</a>

            </div>

          <div class="table-responsive">
            <table class="table table-striped table-hover text-center table-borderless">
              <thead>
                <tr>
                  <th><input type="checkbox" class="checkAll"></th>

             
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('currency') }}</th>

                  <th>{{ __('code') }}</th>
                  <!--th>{{ __('logo') }}</th -->
            
                  <th>{{ __('Action') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($posts as $row)
                <tr id="row{{ $row->id }}">
                  <td>
                    <input type="checkbox" name="ids[]" value="{{ base64_encode($row->id) }}"></td>

                  

                  <td>{{ $row->name_ar  }}</td>
                  <td>{{ $row->currency  }}</td>
                  <td>{{ $row->code  }}</td>


                  <!--td> <img src="{{url('/')}}/uploads/{{$row->id}}/logo_country.png" style="width: 50px;height: 50px;">   </td>
                   
                  <td -->
                    <td>
                    <a href="{{ route('admin.counteries.edit',$row->id) }}" class="btn btn-primary btn-sm text-center"><i class="far fa-edit"></i></a>

                    <a href="{{ route('admin.counteries.destroy',$row->id) }}" class="btn btn-primary btn-sm text-center"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                 <th><input type="checkbox" class="checkAll"></th>
                 
               <th>{{ __('Name') }}</th>
                  <th>{{ __('currency') }}</th>

                  <th>{{ __('code') }}</th>
                  <th>{{ __('logo') }}</th>
              
                  <th>{{ __('Action') }}</th>
               </tr>
             </tfoot>
           </table>
           {{ $posts->links('vendor.pagination.bootstrap-4') }}
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
