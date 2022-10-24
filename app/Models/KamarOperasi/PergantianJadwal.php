<?php

namespace App\Models\KamarOperasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class PergantianJadwal extends Model
{
	use DataLogger;
    	protected $connection = 'kamaroperasi';
    	protected $table = 'pergantian_jadwal';

      public function operasi()
      {
        return $this->belongsTo('App\Models\KamarOperasi\Transaksi', 'id', 'operasi_id');
      }

      public function dokter()
      {
        return $this->belongsTo('App\User', 'user_id', 'id');
      }
}
