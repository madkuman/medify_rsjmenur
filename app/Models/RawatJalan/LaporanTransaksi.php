<?php

namespace App\Models\RawatJalan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class LaporanTransaksi extends Model
{
	use DataLogger;
	protected $connection = 'rawatjalan';
	protected $table = 'laporan_transaksi';


	public function pasien() {
		return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');
	}

	public function kasus()
	{
		return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
	}
	
	public function poliklinik()
	{
		return $this->hasOne('App\Models\RawatJalan\Poliklinik','id','poliklinik_id');
	}

	public function pasien_pembayaran()
	{
		return $this->hasOne('App\Models\Pasien\PasienPembayaran','id','pasien_pembayaran_id')->withTrashed();
	}


	public function diagnosis()
	{
		return $this->hasMany('App\Models\RawatJalan\LaporanTransaksiDiagnosis','kasus_id','kasus_id');
	}
}
