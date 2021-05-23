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
            <h3>Cart Totals</h3>
            <div class="row1">
                <div class="col">
                    <h5>Subtotals</h5>
                    <h5>Shipping</h5>
                </div>
                <div class="col">
                    <h5>IDR.{{number_format($subtotal)}}</h5>
                    <div class="wrapper">
                        <span>
                            <input type="radio" name="shipping" id="" checked />Flat
                            rate:$10
                        </span>
                        <span>
                            <input type="radio" name="shipping" id="" />Free Shipping
                            <br />
                        </span>
                        <span>
                            <input type="radio" name="shipping" id="" />Local Pickup
                        </span>
                        <span>Shipping options <br />
                            will be updated <br />during checkout.</span>
                    </div>
                </div>
            </div>
            <h3>Totals &nbsp; &nbsp; $1000</h3>
            <div class="buttons">
                <a class="button-checkout" href="confirmation.html">Checkout</a>
                <a class="cancel" href="../HTML/men.html">Continue Shopping</a>
            </div>
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
