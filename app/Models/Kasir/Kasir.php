<?php

namespace App\Models\Kasir;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kasir extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kasir';
	protected $table = 'kasir';

	public function tagihan()
	{
		return $this->hasMany('App\Models\Kasir\Tagihan','kasir_id','id')->orderBy('created_at');
	}
}