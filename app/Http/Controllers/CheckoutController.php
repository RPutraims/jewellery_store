<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Order;
use App\Services\CartService;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $amount = $request->input('amount'); 

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Your Cart Items',
                    ],
                    'unit_amount' => $amount * 100, 
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
        ]);

        // Store the order as pending
        Order::create([
            'stripe_session_id' => $session->id,
            'user_id' => $request->user()->id, 
            'total' => $amount,
            'delivery' => 'standard',
            'address' => '123 Main St', 
            'payment_type' => 'stripe',
        ]);

        return redirect($session->url);
    }



    public function success(Request $request, CartService $cartService)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::retrieve($request->get('session_id'));

        $order = Order::where('stripe_session_id', $session->id)->firstOrFail();
        $order->status = 'paid';
        $order->save();

        $cartService->clear();

        return redirect()->route('cart.index')->with([
            'success' => 'Payment successful! Your order has been placed.',
            'order' => $order
        ]);
    }

    public function cancel()
    {
        return redirect()->route('cart.index')->with('error', 'Payment was cancelled.');
    }
}
