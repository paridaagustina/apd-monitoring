<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SesiLive extends Model
{
    use HasFactory;

    protected $table = 'sesi_live';

    protected $fillable = [
        'laporan_id',
        'status',
        'room_id',
        'waktu_mulai',
        'waktu_selesai',
    ];

    protected function casts(): array
    {
        return [
            'waktu_mulai' => 'datetime',
            'waktu_selesai' => 'datetime',
        ];
    }

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(
            LaporanApd::class,
            'laporan_id'
        );
    }
}