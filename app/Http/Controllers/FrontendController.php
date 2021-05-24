<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

    public function getMenu(Request $request)
    {
        $q = $request->q;

        // $courses = Course::when($request->q, function($q, $request){
        //     $q->where('skill_id', $request);
        // })->withCount('orders')->where('status', 0)->paginate(12);

        $products = Product::when($request->q, function($q, $request){
            $q->where('category_id', $request);
        })->where('status', 0)->paginate(12);
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('menu', compact('products', 'categories', 'q'));
    }

    public function produkDetail($id)
    {
        $product = Product::find($id);
        $size = explode(',', $product->size);
        $wishlist = Whistlist::where('product_id', $id)->where('member_id', auth('member')->id())->first();

        return view('produk-detail', compact('product', 'size', 'wishlist'));
    }
}
