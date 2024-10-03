<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Retrieve the orders for the authenticated user
        $orders = Order::where('userId', $user->id)->orderBy('orderDate', 'desc')->get();

        return view('orders.index', compact('orders'));
    }
    public function checkout(Request $request)
    {
        // ตรวจสอบข้อมูลที่ได้รับจากฟอร์ม
        $validatedData = $request->validate([
            'customerName' => 'required|string|max:255',
            'customerAddress' => 'required|string|max:500',
            'customerPhone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'customerEmail' => 'required|email|max:255',
            'shippingMethod' => 'required|in:online,delivery',
            'totalAmount' => 'required|numeric|min:0',
        ]);

        // สร้างคำสั่งซื้อใหม่ (Order)
        $order = new Order();
        $order->userId = Auth::id(); // บันทึก ID ของผู้ใช้
        $order->orderDate = now();
        $order->totalAmount = $validatedData['totalAmount'];
        $order->shipping = $validatedData['shippingMethod'];
        $order->shippingAddress = $validatedData['customerAddress'];
        $order->customerName = $validatedData['customerName'];
        $order->customerPhone = $validatedData['customerPhone'];
        $order->customerEmail = $validatedData['customerEmail'];
        $order->save(); // บันทึกข้อมูลลงในฐานข้อมูล

        // ตรวจสอบว่า orderId ถูกต้องหรือไม่
        if (!$order->orderId) {
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการสร้างคำสั่งซื้อ');
        }

        // เพิ่มสินค้าในตะกร้าไปยังคำสั่งซื้อ
        $cart = Auth::user()->carts;
        if ($cart) {
            foreach ($cart->products as $product) {
                // แนบสินค้าไปยังคำสั่งซื้อ
                $order->products()->attach($product->id, ['quantity' => $product->pivot->quantity]);

                // หักลบสต็อกสินค้าตามจำนวนที่สั่งซื้อ
                $product->stockQuantity -= $product->pivot->quantity;
                $product->save();
            }

            // ล้างตะกร้าสินค้า
            $cart->products()->detach();
        }

        // เปลี่ยนเส้นทางไปยังหน้าสรุปคำสั่งซื้อ
        return redirect()->route('orders.show', ['orderId' => $order->orderId]);
    }
    public function show($orderId)
    {
        $order = Order::with('products')->find($orderId);
        return view('orders.show', compact('order'));
    }


}

