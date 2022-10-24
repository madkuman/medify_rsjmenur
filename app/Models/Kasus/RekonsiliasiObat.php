<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class RekonsiliasiObat extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kasus';
	protected $table = 'rekonsiliasi_obat';


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
		return $this->hasOne('App\Models\Gudang\ItemsTemplate', 'id', 'obat_id');
	}

	public function details() {
		return $this->hasMany('App\Models\Kasus\RekonsiliasiObatDetail', 'rekonsiliasi_obat_id', 'id');
	}
}
