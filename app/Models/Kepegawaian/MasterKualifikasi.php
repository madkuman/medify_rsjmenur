<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;


class MasterKualifikasi extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kepegawaian';
	protected $table = 'master_kualifikasi';
	protected $dates = ['deleted_at'];

	public function masterSubkualifikasi()
	{
		return $this->hasMany('App\Models\Kepegawaian\MasterSubkualifikasi');
	}

	public function pegawai()
	{
		return $this->hasOne('App\Models\Kepegawaian\Pegawai');
	}
}
