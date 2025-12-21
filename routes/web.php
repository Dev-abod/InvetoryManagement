<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PartnerController;



use Illuminate\Support\Facades\Auth;



Route::prefix('partners')->group(function () {

    Route::get('/suppliers', [PartnerController::class, 'suppliers'])
        ->name('partners.suppliers');

    Route::get('/customers', [PartnerController::class, 'customers'])
        ->name('partners.customers');

    Route::get('/search', [PartnerController::class, 'search'])
        ->name('partners.search');

    // CRUD الصحيح
    Route::post('/', [PartnerController::class, 'store'])
        ->name('partners.store');

    Route::put('/{id}', [PartnerController::class, 'update'])
        ->name('partners.update');

    Route::delete('/{id}', [PartnerController::class, 'destroy'])
        ->name('partners.destroy');
});


// تسجيل الخروج 
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');


Route::get('/Welcome', function () {
    return view('Welcome');
});

Route::get('/partners/pdf/{type}', [PartnerController::class, 'exportPdf'])
    ->whereIn('type', ['supplier', 'customer'])
    ->name('partners.pdf');

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



Route::get('/SelectorParents', function () {
    return view('SelectorPartners');
})->name('SelectorParents');
