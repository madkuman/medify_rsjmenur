<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produksi extends Model
{
	use DataLogger;
    
	use SoftDeletes;

	protected $connection = 'farmasi';
	protected $table = 'produksi';

	public function detail()
	{
		return $this->hasMany('App\Models\Farmasi\ProduksiDetail', 'produksi_id', 'id');
	}

	public function lastTransaksi()
	{
		return $this->hasOne('App\Models\Farmasi\ProduksiTransaksi', 'produksi_id', 'id')->latest();
	}
	public function transaksi()
	{
		return $this->hasMany('App\Models\Farmasi\ProduksiTransaksi', 'produksi_id', 'id')->latest();
	}
}
