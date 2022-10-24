<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Spesialisasi extends Model
{
	use DataLogger;
    protected $connection = 'mysql';
	protected $table = 'profession_specialty';

	public function keProfesi(){
		return $this->belongsTo('App\Models\Hospital\Profesi', 'profession');
	}
}
