<?php

use Illuminate\Support\Facades\Route;
use SPPAY\SPPAYLaravel\Controllers\PaymentController;
use SPPAY\SPPAYLaravel\Controllers\TransactionController;
use SPPAY\SPPAYLaravel\Controllers\TransferController;

Route::prefix('sppay')->group(function(){
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{reference}', [TransactionController::class, 'show'])->name('transactions.show');

    Route::get('payment/init', [PaymentController::class, 'init'])->name('payment.init');
    Route::post('payment/init', [PaymentController::class, 'initiate'])->name('payment.init.submit');
    Route::post('payment/validate', [PaymentController::class, 'validate'])->name('payment.validate');
    Route::post('payment/send-otp', [PaymentController::class, 'sendOTP'])->name('payment.send.otp');

    Route::get('transfer', [TransferController::class, 'index'])->name('transfer.index');
    Route::post('validate/account', [TransferController::class, 'validateAccount'])->name('validate.account');
    Route::post('validate/transfer', [TransferController::class, 'validateTransfer'])->name('validate.transfer');
    Route::post('submit/transfer', [TransferController::class, 'submitTransfer'])->name('submit.transfer');
});
