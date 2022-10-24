<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenandaanAreaOperasi extends Model
{
	use DataLogger;
    protected $connection = "kasus";
    protected $table = "penandaan_area_operasi";
    use SoftDeletes;

    public function creator() {
        return $this->hasOne("App\User", "id", "created_by");
    }

    public function notes() {
        return $this->hasMany("App\Models\Kasus\PenandaanAreaOperasiImageNotes", "penandaan_area_operasi_id", "id");
    }
    
}