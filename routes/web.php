<?php

use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProfileController;
use App\Modules\Customers\Controllers\CustomerController;
use App\Modules\Customers\Services\CustomerService;
use App\Modules\Invoices\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('customer')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
        Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
        Route::get('/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    });


    Route::prefix('invoice')->group(function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('invoice.index');
        Route::get('/create', [InvoiceController::class, 'create'])->name('invoice.create');
        Route::get('/{id}', [InvoiceController::class, 'edit'])->name('invoice.edit');
    });


    Route::prefix('crud')->group(function () {
        Route::get('{module}', [ModuleController::class, 'handle']);         // List
        Route::post('{module}', [ModuleController::class, 'handle']);        // Create
        Route::put('{module}/{id}', [ModuleController::class, 'handle']);    // Update
    });

});


require __DIR__.'/auth.php';
