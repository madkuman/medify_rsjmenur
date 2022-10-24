<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemTemplateHarga extends Model
{
	use DataLogger;
	protected $connection = 'farmasi';
	protected $table = 'item_template_harga';
	
	use SoftDeletes;

	public function item_template()
	{
		return $this->hasOne('App\Models\Farmasi\ItemsFarmasi','id', 'item_template_id');
	}

	public function supplier()
	{
		return $this->hasOne('App\Models\Keuangan\Perusahaan','id', 'supplier_id');
	}

}