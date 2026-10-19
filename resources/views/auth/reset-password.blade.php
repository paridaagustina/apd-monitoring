
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Password Baru | Monitoring APD</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0; min-height: 100vh; display: flex;
            align-items: center; justify-content: center; padding: 20px;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e8f0ff, #f5f7fb);
            color: #243247;
        }
        .card {
            width: 100%; max-width: 420px; padding: 34px;
            background: white; border-radius: 18px;
            box-shadow: 0 12px 40px rgba(40, 70, 120, .12);
        }
        h1 { text-align: center; font-size: 24px; margin: 0 0 12px; }
        .intro { color: #718096; font-size: 14px; line-height: 1.6; text-align: center; margin-bottom: 24px; }
        label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; }
        input { width: 100%; padding: 13px; border: 1px solid #d9e0eb; border-radius: 9px; margin-bottom: 16px; }
        button { width: 100%; padding: 13px; border: 0; border-radius: 9px; background: #2864b5; color: white; font-size: 15px; font-weight: bold; cursor: pointer; }
        .error { color: #c0392b; font-size: 13px; margin-bottom: 14px; }
    </style>
</head>
<body>
    <main class="card">
        <h1>Buat Password Baru</h1>
        <p class="intro">Gunakan password baru minimal 8 karakter.</p>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $email) }}"
                autocomplete="email"
                required
            >

            <label for="password">Password Baru</label>
            <input
                type="password"
                id="password"
                name="password"
                minlength="8"
                autocomplete="new-password"
                required
            >

            <label for="password_confirmation">Konfirmasi Password Baru</label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                minlength="8"
                autocomplete="new-password"
                required
            >

            <button type="submit">Simpan Password</button>
        </form>
    </main>
</body>
</html>
