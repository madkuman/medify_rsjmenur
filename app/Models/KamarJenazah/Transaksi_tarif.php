<?php

namespace App\Models\KamarJenazah;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi_tarif extends Model
{
	use DataLogger;
    //
    use SoftDeletes;
    protected $connection = 'kamarjenazah';
    protected $table = 'transaksi_tarif';

    public function transaksi(){
      return $this->hasMany('App\Models\KamarJenazah\Transaksi', 'id', 'transaksi_id')->withTrashed();
  }

  public function tarif(){
      return $this->hasMany('App\Models\KamarJenazah\Diagnosis','id', 'tarif_id')->withTrashed();
  }
}
