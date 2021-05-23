@extends('layouts.app')

@section('head')
{{-- My css --}}
<link rel="stylesheet" href="{{asset('asset/css/checkout.css')}}" />
<title>Cart</title>
@endsection

@section('konten')
<section class="cart-container">
    <h1>Cart</h1>
    <div class="row">
        <div class="column">
            <h1>Your Order</h1>
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
                        <button class="btnDecreaseCart" data-idproduk="{{$cart['product_id']}}"> - </button>
                        <span>{{$cart['qty']}}</span>
                        <button class="btnIncreaseCart" data-idproduk="{{$cart['product_id']}}"> + </button>
                    </div>
                    <div class="delete-list">
                        <form action="{{route('cart.delete', $cart['product_id'])}}" method="post">
                            @csrf
                            <button type="submit"><i class="fas fa-trash fa-2x"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div>
                <p>tidak ada data</p>
            </div>
            @endforelse
        </div>
        <div class="column2">
            <form action="#" method="POST">
                <h3>Cart Totals</h3>
                <div class="row1">
                    <div class="col">
                        <h5>Subtotals</h5>
                        <h5>Shipping</h5>
                    </div>
                    <div class="col">
                        <h5>IDR.{{number_format($subtotal)}}</h5>
                        <h5>
                            *Free Shipping
                            <br>
                            <small style="opacity: 0.3">(semua produk selalu gratis ongkir)</small>
                        </h5>
                    </div>
                </div>
                <div class="row-box-user">
                    <div class="input-box-user">
                        <h5 class="title-input">Nama Penerima</h5>
                        <input type="text" class="input-box">
                    </div>
                    <div class="input-box-user">
                        <h5 class="title-input">Alamat Lengkap Penerima</h5>
                        <textarea class="input-box" style="height: 100px"></textarea>
                    </div>
                    <div class="input-box-user">
                        <h5 class="title-input">Nomor Handphone Penerima</h5>
                        <input type="text" class="input-box">
                    </div>
                </div>
                <div class="row-total">
                    <h3>Total :</h3>
                    <h3>IDR.{{number_format($subtotal)}}</h3>
                </div>
                <div class="buttons row-button">
                    <button type="submit" class="button-checkout">Checkout</button>
                    <a class="cancel" href="../HTML/men.html">Continue Shopping</a>
                </div>
            </form>
        </div>
    </div>


    {{-- Form Decrease  --}}
    <form action="" method="POST" style="display: none" id="form-update-cart">
        @csrf
    </form>

    {{-- Layout Lama --}}
    {{-- <div class="cart-item" id="item">
        <img src="{{asset('storage/assets/images/products/'.$cart['product_image'])}}" alt="produk-cart-img"
    width="60px" height="80px" style="object-fit: contain" />
    <p>{{$cart['product_name']}}</p>
    <p>IDR.{{ number_format($cart['product_price'])}}</p>
    {{$cart['qty']}}
    <input type="number" name="quantity" id="no-of-items" value="7" />
    <button id="remove" class="remove">
        <i class="fas fa-trash fa-2x"></i>
    </button>
    </div> --}}
</section>

<style>
    .cart-container {
        margin-top: 85px;
    }

    .card-list-cart {
        display: flex;
        justify-content: space-around;
        align-items: center;
        margin-bottom: 20px;
    }

    .img-list {
        width: 100px;
        height: 100px;
    }

    .title-list {
        width: 300px;
    }

    .title-list h3 {
        margin-bottom: 0;
    }

    .title-list b {
        opacity: 0.5;
    }

    .price-list {
        width: 150px;
    }

    .qty-container {
        width: 150px;
        text-align: center;
    }

    .qty-container span {
        display: inline-block;
        margin: 0 10px;
    }

    .input-box-user {
        margin-bottom: 20px;
    }

    .title-input {
        margin: 0;
        margin-bottom: 10px;
    }

    .input-box {
        width: 100%;
        margin: 0;
        padding: 5px;
        text-align: left;
    }

    .row-total {
        display: flex;
        justify-content: space-between;
    }

    button.button-checkout {
        cursor: pointer;
        outline: none;
        font-size: 1.2rem !important;
        margin-bottom: 20px;
    }
</style>
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
