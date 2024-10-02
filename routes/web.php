<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiaryEntryController;
use App\Http\Controllers\ProductController;

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
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route to show the bio page
    Route::get('/profile/bio', [UserController::class, 'showBio'])->name('profile.show-bio');
    // Route to handle updating the bio
    Route::patch('/profile/bio', [UserController::class, 'updateBio'])->name('profile.update-bio');
    // Route to show the type page
    Route::get('/profile/type', [UserController::class, 'showType'])->name('profile.show-type');
    // Route to handle updating type
    Route::patch('/profile/type', [UserController::class, 'updateType'])->name('profile.update-type');
    Route::get('/display_diary', [DiaryEntryController::class, 'display_diary'])->name('diary.display_diary');
    Route::get('/diary_count', [DiaryEntryController::class, 'diary_count'])->name('diary.diary_count');
    Route::get('/get_conflict', [DiaryEntryController::class, 'get_conflict'])->name('diary.get_conflict');
    Route::resource('diary', DiaryEntryController::class); //add this
    //name  ด้านหลัง คือไปอ่านมาว่าจะให้ไป ดู php จากไฟล์ ไหนใน view
    Route::get('/products', [ProductController::class, 'index'])->name('humanShop.shoplist');  // Use index method

    Route::get('/cart', [CartController::class, 'index'])->name('cart');

});

Route::post('/profile/photo/update', [UserController::class, 'updateProfilePhoto'])->name('profile.photo.update');

require __DIR__ . '/auth.php';

