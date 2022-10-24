<?php

namespace App\Models\Farmasi;

use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisAntrian extends Model
{
    use DataLogger;
    protected $connection = 'farmasi';
    protected $table = 'jenis_antrian';
    public static $path_sound = 'assets/img/farmasi-tv/jenis-antrian';
    use SoftDeletes;

    public function tipe_perusahaan()
    {
        return $this->hasOne('App\Models\Pasien\PembayaranPerusahaanType', 'id', 'perusahaan_tipe');
    }
}
