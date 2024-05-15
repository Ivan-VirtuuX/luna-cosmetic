<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{

    public function show()
    {
        $cart_products = [];

        if (auth()->check()) {
            $user = auth()->user();

            $cart_items = $user->cart->items()->with('product')->get();

            $cart_products = $cart_items->transform(function ($item) {
                return [
                    'product' => $item,
                ];
            });
        }

        return view('cart', compact('cart_products'));
    }

    public function add(Request $request)
    {
        $product_id = $request->product_id;
        $amount = $request->amount;
        $price = $request->price;

        $user = auth()->user();
        $cart = $user->cart;

        if (!$cart->items()->where([
            ['product_id', '=', $product_id],
            ['amount', '=', $amount]
        ])->exists()) {
            $cart->items()->create([
                'product_id' => $product_id,
                'quantity' => 1,
                'amount' => $amount,
                'price' => $price
            ]);
        }

        return back()->with('success', 'Product added to cart successfully');
    }

    public function remove(Request $request)
    {
        $product_id = $request->product_id;

        $user = auth()->user();
        $cart = $user->cart;

        $cart->items()->where([
            ['product_id', '=', $product_id],
            ['amount', '=', $request->amount]
        ])->delete();

        return response()->json(['success' => true, 'message' => 'Product removed from cart successfully']);
    }

    public function get()
    {
        $user = auth()->user();

        $cartItems = $user->cart->items()->with('product')->get()->map(function ($item) {
            return [
                'id' => $item->product_id,
                'title' => $item->product->title,
                'desc' => $item->product->desc,
                'amount' => $item->amount,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'imageUrl' => $item->product->image_url
            ];
        });

        return response()->json($cartItems);
    }
}
