<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
	use DataLogger;
   protected $connection = 'gizi';
   protected $table = 'menu';
   use SoftDeletes;

   // public function diet_menu()
   // {
   // 	 return $this->hasOne('App\Models\Gizi\Diet','id','diet_id');
   // }

   public function kelas_menu()
   {
   	 return $this->hasOne('App\Models\Hospital\Kelas','id','kelas_id');
   }
   
   public function detail_menu()
   {
   	 return $this->hasMany('App\Models\Gizi\MenuDetail','menu_id', 'id');
   }
   
   public function menu_pemesanan()
   {
   	 return $this->hasMany('App\Models\Gizi\Pemesanan','menu_id','id');
   }
   public function user()
   {
      return $this->hasOne('App\User','id','created_by');
   }
}
