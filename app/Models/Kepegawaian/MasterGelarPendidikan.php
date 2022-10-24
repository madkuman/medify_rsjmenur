<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterGelarPendidikan extends Model
{
	use SoftDeletes;
	
    protected $connection = 'kepegawaian';
	protected $table = 'pendidikan_gelar';

	protected $fillable = [
        'pendidikan_strata_id',
		'nama'
	];
	
	public function strata_pendidikan()
    {
        return $this->hasOne('App\Models\Kepegawaian\MasterStrataPendidikan','id', 'pendidikan_strata_id');
    }
}