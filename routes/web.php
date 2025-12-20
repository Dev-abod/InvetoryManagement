<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OperationController;


use Illuminate\Support\Facades\Auth;


// تسجيل الخروج 
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('Login');
})->name('logout');


Route::get('/Welcome', function () {
    return view('Welcome');
});


// صفحة تسجيل الدخول
Route::get('/login', function () {
    return view('Login');
})->name('login');


// معالجة تسجيل الدخول
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

// الصفحة الرئيسية
Route::get('/home', function () {
    return view('Home');
})->middleware('auth')->name('home');





Route::get('/product-management', function () {
    return view('ProductManagement');
})->name('ProductManagement');



Route::get('/SupplierCustomer', function () {
    return view('Supplier_Customer');
})->name('SupplierCustomer');


Route::get('/TranscationSelector', function () {
    return view('Transcation_Selector');
})->name('TranscationSelector');



Route::get('/Products', function () {
    return view('Sub_ProductManagement.Products');
})->name('Products');


Route::get('/Units', function () {
    return view('Sub_ProductManagement.Units');
})->name('Units');



Route::get('/Categories', function () {
    return view('Sub_ProductManagement.Categories');
})->name('Categories');

Route::prefix('operations')
    ->name('operations.')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('{type}/create', [OperationController::class, 'create'])
            ->name('create');

        Route::post('{type}', [OperationController::class, 'store'])
            ->name('store');

        Route::post('{operation}/correct', [OperationController::class, 'correct'])
            ->name('correct');

        Route::post('{operation}/cancel', [OperationController::class, 'cancel'])
            ->name('cancel');
    });
