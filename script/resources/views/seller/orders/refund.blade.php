@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-sm-10">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link @if(url()->current() == route('seller.refund.status','all')) active @endif"
                                       href="{{ route('seller.refund.status','all') }}">{{ __('All') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if($type == 'pending') active @endif"
                                       href="{{ route('seller.refund.status','pending') }}">{{ __('Pending') }}
                                        <span class="badge badge-secondary">{{ $pendings }}</span></a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link @if($type == 'rejected') active @endif"
                                       href="{{ route('seller.refund.status','rejected') }}">{{ __('Rejected') }} <span
                                            class="badge badge-secondary">{{ $rejected }}</span></a>
                                </li>
                                <li class="nav-item">
                                <li class="nav-item">
                                    <a class="nav-link @if($type == 'completed') active @endif"
                                       href="{{ route('seller.refund.status','completed') }}">{{ __('Completed') }}
                                        <span class="badge badge-secondary">{{ $completed }}</span></a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Refund Orders') }}</h4>
                        <form class="card-header-form">
                            <div class="input-group">
                                <input type="text" name="src" value="{{ $request->src ?? '' }}" class="form-control"
                                       required="" placeholder="ABC-123"/>
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary btn-icon"><i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="float-right">
                            @if(count($request->all()) > 0)
                                {{ $orders->appends($request->all())->links('vendor.pagination.bootstrap-4') }}
                            @else
                                {{ $orders->links('vendor.pagination.bootstrap-4') }}
                            @endif
                        </div>


                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap card-table text-center">
                                <thead>
                                <tr>
                                    <th class="text-left">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input checkAll"
                                                   id="selectAll">
                                            <label class="custom-control-label checkAll" for="selectAll"></label>
                                        </div>
                                    </th>
                                    <th class="text-left">{{ __('Order') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Customer') }}</th>
                                    <th class="text-right">{{ __('Order total') }}</th>
                                    <th>{{ __('Refund status changed') }}</th>
                                    <th>{{ __('Fully Refund') }}</th>
                                    <th>{{ __('Partially Refund') }}</th>
                                    <th>{{ __('Item(s)') }}</th>
                                </tr>
                                </thead>
                                <tbody class="list font-size-base rowlink" data-link="row">
                                @foreach($orders as $key => $row)
                                    <tr>
                                        <td class="text-left">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="ids[]" class="custom-control-input"
                                                       id="customCheck{{ $row->id }}" value="{{ $row->id }}">
                                                <label class="custom-control-label"
                                                       for="customCheck{{ $row->id }}"></label>
                                            </div>
                                        </td>
                                        <td class="text-left">
                                            <a href="{{ route('seller.refund.show',$row->id) }}">{{ $row->order_no }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('seller.refund.show',$row->id) }}">{{ $row->created_at->format('d-F-Y') }}</a>
                                        </td>
                                        <td>@if($row->customer_id !== null)<a
                                                href="{{ route('seller.customer.show',$row->customer_id) }}">{{ $row->customer->name }}</a> @else {{ __('Guest User') }} @endif
                                        </td>
                                        <td>{{ amount_format($row->total) }}</td>
                                        <td>
                                            <i class="@if($row->seller_take_action == 1) fa fa-check text-success @else fa fa-times text-danger @endif"
                                               aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            <i class="@if($row->is_fully_refunded == 1) fa fa-check text-success @else fa fa-times text-danger @endif"
                                               aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            <i class="@if($row->is_partially_refunded == 1) fa fa-check text-success @else fa fa-times text-danger @endif"
                                               aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            @if($row->is_partially_refunded)
                                                {{ $row->get_already_items_refunded->count() }}
                                            @elseif($row->is_fully_refunded)
                                                {{ $row->order_item->count() }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th class="text-left">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input checkAll"
                                                   id="selectAll">
                                            <label class="custom-control-label checkAll" for="selectAll"></label>
                                        </div>
                                    </th>
                                    <th class="text-left">{{ __('Order') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Customer') }}</th>
                                    <th class="text-right">{{ __('Order total') }}</th>
                                    <th>{{ __('Refund status changed') }}</th>
                                    <th>{{ __('Fully Refund') }}</th>
                                    <th>{{ __('Partially Refund') }}</th>
                                    <th class="text-right">{{ __('Item(s)') }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>

    <input type="hidden" id="payment" value="{{ $request->payment_status ?? '' }}">
    <input type="hidden" id="order_status" value="{{ $request->status ?? '' }}">
@endsection
@push('js')
    <script src="{{ asset('assets/js/form.js') }}"></script>
    <script src="{{ asset('assets/js/order_index.js') }}"></script>
@endpush
