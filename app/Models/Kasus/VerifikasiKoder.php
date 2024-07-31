<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class VerifikasiKoder extends Model
{
    protected $connection = 'kasus';
	protected $table = 'verifikasi_koder';
    use SoftDeletes;
    use DataLogger;

    public function kasus() {
        return $this->belongsTo('App\Models\Kasus\Kasus', 'kasus_id', 'id');
    }

    public function icd10() {
	    return $this->hasOne('App\Models\Kasus\ICD10', 'id', 'icd_10')->withTrashed();
    }

    public function icd10_bpjs() {
        return $this->hasOne('App\Models\Kasus\ICD10', 'id', 'icd_10')->where('bpjs_support', 1);
    }

    public function icd9() {
	    return $this->hasOne('App\Models\Kasus\ICD9', 'id', 'icd_9')->withTrashed();
    }

    public function icd9_bpjs() {
	    return $this->hasOne('App\Models\Kasus\ICD9', 'id', 'icd_9')->where('bpjs_support', 1);
    }

    public function creator() {
		return $this->hasOne('App\User', 'id', 'created_by');
    }
    
    public function editor() {
		return $this->hasOne('App\User', 'id', 'updated_by');
	}
}
