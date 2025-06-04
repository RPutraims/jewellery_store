<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Material;
use App\Models\Size;
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

    public function index(){
        $products = Product::get();
        $materials = Material::get();
        $size = Size::get();
        return view('products.index', compact('products'));
    }

    public function create(Request $request){
        if($request->user()->cannot('create', Product::class)) {
            abort(403, 'You are not allowed to create products');
        }


        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request){
        if($request->user()->cannot('create', Product::class)){
            abort(403, 'You are not authorized to create job listings.');
        }

        $validatedData = $request->validate([
            'category_id' => 'required|exists:category,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'photo' => 'required|image|mimes:webp|max:2048',
        ]);

        // Handle file upload
        $photoPath = $request->file('photo')->store('products', 'public');

        Product::create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'sale_price' => $validatedData['sale_price'] ?? null,
            'photo' => $photoPath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function show($id)
    {
        $product = Product::with(['category', 'material', 'size'])->findOrFail($id);
        
        return view('products.show', compact('product'));
    }


}
