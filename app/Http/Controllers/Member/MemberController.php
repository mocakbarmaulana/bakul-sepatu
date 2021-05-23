<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Whistlist;
use Illuminate\Http\Request;

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

    }
}
