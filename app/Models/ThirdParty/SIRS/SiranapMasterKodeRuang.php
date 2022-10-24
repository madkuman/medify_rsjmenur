<?php

namespace App\Models\ThirdParty\SIRS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiranapMasterKodeRuang extends Model
{
	protected $connection = 'rawatinap';
	protected $table = 'siranap_master_kode_ruang';
    use SoftDeletes;


	public function ruangan()
	{
		return $this->hasMany('App\Models\RawatInap\Ruangan', 'siranap_kode_ruang_kode', 'kode');
	}
}
