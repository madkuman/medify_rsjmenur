<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pendidikan extends Model
{
	use DataLogger;
	use SoftDeletes;
	
    protected $connection = 'kepegawaian';
	protected $table = 'pendidikan';

	protected $fillable = [
		'nama',
		'tahun',
		'tempat',
		'jenis_pendidikan_id',
		'strata_pendidikan_id',
		'institusi_pendidikan_id',
		'tgl_masuk',
		'tgl_lulus'
	];

	public function pegawai() {
		return $this->belongsTo('App\Models\Kepegawaian\Pegawai', 'id', 'pegawai_id')
					->withTrashed();
	}

	public function jenisPendidikan() {
		return $this->hasMany('App\Models\Kepegawaian\MasterJenisPendidikan','id', 'jenis_pendidikan_id');
	}

	public function strataPendidikan() {
		return $this->hasMany('App\Models\Kepegawaian\MasterStrataPendidikan', 'id', 'strata_pendidikan_id')->withTrashed();
	}

	public function institusiPendidikan() {
		return $this->hasMany('App\Models\Kepegawaian\MasterInstitusiPendidikan', 'id', 'institusi_pendidikan_id');
	}

	public function creator() {
		return $this->hasOne('App\User', 'id', 'created_by');
	}
}
