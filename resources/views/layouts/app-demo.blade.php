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
    <title>Bakul Sepatu</title>
</head>

<body>
    <header id="home">
        <nav>
            <ul>
                <li class="primary-nav">
                    <img src=" {{asset('asset/img/frontend/img-DS.png')}}" alt="logo" />
                    <a href="#home">BakulSepatu</a>
                </li>
                <li class="secondary-nav">
                    <a href="HTML/checkout.html">
                        <i class="fas fa-shopping-cart"></i> CART
                    </a>
                </li>
                <li class="secondary-nav"><a href="HTML/sepatuformal.html">Sepatu Formal</a></li>
                <li class="secondary-nav"><a href="HTML/sepatuslipon.html">Sepatu Slip On</a></li>
                <li class="secondary-nav"><a href="HTML/sepatuolahraga.html">Sepatu Olahraga</a></li>
                <li class="secondary-nav"><a href="HTML/about.html">About</a>
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
        <div class="row" style="width: 80%;
      margin: 0 auto;">

            <h2 align="center">Best Sellers</h2>
            <div class="row" style="  width: 80%;
      margin: 0 auto;">
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

    <footer>
        <div class="row foot">
            <div class="col">
                <h1>BakulSepatu</h1>
                <h2>Links</h2>
                <ul>
                    <li><a href="./HTML/shop.html">Catalog</a></li>

                    <li><a href="./HTML/Contact-us.html">Contact us</a></li>
                    <li>
                        <a href="./HTML/terms-and-conditions.html">Terms and conditions</a>
                    </li>
                    <li>
                        <a href="./HTML/refund-policy.html">Refund Policy</a>
                    </li>
                </ul>
            </div>
            <footer id="footer-social">
                <ul class="row foot-icons" style="list-style-type: none;">
                    <li>
                        <a href="#" target="_blank">
                            <i class="fab fa-twitter fa-3x"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" target="_blank">
                            <i class="fab fa-facebook fa-3x"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" target="_blank">
                            <i class="fab fa-codepen fa-3x"></i>
                        </a>
                    </li>
                </ul>
            </footer>
        </div>
    </footer>

    {{-- js --}}

</body>

</html>
