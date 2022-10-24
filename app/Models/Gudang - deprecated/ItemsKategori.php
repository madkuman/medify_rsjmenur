<?php

namespace App\Models\Gudang;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemsKategori extends Model
{
	use DataLogger;
	protected $connection = 'gudang';
	protected $table = 'items_kategori';

	use SoftDeletes;

	public function detail_item()
	{
		return $this->hasOne('App\Models\Gudang\ItemsTemplate','id', 'item_template_id');
	}

	public function detail_kategori()
	{
		return $this->hasOne('App\Models\Gudang\Kategori','id', 'kategori_id')->withTrashed();
	}

}
