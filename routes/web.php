<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
// เส้นทางที่เข้าถึงได้โดยไม่ต้องล็อกอิน
Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [ProductController::class, 'showWelcomePage'])->name('welcome');
// Route สำหรับการค้นหาปกติ ที่อาจต้องการการเข้าสู่ระบบ
Route::get('/search', [ProductController::class, 'search'])->name('humanShop.search');

// Group สำหรับการเข้าถึงที่ต้องมีการล็อกอิน
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/bio', [UserController::class, 'showBio'])->name('profile.show-bio');
    Route::patch('/profile/bio', [UserController::class, 'updateBio'])->name('profile.update-bio');
    Route::post('/profile/photo/update', [UserController::class, 'updateProfilePhoto'])->name('profile.photo.update');
    Route::get('/member', function () {
        return view('member');
    })->middleware(['auth', 'verified'])->name('member');

    // Product routes
    Route::get('/products', [ProductController::class, 'showProduct'])->name('humanShop.shoplist');
    Route::get('/products/{productId}/reviews', [ProductController::class, 'showReviews'])->name('humanShop.review');
    Route::post('/products/{productId}/reviews', [ProductController::class, 'storeReview'])->name('humanShop.review.store');

    // Cart and order routes
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
    Route::get('/addtocart/{productId}/{quantity}', [CartController::class, 'addToCart'])->name('addtocart');
    Route::get('/decreasefromcart/{productId}/{quantity}', [CartController::class, 'decreaseFromCart'])->name('decreasefromcart');
    Route::get('/removefromcart/{productId}', [CartController::class, 'removeFromCart'])->name('removefromcart');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{orderId}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/save-customer-info', [CartController::class, 'saveCustomerInfo'])->name('saveCustomerInfo');
    Route::get('/humanShop', [ProductController::class, 'index'])->name('humanShop.index');

});

require __DIR__ . '/auth.php';


