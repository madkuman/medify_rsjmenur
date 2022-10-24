<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResepDetail extends Model
{
	use DataLogger;  
   use SoftDeletes;
   protected $connection = 'gizi';
   protected $table = 'resep_detail';

   public function bahan_makanan()
   {
   	 return $this->hasOne('App\Models\Gizi\BahanMakanan','id','bahan_makanan_id');
   }

   public function resep()
   {
   	 return $this->hasOne('App\Models\Gizi\BahanMakanan','id','bahan_makanan_id');
   }
}
