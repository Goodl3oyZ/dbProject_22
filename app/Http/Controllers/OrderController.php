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
        // Validate the request data
        $validatedData = $request->validate([
            'customerName' => 'required|string|max:255',
            'customerAddress' => 'required|string|max:500',
            'customerPhone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'customerEmail' => 'required|email|max:255',
            'shippingMethod' => 'required|in:online,delivery',
            'totalAmount' => 'required|numeric|min:0',
        ]);

        // Create a new order
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

        // Check if the orderId is valid
        if (!$order->orderId) {
            return redirect()->back()->with('error', 'Error creating the order.');
        }

        // Get the user's cart
        $cart = Auth::user()->carts;
        if ($cart) {
            foreach ($cart->products as $product) {
                // Log::info('Attaching Product ID: ' . $product->productId . ' to Order ID: ' . $order->orderId);

                // Attach the product to the order
                $order->products()->attach($product->productId, ['quantity' => $product->pivot->quantity]);

                // Update product stock quantity
                $product->stockQuantity -= $product->pivot->quantity;
                $product->save();
            }

            // Clear the cart
            $cart->products()->detach();
        }

        // Redirect to the order summary page
        return redirect()->route('orders.show', ['orderId' => $order->orderId]);
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
