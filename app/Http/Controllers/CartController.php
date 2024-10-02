<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // รับ user ID หรือใช้ authenticated user
        $user = auth()->user();

        // ดึง cart ของผู้ใช้
        $cart = $user->cart;

        // ดึง product จาก request (หรือใช้ ID ที่ถูกส่งมา)
        $productId = $request->input('productId');
        $quantity = $request->input('quantity', 1); // ค่าเริ่มต้นคือ 1 ถ้าไม่ได้ระบุ

        // หา product
        $product = Products::find($productId);

        if ($product) {
            // เพิ่มสินค้าลงในตะกร้าด้วยจำนวนที่ต้องการ
            $cart->products()->attach($product->id, ['quantity' => $quantity]);

            return response()->json([
                'message' => 'Product added to cart successfully!',
            ]);
        }

        return response()->json([
            'message' => 'Product not found!',
        ], 404);
    }
    public function index()
    {
        // Get all products in cart  from the database
        $carts = Cart::all();  // Corrected to use the model name directly
        return view('cart', compact('carts'));
    }

}
