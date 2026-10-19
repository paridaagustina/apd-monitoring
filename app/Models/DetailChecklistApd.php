<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailChecklistApd extends Model
{
    use HasFactory;

    protected $table = 'detail_checklist_apd';

    protected $fillable = [
        'laporan_id',
        'jenis_apd_id',
        'digunakan',
    ];

    protected function casts(): array
    {
        return [
            'digunakan' => 'boolean',
        ];
    }

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(
            LaporanApd::class,
            'laporan_id'
        );
    }

    public function jenisApd(): BelongsTo
    {
        return $this->belongsTo(
            JenisApd::class,
            'jenis_apd_id'
        );
    }
}