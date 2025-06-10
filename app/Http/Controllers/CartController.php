<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display cart page
     */
    public function index()
    {
        $cart = $this->cartService->get();
        $totals = $this->cartService->getTotals();

        return view('products.cart', compact('cart', 'totals'));
    }

    /**
     * Add item to cart
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:product,id',
            'material_id' => 'nullable|exists:material,id',
            'size_id' => 'nullable|exists:size,id',
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        try {
            $cartItem = $this->cartService->add(
                $validated['product_id'],
                $validated['material_id'] ?? null,
                $validated['size_id'] ?? null,
                $validated['quantity']
            );

            return back()->with('success', 'Product added to cart successfully!');
        } catch (\Exception $e) {
            dd($e->getMessage(), $e->getFile(), $e->getLine());
            //return back()->with('error', 'Failed to add product to cart. Please try again.');
        }
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, $cartKey)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:0|max:99',
        ]);

        $this->cartService->update($cartKey, $validated['quantity']);

        if ($request->ajax()) {
            $totals = $this->cartService->getTotals();
            return response()->json([
                'success' => true,
                'totals' => $totals
            ]);
        }

        return back()->with('success', 'Cart updated successfully!');
    }

    /**
     * Remove item from cart
     */
    public function remove($cartKey)
    {
        $this->cartService->remove($cartKey);

        return back()->with('success', 'Item removed from cart!');
    }

    /**
     * Clear entire cart
     */
    public function clear()
    {
        $this->cartService->clear();

        return back()->with('success', 'Cart cleared successfully!');
    }

    /**
     * Get cart count for AJAX requests
     */
    public function count()
    {
        return response()->json([
            'count' => $this->cartService->count()
        ]);
    }
}