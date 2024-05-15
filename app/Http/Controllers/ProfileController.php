<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function show()
    {
        $orders = auth()->user()->orders()->with('items.product')->get();

        return view('profile', compact("orders"));
    }
}
