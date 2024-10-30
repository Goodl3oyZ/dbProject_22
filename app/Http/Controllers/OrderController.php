<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        // Start database transaction
        return DB::transaction(function () use ($request) {
            // Validate the request data
            $validatedData = $request->validate([
                'customerName' => 'required|string|max:255',
                'customerAddress' => 'required|string|max:500',
                'customerPhone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'customerEmail' => 'required|email|max:255',
                'shippingMethod' => 'required|in:cash,credit_card,bank_transfer,promptpay',
                'totalAmount' => 'required|numeric|min:0',
            ]);

            // Get the user's cart
            $cart = Auth::user()->carts;
            if (!$cart || $cart->products->isEmpty()) {
                throw new \Exception('Cart is empty');
            }

            // Verify stock availability for all products
            foreach ($cart->products as $cartProduct) {
                // Lock the product row for update to prevent race conditions
                $product = DB::table('products')
                    ->where('productId', $cartProduct->productId)
                    ->lockForUpdate()
                    ->first();

                if (!$product || $product->stockQuantity < $cartProduct->pivot->quantity) {
                    throw new \Exception("Insufficient stock for product: {$cartProduct->productName}");
                }
            }

            // Create new order
            $order = new Order();
            $order->userId = Auth::id();
            $order->orderDate = now();
            $order->totalAmount = $validatedData['totalAmount'];
            $order->shipping = $validatedData['shippingMethod'];
            $order->shippingAddress = $validatedData['customerAddress'];
            $order->customerName = $validatedData['customerName'];
            $order->customerPhone = $validatedData['customerPhone'];
            $order->customerEmail = $validatedData['customerEmail'];
            $order->save();

            // Process each product in the cart
            foreach ($cart->products as $cartProduct) {
                // Attach product to order
                $order->products()->attach($cartProduct->productId, [
                    'quantity' => $cartProduct->pivot->quantity
                ]);

                // Update stock quantity using query builder
                DB::table('products')
                    ->where('productId', $cartProduct->productId)
                    ->decrement('stockQuantity', $cartProduct->pivot->quantity);
            }

            // Clear the cart
            $cart->products()->detach();

            return redirect()->route('orders.show', ['orderId' => $order->orderId]);
        }, 5);
    }


    public function show($orderId)
    {
        $order = Order::with('products')->find($orderId);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Debugging: Check the products associated with the order
        // dd($order->products);

        return view('orders.show', compact('order'));
    }
}
