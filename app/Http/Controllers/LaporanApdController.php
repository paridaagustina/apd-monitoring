<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class LaporanApdController extends Controller
{
    /**
     * Menampilkan form pembuatan laporan APD.
     */
    public function create()
    {
        $jenisApd = DB::table('jenis_apd')->get();

        return view('users.laporan.create', compact('jenisApd'));
    }

    /**
     * Menyimpan laporan APD dan video bukti.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lokasi' => [
                'required',
                'string',
                'max:255',
            ],

            'tanggal_laporan' => [
                'required',
                'date',
            ],

            'catatan_pengguna' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'video' => [
                'required',
                'file',
                'mimes:mp4,mov,avi,webm',
                'max:51200',
            ],

            'apd' => [
                'required',
                'array',
                'min:1',
            ],

            'apd.*' => [
                'required',
                'integer',
                'distinct',
                Rule::exists('jenis_apd', 'id'),
            ],
        ], [
            'lokasi.required' =>
                'Lokasi kerja wajib diisi.',

            'tanggal_laporan.required' =>
                'Tanggal kegiatan wajib diisi.',

            'video.required' =>
                'Silakan unggah video penggunaan APD.',

            'video.mimes' =>
                'Video harus berformat MP4, MOV, AVI, atau WEBM.',

            'video.max' =>
                'Ukuran video maksimal 50 MB.',

            'apd.required' =>
                'Pilih minimal satu APD yang digunakan.',

            'apd.min' =>
                'Pilih minimal satu APD yang digunakan.',
        ]);

        // Simpan video ke storage Laravel.
        $videoPath = $request->file('video')->store(
            'bukti-apd',
            'public'
        );

        try {
            DB::transaction(function () use (
                $validated,
                $videoPath
            ) {
                // Simpan laporan utama.
                $laporanId = DB::table('laporan_apd')
                    ->insertGetId([
                        'user_id' => Auth::id(),
                        'lokasi' => $validated['lokasi'],
                        'tanggal_laporan' =>
                            $validated['tanggal_laporan'],
                        'catatan_pengguna' =>
                            $validated['catatan_pengguna'] ?? null,
                        'status' => 'menunggu',
                    ]);

                // Simpan checklist untuk setiap jenis APD.
                $jenisApd = DB::table('jenis_apd')->get();

                foreach ($jenisApd as $item) {
                    DB::table('detail_checklist_apd')
                        ->insert([
                            'laporan_id' => $laporanId,
                            'jenis_apd_id' => $item->id,
                            'digunakan' => in_array(
                                $item->id,
                                $validated['apd']
                            ),
                        ]);
                }

                // Simpan lokasi file video.
                DB::table('bukti_laporan')->insert([
                    'laporan_id' => $laporanId,
                    'jenis_bukti' => 'video',
                    'file_path' => $videoPath,
                    'created_at' => now(),
                ]);
            });
        } catch (\Throwable $e) {
            // Hapus file jika penyimpanan database gagal.
            Storage::disk('public')->delete($videoPath);

            throw $e;
        }

        return redirect()
            ->route('users.laporan.create')
            ->with(
                'success',
                'Laporan APD berhasil dikirim dan menunggu pemeriksaan admin.'
            );
    }
}