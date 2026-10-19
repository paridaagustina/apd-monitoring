
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Monitoring APD</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e8f0ff, #f5f7fb);
            color: #243247;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 36px;
            border-radius: 20px;
            background: white;
            box-shadow: 0 12px 40px rgba(40, 70, 120, 0.12);
        }

        .logo {
            width: 68px;
            height: 68px;
            margin: 0 auto 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            background: #e7efff;
            color: #2864b5;
            font-size: 30px;
        }

        h1 {
            margin-bottom: 8px;
            text-align: center;
            font-size: 25px;
        }

        .subtitle {
            margin-bottom: 28px;
            text-align: center;
            color: #718096;
            font-size: 14px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .label-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-bottom: 8px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #d9e0eb;
            border-radius: 10px;
            outline: none;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus {
            border-color: #3678d4;
            box-shadow: 0 0 0 3px rgba(54, 120, 212, 0.12);
        }

        a {
            color: #2864b5;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .forgot-link {
            font-size: 12px;
            font-weight: 600;
        }

        .error {
            margin-bottom: 16px;
            padding: 11px 13px;
            border-radius: 9px;
            background: #fff0f0;
            color: #c0392b;
            font-size: 13px;
            line-height: 1.5;
        }

        .success {
            margin-bottom: 16px;
            padding: 11px 13px;
            border-radius: 9px;
            background: #ecfdf3;
            color: #18794e;
            font-size: 13px;
            line-height: 1.5;
        }

        .login-button {
            width: 100%;
            padding: 14px;
            margin-top: 6px;
            border: none;
            border-radius: 10px;
            background: #2864b5;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }

        .login-button:hover {
            background: #1e4f93;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 23px 0;
            color: #94a0b2;
            font-size: 12px;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #e3e8f0;
        }

        .google-button {
            width: 100%;
            min-height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px;
            border: 1px solid #d9e0eb;
            border-radius: 10px;
            background: white;
            color: #344054;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
        }

        .google-button:hover {
            background: #f8fafc;
            border-color: #aebbd0;
        }

        .google-icon {
            width: 19px;
            height: 19px;
        }

        .register-text {
            margin-top: 23px;
            text-align: center;
            font-size: 14px;
            color: #64748b;
        }

        .register-text a {
            font-weight: 700;
        }

        .footer {
            margin-top: 25px;
            text-align: center;
            color: #8a94a5;
            font-size: 12px;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 28px 22px;
            }
        }
    </style>
</head>

<body>
    <main class="login-card">
        <div class="logo">🦺</div>

        <h1>Monitoring APD</h1>

        <p class="subtitle">
            Silakan masuk untuk mengakses sistem
            pemantauan alat pelindung diri.
        </p>

        @if (session('success'))
            <div class="success" role="status">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="username">Username</label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="Masukkan username"
                    autocomplete="username"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <div class="label-row">
                    <label for="password">Password</label>

                    <a
                        href="{{ route('password.request') }}"
                        class="forgot-link"
                    >
                        Lupa Password?
                    </a>
                </div>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <button type="submit" class="login-button">
                Masuk
            </button>
        </form>

        <div class="divider">atau masuk dengan</div>

        <a
            href="{{ route('google.redirect') }}"
            class="google-button"
            style="text-decoration: none;"
        >
            <svg
                class="google-icon"
                viewBox="0 0 48 48"
                aria-hidden="true"
            >
                <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.72 7.18l7.28 5.65c4.25-3.92 7.48-9.7 7.48-17.3z"/>
                <path fill="#FBBC05" d="M10.53 28.59A14.4 14.4 0 0 1 9.75 24c0-1.59.27-3.13.76-4.59l-7.98-6.19A23.9 23.9 0 0 0 0 24c0 3.87.93 7.52 2.56 10.78l7.97-6.19z"/>
                <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.9-5.8l-7.28-5.65c-2.02 1.35-4.6 2.15-8.62 2.15-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 43.62 14.62 48 24 48z"/>
            </svg>

            Masuk dengan Google
        </a>

        <p class="register-text">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar sekarang</a>
        </p>

        <p class="footer">
            Sistem Monitoring Alat Pelindung Diri
        </p>
    </main>
</body>
</html>
