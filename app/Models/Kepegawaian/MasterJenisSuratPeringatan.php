<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterJenisSuratPeringatan extends Model
{
    use SoftDeletes;
	protected $connection = 'kepegawaian';
    protected $table = 'master_jenis_surat_peringatan';
    protected $dates = ['deleted_at'];
    
    public function pegawai()
	{
		return $this->belongsToMany('App\Models\Kepegawaian\Pegawai', 'pegawai_id')
					->withTrashed();
	}

    public function suratPeringatan()
	{
		return $this->hasMany('App\Models\Kepegawaian\SuratPeringatan')
					->withTrashed();
	}
}
