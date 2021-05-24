<header>
    <nav class="navbar">
        <div class="brand">
            <img src="{{asset('asset/img/frontend/img-DS.png')}}" alt="img-brand" width="32px" height="32px" />
            <a href="/" class="link-a" style="color: #555">BakulSepatu</a>
        </div>
        <div class="list-navbar">
            <ul>
                <li>
                    <a href="/" class="link-a">Home</a>
                </li>
                <li>
                    <a href="#" class="link-a">Menu</a>
                </li>
                @if (auth('member')->check())
                <div class="user-info">
                    <li>
                        <a href="#" class="link-a">Pesanan</a>
                    </li>
                    <li>
                        <a href="{{route('showcart')}}" class="link-a"><i class="fas fa-shopping-cart"></i> Cart</a>
                    </li>
                    <li>
                        <a href="#" class="link-a btnLogout">Logout</a>
                    </li>
                </div>
                @else
                <li>
                    <a href="{{route('member.login')}}" class="link-a">Login</a>
                </li>
                <li>
                    <a href="{{route('member.register')}}" class="link-a">Register</a>
                </li>
                @endif
            </ul>
        </div>
    </nav>
</header>

{{-- Form Logout --}}
<form action="{{route('member.logout')}}" method="POST" style="display: none" class="formLogout">
    @csrf
</form>

<script>
    document.querySelector(".btnLogout").addEventListener("click", () => {
        document.querySelector(".formLogout").submit();
    })
</script>
