<?php

namespace App\Models\KamarJenazah;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Diagnosis_permintaan extends Model
{
	use DataLogger;
    //
    protected $connection = 'kamarjenazah';
    protected $table = 'diagnosis_permintaan';

    public function permintaan(){
      return $this->belongsToMany('App\Models\KamarJenazah\Permintaan');
    }

    public function diagnosis(){
      return $this->hasMany('App\Models\KamarJenazah\Diagnosis','id','diagnosis_id');
    }
}
