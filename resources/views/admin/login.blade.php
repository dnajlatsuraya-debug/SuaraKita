<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin - SuaraKita</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f7f5ee;
            color: #26352c;

            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            width: 90%;
            max-width: 430px;

            background: white;

            padding: 38px;

            border-radius: 24px;

            border: 1px solid #e5e2d8;

            box-shadow: 0 15px 40px rgba(40, 60, 45, 0.08);
        }

        .logo {
            text-align: center;

            font-size: 27px;
            font-weight: bold;

            color: #315c43;

            margin-bottom: 8px;
        }

        .title {
            text-align: center;

            font-size: 25px;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;

            color: #737b75;

            font-size: 14px;

            line-height: 1.6;

            margin-bottom: 30px;
        }

        .field {
            margin-bottom: 20px;
        }

        label {
            display: block;

            font-weight: 600;

            margin-bottom: 8px;
        }

        input {
            width: 100%;

            padding: 14px 15px;

            border: 1px solid #d8ddd8;

            border-radius: 12px;

            font-size: 15px;

            outline: none;
        }

        input:focus {
            border-color: #6d9279;
        }

        button {
            width: 100%;

            border: none;

            padding: 14px;

            background: #315c43;

            color: white;

            border-radius: 12px;

            font-size: 15px;

            font-weight: 600;

            cursor: pointer;
        }

        button:hover {
            background: #264a35;
        }

        .error {
            background: #fff0f0;

            color: #a33b3b;

            padding: 13px;

            border-radius: 10px;

            margin-bottom: 20px;

            font-size: 14px;
        }

        .back {
            display: block;

            text-align: center;

            margin-top: 20px;

            color: #52795e;

            text-decoration: none;

            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="login-box">

    <div class="logo">
        SuaraKita.
    </div>

    <h1 class="title">
        Login Admin
    </h1>

    <p class="subtitle">
        Masuk menggunakan akun khusus admin
        untuk mengelola aspirasi siswa.
    </p>

    @if($errors->any())

        <div class="error">
            {{ $errors->first() }}
        </div>

    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">

        @csrf

        <div class="field">

            <label for="email">
                Email
            </label>

            <input
                type="email"
                id="email"
                name="email"
                placeholder="Masukkan email admin"
                value="{{ old('email') }}"
                required
            >

        </div>

        <div class="field">

            <label for="password">
                Password
            </label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                required
            >

        </div>

        <button type="submit">
            Login
        </button>

    </form>

    <a href="{{ route('aspirations.index') }}" class="back">
        ← Kembali ke SuaraKita
    </a>

</div>

</body>

</html>