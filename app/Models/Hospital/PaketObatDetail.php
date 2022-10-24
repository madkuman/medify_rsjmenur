<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaketObatDetail extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'mysql';
	protected $table = 'paket_obat_detail';

	public function item_detail()
	{
		return $this->hasOne('App\Models\Farmasi\ItemsTemplate','id', 'obat_id')->withTrashed();
	}
	public function racikan_detail()
	{
		return $this->hasMany('App\Models\Hospital\PaketObatRacikanDetail','resep_detail_id', 'id');
	}

}
