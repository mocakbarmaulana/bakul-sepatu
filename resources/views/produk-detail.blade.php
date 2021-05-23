@extends('layouts.app')

@section('head')

{{-- My css --}}
<link rel="stylesheet" href="{{asset('asset/css/info.css')}}" />
<title>{{$product->name}}</title>
@endsection

@section('konten')
<section>
    <div class="row">
        <div class="col1" style="text-align: center">
            <img src="{{asset('storage/assets/images/products/'.$product->images)}}" alt="" srcset="" />
        </div>
        <div class="col2">
            <h1>{{$product->name}}</h1>
            <p>{!! $product->description !!}</p>
            <h2>IDR.{{number_format($product->price)}}</h2>

            <span>
                <h3>Size</h3>
                <select name="" id="">
                    <option value="" selected disabled>Please select an option</option>
                    @foreach ($size as $row)
                    <option value="{{$row}}">{{$row}}</option>
                    @endforeach
                </select>
            </span>
            <br />
            <br />
            <div class="box-button">
                <form action="{{route('member.addtocart')}}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <input type="hidden" name="qty" value="1">
                    <button type="submit" class="button-cart button">Add to cart</button>
                </form>
                {{-- Whislist --}}
                @if ($wishlist)
                <form action="{{route('member.rmwhislit', $wishlist->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="wishlist">Remove from wishlist</button>
                </form>
                @else
                <form action="{{route('member.setwhislit', $product->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="wishlist button">Add to wishlist</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</section>
<section class="video">
    <h1 style="text-align: center">Video</h1>
    <video src="{{asset('asset/img/frontend/videoplayback.mp4')}}" type="video/mp4" controls controlsList="nodownload"
        poster="../Images/nike-zoom.gif" style="display:block; margin:30px auto; width: 70%"></video>
</section>

{{-- style --}}
<style>
    .box-button {
        display: flex;
        align-items: center;
    }

    .box-button form:nth-child(1) {
        margin-right: 20px;
    }

    .button {
        border: 0;
        outline: 0;
        cursor: pointer;
    }

    .wishlist {
        background: transparent;
        cursor: pointer;
    }
</style>
@endsection
