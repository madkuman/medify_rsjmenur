<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
	use DataLogger;
	protected $connection = 'farmasi';
	protected $table = 'kategori';

	use SoftDeletes;

	public function item()
	{
		return $this->hasMany('App\Models\Farmasi\ItemsKategori','kategori_id', 'id');
	}

	public function sumber_dana()
	{
		return $this->hasMany('App\Models\Farmasi\SumberDana','kategori_id', 'id');
	}

	public function created_by_detail()
	{
		return $this->hasOne('App\User','id', 'created_by');
	}

}
