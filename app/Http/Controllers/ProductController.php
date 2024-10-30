<?php
namespace App\Http\Controllers;
use App\Models\Products;  // Use singular for model names (standard convention)
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    // Display a listing of products
    public function showProduct()
    {
        $products = Products::with('reviews.user')->get(); // Eager load reviews and their associated user
        return view('humanShop.shoplist', compact('products'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        // ค้นหาสินค้าที่ตรงกับคำค้นหาใน productName
        $products = Products::with('reviews.user')
            ->whereRaw('LOWER(productName) LIKE ?', ['%' . strtolower($query) . '%'])
            ->get();

        // ถ้าไม่พบผลลัพธ์ ให้ค้นหาสินค้าที่มีชื่อใกล้เคียงหรือสินค้ายอดนิยมเป็นคำแนะ��ำ
        if ($products->isEmpty()) {
            // ค้นหาคำแนะนำโดยแสดงสินค้าที่มีชื่อคล้ายกับคำค้นหา (แต่ไม่ตรงเป๊ะ)
            $suggestions = Products::whereRaw('LOWER(productName) LIKE ?', ['%' . substr(strtolower($query), 0, 3) . '%'])
                ->limit(5) // จำกัดคำแนะนำไม่เกิน 5 ชิ้น
                ->get();

            // ส่งคำแนะนำไปยัง View พร้อมกับแสดงข้อความไม่พบผลลัพธ์
            return view('humanShop.shoplist', [
                'products' => $products,
                'suggestions' => $suggestions,
                'error' => 'No products found matching your search. Here are some suggestions:'
            ]);
        }

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
    public function index(Request $request)
    {
        $sort = $request->query('sort', '');

        // เรียงลำดับตามตัวเลือก
        $query = Products::query();

        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('productName', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('productName', 'desc');
                break;
            default:
                // หากไม่มีการจัดเรียงจะใช้ค่า default
                break;
        }

        $products = $query->get();

        return view('humanShop.shoplist', compact('products'));
    }
    public function showWelcomePage()
    {
        // Fetch top-rated products based on average rating
        $topRatedProducts = Products::with(['reviews'])
            ->select('products.*', DB::raw('AVG(reviews.rating) as average_rating'))
            ->join('reviews', 'products.productId', '=', 'reviews.productId')
            ->groupBy('products.productId')
            ->orderByDesc('average_rating')
            ->take(8)
            ->get();

        // Pass the variable to the welcome view
        return view('welcome', compact('topRatedProducts'));
    }
}

