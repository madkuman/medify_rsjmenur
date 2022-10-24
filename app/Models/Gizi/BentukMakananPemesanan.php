<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class BentukMakananPemesanan extends Model
{
	use DataLogger;	
	use SoftDeletes;
 	protected $connection = 'gizi';
 	protected $table = 'pemesanan_bentuk_makanan';

 	public function pemesanan()
 	{
 		return $this->hasOne('App\Models\Gizi\Pemesanan','id','pemesanan_id');
 	}
 	public function bentukMakanan()
 	{
 		return $this->hasOne('App\Models\Gizi\BentukMakanan','id','bentuk_makanan_id');
 	}
}
