<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class ViewTindakanUserTotal extends Model
{
	use DataLogger;
	protected $connection = 'kasus';
	protected $table = 'view_tindakan_user_total';

	public function user() {
		return $this->hasOne('App\User', 'id', 'user');
	}

	public function tarif_master() {
		return $this->hasOne('App\Models\Keuangan\TarifMaster', 'id', 'tarif_master_id');
	}
}
