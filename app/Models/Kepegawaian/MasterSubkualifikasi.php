<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterSubkualifikasi extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kepegawaian';
	protected $table = 'master_subkualifikasi';
	protected $dates = ['deleted_at'];

	public function kualifikasi()
	{
		return $this->belongsTo('App\Models\Kepegawaian\MasterKualifikasi')
					->withTrashed();
	}

	public function pegawai()
	{
		return $this->hasMany('App\Models\Kepegawaian\Pegawai')
					->withTrashed();
	}
}
