<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Customer\MenuController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ReportController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ADMIN ROUTE (KHUSUS ADMIN)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // CRUD PRODUK ADMIN
    Route::resource('/admin/products', ProductController::class); 

    // ORDER MANAGEMENT ADMIN
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
    Route::get('/admin/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/admin/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.status');
    
    Route::get('/admin/reports', [ReportController::class, 'index'])
    ->name('admin.reports');

});

// CUSTOMER ROUTE (SEMUA USER LOGIN BISA)
Route::middleware(['auth'])->group(function () {
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])
        ->name('customer.dashboard');
    
    // MENU CUSTOMER
    Route::get('/menu', [MenuController::class, 'index'])->name('customer.menu');
    
    // CART
    Route::get('/cart', [CartController::class, 'index'])->name('customer.cart');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // CHECKOUT
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('customer.checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    // ORDER
    Route::get('/orders', [OrderController::class, 'index'])->name('customer.orders');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('customer.orders.show');

});

require __DIR__.'/auth.php';
