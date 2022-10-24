<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class MesinAntrianPasien extends Model
{
    use SoftDeletes;
	protected $connection = 'patients';
	protected $table = 'mesin_antrian_pasien';
    use DataLogger;
    
    public function pasien()
    {
        return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');
    }

    public function poliklinik()
    {
        return $this->hasOne('App\Models\RawatJalan\Poliklinik', 'id', 'poliklinik_id');
    }

    public function dokter()
    {
        return $this->belongsTo('App\Models\RawatJalan\Dokter', 'dokter_id', 'id');
    }

    public function loket()
    {
        return $this->hasOne('App\Models\Pasien\PengaturanLoket', 'id', 'loket_id');
    }

    public function jadwal()
    {
        return $this->hasOne('App\Models\RawatJalan\DokterJadwal', 'id', 'id_jadwal');
    }

    public function transaksi_rawat_jalan()
    {
        return $this->hasOne('App\Models\RawatJalan\Transaksi', 'id', 'transaksi_rawat_jalan_id');
    }
}
