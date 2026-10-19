<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BuktiLaporan extends Model
{
    use HasFactory;

    protected $table = 'bukti_laporan';

    const UPDATED_AT = null;

    protected $fillable = [
        'laporan_id',
        'jenis_bukti',
        'file_path',
    ];

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(
            LaporanApd::class,
            'laporan_id'
        );
    }
}