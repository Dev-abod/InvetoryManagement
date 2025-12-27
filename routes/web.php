<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ReportController;








Route::prefix('partners')->group(function () {

    Route::get('/suppliers', [PartnerController::class, 'suppliers'])
        ->name('partners.suppliers');

    Route::get('/customers', [PartnerController::class, 'customers'])
        ->name('partners.customers');

    Route::get('/search', [PartnerController::class, 'search'])
        ->name('partners.search');

    // Create
    Route::post('/', [PartnerController::class, 'store'])
        ->name('partners.store');

    // Update ✅
    Route::put('/{id}', [PartnerController::class, 'update'])
        ->name('partners.update');

    // Delete ✅
    Route::delete('/{id}', [PartnerController::class, 'destroy'])
        ->name('partners.destroy');
});



// تسجيل الخروج 
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');


Route::get('/', function () {
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





// Route::get('/product-management', function () {
//     return view('ProductManagement');
// })->name('ProductManagement');


use App\Http\Controllers\ProductManagementController;

Route::get('/product-management', [ProductManagementController::class, 'index'])
    ->name('ProductManagement');




Route::get('/TranscationSelector', function () {
    return view('Transcation_Selector');
})->name('TranscationSelector');



// Route::get('/Products', function () {
//     return view('Sub_ProductManagement.Products');
// })->name('Products');

use App\Http\Controllers\ProductController;

Route::get('/Products', [ProductController::class, 'index'])
    ->name('Products');

Route::post('/Products', [ProductController::class, 'store'])
    ->name('Products.store');

Route::post('/Products/{id}/update', [ProductController::class, 'update'])
    ->name('Products.update');

Route::post('/Products/{id}/delete', [ProductController::class, 'destroy'])
    ->name('Products.delete');



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





Route::prefix('operations')
    ->name('operations.')
    ->middleware(['auth'])
    ->group(function () {

          Route::get('{type}', [OperationController::class, 'index'])
            ->whereIn('type', ['in', 'out', 'return_in', 'return_out'])
            ->name('index');

        // إنشاء عملية
        Route::get('{type}/create', [OperationController::class, 'create'])
            ->whereIn('type', ['in', 'out', 'return_in', 'return_out'])
            ->name('create');

        // حفظ عملية
        Route::post('{type}', [OperationController::class, 'store'])
            ->whereIn('type', ['in', 'out', 'return_in', 'return_out'])
            ->name('store');

            //  Show (تفاصيل العملية)
        Route::get('show/{operation}', [OperationController::class, 'show'])
            ->whereNumber('operation')
            ->name('show');

       Route::get('operations/{operation}/correct', [OperationController::class, 'correctForm'])
       ->name('correct.form');

      Route::post('operations/{operation}/correct', [OperationController::class, 'correct'])
      ->name('correct');
        // إلغاء عملية
        Route::post('{operation}/cancel', [OperationController::class, 'cancel'])
            ->whereNumber('operation')
            ->name('cancel');

             Route::get('items/popup', [OperationController::class, 'popupItems'])
            ->name('items.popup');

    });
   

Route::get('/SelectorParents', function () {
    return view('SelectorPartners');
})->name('SelectorParents');

Route::prefix('reports')
    ->name('reports.')
    ->group(function () {

        // الصفحة الرئيسية للتقارير (الكروت)
        Route::get('/', [ReportController::class, 'index'])
            ->name('index');

        // تقارير المنتجات
        Route::get('/stock-movements', [ReportController::class, 'stockMovements'])
            ->name('stock.movements');

        // تقارير الحركات المخزنية
        Route::get('/operations', [ReportController::class, 'operations'])
            ->name('operations');

        // تقرير المخزون الحالي (stocks)
        Route::get('/stock', [ReportController::class, 'stocks'])
            ->name('stock');
    });