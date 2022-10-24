<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpnameDetail extends Model
{
	use DataLogger;
	protected $connection = 'farmasi';
	protected $table = 'opname_detail';
	
	use SoftDeletes;

	public function searchableAs()
  	{
    	return 'farmasi_opnamedetail';
  	}

	public function created_by_detail()
	{
		return $this->hasOne('App\User','id', 'created_by');
	}

	public function detail_item()
	{
		return $this->hasOne('App\Models\Farmasi\ItemsFarmasi','id', 'item_id');
	}

	public function stok_opname()
	{
		return $this->hasOne('App\Models\Farmasi\StokOpname','id', 'stok_opname_id');
	}

}
