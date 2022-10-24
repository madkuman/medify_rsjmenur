<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class DietKode extends Model
{
	use DataLogger;	
	use SoftDeletes;
 	protected $connection = 'gizi';
 	protected $table = 'diet_kode';

 	public function bentuk_makanan()
 	{
		return $this->hasOne('App\Models\Gizi\BentukMakanan','id','bentuk_makanan_id');
 	}

 	public function kategori_makanan()
 	{
 		return $this->hasOne('App\Models\Gizi\KategoriMakanan','id','kategori_makanan_id');
 	}

 	public function jenis_makanan()
 	{
 		return $this->hasOne('App\Models\Gizi\JenisMakanan','id','jenis_makanan_id');
 	}

 	public function diet()
 	{
 		return $this->hasOne('App\Models\Gizi\Diet','id','diet_id');
 	}
}
