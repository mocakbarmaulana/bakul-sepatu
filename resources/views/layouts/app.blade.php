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

    <link rel="stylesheet" href="{{asset('asset/css/preloader.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/navbar.css')}}">
    @yield('head')
</head>

<body>

    @include('layouts.module-main.navbar')
    @yield('konten')
    @yield('footer')
    {{-- js --}}
    {{-- Jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    {{-- Preloader js --}}
    <script src="{{asset('asset/js/preloader.js')}}"></script>
    @yield('js')
</body>

</html>
