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
            <a class="button-cart" href="checkout.html">Add to cart</a> &nbsp;
            &nbsp;
            <a class="wishlist" href="">Add to wishlist</a>
        </div>
    </div>
</section>
<section class="video">
    <h1 style="text-align: center">Video</h1>
    <video src="{{asset('asset/img/frontend/videoplayback.mp4')}}" type="video/mp4" controls controlsList="nodownload"
        poster="../Images/nike-zoom.gif" style="display:block; margin:30px auto; width: 70%"></video>
</section>
@endsection
