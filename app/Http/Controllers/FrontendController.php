<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Whistlist;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function home()
    {
        $products = Product::inRandomOrder()->limit(4)->get();
        return view('home', compact('products'));
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
        $wishlist = Whistlist::where('product_id', $id)->where('member_id', auth('member')->id())->first();

        return view('produk-detail', compact('product', 'size', 'wishlist'));
    }
}
