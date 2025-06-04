<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Material;
use App\Models\Size;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected $sessionKey = 'shopping_cart';

    /**
     * Add item to cart
     */
    public function add($productId, $materialId = null, $sizeId = null, $quantity = 1)
    {
        $product = Product::findOrFail($productId);
        $material = $materialId ? Material::find($materialId) : null;
        $size = $sizeId ? Size::find($sizeId) : null;

        // Calculate price with adjustments
        $basePrice = $product->sale_price ?? $product->price;
        $price = $product->getFinalPrice($materialId, $sizeId);

        // Create unique cart item key
        $cartKey = $this->generateCartKey($productId, $materialId, $sizeId);

        $cart = $this->get();

        if (isset($cart[$cartKey])) {
            // Update quantity if item already exists
            $cart[$cartKey]['quantity'] += $quantity;
            $cart[$cartKey]['total'] = $cart[$cartKey]['quantity'] * $cart[$cartKey]['price'];
        } else {
            // Add new item
            $cart[$cartKey] = [
                'id' => $cartKey,
                'product_id' => $productId,
                'product_name' => $product->name,
                'product_photo' => $product->photo_url,
                'material_id' => $materialId,
                'material_name' => $material ? $material->name : null,
                'size_id' => $sizeId,
                'size_name' => $size ? $size->name : null,
                'quantity' => $quantity,
                'price' => $price,
                'base_price' => $basePrice,
                'total' => $price * $quantity,
            ];
        }

        $this->save($cart);

        return $cart[$cartKey];
    }

    /**
     * Get all cart items
     */
    public function get()
    {
        return Session::get($this->sessionKey, []);
    }

    /**
     * Update item quantity
     */
    public function update($cartKey, $quantity)
    {
        $cart = $this->get();

        if (isset($cart[$cartKey])) {
            if ($quantity <= 0) {
                unset($cart[$cartKey]);
            } else {
                $cart[$cartKey]['quantity'] = $quantity;
                $cart[$cartKey]['total'] = $cart[$cartKey]['price'] * $quantity;
            }

            $this->save($cart);
        }

        return $cart;
    }

    /**
     * Remove item from cart
     */
    public function remove($cartKey)
    {
        $cart = $this->get();
        unset($cart[$cartKey]);
        $this->save($cart);

        return $cart;
    }

    /**
     * Clear entire cart
     */
    public function clear()
    {
        Session::forget($this->sessionKey);
    }

    /**
     * Get cart totals
     */
    public function getTotals()
    {
        $cart = $this->get();
        $subtotal = 0;
        $itemCount = 0;

        foreach ($cart as $item) {
            $subtotal += $item['total'];
            $itemCount += $item['quantity'];
        }

        $tax = $subtotal * 0.08; // 8% tax
        $total = $subtotal + $tax;

        return [
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'item_count' => $itemCount,
        ];
    }

    /**
     * Check if cart is empty
     */
    public function isEmpty()
    {
        return empty($this->get());
    }

    /**
     * Get cart item count
     */
    public function count()
    {
        $cart = $this->get();
        return array_sum(array_column($cart, 'quantity'));
    }

    /**
     * Generate unique cart key for item
     */
    protected function generateCartKey($productId, $materialId = null, $sizeId = null)
    {
        return $productId . '_' . ($materialId ?? 'none') . '_' . ($sizeId ?? 'none');
    }

    /**
     * Save cart to session
     */
    protected function save($cart)
    {
        Session::put($this->sessionKey, $cart);
    }
}