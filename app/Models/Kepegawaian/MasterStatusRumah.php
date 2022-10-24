<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterStatusRumah extends Model
{
    use SoftDeletes;
	protected $connection = 'kepegawaian';
    protected $table = 'master_status_rumah';
    protected $dates = ['deleted_at'];
    
    public function pegawai()
    {
        return $this->hasMany('App\Models\Kepegawaian\Pegawai');
    }
}
