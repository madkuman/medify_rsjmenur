<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class BahanMakananLog extends Model
{
	use DataLogger;
    protected $connection = 'gizi';
    protected $table = 'bahan_makanan_log';

    public function log_bahan()
    {
    	return $this->hasOne('App\Models\Gizi\BahanMakanan','id','bahan_makanan_id');
    }
    public function log_produksi()
 	{
 		return $this->HasOne('App\Models\Gizi\Produksi','id','produksi_id');
 	}
 	public function log_belanja()
 	{
 		return $this->HasOne('App\Models\Gizi\BahanMakananLog','id','belanja_id');
 	}
}
