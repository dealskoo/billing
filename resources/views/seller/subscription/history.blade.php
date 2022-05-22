@extends('seller::layouts.panel')

@section('title',__('billing::billing.subscription_history'))
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
                        <li class="breadcrumb-item active">{{ __('billing::billing.subscription_history') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('billing::billing.subscription_history') }}</h4>
            </div>
        </div>
    </div>
    <div class="row">

    </div>
@endsection
