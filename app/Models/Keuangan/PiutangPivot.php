<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class PiutangPivot extends Model
{
	use DataLogger;
	protected $connection = 'keuangan';
	protected $table = 'piutang_pivot';

	public function pasien()
	{
		return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');
	}

	public function piutang()
	{
		return $this->hasOne('App\Models\Keuangan\Piutang', 'id', 'piutang_id');
	}

	public function piutang_detail()
	{
		return $this->hasMany('App\Models\Keuangan\PiutangDetail', 'piutang_pivot_id', 'id');
	}

	public function penagihan_bpjs()
	{
		return $this->hasOne('App\Models\Keuangan\PenagihanBPJS', 'id', 'penagihan_bpjs_id');
	}	
}