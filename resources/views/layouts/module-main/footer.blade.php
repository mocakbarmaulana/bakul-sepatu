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
                <li>
                    <a href="{{route('member.register')}}">Register</a>
                </li>
                <li>
                    <a href="{{route('member.login')}}">Login</a>
                </li>
                <li>
                    <a href="{{route('menu')}}">Menu</a>
                </li>
                <li>
                    <a href="{{route('member.order')}}">Pesanan</a>
                </li>
                <li>
                    <form action="{{route('member.logout')}}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
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
