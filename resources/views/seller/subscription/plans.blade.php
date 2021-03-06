@extends('seller::layouts.panel')

@section('title',__('billing::billing.plans'))
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
                        <li class="breadcrumb-item active">{{ __('billing::billing.plans') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('billing::billing.plans') }}</h4>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
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
                    <a href="#month-plans" data-bs-toggle="tab" aria-expanded="@if(!$year_plan)true @else false @endif"
                       class="nav-link @if(!$year_plan)active @endif">
                        <span>{{ __('billing::billing.month') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#year-plans" data-bs-toggle="tab" aria-expanded="@if($year_plan)true @else false @endif"
                       class="nav-link @if($year_plan)active @endif">
                        <span>{{ __('billing::billing.year') }}</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane @if(!$year_plan)show active @endif" id="month-plans">
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
                                            @foreach($plan['features'] as $feature)
                                                <li class="{{ $feature['class'] }}">{{ __($feature['desc']) }}</li>
                                            @endforeach
                                        </ul>
                                        @if(request()->user('seller')->subscribedToPrice($plan['stripe_id'],'default'))
                                            @if(request()->user('seller')->subscription('default')->onGracePeriod())
                                                <a href="{{ route('seller.subscription.resume') }}"
                                                   class="btn btn-secondary mt-4 mb-2 rounded-pill">{{ __('billing::billing.resume') }}</a>
                                            @else
                                                <a href="{{ route('seller.subscription.cancel') }}"
                                                   class="btn btn-secondary mt-4 mb-2 rounded-pill">{{ __('billing::billing.cancel') }}</a>
                                            @endif
                                        @else
                                            @if(request()->user('seller')->subscribedToProduct(\Dealskoo\Billing\Facades\Price::products(),'default'))
                                                <a href="{{ route('seller.subscription.swap',$plan['stripe_id']) }}"
                                                   class="btn btn-primary mt-4 mb-2 rounded-pill">{{ __('billing::billing.choose_plan') }}</a>
                                            @else
                                                <a href="{{ route('seller.subscription.form',$plan['stripe_id']) }}"
                                                   class="btn btn-primary mt-4 mb-2 rounded-pill">{{ __('billing::billing.subscribe') }}</a>
                                            @endif
                                        @endif
                                    </div>
                                </div> <!-- end Pricing_card -->
                            </div> <!-- end col -->
                        @endforeach
                    </div>
                    <!-- end row -->
                </div>
                <div class="tab-pane @if($year_plan)show active @endif" id="year-plans">
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
                                            @foreach($plan['features'] as $feature)
                                                <li class="{{ $feature['class'] }}">{{ __($feature['desc']) }}</li>
                                            @endforeach
                                        </ul>
                                        @if(request()->user('seller')->subscribedToPrice($plan['stripe_id'],'default'))
                                            @if(request()->user('seller')->subscription('default')->onGracePeriod())
                                                <a href="{{ route('seller.subscription.resume') }}"
                                                   class="btn btn-secondary mt-4 mb-2 rounded-pill">{{ __('billing::billing.resume') }}</a>
                                            @else
                                                <a href="{{ route('seller.subscription.cancel') }}"
                                                   class="btn btn-secondary mt-4 mb-2 rounded-pill">{{ __('billing::billing.cancel') }}</a>
                                            @endif
                                        @else
                                            @if(request()->user('seller')->subscribedToProduct(\Dealskoo\Billing\Facades\Price::products(),'default'))
                                                <a href="{{ route('seller.subscription.swap',$plan['stripe_id']) }}"
                                                   class="btn btn-primary mt-4 mb-2 rounded-pill">{{ __('billing::billing.choose_plan') }}</a>
                                            @else
                                                <a href="{{ route('seller.subscription.form',$plan['stripe_id']) }}"
                                                   class="btn btn-primary mt-4 mb-2 rounded-pill">{{ __('billing::billing.subscribe') }}</a>
                                            @endif
                                        @endif
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
@endsection
