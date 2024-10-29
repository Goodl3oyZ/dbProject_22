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
        try {
            // Validate input first
            $validated = $request->validate([
                'rating_' . $productId => 'required|integer|min:1|max:5',
                'comment_' . $productId => 'nullable|string|max:255', // Increased max length to be more reasonable
            ]);

            $user = Auth::user();
            
            // Check if the user has purchased the product
            $orderCount = $user->order()
                ->whereHas('products', function ($query) use ($productId) {
                    $query->where('products.productId', $productId);
                })
                ->count();

            if ($orderCount <= 0) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'You can only review products you have purchased.');
            }

            // Check for existing reviews
            $reviewCount = $user->review()
                ->where('productId', $productId)
                ->count();
                
            if ($reviewCount >= $orderCount) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'You have already reviewed this product the maximum number of times.');
            }

            // Create the review
            Review::create([
                'userId' => $user->id,
                'productId' => $productId,
                'rating' => $validated['rating_' . $productId],
                'comment' => $validated['comment_' . $productId] ?? null,
            ]);

            return redirect()
                ->back()
                ->with('success', 'Review submitted successfully!');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'An error occurred while submitting your review. Please try again.');
        }
    }
    public function showReviews($productId)
    {
        $product = Products::with('reviews.user')->findOrFail($productId);
        return view('humanShop.review', compact('product'));
    }




}

