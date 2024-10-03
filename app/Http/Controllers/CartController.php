<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function showCart()
    {
        // Fetch the user's cart
        $cart = Auth::user()->carts;
        $user = Auth::user();
        // Check if the user has a cart
        if (!$cart) {
            return view('cart', ['products' => [], 'cartEntries' => []]);
        }

        // Get products in the user's cart
        $products = $cart->products()->get();

        // Return the view and pass the products to the view
        return view('cart', compact('products', 'user'));
    }

    public function addToCart($productId, $quantity)
    {
        // ตรวจสอบผู้ใช้ที่ล็อกอินอยู่
        $user = Auth::user();

        // ค้นหาตะกร้าของผู้ใช้ หรือสร้างใหม่หากยังไม่มี
        $cart = $user->carts; // เนื่องจากเป็น hasOne ใช้ carts() โดยไม่ต้องใส่วงเล็บเพื่อเรียกใช้ความสัมพันธ์

        // ตรวจสอบว่า $cart ถูกสร้างขึ้นแล้วและมีค่า
        if (!$cart) {
            $cart = Cart::create(['userId' => $user->id, 'amount' => 0]);
        }

        // ค้นหาสินค้า
        $product = Products::find($productId);

        // ตรวจสอบว่าสินค้ามีเพียงพอ
        if ($product->stockQuantity < $quantity) {
            return redirect()->back()->with('error', 'สินค้ามีไม่เพียงพอ');
        }

        // เพิ่มสินค้าลงตะกร้าหรือปรับจำนวน
        $cart->products()->syncWithoutDetaching([
            $productId => ['quantity' => $quantity]
        ]);

        // อัปเดตสต็อกสินค้า
        $product->stockQuantity -= $quantity;
        $product->save();

        return redirect()->back()->with('success', 'เพิ่มสินค้าลงในตะกร้าเรียบร้อยแล้ว');
    }
    public function decreaseFromCart($productId, $quantity)
    {
        $user = Auth::user();
        $cart = $user->carts;

        if ($cart) {
            // Get the product in the cart
            $product = $cart->products()->where('productId', $productId)->first(); // Use 'productId' instead of 'product_id'

            if ($product) {
                // Decrease quantity in cart
                $newQuantity = $product->pivot->quantity - $quantity;

                if ($newQuantity > 0) {
                    // Update the quantity in the cart
                    $cart->products()->updateExistingPivot($productId, ['quantity' => $newQuantity]);

                    // Increase the stock in the product table
                    $product->stockQuantity += $quantity;
                    $product->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Quantity decreased and stock updated.');
    }

    public function removeFromCart($productId)
    {
        $user = Auth::user();
        $cart = $user->carts;

        if ($cart) {
            // Get the product in the cart
            $product = $cart->products()->where('productId', $productId)->first(); // Use 'productId' instead of 'product_id'

            if ($product) {
                // Return the quantity to stock
                $product->stockQuantity += $product->pivot->quantity;
                $product->save();

                // Remove the product from the cart
                $cart->products()->detach($productId);
            }
        }

        return redirect()->back()->with('success', 'Product removed from the cart and stock updated.');
    }



}
