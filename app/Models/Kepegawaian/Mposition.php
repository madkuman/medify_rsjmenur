<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mposition extends Model
{
	use DataLogger;
  use SoftDeletes;
	
  protected $connection = 'kepegawaian';
	protected $table = 'master_pangkat';
	protected $table_position = 'pangkat';

	protected $fillable = [
		'name'
	];

	public function employees(){
		return $this->belongsToMany(
			'App\Models\Kepegawaian\Pegawai',
			$this->table_position,
			'mposition_id',
			'employee_id'
		);
	}
}
