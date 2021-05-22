@extends('layouts.app')

@section('head')
<title>Menu</title>
@endsection

@section('konten')
<div class="main-content">
    <h1>Ini Menu</h1>
    <div class="list-menu row">
        @forelse ($products as $product)
        <div class="col-3">
            <a href="{{route('produkdetail', $product->id)}}">
                <div class="menu-product">
                    <div class="menu-image">
                        <img src="{{asset('storage/assets/images/products/'.$product->images)}}" alt="img-menu">
                    </div>
                    <div class="menu-title text-center">
                        <h4>{{$product->name}}</h4>
                    </div>
                </div>
            </a>
        </div>
        @empty
        <div class="col-12 text-center my-5">
            <h3>Tidak ada produk</h3>
        </div>
        @endforelse
    </div>
</div>

<style>
    .list-menu a {
        text-decoration: none;
        color: #000;
    }

    .menu-image {
        width: 100%
    }

    .menu-image img {
        width: 100%
    }
</style>
@endsection
