<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelatihan extends Model
{
	use SoftDeletes;
	
    protected $connection = 'kepegawaian';
	protected $table = 'pelatihan';
	protected $fillable = [ 
		'name',
		'period',
		'place'
	];

	public function pegawai() {
		return $this->hasOne('App\Models\Kepegawaian\Pegawai', 'id', 'pegawai_id');
	}
	
	
	public function creator() {
		return $this->hasOne('App\User', 'id', 'created_by');
	}

	public function master_pelatihan() {
		return $this->hasOne('App\Models\Kepegawaian\MasterPelatihan','id', 'master_pelatihan_id');
	}
}
