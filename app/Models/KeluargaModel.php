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

    protected $fillable = ['nomor_keluarga', 'jumlah_kendaraan', 'jumlah_tanggungan', 'jumlah_orang_kerja', 'foto_kk'];
    // protected $fillable = ['nomor_keluarga', 'jumlah_kendaraan', 'jumlah_tanggungan', 'jumlah_orang_kerja', 'rt', 'foto_kk'];

    public function detail_keluarga(): HasMany
    {
        return $this->hasMany(detail_keluarga_model::class, 'id_keluarga');
    }
    public function keluarga_bansos(): HasMany
    {
        return $this->hasMany(DetailBansosModel::class);
    }
    public function kriteria_keluarga(): HasMany
    {
        return $this->hasMany(KriteriaKeluargaModel::class);
        return $this->hasMany(detail_keluarga_model::class);
    }
    
}