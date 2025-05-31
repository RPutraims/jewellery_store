<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function byCategory($id)
    {
        $category = Category::with('products')->findOrFail($id); // eager load products
        $products = $category->products;

        return view('products.by-category', compact('category', 'products'));
    }
}
