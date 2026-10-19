<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | APD Monitoring</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f6fb;
            color: #243247;
        }

        .sidebar {
            position: fixed;
            width: 250px;
            height: 100vh;
            background: #174a82;
            color: white;
            padding: 28px 18px;
        }

        .brand {
            font-size: 21px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 12px;
            color: #d5e5f7;
            margin-bottom: 35px;
        }

        .menu-title {
            font-size: 11px;
            color: #b9d2ed;
            margin: 20px 10px 10px;
            text-transform: uppercase;
        }

        .menu a {
            display: block;
            padding: 13px 12px;
            margin-bottom: 7px;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .menu a.active,
        .menu a:hover {
            background: #2e73c4;
        }

        .main {
            margin-left: 250px;
            padding: 30px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .topbar h1 {
            font-size: 25px;
            margin-bottom: 7px;
        }

        .muted {
            color: #718096;
            font-size: 14px;
        }

        .profile {
            background: white;
            padding: 12px 16px;
            border-radius: 10px;
            box-shadow: 0 3px 12px #183b5b0b;
            font-size: 14px;
        }

        .welcome {
            background: linear-gradient(120deg, #174a82, #3986d7);
            color: white;
            border-radius: 16px;
            padding: 28px;
            margin-bottom: 25px;
        }

        .welcome h2 {
            font-size: 23px;
            margin-bottom: 12px;
        }

        .welcome p {
            font-size: 14px;
            line-height: 1.7;
            max-width: 650px;
            color: #eef6ff;
        }

        .section-title {
            font-size: 19px;
            margin-bottom: 16px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .card {
            background: white;
            border-radius: 13px;
            padding: 22px;
            box-shadow: 0 4px 16px #183b5b0b;
        }

        .card-icon {
            width: 45px;
            height: 45px;
            background: #e8f2ff;
            color: #2469b4;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 23px;
            margin-bottom: 16px;
        }

        .card h3 {
            font-size: 17px;
            margin-bottom: 9px;
        }

        .card p {
            font-size: 13px;
            color: #718096;
            line-height: 1.6;
            margin-bottom: 18px;
        }

        .btn {
            display: inline-block;
            background: #2e73c4;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 7px;
            padding: 10px 14px;
            font-size: 13px;
            cursor: pointer;
        }

        .btn:hover {
            background: #174a82;
        }

        .notice {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            margin-top: 22px;
            border-left: 4px solid #2e73c4;
            font-size: 14px;
            line-height: 1.7;
        }

        .logout-form {
            margin-top: 30px;
        }

        .logout-btn {
            width: 100%;
            padding: 12px;
            background: #ffffff1c;
            border: 1px solid #ffffff50;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        @media (max-width: 760px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .subtitle {
                margin-bottom: 18px;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <div class="brand">🦺 APD Monitoring</div>
        <div class="subtitle">Sistem Pemantauan Alat Pelindung Diri</div>

        <div class="menu-title">Menu Utama</div>

        <nav class="menu">
            <a href="{{ route('users.dashboard') }}" class="active">
                🏠 Dashboard
            </a>
           <a href="{{ route('users.laporan.create') }}">
    📋 Laporan APD
</a>
            <a href="#fitur">
                📁 Riwayat Laporan
            </a>
            <a href="#fitur">
                📷 Bukti Laporan
            </a>
            <a href="#fitur">
                🎥 Sesi Live
            </a>
        </nav>

        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">↪ Keluar</button>
        </form>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <h1>Dashboard</h1>
                <p class="muted">Selamat datang di sistem APD Monitoring.</p>
            </div>

            <div class="profile">
                👤 {{ auth()->user()->nama }}
            </div>
        </header>

        <section class="welcome">
            <h2>Halo, {{ auth()->user()->nama }}! 👋</h2>
            <p>
                Selamat datang di APD Monitoring. Gunakan sistem ini untuk
                melaporkan penggunaan Alat Pelindung Diri (APD), melengkapi
                bukti laporan, dan memantau status pemeriksaan.
            </p>
        </section>

        <h2 class="section-title" id="fitur">Menu Layanan</h2>

        <section class="cards">
            <div class="card">
                <div class="card-icon">📋</div>
                <h3>Buat Laporan APD</h3>
                <p>
                    Isi laporan penggunaan APD berdasarkan lokasi kerja,
                    tanggal, dan checklist APD yang digunakan.
                </p>
                <a href="{{ route('users.laporan.create') }}" class="btn">
    Buat Laporan
</a>
            </div>

            <div class="card">
                <div class="card-icon">📁</div>
                <h3>Riwayat Laporan</h3>
                <p>
                    Lihat laporan yang pernah dibuat dan pantau status
                    pemeriksaan laporan APD.
                </p>
                <a href="#fitur" class="btn">Lihat Riwayat</a>
            </div>

            <div class="card">
                <div class="card-icon">📷</div>
                <h3>Bukti Laporan</h3>
                <p>
                    Siapkan bukti foto atau video untuk mendukung laporan
                    penggunaan APD.
                </p>
                <a href="#fitur" class="btn">Kelola Bukti</a>
            </div>

            <div class="card">
                <div class="card-icon">🎥</div>
                <h3>Sesi Live</h3>
                <p>
                    Fitur untuk mendukung sesi pemantauan APD secara langsung
                    sesuai jadwal pemeriksaan.
                </p>
                <a href="#fitur" class="btn">Lihat Sesi</a>
            </div>
        </section>

        <div class="notice">
            <strong>Informasi:</strong>
            Fitur pada halaman ini merupakan tampilan awal dashboard.
            Tombol laporan, riwayat, bukti, dan sesi live belum terhubung
            ke halaman fungsional.
        </div>
    </main>
</body>
</html>