<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Lain_Urikkes extends Model
{
	use DataLogger;
  protected $connection = 'kasus';
  protected $table = 'urikkes_resume';

  public function user(){
    return $this->hasOne('App\User', 'id', 'created_by');
  }
}
