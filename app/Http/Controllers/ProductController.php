<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductMaterial;
use App\Models\ProductSize;
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
        $productsizes = ProductSize::all();
        $productmaterials = ProductMaterial::all();
        $materials = Material::get();
        $sizes = Size::get();
        return view('products.create', [
            'categories' => $categories,
            'productsizes' => $productsizes,
            'materials' => $materials,
            'sizes' => $sizes,
            'productmaterials' => $productmaterials
        ]);
    }

    public function store(Request $request){
        if($request->user()->cannot('create', Product::class)){
            abort(403, 'You are not authorized to create product listings.');
        }

        $validatedData = $request->validate([
            'category_id' => 'required|exists:category,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'photo' => 'required|image|mimes:webp|max:2048',
            'material_ids' => 'required|array|min:1',
            'material_ids.*' => 'exists:material,id',
            'size_ids' => 'required|array|min:1',
            'size_ids.*' => 'exists:size,id',
        ]);

        // Handle file upload
        $photoPath = $request->file('photo')->store('products', 'public');

        $product = Product::create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'sale_price' => $validatedData['sale_price'] ?? null,
            'photo' => $photoPath,
        ]);


        foreach ($validatedData['material_ids'] as $materialId) {
            ProductMaterial::create([
                'product_id' => $product->id,
                'material_id' => $materialId,
            ]);
        }

        // Attach sizes
        foreach ($validatedData['size_ids'] as $sizeId) {
            ProductSize::create([
                'product_id' => $product->id,
                'size_id' => $sizeId,
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function show($id)
    {
        $product = Product::with(['category', 'materials', 'sizes'])->findOrFail($id);

        
        return view('products.show', compact('product'));
    }

    public function edit(Request $request, Product $product){
        if($request->user()->cannot('update', $product)) {
            abort(403, 'You are not allowed to edit this product');
        }

        $categories = Category::all();
        $productsizes = ProductSize::all();
        $productmaterials = ProductMaterial::all();
        $materials = Material::get();
        $sizes = Size::get();

        $product->load(['productMaterials', 'productSizes']);
        
        // Get currently selected materials and sizes for this product
        $selectedMaterials = $product->productMaterials->pluck('material_id')->toArray();
        $selectedSizes = $product->productSizes->pluck('size_id')->toArray();
        
        return view('products.edit', [
            'product' => $product,
            'categories' => $categories,
            'productsizes' => $productsizes,
            'materials' => $materials,
            'sizes' => $sizes,
            'productmaterials' => $productmaterials,
            'selectedMaterials' => $selectedMaterials,
            'selectedSizes' => $selectedSizes
        ]);
    }

    public function update(Request $request, Product $product){
        if($request->user()->cannot('update', $product)){
            abort(403, 'You are not authorized to update this product.');
        }

        $validatedData = $request->validate([
            'category_id' => 'required|exists:category,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'photo' => 'nullable|image|mimes:webp|max:2048',
            'material_ids' => 'required|array|min:1',
            'material_ids.*' => 'exists:material,id',
            'size_ids' => 'required|array|min:1',
            'size_ids.*' => 'exists:size,id',
        ]);

        // Handle file upload if new photo is provided
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($product->photo && Storage::disk('public')->exists($product->photo)) {
                Storage::disk('public')->delete($product->photo);
            }
            
            $photoPath = $request->file('photo')->store('products', 'public');
            $validatedData['photo'] = $photoPath;
        }

        // Update product
        $product->update([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'sale_price' => $validatedData['sale_price'] ?? null,
            'photo' => $validatedData['photo'] ?? $product->photo,
        ]);

        // Delete existing materials and sizes
        ProductMaterial::where('product_id', $product->id)->delete();
        ProductSize::where('product_id', $product->id)->delete();

        // Attach new materials
        foreach ($validatedData['material_ids'] as $materialId) {
            ProductMaterial::create([
                'product_id' => $product->id,
                'material_id' => $materialId,
            ]);
        }

        // Attach new sizes
        foreach ($validatedData['size_ids'] as $sizeId) {
            ProductSize::create([
                'product_id' => $product->id,
                'size_id' => $sizeId,
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product, Request $request)
    {
        if($request->user()->cannot('delete', $product)) {
            abort(403, 'You are not allowed to edit this product');
        }

        $product->productMaterials()->delete();
        $product->productSizes()->delete();

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }


}
