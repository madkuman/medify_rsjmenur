<?php

namespace App\Models\Laundry;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class PenanggungJawab extends Model
{
	use DataLogger;
  protected $connection = 'laundry';
  protected $table = 'penanggungjawab';

  public function getWaktu(){
    return $this->belongsTo('App\Models\Laundry\Transaksi','transaksi_id');
  }
}
