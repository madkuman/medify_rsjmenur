<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;


class CatatanPengobatanPasien extends Model
{
	use DataLogger;
    use SoftDeletes;
	protected $connection = 'kasus';
	protected $table = 'catatan_pengobatan_pasien';


    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function updater() {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }
    public function deleter() {
        return $this->hasOne('App\User', 'id', 'deleted_by');
    }

    public function kasus() {
        return $this->hasOne('App\Models\Kasus\Kasus', 'id', 'kasus_id');
    }

    public function item_master() {
        return $this->hasOne('App\Models\Farmasi\ItemsTemplate', 'id', 'obat_id');
    }

    public function details() {
        return $this->hasMany('App\Models\Kasus\CatatanPengobatanPasienDetail', 'catatan_pengobatan_pasien_id', 'id')->orderBy('pemberian_at','asc');
    }
}
