<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PNS extends Model
{
	use DataLogger;
	use SoftDeletes;
	
    protected $connection = 'kepegawaian';
	protected $table = 'pns';

	protected $fillable = [
		'section',
		'position',
		'functional_position'
	];

	public function employee() {
		return $this->hasOne('App\Models\Kepegawaian\Pegawai', 'id', 'employee_id');
	}
}
