<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan APD | APD Monitoring</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 25px;
            font-family: Arial, sans-serif;
            background: #f3f6fb;
            color: #203047;
        }

        .container {
            max-width: 850px;
            margin: 0 auto;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            color: #2469b4;
            text-decoration: none;
            font-weight: 600;
        }

        .back:hover {
            color: #174a82;
        }

        .panel {
            background: white;
            padding: 28px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .05);
        }

        h1 {
            margin-top: 0;
            font-size: 25px;
        }

        .description,
        .hint {
            color: #718096;
            line-height: 1.6;
        }

        .field {
            margin-top: 22px;
        }

        .field > label,
        .field-title {
            display: block;
            font-weight: bold;
            margin-bottom: 9px;
        }

        input[type="text"],
        input[type="date"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d5deea;
            border-radius: 8px;
            font: inherit;
            background: white;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #2e73c4;
            box-shadow: 0 0 0 3px rgba(46, 115, 196, .12);
        }

        textarea {
            resize: vertical;
        }

        .checklist {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 12px;
        }

        .check-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px;
            border: 1px solid #dce5f0;
            border-radius: 9px;
            cursor: pointer;
            font-weight: normal;
            transition: .2s;
        }

        .check-item:hover {
            border-color: #2e73c4;
            background: #f5f9ff;
        }

        .check-item input {
            width: 18px;
            height: 18px;
            accent-color: #2e73c4;
            cursor: pointer;
            flex-shrink: 0;
        }

        .hint {
            font-size: 13px;
        }

        .alert {
            padding: 14px;
            margin-bottom: 18px;
            border-radius: 8px;
            line-height: 1.6;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn {
            display: inline-block;
            margin-top: 25px;
            background: #2e73c4;
            color: white;
            padding: 13px 20px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
        }

        .btn:hover {
            background: #174a82;
        }

        .btn:disabled {
            background: #9caec2;
            cursor: not-allowed;
        }

        .video-info {
            margin-top: 10px;
            padding: 12px;
            background: #f5f8fc;
            border-radius: 8px;
            color: #52657d;
            font-size: 13px;
            line-height: 1.5;
        }

        @media (max-width: 600px) {
            body {
                padding: 15px;
            }

            .checklist {
                grid-template-columns: 1fr;
            }

            .panel {
                padding: 20px;
            }

            h1 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <a href="{{ route('users.dashboard') }}" class="back">
        ← Kembali ke Dashboard
    </a>

    <div class="panel">
        <h1>📋 Buat Laporan APD</h1>

        <p class="description">
            Isi informasi kegiatan dan unggah video sebagai bukti penggunaan
            Alat Pelindung Diri (APD). Admin akan memeriksa video dan menilai
            kelengkapan setiap APD.
        </p>

        @if (session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert error">
                <strong>Periksa kembali data berikut:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('users.laporan.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="field">
                <label for="lokasi">Lokasi Kerja</label>
                <input
                    type="text"
                    id="lokasi"
                    name="lokasi"
                    value="{{ old('lokasi') }}"
                    placeholder="Contoh: Area Produksi"
                    maxlength="255"
                    required
                >
            </div>

            <div class="field">
                <label for="tanggal_laporan">Tanggal Kegiatan</label>
                <input
                    type="date"
                    id="tanggal_laporan"
                    name="tanggal_laporan"
                    value="{{ old('tanggal_laporan', date('Y-m-d')) }}"
                    required
                >
            </div>

            <div class="field">
                <span class="field-title">
                    Checklist APD yang Digunakan
                </span>

                <p class="hint">
                    Centang APD yang kamu gunakan dalam kegiatan.
                    Admin akan memeriksa kembali setiap pilihan berdasarkan
                    video yang diunggah.
                </p>

                <div class="checklist">
                    @forelse ($jenisApd as $item)
                        <label class="check-item">
                            <input
                                type="checkbox"
                                name="apd[]"
                                value="{{ $item->id }}"
                                {{ in_array($item->id, old('apd', [])) ? 'checked' : '' }}
                            >

                            <span>{{ $item->nama_apd }}</span>
                        </label>
                    @empty
                        <p>
                            Data jenis APD belum tersedia atau belum aktif.
                            Silakan hubungi administrator.
                        </p>
                    @endforelse
                </div>
            </div>

            <div class="field">
                <label for="video">Video Penggunaan APD</label>

                <input
                    type="file"
                    id="video"
                    name="video"
                    accept=".mp4,.mov,.avi,.webm"
                    required
                >

                <div class="video-info">
                    <strong>Ketentuan video:</strong><br>
                    Format MP4, MOV, AVI, atau WEBM dengan ukuran maksimal
                    50 MB. Pastikan penggunaan APD terlihat jelas agar
                    admin dapat melakukan pemeriksaan.
                </div>

                <p id="video-name" class="hint"></p>
            </div>

            <div class="field">
                <label for="catatan_pengguna">Catatan</label>

                <textarea
                    id="catatan_pengguna"
                    name="catatan_pengguna"
                    rows="4"
                    maxlength="2000"
                    placeholder="Tambahkan keterangan kegiatan jika diperlukan..."
                >{{ old('catatan_pengguna') }}</textarea>
            </div>

            <button
                type="submit"
                class="btn"
                @if ($jenisApd->isEmpty()) disabled @endif
            >
                Kirim Laporan
            </button>
        </form>
    </div>
</div>

<script>
    const videoInput = document.getElementById('video');
    const videoName = document.getElementById('video-name');

    videoInput.addEventListener('change', function () {
        if (this.files.length > 0) {
            const file = this.files[0];
            const sizeMB = (file.size / (1024 * 1024)).toFixed(2);

            videoName.textContent =
                'Video dipilih: ' + file.name + ' (' + sizeMB + ' MB)';

            if (file.size > 50 * 1024 * 1024) {
                videoName.textContent =
                    'Ukuran video melebihi 50 MB. Silakan pilih video lain.';
                videoName.style.color = '#b91c1c';
            } else {
                videoName.style.color = '#166534';
            }
        } else {
            videoName.textContent = '';
        }
    });
</script>

</body>
</html>