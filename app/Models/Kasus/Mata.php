<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mata extends Model
{
	use DataLogger;
  protected $connection = 'kasus';
  protected $table = 'urikkes_mata';
  use SoftDeletes;

  public function user(){
    return $this->hasOne('App\User', 'id', 'created_by');
  }
}
