<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class Diagnosis extends Model
{
	use DataLogger;
  	protected $connection = 'kasus';
	protected $table = 'diagnosis';
    protected $appends = ['tanggal'];
    use SoftDeletes;

    public function creator() {
	    return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function icd10() {
	    return $this->hasOne('App\Models\Kasus\ICD10', 'id', 'icd_10')->withTrashed();
    }
    public function getTanggalAttribute() {
        if(isset($this->attributes['created_at']))
        {
            return Carbon::parse($this->attributes['created_at'])->format('d F Y');
        }
    }
    public function kasus() {
        return $this->hasOne('App\Models\Kasus\Kasus', 'id', 'kasus_id');
    }

    public function clinical_pathway() {
        return $this->hasMany('App\Models\ClinicalPathway\Article', 'icd10_id', 'icd_10');
    }

    public function lokasi()
    {
        return $this->hasOne('App\Models\Hospital\Lokasi', 'id', 'lokasi_id');
    }

    public function icd10_bpjs()
    {
        return $this->hasOne('App\Models\Kasus\ICD10', 'id', 'icd_10')->where('bpjs_support', 1);
    }
}