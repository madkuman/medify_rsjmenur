<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProduksiBahan extends Model
{
	use DataLogger;	
   use SoftDeletes;	
   protected $connection = 'gizi';
   protected $table = 'produksi_bahan';

   public function produksi()
   {
   	 return $this->hasOne('App\Models\Gizi\Produksi','id','produksi_id');
   }

   public function bahan()
   {
   	 return $this->hasOne('App\Models\Gizi\BahanMakanan','id','bahan_makanan_id');
   }
}
