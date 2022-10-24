<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class JenisPasien extends Model
{
	use DataLogger;
   protected $connection = 'gizi';
   protected $table = 'jenis_pasien';

   public function jenis_pemesanan()
   {
   	 return $this->hasMany('App\Models\Gizi\Pemesanan','jenis_pasien_id','id');
   }
}
