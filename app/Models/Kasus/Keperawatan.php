<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Keperawatan extends Model
{
	use DataLogger;
  protected $connection = 'kasus';
  protected $table = 'keperawatan';
  use SoftDeletes;

  protected $dates = [
    'created_at',
    'updated_at'
];

  public function user() {
    return $this->hasOne('App\User', 'id', 'user_id');
  }

  public function creator() {
    return $this->hasOne('App\User', 'id', 'created_by');
  }

  public function verifikator_dokter() {
    return $this->hasOne('App\User', 'id', 'verified_dokter_by');
  }

  public function verifikator_ners() {
    return $this->hasOne('App\User', 'id', 'verified_ners_by');
  }

  public function created_by_detail(){
    return $this->hasOne('App\User','id', 'created_by');
  }
    
  public function jenis_id_detail(){
    return $this->hasOne('App\Models\Keperawatan\JenisRencanaAsuhan', 'id', 'asuhan_jenis');
  }
    
  public function kasus() {
    return $this->hasOne('App\Models\Kasus\Kasus', 'id', 'kasus_id');
  }

  public function asuhan()
  {
    return $this->hasOne('App\Models\Keperawatan\RencanaAsuhan','id','asuhan_diagnosa')->withTrashed();
  }

}
