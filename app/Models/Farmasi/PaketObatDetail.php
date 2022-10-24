<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaketObatDetail extends Model
{
	use DataLogger;
    use SoftDeletes;
	protected $connection = 'farmasi';
	protected $table = 'paket_obat_detail';

	public function item_detail()
	{
		return $this->hasOne('App\Models\Farmasi\ItemsFarmasi','id', 'obat_id')->withTrashed();
	}
}
