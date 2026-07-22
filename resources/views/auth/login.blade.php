<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management - Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
            height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .login-card{
            width:900px;
            border:none;
            border-radius:15px;
            overflow:hidden;
            box-shadow:0 10px 30px rgba(0,0,0,.1);
        }

        .left-side{
            background:#0d6efd;
            color:white;
            padding:60px;
            display:flex;
            flex-direction:column;
            justify-content:center;
        }

        .left-side h1{
            font-weight:bold;
            margin-bottom:20px;
        }

        .left-side p{
            opacity:.9;
        }

        .right-side{
            padding:50px;
            background:#fff;
        }

        .form-control{
            height:48px;
        }

        .btn-login{
            height:48px;
            font-size:18px;
        }
    </style>
</head>
<body>

<div class="card login-card">

    <div class="row g-0">

        <div class="col-md-6 left-side">

            <h1>Product Management</h1>

            <p>
                Welcome Back!<br>
                Login to access your dashboard and manage your products.
            </p>

        </div>

        <div class="col-md-6 right-side">

            <h3 class="text-center mb-4">
                Login
            </h3>

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror"
                        required
                        autofocus>

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required>

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="d-flex justify-content-between mb-4">

                    <div class="form-check">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="remember"
                            id="remember">

                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>

                    </div>

                    @if (Route::has('password.request'))

                        <a href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>

                    @endif

                </div>

                <button class="btn btn-primary w-100 btn-login">

                    Login

                </button>

            </form>

            <hr>

            <div class="text-center">

                Don't have an account?

                <a href="{{ route('register') }}">

                    Register

                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>