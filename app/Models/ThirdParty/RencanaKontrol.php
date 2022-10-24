<?php

namespace App\Models\ThirdParty;

use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RencanaKontrol extends Model
{
    use DataLogger;
	use SoftDeletes;

    protected $connection = 'thirdp';
    protected $table = 'rencana_kontrol';

    public function pasien()
    {
        return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');
    }

    public function dokter(){
        return $this->hasOne(\App\Models\RawatJalan\Dokter::class, 'bpjs_kode_dpjp', 'kode_dokter');
    }

    public function sep(){
        return $this->hasOne(\App\Models\Kasus\BPJSSEP::class, 'no_sep', 'no_sep');
    }
}
