<?php

namespace App\Models\ThirdParty\SIRS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiranapMasterTipePasien extends Model
{
	protected $connection = 'rawatinap';
	protected $table = 'siranap_master_tipe_pasien';
    use SoftDeletes;

    
	public function ruangan()
	{
		return $this->hasMany('App\Models\RawatInap\Ruangan', 'siranap_tipe_pasien_kode', 'kode');
	}
}
