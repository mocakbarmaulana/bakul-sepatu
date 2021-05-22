<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function home()
    {
        return view('home');
    }

    public function getMenu()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(9);
        return view('menu', compact('products'));
    }

    public function produkDetail($id)
    {
        $product = Product::find($id);
        $size = explode(',', $product->size);

        return view('produk-detail', compact('product', 'size'));
    }
}
