<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PangkatPegawai extends Model
{
	use DataLogger;
	use SoftDeletes;
	
    protected $connection = 'kepegawaian';
	protected $table = 'pangkat_pegawai';

	protected $fillable = [
		'pangkat_id',
		'pegawai_id',
		''
	];

	public function pegawai() {
		return $this->belongsTo('App\Models\Kepegawaian\Pegawai', 'id', 'pegawai_id');
	}
	public function masterPangkat() {
		return $this->belongsTo('App\Models\Kepegawaian\MasterPangkat')->withTrashed();
	}
	public function creator() {
		return $this->hasOne('App\User', 'id', 'created_by');
	}
}
