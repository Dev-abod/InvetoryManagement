<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
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


// Route::get('/Units', function () {
//     return view('Sub_ProductManagement.Units');
// })->name('Units');

use App\Http\Controllers\UnitController;

Route::get('/Units', [UnitController::class, 'index'])
    ->name('Units');

Route::post('/Units', [UnitController::class, 'store'])
    ->name('Units.store');

Route::post('/Units/{id}/update', [UnitController::class, 'update'])
    ->name('Units.update');

Route::post('/Units/{id}/delete', [UnitController::class, 'destroy'])
    ->name('Units.delete');



Route::get('/Categories', [CategoryController::class, 'index'])->name('Categories');
Route::post('/Categories', [CategoryController::class, 'store'])->name('Categories.store');
Route::post('/Categories/{id}/update', [CategoryController::class, 'update'])->name('Categories.update');
Route::post('/Categories/{id}/delete', [CategoryController::class, 'destroy'])->name('Categories.delete');


// Route::resource('Categories', CategoryController::class);

