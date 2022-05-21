<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8"/>
    <title>{{ __('billing::billing.pricing') }} - {{ __('seller::auth.title') }} - {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
    <!-- App css -->
    <link href="{{ asset('/vendor/seller/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/vendor/seller/css/app-creative.min.css') }}" rel="stylesheet" type="text/css"
          id="light-style"/>
    <link href="{{ asset('/vendor/seller/css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css"
          id="dark-style"/>
</head>

<body>
<div class="content">
    <div class="navbar-custom topnav-navbar">
        <div class="col-xxl-10 container-fluid">
            <a href="{{ route('seller.dashboard') }}" class="topnav-logo">
                                <span class="topnav-logo-lg">
                                    <img src="{{ asset(config('seller.logo')) }}" alt="" height="40">
                                </span>
                <span class="topnav-logo-sm">
                                    <img src="{{ asset(config('seller.logo_sm')) }}" alt="" height="40">
                                </span>
            </a>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-xxl-10">

            <!-- Pricing Title-->
            <div class="text-center">
                <h3 class="mb-2">{{ __('billing::billing.plans_title') }}</h3>
                <p class="text-muted md:w-50 m-auto">
                    {{ __('billing::billing.plans_summary') }}
                </p>
            </div>
            <ul class="nav nav-tabs justify-content-center nav-bordered my-4">
                <li class="nav-item">
                    <a href="#month-plans" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                        <span>{{ __('billing::billing.month') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#year-plans" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                        <span>{{ __('billing::billing.year') }}</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="month-plans">
                    <!-- Month Plans -->
                    <div class="row mt-sm-5 mt-3 mb-3">
                        @foreach(config('billing.plans.month') as $plan)
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
                                            <span>/ {{ __(\Dealskoo\Billing\Facades\Price::interval($plan['stripe_id'])) }}</span>
                                        </h2>
                                        <ul class="card-pricing-features">
                                            @foreach($plan['items'] as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                        <a href="{{ route('seller.subscription.form',$plan['stripe_id']) }}"
                                           class="btn btn-primary mt-4 mb-2 rounded-pill">{{ __('billing::billing.subscribe') }}</a>
                                    </div>
                                </div> <!-- end Pricing_card -->
                            </div> <!-- end col -->
                        @endforeach
                    </div>
                    <!-- end row -->
                </div>
                <div class="tab-pane" id="year-plans">
                    <!-- Year Plans -->
                    <div class="row mt-sm-5 mt-3 mb-3">
                        @foreach(config('billing.plans.year') as $plan)
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
                                            <span>/ {{ __(\Dealskoo\Billing\Facades\Price::interval($plan['stripe_id'])) }}</span>
                                        </h2>
                                        <ul class="card-pricing-features">
                                            @foreach($plan['items'] as $item)
                                                <li>{{ __($item) }}</li>
                                            @endforeach
                                        </ul>
                                        <a href="{{ route('seller.subscription.form',$plan['stripe_id']) }}"
                                           class="btn btn-primary mt-4 mb-2 rounded-pill">{{ __('billing::billing.subscribe') }}</a>
                                    </div>
                                </div> <!-- end Pricing_card -->
                            </div> <!-- end col -->
                        @endforeach
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div> <!-- end col-->
    </div>
</div>
<!-- bundle -->
<script src="{{ asset('/vendor/seller/js/vendor.min.js') }}"></script>
<script src="{{ asset('/vendor/seller/js/app.min.js') }}"></script>
</body>

</html>
