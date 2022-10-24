<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class DietTambahanPemesanan extends Model
{
	use DataLogger;	
	use SoftDeletes;
 	protected $connection = 'gizi';
 	protected $table = 'pemesanan_diet_tambahan';

 	public function pemesanan()
 	{
 		return $this->hasOne('App\Models\Gizi\Pemesanan','id','pemesanan_id');
 	}
 	public function diet()
 	{
 		return $this->hasOne('App\Models\Gizi\DietTambahan','id','diet_id');
 	}
}
