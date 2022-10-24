<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;


class BelanjaDetail extends Model
{
	use DataLogger;
   use SoftDeletes;
   protected $connection = 'gizi';
   protected $table = 'belanja_detail';

   public function detail_bahan()
   {
   	 return $this->hasOne('App\Models\Gizi\BahanMakanan','id','bahan_makanan_id');
   }

   public function detail_belanja()
   {
   	 return $this->hasOne('App\Models\Gizi\Belanja','id','belanja_id');
   }    
}
