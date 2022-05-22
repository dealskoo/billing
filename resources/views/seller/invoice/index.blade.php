@extends('seller::layouts.panel')

@section('title',__('billing::billing.invoices'))
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a
                                href="{{ route('seller.dashboard') }}">{{ __('seller::seller.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a
                                href="javascript: void(0);">{{ __('billing::billing.billing') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('billing::billing.invoices') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('billing::billing.invoices') }}</h4>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form id="payment-form">
                        <div id="payment-element"></div>
                        <button id="submit">Subscribe</button>
                        <div id="error-message"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        $(function () {
            const stripe = Stripe("{{ config('cashier.key') }}");
            const options = {
                clientSecret: '{{ $clientSecret }}',
                appearance: {}
            }
            const elements = stripe.elements(options);
            const paymentElement = elements.create('payment');
            paymentElement.mount('#payment-element');
        });
    </script>
@endsection
