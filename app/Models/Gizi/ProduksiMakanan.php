<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProduksiMakanan extends Model
{
	use DataLogger;	
   use SoftDeletes;	
   protected $connection = 'gizi';
   protected $table = 'produksi_makanan';

   public function produksi()
   {
   	 return $this->hasOne('App\Models\Gizi\Produksi','id','produksi_id');
   }

   public function resep()
   {
   	 return $this->hasOne('App\Models\Gizi\Resep','id','resep_id'); 
   }
}
