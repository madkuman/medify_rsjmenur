<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diet extends Model
{
	use DataLogger;  
   use SoftDeletes;
   protected $connection = 'gizi';
   protected $table = 'diet';

   public function diet_menu()
   {
   	 return $this->hasMany('App\Models\Gizi\Menu','diet_id','id');
   }

   public function diet_pemesanan()
   {
   	 return $this->hasMany('App\Models\Gizi\Pemesanan','diet_id','id');
   }
}
