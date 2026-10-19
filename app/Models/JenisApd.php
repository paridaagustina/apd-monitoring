<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisApd extends Model
{
    use HasFactory;

    protected $table = 'jenis_apd';

    protected $fillable = [
        'nama_apd',
        'keterangan',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'aktif' => 'boolean',
        ];
    }

    public function detailChecklist(): HasMany
    {
        return $this->hasMany(
            DetailChecklistApd::class,
            'jenis_apd_id'
        );
    }
}