<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Laravel\Scout\Searchable;

class ResepDetail extends Model
{
	use DataLogger;
	protected $connection = 'farmasi';
	protected $table = 'resep_detail';
	//use Searchable;
	use SoftDeletes;

	/*public function searchableAs()
	{
	    return 'apotek_transaction';
	}*/

	public function owner_detail()
	{
		return $this->hasOne('App\Models\Farmasi\Farmasi','id', 'farmasi_id')->withTrashed();
	}

	public function resep_detail()
	{
		return $this->hasOne('App\Models\Farmasi\Resep','id', 'resep_id');
	}

	public function detail_asal()
	{
		return $this->hasOne('App\Models\Farmasi\ResepDetail','id', 'detail_asal_id');
	}

	public function resep()
	{
		return $this->hasOne('App\Models\Farmasi\Resep','id', 'resep_id');
	}
	
	public function obat_detail()
	{
		return $this->hasOne('App\Models\Farmasi\ItemsFarmasi','id', 'obat_id');
	}

	public function items_detail()
	{
		return $this->hasOne('App\Models\Farmasi\Items','id', 'item_id');
	}

	public function aturan_detail()
	{
		return $this->hasOne('App\Models\Farmasi\AturanObat','id', 'aturan_id');
	}

	public function log()
	{
		return $this->hasMany('App\Models\Farmasi\LogTransaksi','resep_detail_id', 'id');
	}
	public function logLast()
	{
		return $this->hasOne('App\Models\Farmasi\LogTransaksi','resep_detail_id', 'id')->latest('id');
	}

	public function racikan()
	{
		return $this->hasMany('App\Models\Farmasi\RacikanDetail','resep_detail_id', 'id');
	}

	public function kasusTagihanDetail()
	{
		return $this->hasOne('App\Models\Kasus\TagihanDetail','id', 'kasus_tagihan_detail_id');
	}

	public function getNamaObatAttribute(){	

		$nama_obat = $this->obat_detail->item_detail->nama ?? $this->getOriginal('nama_obat');
		return $nama_obat;
	}
}
