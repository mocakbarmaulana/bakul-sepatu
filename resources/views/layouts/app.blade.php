<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('asset/img/frontend/img-DS.png')}}" />

    <!-- Google FOnt -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet" />

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        referrerpolicy="no-referrer" />

    <!-- css global -->
    <link rel="stylesheet" href="{{asset('asset/css/navbar.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/footer.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
    @yield('head')
</head>

<body>

    {{-- Navbar --}}
    @include('layouts.module-main.navbar')

    <!-- Main Kontent -->
    <div class="main-content">
        @yield('main-content')
    </div>

    {{-- Footer --}}
    @include('layouts.module-main.footer')

</body>

</html>
