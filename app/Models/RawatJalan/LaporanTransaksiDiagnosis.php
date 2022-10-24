<?php

namespace App\Models\RawatJalan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class LaporanTransaksiDiagnosis extends Model
{
	use DataLogger;

	protected $connection = 'rawatjalan';
	protected $table = 'laporan_transaksi_diagnosis';


	public function laporan_transaksi() {
		return $this->hasOne('App\Models\RawatJalan\LaporanTransaksi', 'kasus_id', 'kasus_id');
	}

	public function dtd()
	{
		return $this->hasOne('App\Models\Kasus\DTD','id','dtd_id');
	}


	public function icd10() {
		return $this->hasOne('App\Models\Kasus\ICD10', 'id', 'icd10_id')->withTrashed();
	}
}
