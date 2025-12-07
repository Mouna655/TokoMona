<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($id)
    {
        $product = \App\Models\Product::find($id);
        return view('product.detail', compact('product'));
    }
}
