<?php

namespace App\Models\Gudang;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
	use DataLogger;
	protected $connection = 'gudang';
	protected $table = 'kategori';

	use SoftDeletes;

	public function item()
	{
		return $this->hasMany('App\Models\Gudang\ItemsKategori','kategori_id', 'id');
	}

	public function created_by_detail()
	{
		return $this->hasOne('App\User','id', 'created_by');
	}

}
