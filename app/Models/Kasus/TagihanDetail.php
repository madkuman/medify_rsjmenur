<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagihanDetail extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kasus';
	protected $table = 'tagihan_detail';
	protected $dates = ['deleted_at'];
	
	public function creator() {
		return $this->hasOne('App\User', 'id', 'created_by');
	}

	public function sep()
	{
		return $this->hasOne('App\Models\Kasus\BPJSSEP','id','sep_id');
	}

	public function departemen()
	{
		return $this->hasOne('App\Models\Keuangan\Departemen','id','departemen_id');	
	}
	
	
	public function tagihan()
	{
		return $this->hasOne('App\Models\Kasus\Tagihan','id','kasus_tagihan_id');
	}

	public function lokasi()
	{
		return $this->hasOne('App\Models\Hospital\Lokasi','id','lokasi_id');
	}

	public function radiologi()
	{
		return $this->hasOne('App\Models\Radiology\TransactionDetail', 'tagihan_detail_id', 'id');
	}

	public function labpa()
	{
		return $this->hasOne('App\Models\LabPA\TransactionDetail', 'tagihan_detail_id', 'id');
	}

	public function labpk()
	{
		return $this->hasOne('App\Models\LabPK\TransaksiDetail', 'tagihan_detail_id', 'id');
	}

	public function farmasiResepDetail()
	{
		return $this->hasOne('App\Models\Farmasi\ResepDetail', 'kasus_tagihan_detail_id', 'id');
	}
	public function operasi()
	{
		return $this->hasOne('App\Models\KamarOperasi\Transaksi', 'id', 'transaksi_kamar_operasi_id');
	}
	public function cppt()
	{
		return $this->hasOne('App\Models\Kasus\CPPT', 'tagihan_detail_id', 'id');
	}
	
	public function tarif()
	{
		return $this->hasOne('App\Models\Keuangan\Tarif', 'id', 'tarif_id');
	}
}