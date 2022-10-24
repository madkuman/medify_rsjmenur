<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatatanPengobatanPasienDetail extends Model
{
	use DataLogger;
    use SoftDeletes;

	protected $connection = 'kasus';
	protected $table = 'catatan_pengobatan_pasien_detail';


    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function updater() {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }
    public function deleter() {
        return $this->hasOne('App\User', 'id', 'deleted_by');
    }
    public function catatan_pengobatan_pasien() {
        return $this->hasOne('App\Models\Kasus\CatatanPengobatanPasien', 'id', 'catatan_pengobatan_pasien_id');
    }
    public function verifikator_1() {
        return $this->hasOne('App\User', 'id', 'verified_by');
    }
    public function verifikator_2() {
        return $this->hasOne('App\User', 'id', 'verified_by_2');
    }

}
