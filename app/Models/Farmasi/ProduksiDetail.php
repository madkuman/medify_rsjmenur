<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProduksiDetail extends Model
{
	use DataLogger;
    
	use SoftDeletes;

	protected $connection = 'farmasi';
	protected $table = 'produksi_detail';

	public function itemFarmasi()
	{
		return $this->hasOne('App\Models\Farmasi\ItemsFarmasi', 'id', 'item_farmasi_id')->withTrashed();
	}
	public function produksi()
	{
		return $this->hasOne('App\Models\Farmasi\Produksi', 'id', 'produksi_id');
	}
}
