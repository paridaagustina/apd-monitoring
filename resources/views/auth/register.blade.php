
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | Monitoring APD</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .register-card {
            width: 100%;
            max-width: 440px;
            padding: 32px;
            background: white;
            border-radius: 18px;
            box-shadow: 0 12px 40px rgba(15, 23, 42, .08);
        }

        .logo {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            border-radius: 16px;
            background: #e8f1ff;
            font-size: 30px;
        }

        h1 {
            margin: 0;
            text-align: center;
            font-size: 25px;
        }

        .subtitle {
            margin: 10px 0 25px;
            color: #64748b;
            text-align: center;
            font-size: 14px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-size: 14px;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            outline: none;
            font-size: 14px;
        }

        input:focus {
            border-color: #2e73c4;
            box-shadow: 0 0 0 3px rgba(46, 115, 196, .12);
        }

        .error {
            margin: 6px 0 0;
            color: #dc2626;
            font-size: 12px;
        }

        .register-button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 9px;
            background: #2e73c4;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        .register-button:hover {
            background: #245fa4;
        }

        .footer {
            margin: 22px 0 0;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }

        a {
            color: #2e73c4;
            font-weight: 600;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .register-card {
                padding: 25px 20px;
            }
        }
    </style>
</head>
<body>
    <main class="register-card">
        <div class="logo">🦺</div>

        <h1>Buat Akun</h1>
        <p class="subtitle">
            Daftar untuk menggunakan Sistem Monitoring Alat Pelindung Diri.
        </p>

        @if ($errors->any())
            <div role="alert" style="margin-bottom: 18px;">
                @foreach ($errors->all() as $error)
                    <p class="error">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.process') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input
                    type="text"
                    id="nama"
                    name="nama"
                    value="{{ old('nama') }}"
                    placeholder="Masukkan nama lengkap"
                    maxlength="100"
                    autocomplete="name"
                    required
                >
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="Buat username"
                    maxlength="50"
                    autocomplete="username"
                    required
                >
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="nama@email.com"
                    autocomplete="email"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimal 8 karakter"
                    minlength="8"
                    autocomplete="new-password"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Ulangi password"
                    minlength="8"
                    autocomplete="new-password"
                    required
                >
            </div>

            <button type="submit" class="register-button">
                Daftar Sekarang
            </button>
        </form>

        <p class="footer">
            Sudah punya akun?
            <a href="{{ route('login') }}">Masuk</a>
        </p>
    </main>
</body>
</html>
