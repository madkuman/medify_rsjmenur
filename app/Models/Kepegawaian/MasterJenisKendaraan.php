<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterJenisKendaraan extends Model
{
    use SoftDeletes;
	protected $connection = 'kepegawaian';
    protected $table = 'master_jenis_kendaraan';
    protected $dates = ['deleted_at'];
    
    public function Pegawai()
    {
        return $this->hasMany('App\Models\Kepegawaian\Pegawai');
    }

}
