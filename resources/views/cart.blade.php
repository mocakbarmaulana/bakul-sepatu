@extends('layouts.app')

@section('head')
{{-- My css --}}]
<link rel="stylesheet" href="{{asset('asset/css/cart.css')}}">
<title>Cart</title>
@endsection

@section('main-content')
<!-- Cart Page -->
<section class="cart-page">
    <h1>Cart</h1>
    <div class="container-cart">
        <div class="items-info">
            <h2>Your Order</h2>
            <h5>Please select the quantity below</h5>
            @forelse ($carts as $cart)
            <div class="list-cart-container">
                <div class="card-list-cart">
                    <div class="img-list">
                        <img src="{{asset('storage/assets/images/products/'.$cart['product_image'])}}" alt="img-produk"
                            width="100%" height="100%">
                    </div>
                    <div class="title-list">
                        <h3>{{$cart['product_name']}}</h3>
                        <b>(Size : {{$cart['product_size']}})</b>
                    </div>
                    <div class="price-list">
                        <p>IDR.{{number_format($cart['product_price'])}}</p>
                    </div>
                    <div class="qty-container">
                        <button class="btnDecreaseCart btn-update" data-idproduk="{{$cart['product_id']}}"> - </button>
                        <span>{{$cart['qty']}}</span>
                        <button class="btnIncreaseCart btn-update" data-idproduk="{{$cart['product_id']}}"> + </button>
                    </div>
                    <div class="delete-list">
                        <form action="{{route('cart.delete', $cart['product_id'])}}" method="post">
                            @csrf
                            <button type="submit" class="btn-delete"><i class="fas fa-trash fa-2x"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-cart">
                <p>tidak ada data</p>
            </div>
            @endforelse
        </div>
        <div class="user-info">
            <form action="{{route('member.setcheckout')}}" method="POST">
                @csrf
                <input type="hidden" name="total" value="{{$subtotal}}">
                <h2>Cart Totals</h2>
                <div class="row-box-user">
                    <div class="info-text-user">
                        <h5 class="subtitle">Subtotals</h5>
                        <h5>: IDR.{{number_format($subtotal)}}</h5>
                    </div>
                    <div class="info-text-user">
                        <h5 class="subtitle">Shipping</h5>
                        <h5>
                            : *Free Shipping
                            <br>
                            <small style="opacity: 0.3">(semua produk selalu gratis ongkir)</small>
                        </h5>
                    </div>
                    <div class="input-box-user">
                        <h5 class="title-input">Nama Penerima</h5>
                        <input name="name" type="text" class="input-box" value="{{old('name')}}" required>
                    </div>
                    <div class="input-box-user">
                        <h5 class="title-input">Alamat Lengkap Penerima</h5>
                        <textarea name="address" class="input-box" style="height: 100px"
                            required>{{old('address')}}</textarea>
                    </div>
                    <div class="input-box-user">
                        <h5 class="title-input">Nomor Handphone Penerima</h5>
                        @error('number_phone')
                        <small style="color: crimson">Nomor handphone haruslah yang benar</small>
                        @enderror
                        <input name="number_phone" type="text" class="input-box" value="{{old('number_phone')}}"
                            required>
                    </div>
                </div>
                <div class="row-total">
                    <h3>Total :</h3>
                    <h3>IDR.{{number_format($subtotal)}}</h3>
                </div>
                <div class="buttons row-button">
                    <button type="submit" class="button btn-checkout">Checkout</button>
                    <a class="link-a" href="#">Continue Shopping</a>
                </div>
            </form>
        </div>
    </div>
</section>

{{-- Form Decrease  --}}
<form action="" method="POST" style="display: none" id="form-update-cart">
    @csrf
</form>
@endsection

@section('js')
<script>
    $(".btnDecreaseCart").on("click", function(){
        const id = $(this)[0].dataset.idproduk;
        $("#form-update-cart").attr('action', `/cart/decrease/${id}`).submit();
    })

    $(".btnIncreaseCart").on("click", function(){
        const id = $(this)[0].dataset.idproduk;
        $("#form-update-cart").attr('action', `/cart/increase/${id}`).submit();
    })
</script>
@endsection
