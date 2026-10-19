<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PemeriksaanApd extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan_apd';

    public $timestamps = false;

    protected $fillable = [
        'laporan_id',
        'admin_id',
        'hasil',
        'catatan',
        'tanggal_pemeriksaan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pemeriksaan' => 'datetime',
        ];
    }

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(
            LaporanApd::class,
            'laporan_id'
        );
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'admin_id'
        );
    }
}