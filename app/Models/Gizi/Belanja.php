<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Belanja extends Model
{
	use DataLogger;
   use SoftDeletes;
   protected $connection = 'gizi';
   protected $table = 'belanja';

   public function log_belanja()
   {
 	 return $this->hasMany('App\Models\Gizi\BahanMakananLog','belanja_id','id');
   }

   public function belanja_detail()
   {
   	 return $this->hasMany('App\Models\Gizi\BelanjaDetail','belanja_id','id');
   }

   public function pembuat()
   {
      return $this->hasOne('App\User','id','created_by');
   }

   public function konfirmasi()
   {
      return $this->hasOne('App\User','id','confirmed_by');  
   }
}
