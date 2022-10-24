<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenandaanAreaOperasiImageNotes extends Model
{
	use DataLogger;
	protected $connection = "kasus";
	protected $table = "penandaan_area_operasi_image_notes";
	use SoftDeletes;

	public function creator() {
		return $this->hasOne("App\User", "id", "created_by");
	}
}
