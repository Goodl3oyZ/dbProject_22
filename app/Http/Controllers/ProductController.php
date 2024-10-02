<?php
namespace App\Http\Controllers;

use App\Models\Products;  // Use singular for model names (standard convention)
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display a listing of products
    public function index()
    {
        // Get all products from the database
        $products = Products::all();  // Corrected to use the model name directly
        // Return the view and pass products to the view
        return view('humanShop.shoplist', compact('products'));
    }
}

///adddddddadsadadasd
