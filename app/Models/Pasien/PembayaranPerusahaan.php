<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembayaranPerusahaan extends Model
{
	use DataLogger;
		use SoftDeletes;
    	protected $connection = 'patients';
    	protected $table = 'pembayaran_perusahaan';

    	public function tipe()
		{
			return $this->hasOne('App\Models\Pasien\PembayaranPerusahaanType', 'id', 'type');
		}

		public function perusahaan_keuangan()
		{
			return $this->hasOne('App\Models\Keuangan\Perusahaan', 'id', 'perusahaan_keuangan_id');
		}

		public function pekerjaan()
		{
			return $this->hasOne('App\Models\Pasien\PembayaranPerusahaanPekerjaan', 'id', 'pekerjaan_id');
		}

		public function golongan()
		{
			return $this->hasOne('App\Models\Pasien\PembayaranPerusahaanGolongan', 'id', 'golongan_id');
		}
}
