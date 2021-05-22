<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        referrerpolicy="no-referrer" />

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet" />

    {{-- My css --}}
    <link rel="stylesheet" href="{{asset('asset/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('asset/css/navbar.css')}}" />
    <link rel="stylesheet" href="{{asset('asset/css/preloader.css')}}" />

    {{-- Jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    {{-- Preloader js --}}
    <script src="{{asset('asset/js/preloader.js')}}"></script>
    <title>Home Bakul Sepatu</title>
</head>

<body>

    <header id="home">
        <nav>
            <ul>
                <li class="primary-nav">
                    <img src=" {{asset('asset/img/frontend/img-DS.png')}}" alt="logo" />
                    <a href="/">BakulSepatu</a>
                </li>
                <li class="secondary-nav">
                    <a href="#">
                        <i class="fas fa-shopping-cart"></i> CART
                    </a>
                </li>
                <li class="secondary-nav"><a href="#">Sepatu Formal</a></li>
                <li class="secondary-nav"><a href="#">Sepatu Slip On</a></li>
                <li class="secondary-nav"><a href="#">Sepatu Olahraga</a></li>
                <li class="secondary-nav"><a href="#">About</a>
                </li>
            </ul>
        </nav>
        <div class="pxtext">
            <span class="border">
                Nike Air Jordan
            </span>
            <p><a href="HTML/men.html">Shop Now</a></p>
        </div>
    </header>
    <section>
        <div class="row" style="width: 80%;margin: 0 auto;">
            <h2>Best Sellers</h2>
            <div class="row" style="width: 80%; margin: 0 auto;">
                @forelse ($products as $product)
                <figure class="item">
                    <a href="{{route('produkdetail', $product->id)}}">
                        <img src="{{asset('storage/assets/images/products/'.$product->images)}}" alt="img-produk"
                            height="125px" width="200px" class="img-produk-item" />
                        <figcaption>{{$product->name}}</figcaption>
                    </a>
                </figure>
                @empty
                <p>Tidak ada data</p>
                @endforelse
            </div>
    </section>
    @include('layouts.module-main.footer')

    <style>
        .img-produk-item {
            object-fit: contain;
            object-position: center
        }
    </style>
</body>

</html>
