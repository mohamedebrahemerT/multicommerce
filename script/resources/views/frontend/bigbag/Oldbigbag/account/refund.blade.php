@extends('frontend.bigbag.account.layout.app')
@section('user_content')
    <section class="section">
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title d-flex justify-content-between align-items-center">
                                <h2>{{ __('Order Information') }}</h2>
                                <div class="invoice-number"><strong>{{ __('Order Id') }}:</strong>
                                    {{ $order_code }}
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
