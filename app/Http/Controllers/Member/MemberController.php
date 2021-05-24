<?php

namespace App\Http\Controllers\Member;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
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
            //Kosongkan carts
            $carts = [];
            // simpan dalam cookie lagi.
            $cookie = cookie('bakulsepatu', json_encode($carts), 2880);

            return redirect()->route('member.invoice', $order->invoice)->cookie($cookie);
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with(['error' => $th->getMessage()]);
        }

    }

    public function getOrder()
    {
        $id = auth('member')->id();
        $orders = Order::where('member_id', $id)->get();

        return view('member.order', compact('orders'));
    }

    public function getInvoice($invoice)
    {
        $order = Order::with('order_details')->where('invoice', $invoice)->where('member_id', auth('member')->id())->first();

        if(!$order) {
            return redirect()->route('member.order');
        }

        return view('member.invoice', compact('order'));
    }

    // Konfirmasi Bukti Pembayaran
    public function confirmPayment(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
            'name' => 'required|string|max:100',
            'name_bank' => 'required|string|max:50',
            'number_bank' => 'required|numeric',
            'date_transfer' => 'required|date',
            'total' => 'required|integer',
            'order_id' => 'required|integer',
        ]);

        $imageName = Helper::uploadImage($request->image, null, 'payment');

        Payment::create([
            'order_id' => $request->order_id,
            'name_transfer' => $request->name,
            'name_bank' => $request->name_bank,
            'number_bank' => $request->number_bank,
            'date_transfer' => $request->date_transfer,
            'total' => $request->total,
            'image_transfer' => $imageName,
            'status' => false,
        ]);

        return redirect()->back()->with('info', 'Bukti pembayaran berhasil dikirim, silakan tunggu beberapa saat untuk dilakukan pengecekan oleh admin kami');

    }
}
