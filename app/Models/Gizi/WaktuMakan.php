<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class WaktuMakan extends Model
{
	use DataLogger;
   protected $connection = 'gizi';
   protected $table = 'waktu_makan';

   public function menu_detail_waktu()
   {
   	 return $this->hasMany('App\Models\Gizi\MenuDetail','waktu_makan_id', 'id');
   }

   public function pemesanan_detail_waktu()
   {
   	 return $this->hasMany('App\Models\Gizi\PemesananDetail','waktu_makan_id','id');
   }

   public function produksi_detail_waktu()
   {
   	 return $this->hasMany('App\Models\Gizi\ProduksiDetail','waktu_makan_id','id');
   }
}
