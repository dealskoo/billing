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
                <h3 class="mb-2">Our Plans and Pricing</h3>
                <p class="text-muted md:w-50 m-auto">
                    We have plans and prices that fit your business perfectly.
                </p>
            </div>
            <ul class="nav nav-tabs justify-content-center nav-bordered my-4">
                <li class="nav-item">
                    <a href="#month-plans" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                        <span>Month</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#year-plans" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                        <span>Year</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="month-plans">
                    <!-- Month Plans -->
                    <div class="row mt-sm-5 mt-3 mb-3">
                        <div class="col-md-4">
                            <div class="card card-pricing">
                                <div class="card-body text-center">
                                    <p class="card-pricing-plan-name fw-bold text-uppercase">Lite</p>
                                    <i class="card-pricing-icon dripicons-user text-primary"></i>
                                    <h2 class="card-pricing-price">$19 <span>/ Month</span></h2>
                                    <ul class="card-pricing-features">
                                        <li>10 GB Storage</li>
                                        <li>500 GB Bandwidth</li>
                                        <li>No Domain</li>
                                        <li>1 User</li>
                                        <li>Email Support</li>
                                        <li>24x7 Support</li>
                                    </ul>
                                    <button class="btn btn-primary mt-4 mb-2 rounded-pill">Choose Plan</button>
                                </div>
                            </div> <!-- end Pricing_card -->
                        </div> <!-- end col -->

                        <div class="col-md-4">
                            <div class="card card-pricing card-pricing-recommended">
                                <div class="card-body text-center">
                                    <div class="card-pricing-plan-tag">Recommended</div>
                                    <p class="card-pricing-plan-name fw-bold text-uppercase">Standard</p>
                                    <i class="card-pricing-icon dripicons-briefcase text-primary"></i>
                                    <h2 class="card-pricing-price">$29 <span>/ Month</span></h2>
                                    <ul class="card-pricing-features">
                                        <li>50 GB Storage</li>
                                        <li>900 GB Bandwidth</li>
                                        <li>2 Domain</li>
                                        <li>10 User</li>
                                        <li>Email Support</li>
                                        <li>24x7 Support</li>
                                    </ul>
                                    <button class="btn btn-primary mt-4 mb-2 rounded-pill">Choose Plan</button>
                                </div>
                            </div> <!-- end Pricing_card -->
                        </div> <!-- end col -->

                        <div class="col-md-4">
                            <div class="card card-pricing">
                                <div class="card-body text-center">
                                    <p class="card-pricing-plan-name fw-bold text-uppercase">Advanced</p>
                                    <i class="card-pricing-icon dripicons-store text-primary"></i>
                                    <h2 class="card-pricing-price">$39 <span>/ Month</span></h2>
                                    <ul class="card-pricing-features">
                                        <li>100 GB Storege</li>
                                        <li>Unlimited Bandwidth</li>
                                        <li>10 Domain</li>
                                        <li>Unlimited User</li>
                                        <li>Email Support</li>
                                        <li>24x7 Support</li>
                                    </ul>
                                    <button class="btn btn-primary mt-4 mb-2 rounded-pill">Choose Plan</button>
                                </div>
                            </div> <!-- end Pricing_card -->
                        </div> <!-- end col -->

                    </div>
                    <!-- end row -->
                </div>
                <div class="tab-pane" id="year-plans">
                    <!-- Year Plans -->
                    <div class="row mt-sm-5 mt-3 mb-3">
                        <div class="col-md-4">
                            <div class="card card-pricing">
                                <div class="card-body text-center">
                                    <p class="card-pricing-plan-name fw-bold text-uppercase">Lite</p>
                                    <i class="card-pricing-icon dripicons-user text-primary"></i>
                                    <h2 class="card-pricing-price">$19 <span>/ Year</span></h2>
                                    <ul class="card-pricing-features">
                                        <li>10 GB Storage</li>
                                        <li>500 GB Bandwidth</li>
                                        <li>No Domain</li>
                                        <li>1 User</li>
                                        <li>Email Support</li>
                                        <li>24x7 Support</li>
                                    </ul>
                                    <button class="btn btn-primary mt-4 mb-2 rounded-pill">Choose Plan</button>
                                </div>
                            </div> <!-- end Pricing_card -->
                        </div> <!-- end col -->

                        <div class="col-md-4">
                            <div class="card card-pricing card-pricing-recommended">
                                <div class="card-body text-center">
                                    <div class="card-pricing-plan-tag">Recommended</div>
                                    <p class="card-pricing-plan-name fw-bold text-uppercase">Standard</p>
                                    <i class="card-pricing-icon dripicons-briefcase text-primary"></i>
                                    <h2 class="card-pricing-price">$29 <span>/ Year</span></h2>
                                    <ul class="card-pricing-features">
                                        <li>50 GB Storage</li>
                                        <li>900 GB Bandwidth</li>
                                        <li>2 Domain</li>
                                        <li>10 User</li>
                                        <li>Email Support</li>
                                        <li>24x7 Support</li>
                                    </ul>
                                    <button class="btn btn-primary mt-4 mb-2 rounded-pill">Choose Plan</button>
                                </div>
                            </div> <!-- end Pricing_card -->
                        </div> <!-- end col -->

                        <div class="col-md-4">
                            <div class="card card-pricing">
                                <div class="card-body text-center">
                                    <p class="card-pricing-plan-name fw-bold text-uppercase">Advanced</p>
                                    <i class="card-pricing-icon dripicons-store text-primary"></i>
                                    <h2 class="card-pricing-price">$39 <span>/ Year</span></h2>
                                    <ul class="card-pricing-features">
                                        <li>100 GB Storege</li>
                                        <li>Unlimited Bandwidth</li>
                                        <li>10 Domain</li>
                                        <li>Unlimited User</li>
                                        <li>Email Support</li>
                                        <li>24x7 Support</li>
                                    </ul>
                                    <button class="btn btn-primary mt-4 mb-2 rounded-pill">Choose Plan</button>
                                </div>
                            </div> <!-- end Pricing_card -->
                        </div> <!-- end col -->

                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div> <!-- end col-->
    </div>
@endsection
