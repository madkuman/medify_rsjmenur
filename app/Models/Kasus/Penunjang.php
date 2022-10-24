<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;


class Penunjang extends Model
{
	use DataLogger;
  	protected $connection = 'kasus';
	protected $table = 'penunjang';
    use SoftDeletes;

	public function permintaan() {
		return $this->hasOne('App\Models\Kasus\PenunjangPermintaan', 'transaksi_id', 'penunjang_permintaan_id');
	}
	
    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function komentar() {
    	return $this->hasMany('App\Models\Kasus\PenunjangKomentar', 'penunjang_id', 'id');
    }

    public function kasus(){
        return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
    }

    public function transaksi_radiolgy(){
        return $this->hasOne('App\Models\Radiology\Photo','penunjang_id','id');
    }
}