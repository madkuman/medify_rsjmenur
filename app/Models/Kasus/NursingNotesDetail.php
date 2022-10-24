<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class NursingNotesDetail extends Model
{
	use DataLogger;
    
	use SoftDeletes;
	protected $connection = 'kasus';
	protected $table = 'nursing_notes_detail';


	public function creator() {
		return $this->hasOne('App\User', 'id', 'created_by');
	}

	public function updater() {
		return $this->hasOne('App\User', 'id', 'updated_by');
	}
	public function deleter() {
		return $this->hasOne('App\User', 'id', 'deleted_by');
	}

	public function nursing_notes() {
		return $this->hasOne('App\Models\Kasus\NursingNotes', 'id', 'nursing_note_id');
	}

	public function implementasi() {
		return $this->hasOne('App\Models\Keperawatan\RencanaAsuhanDetail', 'id', 'implementasi_id');
	}
}
