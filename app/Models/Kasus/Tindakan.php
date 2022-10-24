<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;

class Tindakan extends Model
{
	use DataLogger;
    protected $connection = 'kasus';
    protected $table = 'tindakan';
    protected $appends = ['tanggal'];


    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }
    public function subscriber() {
        return $this->hasOne('App\User', 'id', 'subscribed_by');
    }
    public function kesalahanTindakanBy() {
        return $this->hasOne('App\User', 'id', 'kesalahan_tindakan_by');
    }

    public function icd9() {
        return $this->hasOne('App\Models\Kasus\ICD9', 'id', 'icd_9')->withTrashed();
    }

    public function kasus()
    {
        return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
    }

    public function tarif_master()
    {
        return $this->hasOne('App\Models\Keuangan\TarifMaster','id','tarif_master_id');
    }

    public function getTanggalAttribute() {
        return Carbon::parse($this->attributes['created_at'])->format('d F Y H:i');
    }


    public function lokasi()
    {
        return $this->hasOne('App\Models\Hospital\Lokasi', 'id', 'lokasi_id');
    }

    public function icd9_bpjs()
    {
        return $this->hasOne('App\Models\Kasus\ICD9', 'id', 'icd_9')->where('bpjs_support', 1);
    }
}