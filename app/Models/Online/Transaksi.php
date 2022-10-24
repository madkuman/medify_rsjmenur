<?php

namespace App\Models\Online;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use App\Models\RawatJalan\Poliklinik;
use App\Models\Urikkes\Paket;
use Carbon\Carbon;

class Transaksi extends Model
{
	use DataLogger;
	protected $connection = 'online';
	protected $table = 'transaksi';

	public function poli()
	{
		return $this->hasOne('App\Models\RawatJalan\Transaksi', 'id', 'transaksi_lokal_id');
	}

	public function urikkes()
	{
		return $this->hasOne('App\Models\Urikkes\Transaksi', 'id', 'transaksi_lokal_id');
	}

	public function tipe()
	{
		return $this->hasOne('App\Models\Online\Tipe', 'id', 'tipe_id');
	}

	public function pasien()
	{
		return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');
	}

	public function getLayananAttribute()
	{
		if(!empty($this->layanan_id))
		{
			if($this->tipe_id == 1) 
			{
				$layanan = Poliklinik::find($this->layanan_id);
				$layanan->nama = $layanan->name;
			}
			else  $layanan = Paket::find($this->layanan_id);
		}
		else
		$layanan = null;


		return $layanan;
	}

	public function getStatusTextAttribute()
	{

		if($this->status == 0)
		{
			$expired = Carbon::parse($this->expired_at);
			$now = Carbon::now();
			if($expired < $now) $status = -1;
			else $status = 0;
		}
		else if($this->status == 1) $status = 1;
		else if($this->status == -1) $status = -1;

		if($status == 0) $text = 'Menunggu';
		else if($status == 1) $text = 'Berhasil Dikonfirmasi';
		else if($status == -1) $text = 'Expired';
		else  $text = 'Menunggu';


		return $text;
	}

	public function getExpiredHumanAttribute()
	{
		Carbon::setLocale('id');
		$expired_at = Carbon::parse($this->expired_at);
		return $expired_at->diffForHumans();
	}

	public function getStatusExpiredAttribute()
	{
		if($this->status == 0)
		{
			$expired = Carbon::parse($this->expired_at);
			$now = Carbon::now();
			if($expired < $now) $status = -1;
			else $status = 0;
		}
		else if($this->status == 1) $status = 1;
		else if($this->status == -1) $status = -1;


		return $status;
	}

}
