<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use App\Models\Radiology\Transaction as TransaksiRadiologi;
use App\Models\LabPK\Transaksi as TransaksiLabPK;
use App\Models\LabPA\Transaction as TransaksiLabPA;
use Carbon\Carbon;

class PenunjangPermintaan extends Model
{
	use DataLogger;
	protected $connection = 'kasus';
	protected $table = 'penunjang_permintaan';

	public function getTransaksiAttribute()
	{
		switch ($this->modul_id) {
			case 6:
				return TransaksiRadiologi::with('detail.tarif')->find($this->transaksi_id);
				break;
			case 10:
				return TransaksiLabPK::with('detail.tarif','detail.hasil','spesimen.spesimen')->find($this->transaksi_id);
				break;
			case 11:
				return TransaksiLabPA::with('detail.tarif')->find($this->transaksi_id);
				break;			
			default:
				break;
		}
	}

	public function creator()
	{
		return $this->hasOne('App\User','id','created_by');
	}

	public function kasus()
	{
		return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
	}

	public function transaksi_labpk()
	{
		return $this->hasOne('App\Models\LabPK\TransaksiLabPK','id','transaksi_id');
	}


}
