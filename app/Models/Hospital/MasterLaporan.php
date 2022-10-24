<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterLaporan extends Model
{
	use DataLogger;
	use SoftDeletes;

	protected $connection = 'mysql';
	protected $table = 'master_laporan';



	public function departemen(){
		return $this->hasOne('App\Models\Hospital\LokasiDepartemen', 'id', 'departemen_id');
	}
}
