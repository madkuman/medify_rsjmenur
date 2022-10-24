<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use App\User;

class Telinga extends Model
{
	use DataLogger;
  protected $connection = 'kasus';
  protected $table = 'urikkes_telinga';

  public function user(){
    return $this->hasOne('App\User', 'id', 'created_by');
  }
}
