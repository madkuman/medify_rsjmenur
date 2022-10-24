<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;
use App\Models\Kasus\TagihanDetail;

class Tagihan extends Model
{
	use DataLogger;
  	protected $connection = 'kasus';
	protected $table = 'tagihan';


	public function detail()
	{
		return $this->hasMany('App\Models\Kasus\TagihanDetail','kasus_tagihan_id','id')->orderBy('created_at');
	}

	public function detailOperasi()
	{
		return $this->hasOne('App\Models\Kasus\TagihanDetail','kasus_tagihan_id','id')->whereNotNull('transaksi_kamar_operasi_id')->orderBy('created_at');
	}

	public function detail_descending()
	{
		return $this->hasMany('App\Models\Kasus\TagihanDetail','kasus_tagihan_id','id')->orderBy('created_at','desc');
	}

	public function detailDepartemen($id)
	{
		return $this->hasMany('App\Models\Kasus\TagihanDetail','kasus_tagihan_id','id')->where('departemen_id',$id)->orderBy('created_at');
	}

	public function kasus()
	{
		return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
	}

	public function piutang()
	{
		return $this->hasOne('App\Models\Keuangan\Piutang','kasus_tagihan_id','id');
	}

	public function getCheckoutAtFormattedAttribute()
	{
		return Carbon::createFromFormat('Y-m-d H:i:s', $this->checkout_at)->format('d F Y, H:i');
	}

	public function getTotalSumAttribute()
	{
		$subtotal = TagihanDetail::where('kasus_tagihan_id',$this->id)->sum('subtotal');
		return $subtotal;
	}

	public function getShowSyncAttribute()
	{
		$detail = TagihanDetail::where('kasus_tagihan_id',$this->id)->get();
		
		$sep_change = 0;

		foreach($detail as $key => $item)
		{
			if($key == 0) $sep_id = $item->sep_id;
			if($sep_id != $item->sep_id) $sep_change = 1;
		}

		return $sep_change;
	}

	public function hasPenunjang($penunjang)
	{
		switch ($penunjang) {
			case 'radiologi':
				foreach($this->detail as $d)
				{
					if(isset($d->radiologi) && !is_null($d->radiologi))
						return TRUE;
				}
				break;
			case 'labpa':
				foreach($this->detail as $d)
				{
					if(isset($d->labpa) && !is_null($d->labpa))
						return TRUE;
				}
				break;
			case 'labpk':
				foreach($this->detail as $d)
				{
					if(isset($d->labpk) && !is_null($d->labpk))
						return TRUE;
				}
				break;
			
			default:
				# code...
				break;
		}
		return FALSE;
	}
	
	public function permintaanJenazah()
	{
		return $this->hasOne('App\Models\KamarJenazah\Permintaan', 'kasus_id', 'kasus_id');
	}

	public function ketKelahiran()
	{
		return $this->hasMany('App\Models\Kasus\KetKelahiran', 'kasus_id', 'kasus_id');
	}
}