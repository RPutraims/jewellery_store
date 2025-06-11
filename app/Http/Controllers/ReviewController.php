<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display all reviews.
     */
    public function index()
    {
        $reviews = Review::with(['user', 'product'])->latest()->get();
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Display reviews for a specific product.
     */
    public function byProduct($productId)
    {
        $product = Product::with('reviews.user')->findOrFail($productId);
        $reviews = $product->reviews()->latest()->get();
        return view('reviews.by-product', compact('product', 'reviews'));
    }

    /**
     * Show form to create a new review for a product.
     */
    public function create()
    {
        $product = Product::all(); 
        return view('reviews.create', compact('product'));
    }

    /**
     * Store a new review.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:product,id',
            'title' => 'required|string|min:3|max:50',
            'rating' => 'required|integer|min:1|max:5',
            'photo' => 'nullable|image|mimes:webp|max:2048',
        ]);

        $productId = $request->input('product_id');
        // Prevent duplicates
        if (Review::where('user_id', $request->user())->where('product_id', $productId)->exists()) {
            return redirect()->back()->with('error', 'You have already submitted a review for this product.');
        }

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('reviews', 'public');
        }
        Review::create([
            'user_id' => $request->user()->id,
            'product_id' => $request->product_id,
            'title' => $request->title,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
            'photo' => $photoPath,
        ]);

        return redirect()->route('reviews.index')->with('success', 'Review submitted!');
    }

    /**
     * Delete a review (only owner or admin can delete).
     */
    public function destroy($id, Request $request)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== $request->user() && !$request->user()->isAdmin()) {
            abort(403, 'Unauthorized to delete this review.');
        }

        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully.');
    }
}

