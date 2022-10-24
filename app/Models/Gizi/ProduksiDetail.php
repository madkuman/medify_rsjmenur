<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProduksiDetail extends Model
{
	use DataLogger;
   use SoftDeletes;
   protected $connection = 'gizi';
   protected $table = 'produksi_detail';

   public function produksi()
   {
   	 return $this->hasOne('App\Models\Gizi\Produksi','id','produksi_id');
   }

   public function waktu_makan()
   {
   	 return $this->hasOne('App\Models\Gizi\WaktuMakan','id','waktu_makan_id');
   }

}
