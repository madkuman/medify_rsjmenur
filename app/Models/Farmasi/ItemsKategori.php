<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemsKategori extends Model
{
	use DataLogger;
	protected $connection = 'farmasi';
	protected $table = 'items_kategori';

	use SoftDeletes;

	public function detail_item()
	{
		return $this->hasOne('App\Models\Farmasi\ItemsTemplate','id', 'item_template_id');
	}

	public function detail_kategori()
	{
		return $this->hasOne('App\Models\Farmasi\Kategori','id', 'kategori_id')->withTrashed();
	}

}
