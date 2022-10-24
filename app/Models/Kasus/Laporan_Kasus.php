<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Laporan_Kasus extends Model
{
	use DataLogger;
  protected $connection = 'kasus';
  protected $table = 'laporan_kasus';

  public static function user(){
    return $this->hasMany('App\User');
  }
}
