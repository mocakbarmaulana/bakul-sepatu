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

    @include('layouts.module-main.navbar')
    <section>
        <div class="row" style="width: 80%;margin: 0 auto;">

            <h2>Best Sellers</h2>
            <div class="row" style="width: 80%; margin: 0 auto;">
                <figure class="item">
                    <a href="HTML/info.html">
                        <img src="{{ asset("asset/img/frontend/") }}/img-Nike1.jpg" alt="" width="100%" />
                        <figcaption>Nike Run +</figcaption>
                    </a>
                </figure>
                <figure class="item">
                    <a href="HTML/info.html">
                        <img src="{{ asset("asset/img/frontend/") }}/img-Nike3.jpg" alt="" width="100%" />
                        <figcaption>Nike Air Blue</figcaption>
                    </a>
                </figure>
                <figure class="item">
                    <a href="HTML/info.html">
                        <img src="{{ asset("asset/img/frontend/") }}/img-Nike5.jpg" width="100%" />
                        <figcaption>Casual Nike</figcaption>
                    </a>
                </figure>
                <figure class="item">
                    <a href="HTML/info.html">
                        <img src="{{ asset("asset/img/frontend/") }}/img-Nike10.jpg" alt="" width="100%" />
                        <figcaption>Nike Air Orange</figcaption>
                    </a>
                </figure>
            </div>
    </section>
    @include('layouts.module-main.footer')
</body>

</html>
