<?php

namespace App\Models\Urikkes;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Photo extends Model
{
	use DataLogger;

	protected $connection = 'urikkes';
	protected $table = 'photo';
	public function latihanKesehatan() {
		return $this->belongsTo('App\Models\Urikkes\LatihanKesehatan','latihan_kesehatan_id');
	}

}