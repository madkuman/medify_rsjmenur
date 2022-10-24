<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class NursingNotes extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kasus';
	protected $table = 'nursing_notes';


	public function creator() {
		return $this->hasOne('App\User', 'id', 'created_by');
	}

	public function updater() {
		return $this->hasOne('App\User', 'id', 'updated_by');
	}
	public function deleter() {
		return $this->hasOne('App\User', 'id', 'deleted_by');
	}
	public function verifikator() {
		return $this->hasOne('App\User', 'id', 'verified_by');
	}

	public function kasus() {
		return $this->hasOne('App\Models\Kasus\Kasus', 'id', 'kasus_id');
	}

	public function asuhan() {
		return $this->hasOne('App\Models\Keperawatan\RencanaAsuhan', 'id', 'diagnosis_id');
	}

	public function details() {
		return $this->hasMany('App\Models\Kasus\NursingNotesDetail', 'nursing_note_id', 'id');
	}
}
