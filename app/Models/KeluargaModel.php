<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KeluargaModel extends Model
{
    use HasFactory;
    protected $table = 'keluarga_penduduk';
    protected $primaryKey = 'id_keluarga';
    protected $fillable = ['nomor_keluarga', 'jumlah_kendaraan', 'jumlah_tanggungan', 'jumlah_orang_kerja', 'luas_tanah'];
    public function keluarga(): HasMany
    {
        return $this->hasMany(PendudukModel::class, 'id_keluarga', 'id_keluarga');
    }
}