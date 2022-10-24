<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
	use DataLogger;	
	use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'kategori';

	public function parent()
	{
		return $this->hasOne('App\Models\Keuangan\Kategori','id','parent_id');
	}

	public function child()
	{
		return $this->hasMany('App\Models\Keuangan\Kategori','parent_id','id');
	}
}
