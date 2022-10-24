<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class KategoriBPJS extends Model
{
	use DataLogger;
	protected $connection = 'keuangan';
	protected $table = 'kategori_bpjs';

	public function parent()
	{
		return $this->hasOne('App\Models\Keuangan\KategoriBPJS', 'id', 'parent_id');
	}

	public function child()
	{
		return $this->hasMany('App\Models\Keuangan\KategoriBPJS', 'parent_id', 'id');
	}
}