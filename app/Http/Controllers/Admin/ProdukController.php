<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = 'Produk';
        $categories = Category::orderBy('name', 'ASC')->get();
        $products = Product::orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.produk.index', compact('active', 'categories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100|unique:products',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'size' => 'required|string|max:100',
            'price' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imageName = Helper::uploadImage($request->image, null, 'products');

        Product::create([
            'name' => $request->name,
            'images' => $imageName,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'size' => $request->size,
            'status' => false,
        ]);

        return redirect()->back()->with('success', 'Produk baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $active = 'Produk';
        $product = Product::find($id);
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('admin.produk.show', compact('active', 'product', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100|unique:products,name,'.$id,
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'size' => 'required|string|max:100',
            'price' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);


        $product = Product::find($id);
        $imageName = Helper::uploadImage($request->image, $product->images, 'products');

        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->size = $request->size;
        $product->price = $request->price;
        $product->images = $imageName;
        $product->save();

        return redirect()->back()->with('success', 'Produk berhasil diperbaharui');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        Storage::delete('/public/assets/images/products/'.$product->images);
        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }
}
