<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function submitRequest(Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required|string',
            'productId' => 'required|exists:products,id'
        ]);

        $newRequest = new Order([
            'phone_number' => $request->phoneNumber,
            'product_id' => $request->productId,
            'user_id' => auth()->id(),
        ]);
        $newRequest->save();

        return redirect()->route('products')->with('success', "Заявка успешно отправлена");
    }

    public function orders()
    {
        $user_id = Auth::user()->id;
        $orders = Order::with("product", "user")->where("user_id", $user_id)->get();

        return view("orders", compact("orders"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'author' => 'required|string',
            'text' => 'required|string'
        ]);

        $newRequest = new Post([
            'author' => $request->author,
            'text' => $request->text,
            'likes_count' => 0
        ]);
        $newRequest->save();

        return redirect()->route("post.index");
    }

    public function create()
    {
        return view("order.create");
    }

    public function checkout(Request $request)
    {
        $products = json_decode($request->input('products'), true);


        if (empty($products)) return redirect('/')->with('error', 'Нет выбранных продуктов для оформления заказа.');

        $products = array_map(function ($product) {
            return array_merge($product,
                [
                    'quantity' => $product['quantity'] ?? 1,
                ]
            );
        }, $products);

        $total_price = 0;

        foreach ($products as $product) $total_price += $product['price'] * $product['quantity'];

        return view('order.checkout', compact('products', 'total_price'));
    }

    public function processProductOrder(Request $request)
    {
        try {
            $products = json_decode($request->input('products'), true);

            $order = new Order([
                'user_id' => auth()->user()->id,
                'fullname' => $request->fullname,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
            ]);
            $order->save();

            foreach ($products as $product) {
                $order->items()->create([
                    'order_id' => $order->id,
                    'product_id' => $product["id"],
                    'quantity' => $product["quantity"],
                    'amount' => $product["amount"],
                    'price' => $product["price"],
                ]);

                CartItem::where([
                    "cart_id" => auth()->user()->cart->id,
                    "product_id" => $product["id"],
                    "amount" => $product["amount"]
                ])->delete();
            }

            return redirect()->route('order.success', $order)->with('success', "Заказ успешно сформирован");
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Ошибка при формировании заказа: ' . $e->getMessage());
        }
    }

    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);

        if (auth()->id() !== $order->user_id) abort(403, 'Нет прав для просмотра этого заказа');

        return view('order.success', compact('order'));
    }
}
