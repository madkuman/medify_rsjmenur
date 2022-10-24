<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterJabatan extends Model
{
    use SoftDeletes;
    
	protected $connection = 'kepegawaian';
    protected $table = 'master_jabatan';

    public function pegawai() {
        return $this->hasOne('App\Models\Kepegawaian\Pegawai')
        ->withTrashed();
    }

    public function jenis_jabatan()
    {
        return $this->belongsTo('App\Models\Kepegawaian\MasterJenisJabatan', 'jenis_jabatan_id', 'id')
        ->withTrashed();
    }

    public function departemen()
    {
        return $this->belongsTo('App\Models\Kepegawaian\MasterDepartemen', 'departemen_id', 'id')
        ->withTrashed();
    }

    public function parent()
    {
        return $this->hasOne('App\Models\Kepegawaian\MasterJabatan', 'id', 'parent_id');
    }

    public function child()
    {
        return $this->hasOne('App\Models\Kepegawaian\MasterJabatan', 'parent_id', 'id');
    }
}