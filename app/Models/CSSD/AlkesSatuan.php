<?php

namespace App\Models\CSSD;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use App\Models\CSSD\Alkes;
use Illuminate\Database\Eloquent\SoftDeletes;


class AlkesSatuan extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'cssd';
	protected $table = 'alkes_satuan';


	public function alkes()
	{
		return $this->hasOne('App\Models\Farmasi\ItemsTemplate', 'id', 'item_template_id');
	}

	public function log()
	{
		return $this->hasMany('App\Models\CSSD\AlkesSatuanLog', 'alkes_satuan_id', 'id');
	}

	public function getIsEffectiveAttribute()
	{

		if($this->jumlah_pemakaian < $this->alkes->max_pemakaian)
			return 1;
		else
			return 0;
	}
}
