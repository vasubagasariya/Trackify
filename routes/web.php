<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\LoginController;


Route::view('/dashboard','dashboard');

Route::get('/',[LoginController::class,'show'])->name('login.show')->middleware('adminCheckLogout');
Route::post('/',[LoginController::class,'check'])->name('login.check')->middleware('adminCheckLogout');


Route::middleware('adminCheck')->group(function(){
    
    Route::view('/dashboard','dashboard')->name('dashboard');

    Route::prefix('accounts')->name('accounts.')->group(function(){
        Route::get('',[AccountController::class, 'show'])->name('show');
        Route::get('create',[AccountController::class, 'create'])->name('create');
        Route::post('store',[AccountController::class, 'store'])->name('store');
        Route::get('edit/{name}',[AccountController::class, 'edit'])->name('edit');
        Route::post('update/{name}',[AccountController::class, 'update'])->name('update');
        Route::get('delete/{name}',[AccountController::class, 'delete'])->name('delete');
    });
    
    Route::prefix('transactions')->name('transactions.')->group(function(){
        Route::get('',[TransactionController::class,'show'])->name('show');
        Route::get('create',[TransactionController::class, 'create'])->name('create');
        Route::post('store',[TransactionController::class, 'store'])->name('store');
        Route::get('edit/{id}',[TransactionController::class, 'edit'])->name('edit');
        Route::post('update/{id}',[TransactionController::class, 'update'])->name('update');
        Route::get('delete/{id}',[TransactionController::class, 'delete'])->name('delete');
    });

    Route::prefix('transfers')->name('transfers.')->group(function(){
        Route::get('',[TransferController::class,'show'])->name('show');
        Route::get('create',[TransferController::class,'create'])->name('create');
        Route::post('store',[TransferController::class, 'store'])->name('store');
        Route::get('edit/{id}',[TransferController::class, 'edit'])->name('edit');
        Route::post('update/{id}',[TransferController::class, 'update'])->name('update');
        Route::get('delete/{id}',[TransferController::class, 'delete'])->name('delete');
    });
    Route::get('/logout', function () {
        session()->flush('admin_logged_in');
        return redirect()->route('login.show');
    })->name('logout');

});