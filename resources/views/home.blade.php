@extends('layouts.app')

@section('head')
{{-- Mycss --}}
<link rel="stylesheet" href="{{asset('asset/css/home.css')}}">
<title>Home BakulSepatu</title>
@endsection

@section('main-content')
<!-- Jumbotron -->
<section class="main-jumbotron">
    <div class="info-jumbotron">
        <h1>Nike Air Jordan</h1>
        <a href="#" class="button">Shop Now</a>
    </div>
</section>
<!-- Product List -->
<div class="container">
    <section class="menu-product">
        <div class="product-title">
            <h2>Produk :</h2>
            <!-- <a href="#"><small>Lihat semuanya</small></a> -->
        </div>
        <div class="product-list">
            <div class="cards">
                @forelse ($products as $product)
                <div class="card">
                    <a href="{{route("produkdetail", $product->id)}}">
                        <img src="{{asset('storage/assets/images/products/'.$product->images)}}" alt="" width="100%" />
                        <span>Nike Air Blue</span>
                    </a>
                </div>
                @empty
                <div style="text-align: center">
                    <p>Tidak ada data</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
