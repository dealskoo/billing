@extends('seller::layouts.panel')

@section('title',__('billing::billing.subscription'))
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
                        <li class="breadcrumb-item active">{{ __('billing::billing.subscription') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('billing::billing.subscription') }}</h4>
            </div>
        </div>
    </div>
    <form action="{{ route('seller.subscription.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <input type="hidden" name="price" value="{{ $price->id }}">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="promotion_code"
                                       class="form-label">{{ __('billing::billing.promotion_code') }}</label>
                                <input type="text" id="promotion_code" class="form-control" name="promotion_code"
                                       value="{{ old('promotion_code') }}" autofocus tabindex="1">
                            </div>
                        </div>
                        <div class="row mb-3">
                            @foreach($methods as $key=>$method)
                                <div class="col-md-6">
                                    <div class="border p-3 rounded mb-3">
                                        <div class="mb-0 address-lg">
                                            <div class="form-check">
                                                <input type="radio" id="{{$key}}" name="payment_method"
                                                       class="form-check-input"
                                                       value="{{ $method->id }}" @isset($default)
                                                           @if($method->id == $default->id)
                                                               checked=""
                                                    @endif
                                                    @endisset>
                                                <label class="form-check-label font-16 fw-bold"
                                                       for="{{$key}}">
                                                    <span
                                                        class="text-uppercase">{{ $method->card->brand }}</span><span class="ms-2">{{ $method->billing_details->name }}</span><span
                                                        class="ms-2">•••• {{ $method->card->last4 }}</span><span
                                                        class="ms-2">{{ $method->card->exp_month }}/{{$method->card->exp_year}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-end mt-2">
                                <a href="{{ route('seller.payment.index') }}">{{ __('billing::billing.add_payment_method') }}</a>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" id="card-button"
                                    class="btn btn-success mt-2">{{ __('billing::billing.subscribe') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div
                    class="card card-pricing @if(\Dealskoo\Billing\Facades\Price::recommended($plan['stripe_id']))card-pricing-recommended @endif">
                    <div class="card-body text-center">
                        @if(\Dealskoo\Billing\Facades\Price::recommended($plan['stripe_id']))
                            <div
                                class="card-pricing-plan-tag">{{ __('billing::billing.recommended') }}</div>
                        @endif
                        <p class="card-pricing-plan-name fw-bold text-uppercase">{{ __(\Dealskoo\Billing\Facades\Price::name($plan['stripe_id'])) }}</p>
                        <i class="card-pricing-icon {{ \Dealskoo\Billing\Facades\Price::icon($plan['stripe_id']) }} text-primary"></i>
                        <h2 class="card-pricing-price">{{ \Dealskoo\Billing\Facades\Price::money($plan['stripe_id']) }}
                            <span>/ {{ __(\Dealskoo\Billing\Facades\Price::interval($plan['stripe_id'])) }}</span></h2>
                        <ul class="card-pricing-features">
                            @foreach($plan['items'] as $item)
                                <li>{{ __($item) }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div> <!-- end Pricing_card -->
            </div>
        </div>
    </form>
@endsection
