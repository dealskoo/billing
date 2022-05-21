@extends('seller::layouts.panel')

@section('title',__('billing::billing.payment_methods'))
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
                        <li class="breadcrumb-item active">{{ __('billing::billing.payment_methods') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('billing::billing.payment_methods') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">{{ __('billing::billing.add_payment_method') }}</h5>
                    <form id="payment-form" action="{{ route('seller.payment.store') }}" method="post">
                        @csrf
                        @if (!empty($errors->all()))
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <p class="mb-0">{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        <div id="card-errors" class="alert alert-danger d-none">
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="card_holder_name"
                                       class="form-label">{{ __('billing::billing.card_holder_name') }}</label>
                                <input type="text" id="card-holder-name" class="form-control" name="card_holder_name"
                                       required value="{{ old('name') }}" autofocus tabindex="1">
                            </div>
                            <div class="col-md-12 mb-3">
                                <div id="card-element" class="form-control"></div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" id="card-button" class="btn btn-success mt-2"
                                    data-secret="{{ $intent->client_secret }}">{{ __('seller::seller.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('billing::billing.payment_methods') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap">
                            <thead>
                            <tr>
                                <th>{{ __('billing::billing.card_holder_name') }}</th>
                                <th>{{ __('billing::billing.card_brand') }}</th>
                                <th>{{ __('billing::billing.last4') }}</th>
                                <th>{{ __('billing::billing.exp') }}</th>
                                <th>{{ __('billing::billing.postal_code') }}</th>
                                <th class="table-action">{{ __('billing::billing.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($methods as $method)
                                <tr>
                                    <td>
                                        @isset($default)
                                            @if($method->id == $default->id)
                                                <span
                                                    class="badge bg-primary">{{ __('billing::billing.default') }}</span>
                                            @endif
                                        @endisset
                                        {{ $method->billing_details->name }}
                                    </td>
                                    <td class="text-uppercase">{{ $method->card->brand }}</td>
                                    <td>{{ $method->card->last4 }}</td>
                                    <td>{{ $method->card->exp_month }}/{{$method->card->exp_year}}</td>
                                    <td>{{ $method->billing_details->address->postal_code }}</td>
                                    <td>
                                        @isset($default)
                                            @if($method->id != $default->id)
                                                <a href="{{ route('seller.payment.update',$method->id) }}"
                                                   onclick="event.preventDefault();submit_form('#update-form',this)"
                                                   class="action-icon"
                                                   title="{{ __('billing::billing.set_default') }}"><i
                                                        class="mdi mdi-disc"></i></a>
                                                <a href="{{ route('seller.payment.destroy',$method->id) }}"
                                                   onclick="event.preventDefault();submit_form('#delete-form',this)"
                                                   class="action-icon delete-btn"><i
                                                        class="mdi mdi-delete"></i></a>
                                            @endif
                                        @endisset
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <form id="update-form" method="post" class="d-none">
                            @csrf
                            @method('PUT')
                        </form>
                        <form id="delete-form" method="post" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
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
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');
            const cardHolderName = document.getElementById('card-holder-name');
            const form = document.getElementById('payment-form');
            const cardButton = document.getElementById('card-button');
            const cardErrors = $('#card-errors');
            const clientSecret = cardButton.dataset.secret;
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                cardButton.disable = true;
                const {setupIntent, error} = await stripe.confirmCardSetup(clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {name: cardHolderName.value}
                    }
                });
                if (error) {
                    cardButton.disable = false;
                    cardErrors.html(error.message);
                    cardErrors.removeClass('d-none');
                } else {
                    let payment_method = document.createElement('input');
                    payment_method.setAttribute('type', 'hidden');
                    payment_method.setAttribute('name', 'payment_method');
                    payment_method.setAttribute('value', setupIntent.payment_method);
                    form.appendChild(payment_method);
                    form.submit();
                }
            });
        });

        function submit_form(id, btn) {
            let action = $(btn).attr('href');
            let form = $(id);
            form.attr('action', action);
            form.submit();
        }
    </script>
@endsection
