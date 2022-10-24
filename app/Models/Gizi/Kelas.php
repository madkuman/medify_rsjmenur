<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
	use DataLogger;
   use SoftDeletes;
   protected $connection = 'gizi';
   protected $table = 'kelas';

   public function kelas_menu()
   {
   	 return $this->hasMany('App\Models\Gizi\Menu','kelas_id','id');
   }

   public function kelas_pemesanan()
   {
   	 return $this->hasMany('App\Models\Gizi\Pemesanan','kelas_id','id');
   }
}
