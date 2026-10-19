
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password | Monitoring APD</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e8f0ff, #f5f7fb);
            color: #243247;
        }
        .card {
            width: 100%;
            max-width: 420px;
            padding: 34px;
            background: white;
            border-radius: 18px;
            box-shadow: 0 12px 40px rgba(40, 70, 120, .12);
        }
        h1 { text-align: center; font-size: 24px; margin: 0 0 12px; }
        p { color: #718096; font-size: 14px; line-height: 1.6; }
        .intro { text-align: center; margin-bottom: 24px; }
        label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; }
        input {
            width: 100%; padding: 13px;
            border: 1px solid #d9e0eb; border-radius: 9px;
            font-size: 14px; margin-bottom: 16px;
        }
        button {
            width: 100%; padding: 13px; border: 0; border-radius: 9px;
            background: #2864b5; color: white; font-weight: bold;
            font-size: 15px; cursor: pointer;
        }
        .message { margin-bottom: 15px; font-size: 13px; line-height: 1.5; }
        .error { color: #c0392b; }
        .success { color: #18794e; }
        .back { text-align: center; margin-top: 22px; }
        a { color: #2864b5; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
    <main class="card">
        <h1>Lupa Password?</h1>
        <p class="intro">
            Masukkan email yang terdaftar. Kami akan mengirimkan tautan
            untuk membuat password baru.
        </p>

        @if (session('success'))
            <p class="message success">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <div class="message error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
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
            <button type="submit">Kirim Tautan Reset</button>
        </form>

        <p class="back">
            <a href="{{ route('login') }}">← Kembali ke Login</a>
        </p>
    </main>
</body>
</html>
