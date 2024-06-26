<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::all();

        return view("product.index", compact("products"));
    }

    public function show(Product $product)
    {
        return view("product.show", compact("product"));
    }
}
