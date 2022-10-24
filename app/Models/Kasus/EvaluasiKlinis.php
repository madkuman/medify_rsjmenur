<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use App\User;

class EvaluasiKlinis extends Model
{
	use DataLogger;
  protected $connection = 'kasus';
  protected $table = 'urikkes_fisik';

  public function user(){
    return $this->hasOne('App\User', 'id', 'created_by');
  }
  public function mata_cek()
  {
  	return $this->hasOne('App\Models\Kasus\Mata','urikkes_fisik_id','id');
  }
  public function telinga_cek()
  {
  	return $this->hasOne('App\Models\Kasus\Telinga','urikkes_fisik_id','id');  	
  }
}
