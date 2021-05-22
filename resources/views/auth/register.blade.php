<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simple Login White</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        referrerpolicy="no-referrer" />

    <!-- My Styling -->
    <link rel="stylesheet" href="{{asset('asset/css/admin/login-style.css')}}" />
</head>

<body>
    <div class="container-login">
        <div class="login-page">
            <form method="POST" action="{{route('register')}}">
                @csrf

                <h2>Register</h2>
                @error('name')
                <small class="error-form">*{{$message}}</small>
                @enderror
                <div class="input-form">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" placeholder="Name" value="{{old('name')}}" required />
                </div>

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
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password_confirmation" placeholder="Retype-Password" required />
                </div>

                <div class="input-form">
                    <button type="submit">Register</button>
                </div>

                <div class="info-box">
                    <p>Have a account ? <a href="#">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
