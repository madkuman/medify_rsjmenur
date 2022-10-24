<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produksi extends Model
{
	use DataLogger;  
   use SoftDeletes;
   protected $connection = 'gizi';
   protected $table = 'produksi';

   public function log_makanan()
   {
 		return $this->hasMany('App\Models\Gizi\BahanMakananLog','produksi_id','id');
   }

   public function produksi_bahan()
   {
   	 return $this->hasMany('App\Models\Gizi\ProduksiBahan','produksi_id','id');
   }

   public function produksi_makanan()
   {
   	 return $this->hasMany('App\Models\Gizi\ProduksiMakanan','produksi_id','id');
   }

   public function produksi_detail()
   {
   	 return $this->hasMany('App\Models\Gizi\ProduksiDetail','produksi_id','id');
   }
}
