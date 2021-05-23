<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getCarts()
    {
        $carts = json_decode(request()->cookie('bakulsepatu'), true);
        $carts = $carts != '' ? $carts:[];
        return $carts;
    }

    public function addToCart(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer',
            'size' => 'required|string',
        ]);


        // Panggil getCarts untuk mengetahui apakah cookie carts sudah ada atau belum.
        $carts = $this->getCarts();


        // check jika carts tidak kosong dan product id ada didalam cart
        if($carts && array_key_exists($request->product_id, $carts)){
            // update qty berdasarkan produk id yand dijadikan key array assoc
            $carts[$request->product_id]['qty'] += $request->qty;
        } else {
            // Jika cart kosong dan belum ada product id
            $product = Product::find($request->product_id);
            // tambahkan data baru ke dalam cart berdasarkan product id sebagai key arraynya.
            $carts[$request->product_id] = [
                'qty' => $request->qty,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_price' => $product->price,
                'product_image' => $product->images,
                'product_size' => $request->size,
            ];
        }

        // buat cookie dengan limit 48 jam.
        $cookie = cookie('bakulsepatu', json_encode($carts), 2880);

        // Kembali ke halaman sebelumnya dengan membawa cookie
        return redirect()->back()->cookie($cookie)->with('info', 'Product berhasil ditambahkan ke cart');
    }

    public function decreaseCart($id)
    {
        $carts = $this->getCarts();

        $carts[$id]['qty'] -= 1;

        if($carts[$id]['qty'] == 0 ){
            unset($carts[$id]);
        };

        $cookie = cookie('bakulsepatu', json_encode($carts), 2880);

        return redirect()->back()->cookie($cookie);
    }

    public function increaseCart($id)
    {
        $carts = $this->getCarts();

        $carts[$id]['qty'] += 1;

        $cookie = cookie('bakulsepatu', json_encode($carts), 2880);

        return redirect()->back()->cookie($cookie);
    }

    public function deleteCart($id)
    {
        $carts = $this->getCarts();

        unset($carts[$id]);

        $cookie = cookie('bakulsepatu', json_encode($carts), 2880);

        return redirect()->back()->cookie($cookie);
    }

    public function showCart()
    {
        $carts = $this->getCarts();

        // UBAH ARRAY MENJADI COLLECTION, KEMUDIAN GUNAKAN METHOD SUM UNTUK MENGHITUNG SUBTOTAL
        $subtotal = collect($carts)->sum(function($q) {
            return $q['qty'] * $q['product_price']; //SUBTOTAL TERDIRI DARI QTY * PRICE
        });

        return view('cart', compact('carts', 'subtotal'));
    }
}
