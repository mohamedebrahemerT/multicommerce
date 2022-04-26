@extends('layouts.app')
@section('head')
    @include('layouts.partials.headersection',['title'=> trans('Order No:') .$info->order_no])
@endsection
@section('content')
    <div class="row" id="order">
        @if($info->is_fully_refunded)
            <div class="col-12">
                <div class="card">{{ $info->refund_reason }}</div>
            </div>
        @endif
        <div class="col-12">
            @if($info->refund_status=='pending')
                <div class="card card-warning">
                    @elseif($info->refund_status=='rejected')
                        <div class="card card-primary">
                            @elseif($info->refund_status=='accepted')
                                <div class="card card-success">
                                    @else
                                        <div class="card card-primary">
                                            @endif


                                            <div class="card-body">
                                                <ul class="list-group list-group-lg list-group-flush list">
                                                    <li class="list-group-item">
                                                        <div class="row align-items-center">
                                                            <div class="col-4">
                                                                <strong>{{ __('Product') }}</strong>
                                                            </div>
                                                            <div class="col-2"></div>
                                                            <div class="col-2"></div>
                                                            <div class="col-2 text-right">
                                                                <strong>{{ __('Amount') }}</strong>
                                                            </div>
                                                            <div class="col-2 text-right">
                                                                <strong>{{ __('Total') }}</strong>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @foreach($info->order_item as $row)
                                                        <li class="list-group-item">
                                                            <div class="row align-items-center">
                                                                <div class="col-4">
                                                                    <a href="{{ url('/seller/product/'.$row->term->id.'/edit') }}">{{ $row->term->title ?? '' }}
                                                                    </a>
                                                                    @if($row->is_refundable)
                                                                        <span
                                                                            class="badge @if($row->refund_status == 'pending') badge-warning @elseif($row->refund_status == 'accepted') badge-success @elseif($row->refund_status == 'rejected') badge-danger @endif  mx-1">{{ __($row->refund_status) }}</span>
                                                                    @endif
                                                                    <br>
                                                                    @php
                                                                        $variations=json_decode($row->info);

                                                                    @endphp
                                                                    @foreach ($variations->attribute ?? [] as $item)

                                                                        <span>{{ __('Variation') }} :</span>
                                                                        <small>{{ $item->attribute->name ?? '' }}
                                                                            - {{ $item->variation->name ?? '' }}</small>
                                                                    @endforeach
                                                                    <br>
                                                                    @foreach ($variations->options ?? [] as $option)
                                                                        <span>{{ __('Options') }} :</span>
                                                                        <small>{{ $option->name ?? '' }}</small>
                                                                    @endforeach

                                                                </div>
                                                                <div class="col-2">{{ $row->reason }}</div>
                                                                <div class="col-2">
                                                                    @if($row->is_refundable)
                                                                        <form method="post"
                                                                              action="{{ route('seller.orders.refund.change-status-method') }}"
                                                                              class="basicform">
                                                                            @csrf
                                                                            <input type="hidden" name="productId"
                                                                                   id="productId"
                                                                                   value="{{$row->term->id}}">
                                                                            <input type="hidden" name="orderId"
                                                                                   id="orderId" value="{{$row->id}}">
                                                                            <input type="hidden" name="mainOrderId"
                                                                                   id="orderId" value="{{$info->id}}">
                                                                            <div class="input-group mb-1">
                                                                                <select class="form-control selectric"
                                                                                        name="method">
                                                                                    <option disabled
                                                                                            selected="">{{ __('Select Refund Status') }}</option>
                                                                                    <option
                                                                                        value="pending">{{ __('Pending') }}</option>
                                                                                    <option
                                                                                        value="rejected">{{ __('Rejected') }}</option>
                                                                                    <option
                                                                                        value="accepted">{{ __('Accepted') }}</option>
                                                                                </select>
                                                                                <div class="input-group-append">
                                                                                    <button
                                                                                        class="btn btn-primary basicbtn"
                                                                                        type="submit">{{ __('Submit') }}</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    @endif
                                                                </div>

                                                                <div class="col-2 text-right">
                                                                    {{ $row->amount }} × {{ $row->qty }}
                                                                </div>
                                                                <div class="col-2 text-right">
                                                                    {{  amount_format($row->amount*$row->qty) }}
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach




                                                    <li class="list-group-item">
                                                        <div class="row align-items-center">


                                                            <div class="col-4">
                                                                {{ $info->shipping_info->shipping_method->name ?? '' }}
                                                            </div>
                                                            <div class="col-2"></div>
                                                            <div class="col-2"></div>
                                                            <div class="col-2 text-right">
                                                                {{ __('Shipping Fee') }}
                                                            </div>
                                                            <div class="col-2 text-right">
                                                                {{ amount_format($info->shipping) }}
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row align-items-center">
                                                            <div class="col-9 text-right">{{ __('Tax') }}</div>
                                                            <div
                                                                class="col-3 text-right"> {{ amount_format($info->tax) }} </div>
                                                        </div>
                                                    </li>


                                                    <li class="list-group-item">
                                                        <div class="row align-items-center">
                                                            <div class="col-9 text-right">{{ __('Discount') }}</div>
                                                            <div
                                                                class="col-3 text-right"> {{ amount_format($order_content->coupon_discount) }} </div>
                                                        </div>
                                                    </li>
                                                   
                                                    <li class="list-group-item">
                                                        <div class="row align-items-center">
                                                            <div class="col-9 text-right">{{ __('Total') }}</div>
                                                            <div
                                                                class="col-3 text-right">{{ amount_format($info->total) }}</div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="card-footer">

                                                <div class="text-right">

                                                    @if($info->is_fully_refunded == 1 && $info->is_partially_refunded != 1)
                                                        <form method="POST"
                                                              action="{{ route('seller.orders.refund.change-status-method') }}"
                                                              accept-charset="UTF-8" class="d-inline basicform">
                                                            @csrf

                                                            <div class="btn-group">
                                                                <input type="hidden" value="{{$info->order_no}}"
                                                                       name="mainOrderId">
                                                                <select class="form-control" name="method">
                                                                    <option disabled="" selected="">
                                                                        <b>{{ __('Select Refund Status') }}</b></option>
                                                                    <option value="pending">{{ __('Pending') }}</option>
                                                                    <option
                                                                        value="accepted">{{ __('Accepted') }}</option>
                                                                    <option
                                                                        value="rejected">{{ __('Rejected') }}</option>

                                                                </select>

                                                            </div>
                                                            <button type="submit"
                                                                    class="btn btn-primary float-right mt-2 ml-2 basicbtn">{{ __('Save') }}</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                </div>
                        </div>
                        @endsection
                        @push('js')
                            <script src="{{ asset('assets/js/form.js') }}"></script>
                            <script src="{{ asset('assets/js/order_index.js') }}"></script>

    @endpush
