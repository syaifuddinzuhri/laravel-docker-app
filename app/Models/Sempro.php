<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sempro extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'judul_1',
        'judul_2',
        'judul_3',
        'waktu',
        'tempat',
        'nama_ruang',
        'link',
        'pembimbing_1',
        'pembimbing_2',
        'pendamping',
        'status_judul_1',
        'status_judul_2',
        'status_judul_3',
        'status'
    ];

    /**
     * Get the mahasiswa that owns the Sempro
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
