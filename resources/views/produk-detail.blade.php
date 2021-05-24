@extends('layouts.app')

@section('head')
{{-- Mycss --}}
<link rel="stylesheet" href="{{asset('asset/css/detail.css')}}">
<title>{{$product->name}}</title>
@endsection

@section('main-content')
<!-- Detail Page -->
<div class="info-flash">
    @include('utils.flash-msg')
</div>
<section class="detail-page">
    <div class="image-detail">
        <img src="{{asset('storage/assets/images/products/'.$product->images)}}" alt="image-detail" />
    </div>
    <div class="info-detail">
        <h1 class="mb-2">{{$product->name}}</h1>
        <div class="mb-2 description">{!! $product->description !!}</div>
        <h2 class="mb-2">IDR.{{number_format($product->price)}}</h2>
        @error('size')
        <small class="text-danger">{{$message}}</small>
        @enderror
        <div class="info-size">
            <h3 class="mb-2">Size :</h3>
            <select name="" class="mb-5" id="option-size">
                <option value="" selected disabled>
                    Please select an option
                </option>
                @foreach ($size as $row)
                <option value="{{$row}}">{{$row}}</option>
                @endforeach
            </select>
        </div>
        <div class="button-box">
            <form action="{{route('member.addtocart')}}" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <input type="hidden" name="qty" value="1">
                <input type="hidden" name="size" id="size-product">
                <button type="submit" class="button button-cart">Add to cart</button>
            </form>
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
    const optionSize = document.getElementById("option-size");

    $("#option-size").on("change", function(){
        $("#size-product").val(this.value);
    })
</script>
@endsection
