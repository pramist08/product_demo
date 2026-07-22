<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management - Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
            height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .register-card{
            width:950px;
            border:none;
            border-radius:15px;
            overflow:hidden;
            box-shadow:0 10px 30px rgba(0,0,0,.1);
        }

        .left-side{
            background:#198754;
            color:#fff;
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
            background:#fff;
            padding:40px;
        }

        .form-control{
            height:48px;
        }

        .btn-register{
            height:48px;
            font-size:18px;
        }
    </style>
</head>
<body>

<div class="card register-card">

    <div class="row g-0">

        <div class="col-md-6 left-side">

            <h1>Product Management</h1>

            <p>
                Create your account to access the Product Management Dashboard.
            </p>

        </div>

        <div class="col-md-6 right-side">

            <h3 class="text-center mb-4">
                Register
            </h3>

            <form method="POST" action="{{ route('register') }}">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        required
                        autofocus>

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        required>

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

                <div class="mb-4">

                    <label class="form-label">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        required>

                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <button class="btn btn-success w-100 btn-register">

                    Create Account

                </button>

            </form>

            <hr>

            <div class="text-center">

                Already have an account?

                <a href="{{ route('login') }}">

                    Login

                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>