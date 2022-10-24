<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Laravel\Scout\Searchable;

class RacikanDetail extends Model
{
	use DataLogger;
	protected $connection = 'farmasi';
	protected $table = 'racikan_detail';
	//use Searchable;
	use SoftDeletes;

	/*public function searchableAs()
	{
	    return 'apotek_transaction';
	}*/

	public function owner_detail()
	{
		return $this->hasOne('App\Models\Farmasi\Farmasi','id', 'farmasi_id')->withTrashed();
	}

	public function resep_detail()
	{
		return $this->hasOne('App\Models\Farmasi\ResepDetail','id', 'resep_id');
	}

	public function obat_detail()
	{
		return $this->hasOne('App\Models\Farmasi\ItemsFarmasi','id', 'obat_id');
	}

	public function items_detail()
	{
		return $this->hasOne('App\Models\Farmasi\Items','id', 'item_id');
	}

	public function aturan_detail()
	{
		return $this->hasOne('App\Models\Farmasi\AturanObat','id', 'aturan_id');
	}
}
