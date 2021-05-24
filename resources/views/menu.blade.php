@extends('layouts.app')

@section('head')
{{-- My css --}}
<link rel="stylesheet" href="{{asset('asset/css/menu.css')}}">
<title>Menu</title>
@endsection

@section('main-content')
{{-- Menu Page --}}
<div class="menu-page">
    <div class="filter-menu container">
        <form action="" method="get" class="formMenu">
            <select name="q" id="selectCategory">
                <option selected disabled>Pilih kategori</option>
                @forelse ($categories as $category)
                <option value="{{$category->id}}" @if ($category->id == $q) selected @endif>{{$category->name}}</option>
                @empty
                <option disabled>Tidak ada kateogri</option>
                @endforelse
            </select>
        </form>
    </div>
    <div class="product-list">
        <div class="cards">
            @forelse ($products as $product)
            <div class="card">
                <a href="{{route("produkdetail", $product->id)}}">
                    <img src="{{asset('storage/assets/images/products/'.$product->images)}}" alt="" width="100%" />
                    <span>{{$product->name}}</span>
                </a>
            </div>
            @empty
            <div style="text-align: center">
                <p>Tidak ada data</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $("#selectCategory").on("change", function() {
        $(".formMenu").submit()
    })
</script>
@endsection
