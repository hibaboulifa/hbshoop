<?php
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use Illuminate\Support\Facades\Route;


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', AdminProductController::class);
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/export-report', [DashboardController::class, 'exportPDF'])->name('admin.export-report');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

});


Route::middleware(['auth', 'isCustomer'])->group(function () {
    Route::get('/checkout', function () {
        $cart = session()->get('cart', []);
        $products = \App\Models\Product::find(array_keys($cart));
        return view('checkout', compact('products', 'cart'));
    })->name('checkout.index');

    Route::get('/points', [CustomerController::class, 'showPoints'])->name('customer.points');
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.confirm');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/customer/invoice/{order}', [CustomerController::class, 'invoice'])->name('customer.invoice');

});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');

});


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



require __DIR__.'/auth.php';