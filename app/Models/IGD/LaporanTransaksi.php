<?php

namespace App\Models\IGD;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class LaporanTransaksi extends Model
{
	use DataLogger;
    protected $connection = 'igd';
	protected $table = 'laporan_transaksi';


	public function pasien() {
		return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');
	}

	public function kasus()
	{
		return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
	}
	
	public function ruangan()
	{
		return $this->hasOne('App\Models\IGD\Ruangan','id','ruangan_id');
	}

	public function pasien_pembayaran()
	{
		return $this->hasOne('App\Models\Pasien\PasienPembayaran','id','pasien_pembayaran_id')->withTrashed();
	}

	public function diagnosis()
	{
		return $this->hasMany('App\Models\IGD\LaporanTransaksiDiagnosis','kasus_id','kasus_id');
	}
}
