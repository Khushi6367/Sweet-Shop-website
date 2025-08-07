<?php

use App\Http\Controllers\AboutusController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\MyorderController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Cart;
use App\Models\Shipping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutusController::class, 'index']);
Route::get('/contact', [ContactusController::class, 'index']);
Route::post('contact/store', [ContactusController::class, 'store']);
Route::get('/product/all', [ProductController::class, 'listing']);
Route::get("/product/adminlisting", [ProductController::class, 'adminlisting'])->middleware(AdminMiddleware::class);
Route::get('/privacy-policy', [PolicyController::class, 'privacyPolicy']);
Route::get('/shipping-policy', [PolicyController::class, 'shippingPolicy']);
Route::get('/return-refund-policy', [PolicyController::class, 'returnrefundPolicy']);
Route::get('/terms-and-conditions', [PolicyController::class, 'termsConditions']);
Route::get('/search', [ProductController::class, 'search']);

Route::middleware('auth')->group(function () {
    Route::resource('/product', ProductController::class);
    Route::resource('/cart', CartController::class);
    Route::resource('/myorder', MyorderController::class);
    Route::get('/order/{billno}/invoice', [MyOrderController::class, 'downloadInvoice'])->name('order.invoice');
    Route::resource('/shipping', ShippingController::class);
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
});

Route::get('/product/create', [ProductController::class, 'create'])
    ->middleware(AdminMiddleware::class);

Route::middleware(AdminMiddleware::class)->group(
    function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/orders', [AdminController::class, 'orders']);
        Route::patch('/admin/orders/{id}', [MyorderController::class, 'update']);
        Route::get('/admin/orders/{billno_id}', [AdminController::class, 'show']);
    }
);
