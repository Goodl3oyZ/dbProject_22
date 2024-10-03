<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Log;
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
        $user = Auth::user();
        $cart = $user->carts;
        $products = $cart ? $cart->products : [];

        // Validate the customer data and shipping method
        $validatedData = $request->validate([
            'customerName' => 'required|string|max:255',
            'customerAddress' => 'required|string|max:500',
            'customerPhone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'customerEmail' => 'required|email|max:255',
            'shippingMethod' => 'required|in:online,delivery',
            'totalAmount' => 'required|numeric|min:0', // Validate the total amount
        ]);

        // Use the totalAmount passed from the cart page
        $totalAmountAfterDiscount = $validatedData['totalAmount'];

        // Reduce stock
        foreach ($products as $product) {
            $quantity = $product->pivot->quantity;
            if ($product->stockQuantity >= $quantity) {
                $product->stockQuantity -= $quantity;
                $product->save();
            } else {
                return redirect()->back()->with('error', 'Not enough stock for ' . $product->productName);
            }
        }

        // Create a new order
        $order = new Order();
        $order->userId = $user->id;
        $order->orderDate = now();
        $order->totalAmount = $totalAmountAfterDiscount; // Use the total amount from the form
        $order->shipping = $validatedData['shippingMethod'];
        $order->save();

        // Attach products to the order
        foreach ($cart->products as $product) {
            $order->products()->attach($product->id, ['quantity' => $product->pivot->quantity]);
        }

        // Clear the cart
        $cart->products()->detach();

        // Redirect to the order details page
        return redirect()->route('orders.show', ['orderId' => $order->id]);
    }


    public function show($orderId)
    {
        $order = Order::with('products')->find($orderId);
        return view('orders.show', compact('order'));
    }


}

