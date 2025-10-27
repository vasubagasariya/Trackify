<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;

Route::view('/','welcome');

Route::prefix('accounts')->name('accounts.')->group(function(){
    Route::get('show',[AccountController::class, 'show'])->name('show');
    Route::get('create',[AccountController::class, 'create'])->name('create');
    Route::post('store',[AccountController::class, 'store'])->name('store');
    Route::get('edit/{name}',[AccountController::class, 'edit'])->name('edit');
    Route::post('update/{name}',[AccountController::class, 'update'])->name('update');
    Route::get('delete/{name}',[AccountController::class, 'delete'])->name('delete');
});

Route::prefix('transactions')->name('transactions.')->group(function(){
    Route::get('show',[TransactionController::class,'show'])->name('show');
    Route::get('create',[TransactionController::class, 'create'])->name('create');
    Route::post('store',[TransactionController::class, 'store'])->name('store');
    Route::get('edit/{id}',[TransactionController::class, 'edit'])->name('edit');
    Route::post('update/{id}',[TransactionController::class, 'update'])->name('update');
    Route::get('delete/{id}',[TransactionController::class, 'delete'])->name('delete');
});