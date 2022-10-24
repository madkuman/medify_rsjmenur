<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mdepartment extends Model
{
	use DataLogger;
  use SoftDeletes;
	
  protected $connection = 'kepegawaian';
	protected $table = 'mdepartments';
	protected $table_department = 'departments';

	protected $fillable = [
		'name'
	];

	public function employees(){
		return $this->belongsToMany(
			'App\Models\Kepegawaian\Pegawai',
			$this->table_department,
			'mdepartment_id',
			'employee_id'
		);
	}
}
