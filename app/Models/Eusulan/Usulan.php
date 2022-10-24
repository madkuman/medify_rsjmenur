<?php

namespace App\Models\Eusulan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usulan extends Model
{
    use DataLogger;
    protected $connection = 'eusulan';
    protected $table = 'usulan';

    use SoftDeletes;

    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function updater() {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    public function detail()
    {
        return $this->hasMany('App\Models\Eusulan\LogUsulan', 'usulan_id', 'id')->where('status','=',1);
    }

    public function detail_gagal()
    {
        return $this->hasMany('App\Models\Eusulan\LogUsulan', 'usulan_id', 'id')->where('status','=',0);
    }

    public function unit() {
        return $this->hasOne('App\Models\Eusulan\Unit', 'id', 'unit_id');
    }

}
