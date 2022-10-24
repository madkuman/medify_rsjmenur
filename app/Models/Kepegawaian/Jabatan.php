<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jabatan extends Model
{
	use SoftDeletes;
	
    protected $connection = 'kepegawaian';
	protected $table = 'jabatan';

	protected $fillable = [
		'departemen_id',
        'jabatan_id',
        'pegawai_id',
		'no_surat',
		'tgl_surat'
	];

	public function jabatan()
    {
        return $this->belongsTo('App\Models\Kepegawaian\MasterJabatan', 'jabatan_id', 'id');
    }

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Kepegawaian\Pegawai', 'pegawai_id', 'id');
    }

    public function departemen()
    {
        return $this->belongsTo('App\Models\Kepegawaian\MasterDepartemen', 'departemen_id', 'id');
    }
}
