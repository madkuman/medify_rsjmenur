<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PasienPembayaran extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'patients';
	protected $table = 'pasien_pembayaran';

	public function perusahaan()
	{
		return $this->hasOne('App\Models\Pasien\PembayaranPerusahaan', 'id', 'perusahaan_id');
	}

	public function jenis()
	{
		return $this->hasOne('App\Models\Pasien\JenisPembayaran', 'id', 'jenis_pembayaran');
	}

	public function kelas()
	{
		return $this->hasOne('App\Models\Hospital\Kelas', 'id', 'kelas_id');
	}

	public function pasien()
	{
		return $this->belongsTo('App\Models\Pasien\Pasien', 'pasien_id');
	}
}
