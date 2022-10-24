<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimbangTerima extends Model
{
	use DataLogger;
    protected $connection = 'kasus';
    protected $table = 'timbang_terima';
    use SoftDeletes;

	public function creator() {
		return $this->hasOne('App\User', 'id', 'created_by');
	}
	public function updater() {
		return $this->hasOne('App\User', 'id', 'updated_by');
	}
	public function penerima() {
		return $this->hasOne('App\User', 'id', 'perawat_menerima_by');
	}
	public function verifikator() {
		return $this->hasOne('App\User', 'id', 'ppja_verifikasi_by');
	}
}
