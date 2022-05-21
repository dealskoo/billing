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

        Route::resource('payment', PaymentController::class)->except(['create', 'edit']);

        Route::get('/subscription/history', [SubscriptionController::class, 'index'])->name('subscription.history');
        Route::get('/subscription/swap/{id}', [SubscriptionController::class, 'swap'])->name('subscription.swap');
        Route::get('/subscription/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
        Route::get('/subscription/resume', [SubscriptionController::class, 'resume'])->name('subscription.resume');
        Route::get('/subscription/{id}', [SubscriptionController::class, 'form'])->name('subscription.form');
        Route::post('/subscription', [SubscriptionController::class, 'store'])->name('subscription.store');

        Route::middleware(['password.confirm:seller.password.confirm'])->group(function () {

        });
    });
});
