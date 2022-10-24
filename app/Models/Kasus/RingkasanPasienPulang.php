<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RingkasanPasienPulang extends Model
{
    protected $connection = "kasus";
    protected $table = "ringkasan_pasien_pulang";
    use SoftDeletes;

    public function creator() {
        return $this->hasOne("App\User", "id", "created_by");
    }
    public function updater() {
        return $this->hasOne("App\User", "id", "updated_by");
    }
    
    public function query_axis_1() {
    	return $this->hasOne("App\Models\Kasus\ICD10", "id", "icd_10_axis_1");
    }

    public function query_axis_3() {
    	return $this->hasOne("App\Models\Kasus\ICD10", "id", "icd_10_axis_2");
    }
}