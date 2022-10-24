<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuDetail extends Model
{
	use DataLogger;
   protected $connection = 'gizi';
   protected $table = 'menu_detail';
   use SoftDeletes;

   public function detail_waktu()
   {
   	 return $this->hasOne('App\Models\Gizi\WaktuMakan','id','waktu_makan_id');
   }
   public function detail_resep()
   {
   	 return $this->hasOne('App\Models\Gizi\Resep','id','resep_id');
   }
   public function detail_menu()
   {
   	 return $this->hasOne('App\Models\Gizi\Menu','id','menu_id');
   }   
}
