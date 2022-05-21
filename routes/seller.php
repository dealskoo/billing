<?php

use Dealskoo\Billing\Http\Controllers\PricingController;
use Dealskoo\Billing\Http\Controllers\Seller\InvoiceController;
use Dealskoo\Billing\Http\Controllers\Seller\PaymentController;
use Dealskoo\Billing\Http\Controllers\Seller\PlanController;
use Dealskoo\Billing\Http\Controllers\Seller\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'seller_locale'])->prefix(config('seller.route.prefix'))->name('seller.')->group(function () {

    Route::get('/pricing', [PricingController::class, 'index'])->name('pricing');

    Route::middleware(['guest:seller'])->group(function () {

    });

    Route::middleware(['auth:seller', 'verified:seller.verification.notice', 'seller_active'])->group(function () {

        Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
        Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
        Route::get('/payment/methods', [PaymentController::class, 'methods'])->name('payment.methods');
        Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');
        Route::get('/subscription/history', [SubscriptionController::class, 'index'])->name('subscription.history');

        Route::middleware(['password.confirm:seller.password.confirm'])->group(function () {

        });
    });
});
