<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class CutiKuota extends Model
{
    use SoftDeletes;
    use DataLogger;
    
    protected $connection = 'kepegawaian';
    protected $table = 'cuti_kuota';
    protected $dates = ['tanggal'];


    public function master_cuti()
    {
        return $this->hasOne('App\Models\Kepegawaian\MasterCuti','id', 'master_cuti_id');
    }
    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }
    public function creator()
    {
        return $this->hasOne('App\User','id','created_by');
    }
    public function response_oleh()
    {
        return $this->hasOne('App\User','id','response_by');
    }
}
