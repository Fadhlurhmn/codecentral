<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class satpam extends Model
{
    use HasFactory;
    protected $table = 'satpam';
    protected $primaryKey = 'id_satpam';
    protected $fillable = ['nama', 'nomor_telepon'];

    public function jadwal_keamanan()
    {
        return $this->hasMany(detail_jadwal_keamanan::class, 'id_satpam', 'id_satpam');
    }
}
