<?php

namespace App\Models\RawatInap;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class LaporanTransaksi extends Model
{
	use DataLogger;
	protected $connection = 'rawatinap';
	protected $table = 'laporan_transaksi';


	public function pasien() {
		return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');
	}

	public function kasus()
	{
		return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
	}
	
	public function tempat_tidur()
	{
		return $this->hasOne('App\Models\RawatInap\TempatTidur','id','tempat_tidur_id');
	}

	public function pasien_pembayaran()
	{
		return $this->hasOne('App\Models\Pasien\PasienPembayaran','id','pasien_pembayaran_id')->withTrashed();
	}


	public function diagnosis()
	{
		return $this->hasMany('App\Models\RawatInap\LaporanTransaksiDiagnosis','kasus_id','kasus_id');
	}

	public function getKrsSebelumAttribute()
    {
        $krs_sebelum = LaporanTransaksi::where('pasien_id',$this->pasien_id)->where('krs_at','<',$this->krs_at)->orderby('krs_at','desc')->first();
        if(!empty($krs_sebelum)) return $krs_sebelum->krs_at;
        else return null;
    }
}
