<?php
namespace App\Http\Controllers;
use App\Models\Products;  // Use singular for model names (standard convention)
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Display a listing of products
    public function showProduct()
    {
        $products = Products::with('reviews.user')->get(); // Eager load reviews and their associated user
        return view('humanShop.shoplist', compact('products'));
    }
    public function storeReview(Request $request, $productId)
    {
        // Check if the user has purchased the product
        $user = Auth::user();
        $orderCount = $user->order()->whereHas('products', function ($query) use ($productId) {
            $query->where('products.productId', $productId);
        })->count();

        if ($orderCount <= 0) {
            // User has not purchased this product, so deny the review
            return redirect()->back()->with('error', 'You can only review products you have purchased.');
        }
        // Check if the number of reviews does not exceed the number of orders containing the product
        $reviewCount = $user->review()->where('productId', $productId)->count();
        if ($reviewCount >= $orderCount) {
            return redirect()->back()->with('error', 'You have already reviewed this product the maximum number of times.');
        }
        // Validate input
        $request->validate([
            'rating_' . $productId => 'required|integer|min:1|max:5',
            'comment_' . $productId => 'nullable|string|max:20',
        ]);

        // Create a new review
        Review::create([
            'userId' => $user->id,
            'productId' => $productId,
            'rating' => $request->input('rating_' . $productId),
            'comment' => $request->input('comment_' . $productId),
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }




}

