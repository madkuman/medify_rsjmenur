<?php

namespace App\Models\Gudang;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpnameDetail extends Model
{
	use DataLogger;
    protected $connection = 'gudang';
	protected $table = 'opname_detail';
	
	use SoftDeletes;

	public function searchableAs()
  	{
    	return 'gudang_opnamedetail';
  	}

	public function created_by_detail()
	{
		return $this->hasOne('App\User','id', 'created_by');
	}

	public function detail_item()
	{
		return $this->hasOne('App\Models\Gudang\ItemsTemplate','id', 'item_id')->withTrashed();
	}

	public function stok_opname()
	{
		return $this->hasOne('App\Models\Gudang\StokOpname','id', 'stok_opname_id');
	}
}
