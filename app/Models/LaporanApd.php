<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LaporanApd extends Model
{
    use HasFactory;

    protected $table = 'laporan_apd';

    protected $fillable = [
        'user_id',
        'lokasi',
        'tanggal_laporan',
        'catatan_pengguna',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_laporan' => 'datetime',
        ];
    }

    // Pengguna yang membuat laporan
    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Daftar checklist APD
    public function detailChecklist(): HasMany
    {
        return $this->hasMany(
            DetailChecklistApd::class,
            'laporan_id'
        );
    }

    // Bukti foto dan video
    public function buktiLaporan(): HasMany
    {
        return $this->hasMany(
            BuktiLaporan::class,
            'laporan_id'
        );
    }

    // Riwayat pemeriksaan admin
    public function pemeriksaan(): HasMany
    {
        return $this->hasMany(
            PemeriksaanApd::class,
            'laporan_id'
        );
    }

    // Sesi pemantauan langsung
    public function sesiLive(): HasMany
    {
        return $this->hasMany(
            SesiLive::class,
            'laporan_id'
        );
    }
}