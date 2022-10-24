<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterDepartemen extends Model
{
	use SoftDeletes;
	
    protected $connection = 'kepegawaian';
	protected $table = 'departemen';

	protected $fillable = [
		'nama'
	];

	public function MasterJabatan() {
		return $this->belongsTo('App\Models\Kepegawaian\MasterJabatan','jabatan_id')
					->withTrashed();
	}
}
