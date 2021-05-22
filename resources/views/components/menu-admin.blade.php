<ul id="sidebarnav">
    <!-- User Profile-->
    <li>
        <!-- User Profile-->
        <div class="user-profile d-flex no-block dropdown m-t-20">
            <div class="user-pic"><img src="{{ asset("xtreme-admin/assets/") }}/images/users/1.jpg" alt="users"
                    class="rounded-circle" width="40" /></div>
            <div class="user-content hide-menu m-l-10 d-flex align-items-center">
                <h5 class="m-b-0 user-name font-medium">Steave Jobs</h5>
            </div>
        </div>
        <!-- End User Profile-->
    </li>
    <!-- User Profile-->
    <li class="sidebar-item">
        <a class="sidebar-link active waves-effect waves-dark sidebar-link" href="#" aria-expanded="false">
            <i class="fas fa-user"></i>
            <span class="hide-menu">Testing</span>
        </a>
    </li>
    @foreach ($Menus as $menu)
    <li class="sidebar-item">
        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{$menu['link']}}" aria-expanded="false">
            <i class="{{$menu['icon']}}"></i>
            <span class="hide-menu">{{$menu['label']}}</span>
        </a>
    </li>
    @endforeach
    <li class="sidebar-item">
        <a class="sidebar-link logout" aria-expanded="false">
            <i class="fas fa-sign-out-alt"></i>
            <span class="hide-menu">Log out</span>
        </a>
    </li>
</ul>

{{-- Form Logout --}}
<form action="{{route('logout')}}" method="POST" id="form-logout" style="display: none">
    @csrf
</form>

{{-- Css Inline --}}
<style>
    .sidebar-link {
        font-weight: 700;
        letter-spacing: 0.1rem
    }

    .sidebar-link.active {
        background-color: #4fc3f7;
        color: #fff !important;
    }

    .sidebar-link.active i {
        color: #fff !important
    }

    .hide-menu {
        margin-left: 10px
    }
</style>

{{-- Script js --}}
<script>
    const logout = document.querySelector('.logout');
    const formLogout = document.querySelector("#form-logout")

    logout.addEventListener('click', () => {
        formLogout.submit();
    })
</script>
