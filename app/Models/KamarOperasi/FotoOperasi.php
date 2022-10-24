<?php

namespace App\Models\KamarOperasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class FotoOperasi extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kamaroperasi';
	protected $table = 'foto_operasi';

	public function getLastUrlAttribute()
	{
		$explosion = explode("/",$this->url);
		$id = end($explosion);
		return $id;
	}
}
