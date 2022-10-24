<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Layanan extends Model
{
	use DataLogger;
  protected $connection = 'kasus';
  protected $table = 'layanan_urikkes';

  public static function user(){
    return $this->hasMany('App\User');
  }
}
