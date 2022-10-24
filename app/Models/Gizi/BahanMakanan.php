<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class BahanMakanan extends Model
{
	use DataLogger;	
	use SoftDeletes;
 	protected $connection = 'gizi';
 	protected $table = 'bahan_makanan';

 	public function log_bahan()
 	{
 		return $this->hasMany('App\Models\Gizi\BahanMakananLog','bahan_makanan_id','id');
 	}
 	public function belanja_bahan()
 	{
 		return $this->hasMany('App\Models\Gizi\BelanjaDetail','bahan_makanan_id','id');
 	}

 	public function resep_detail()
    {
   	  return $this->hasMany('App\Models\Gizi\ResepDetail','bahan_makanan_id','id');
    }

    public function jenis_bahan()
    {
    	return $this->hasOne('App\Models\Gizi\JenisBahan','id','jenis_bahan_id');
    }

    public function produksi()
    {
    	return $this->hasMany('App\Models\Gizi\ProduksiBahan','bahan_makanan_id','id');
    }
}
