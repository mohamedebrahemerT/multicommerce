@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>trans('Admin Groups')])
@endsection
@section('content')
<div class="card"  >
    <div class="card-body">
        <div class="row mb-30">
            <div class="col-lg-6">
                <h4>{{ __('Admin Groups') }}</h4>
            </div>
            <div class="col-lg-6">
 <div class="table-toolbar">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="btn-group">
                                                        <a href="{{url('/')}}/admin/AdminGroup/create" id="sample_editable_1_new" class="btn sbold green"> {{__('Add New')}}
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
            </div>
        </div>
        <br>
        
            <div class="table-responsive custom-table">
                <table class="table">
                    <thead>
                        <tr>
                             
                            <th>{{ __('Admin Group') }}</th>
                            <th>{{ __('opration') }}</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                                                @foreach($AdminGroups as $AdminGroup)
                         
                        <tr>
                            
                            <td>
                              {{$AdminGroup->group_name}} 
                            </td>
                            <td>
<div class="dropdown d-inline">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton2" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    {{ __('Action') }}
                                                </button>
                                 <div class="dropdown-menu">

    
                  <a class="dropdown-item has-icon"   href="{{url('/')}}/admin/AdminGroup/{{$AdminGroup->id}}/edit"><i
                                                                class="far fa-edit"></i> {{ __('Edit') }}</a>


                  <a class="dropdown-item has-icon"   href="{{url('/')}}/AdminGroup/{{$AdminGroup->id}}/destroy"><i
                                                                class="far fa-edit"></i> {{ __('delete') }}</a>
                                                 
                                                </div>
                                                </div>
                                

                                
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </form>

            </table>


        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('admin/js/form.js') }}"></script>
@endsection



 