<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengadaan extends Model
{
	use DataLogger;
	protected $connection = 'farmasi';
	protected $table = 'pengadaan';
	
	use SoftDeletes;

	public function searchableAs()
  	{
    	return 'farmasi_pengadaan';
  	}

	public function supplier_detail()
	{
		return $this->hasOne('App\Models\Keuangan\Perusahaan','id', 'supplier_id')->withTrashed();
	}

	public function created_by_detail()
	{
		return $this->hasOne('App\User','id', 'created_by');
	}

	public function owner_detail()
	{
		return $this->hasOne('App\Models\Farmasi\Apotek','id', 'farmasi_id')->withTrashed();
	}

	public function log()
	{
		return $this->hasMany('App\Models\Farmasi\LogPengadaan','pengadaan_id', 'id');
	}

	public function utang()
	{
		return $this->hasOne('App\Models\Keuangan\Utang','id', 'utang_id');
	}

	public function sumber_dana()
    {
        return $this->hasOne('App\Models\Farmasi\SumberDana','id', 'sumber_dana_id')->withTrashed();
    }

    public function katalog()
    {
        return $this->hasOne('App\Models\Farmasi\Katalog','id', 'katalog_id')->withTrashed();
    }

}
