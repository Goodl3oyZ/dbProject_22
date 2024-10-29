<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    //Route:: get/patch -  เหมือน โชว์ / อัพเดต
    //โดย ผ่าน Controller ที่มี  method ว่าอะไร 
    //แล้ว จะตั้งชื่อ เส้นทางในการถูก เอาไปเรียกใช้ว่ายังไง ex เรียกใช้ แบบ href="{{ route('dashboard') }}" or "{{route('profile.edit')}}"
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //ทำงานเมื่อเกิดการเปลี่ยนรูป
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //ทำงานเมื่อลบ user 
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route to show the bio page
    Route::get('/profile/bio', [UserController::class, 'showBio'])->name('profile.show-bio');
    // Route to handle updating the bio
    Route::patch('/profile/bio', [UserController::class, 'updateBio'])->name('profile.update-bio');
    //name  ด้านหลัง คือไปอ่านมาว่าจะให้ไป ดู php จากไฟล์ ไหนใน view
    Route::get('/products', [ProductController::class, 'showProduct'])->name('humanShop.shoplist');  // Use index method
    // test method
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart');  // Use index
    Route::get('/addtocart/{productId}/{quantity}', [CartController::class, 'addToCart'])->name('addtocart');
    Route::get('/decreasefromcart/{productId}/{quantity}', [CartController::class, 'decreaseFromCart'])->name('decreasefromcart');
    Route::get('/removefromcart/{productId}', [CartController::class, 'removeFromCart'])->name('removefromcart');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{orderId}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/save-customer-info', [CartController::class, 'saveCustomerInfo'])->name('saveCustomerInfo');
    Route::get('/products/{productId}/reviews', [ProductController::class, 'showReviews'])->name('humanShop.review');
    Route::post('/products/{productId}/reviews', [ProductController::class, 'storeReview'])->name('humanShop.review.store');

});
Route::post('/profile/photo/update', [UserController::class, 'updateProfilePhoto'])->name('profile.photo.update');

// เพิ่ม route นี้ในกลุ่ม middleware auth
Route::get('/member', function () {
    return view('member');
})->middleware(['auth', 'verified'])->name('member');

require __DIR__ . '/auth.php';

