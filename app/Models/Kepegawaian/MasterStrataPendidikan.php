<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterStrataPendidikan extends Model
{
	use SoftDeletes;
	
    protected $connection = 'kepegawaian';
	protected $table = 'pendidikan_strata';

	protected $fillable = [
        'pendidikan_jenis_id',
		'name'
	];
	
	public function jenisPendidikan()
	{
		return $this->hasOne('App\Models\Kepegawaian\MasterJenisPendidikan','id', 'pendidikan_jenis_id')->withTrashed();
	}
}