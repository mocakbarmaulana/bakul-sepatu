<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Whistlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function setWhislist($id)
    {

        $idMember = auth('member')->id();
        $wishlist = Whistlist::where('product_id', $id)->where('member_id', $idMember)->first();

        if($wishlist) {
            return redirect()->back()->with('warning', 'Produk sudah ada didalam wishlist');
        }
        Whistlist::create([
            'product_id' => $id,
            'member_id' => auth('member')->id(),
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan produk ke wishlist');
    }

    public function removeWhislist($id)
    {
        Whistlist::destroy($id);

        return redirect()->back();
    }

    public function setCheckout(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'address' => 'required|string',
            'number_phone' => 'required|numeric',
            'total' => 'required|integer',
        ]);

        // Initiasi Database Transaction
        DB::beginTransaction();
        try {

             //JIKA DIA TIDAK LOGIN DAN DATA CUSTOMERNYA ADA
             if (!auth('member')->check()) {
                return redirect(route('customer.login'))->with('info', 'Silahkan Login Terlebih Dahulu');
            }

            //  ambil data cookie carts
            $carts = json_decode(request()->cookie('bakulsepatu'), true);

            // Simpan data orders
            $order = Order::create([
                'invoice' => Str::random(4) . '-' . time(), //INVOICENYA KITA BUAT DARI STRING RANDOM DAN WAKTU
                'member_id' => auth('member')->id(),
                'customer_name' => $request->name,
                'customer_phone' => $request->number_phone,
                'customer_address' => $request->address,
                'subtotal' => $request->total,
                'status' => false,
            ]);

            // Simpan data order_details
            foreach ($carts as $cart) {
                //AMBIL DATA PRODUK BERDASARKAN PRODUCT_ID
                $product = Product::find($cart['product_id']);
                //SIMPAN DETAIL ORDER
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $cart['product_id'],
                    'name_product' => $product->name,
                    'price_product' => $product->price,
                    'size_product' => $cart['product_size'],
                    'qty' => $cart['qty'],
                ]);
            }

            // Jika tidak terjadi error maka commit;
            DB::commit();

            $carts = []; //Kosongkan carts
            // simpan dalam cookie lagi.
            $cookie = cookie('catering-in', json_encode($carts), 2880);

            return redirect()->route('member.invoice', $order->invoice)->cookie($cookie);
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with(['error' => $th->getMessage()]);
        }

    }

    public function getInvoice($invoice)
    {
        $order = Order::where('invoice', $invoice)->first();

        dd($order);

        return view('member.invoice', compact('order'));
    }
}
