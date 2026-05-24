<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankAccountController;

Route::get('/', [BankAccountController::class, 'index'])->name('bank-accounts.index');
Route::get('/create', [BankAccountController::class, 'create'])->name('bank-accounts.create');
Route::post('/store', [BankAccountController::class, 'store'])->name('bank-accounts.store');
