<?php

namespace App\Models\RawatJalan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;

class Dokter extends Model
{
	use DataLogger;
	protected $connection = 'rawatjalan';
	protected $table = 'dokter';

	public function jadwal(){
		return $this->hasMany('App\Models\RawatJalan\DokterJadwal', 'dokter_id', 'id');
	}

	public function jobs_today(){
		return $this->hasMany('App\Models\RawatJalan\Transaksi', 'dokter_id', 'id')->whereDate('ordered_at', '=', Carbon::today()->toDateString());
	}

	public function user(){
		return $this->hasOne('App\User', 'dokter_id', 'id');
	}

	public function jadwal_temp(){
        return $this->hasMany('App\Models\RawatJalan\DokterJadwalTemp', 'dokter_id', 'id');
    }

	public function satusehat_practitioner()
	{
		return $this->hasOne(\App\Models\ThirdPartySatuSehat\Practitioner::class, 'dokter_id', 'id');
	}
}
