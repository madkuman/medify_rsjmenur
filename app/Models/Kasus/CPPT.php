<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class CPPT extends Model
{
	use DataLogger;
    protected $connection = 'kasus';
    protected $table = 'cppt';
    protected $appends = ['tanggal','tanggal_update','tanggal_verifikasi','tanggal_verifikasi_ners'];
    use SoftDeletes;


    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function updater() {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }
    public function verifier() {
        return $this->hasOne('App\User', 'id', 'verified_by');
    }
    public function verifikatorNers() {
        return $this->hasOne('App\User', 'id', 'verified_ners_by');
    }
    public function reviewer() {
        return $this->hasOne('App\User', 'id', 'review_by');
    }


    public function kasus() {
        return $this->hasOne('App\Models\Kasus\Kasus', 'id', 'kasus_id');
    }

    public function getTanggalAttribute() {
        return Carbon::parse($this->attributes['created_at'])->format('d F Y H:i');
    }

    public function getTanggalUpdateAttribute() {
        return Carbon::parse($this->attributes['updated_at'])->format('d F Y H:i');
    }

    public function getTanggalVerifikasiAttribute() {
        return Carbon::parse($this->attributes['verified_at'])->format('d F Y H:i');
    }

    public function getTanggalVerifikasiNersAttribute() {
        return Carbon::parse($this->attributes['verified_ners_at'])->format('d F Y H:i');
    }

    public function tagihanDetail()
    {
        return $this->hasOne('App\Models\Kasus\TagihanDetail','id','tagihan_detail_id');
    }
}
