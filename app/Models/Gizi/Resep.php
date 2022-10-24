<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resep extends Model
{
	use DataLogger;
   use SoftDeletes;
   protected $connection = 'gizi';
   protected $table = 'resep';

   public function menu_detail_resep()
   {
   	 return $this->hasMany('App\Models\Gizi\MenuDetail','resep_id', 'id');
   }

   public function pemesanan_detail_resep()
   {
   	 return $this->hasMany('App\Models\Gizi\PemesananDetail','resep_id','id');
   }

   public function resep_detail_resep()
   {
   	 return $this->hasMany('App\Models\Gizi\ResepDetail','resep_id','id');
   }

   public function user()
   {
      return $this->hasOne('App\User','id','created_by');
   }

   public function produksi()
   {
      return $this->hasMany('App\Models\Gizi\ProduksiMakanan','resep_id','id');
   }
}
