<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class BukuKas extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'buku_kas';


	public function pemasukan()
	{
		return $this->hasOne('App\Models\Keuangan\Pemasukan','buku_kas_id','id');
	}
	public function pengeluaran()
	{
		return $this->hasOne('App\Models\Keuangan\Pengeluaran','buku_kas_id','id');
	}
}
