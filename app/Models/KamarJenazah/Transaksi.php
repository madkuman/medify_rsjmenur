<?php

namespace App\Models\KamarJenazah;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
	use DataLogger;
	use SoftDeletes;
    protected $connection = 'kamarjenazah';
  	protected $table = 'transaksi';

    public function permintaan(){
      return $this->hasOne('App\Models\KamarJenazah\Permintaan', 'id', 'permintaan_id')->withTrashed();
    }
}
