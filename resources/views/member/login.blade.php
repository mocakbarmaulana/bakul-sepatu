<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Admin</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        referrerpolicy="no-referrer" />

    <!-- My Styling -->
    <link rel="stylesheet" href="{{asset('asset/css/admin/login-style.css')}}" />

    <style>
        .alert {
            background-color: crimson;
            padding: 10px 0;
            margin-bottom: 10px;
            color: #fff;
            text-align: center;

        }
    </style>
</head>

<body>
    <div class="container-login">
        <div class="login-page">
            <form method="POST" action="{{route('member.setlogin')}}">
                @csrf

                <h2>Login</h2>

                @if (session('error'))
                <div class="alert">
                    <i class="fas fa-info-circle"></i>
                    <small>Email / password tidak cocok</small>
                </div>
                @endif

                @error('email')
                <small class="error-form">*{{$message}}</small>
                @enderror
                <div class="input-form">
                    <i class="far fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" value="{{old('email')}}" required />
                </div>

                @error('password')
                <small class="error-form">*{{$message}}</small>
                @enderror
                <div class="input-form">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required />
                </div>

                <div class="input-form">
                    <button type="submit">Login</button>
                </div>

                <div class="info-box">
                    <p>Have a account ? <a href="{{route('member.register')}}">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
