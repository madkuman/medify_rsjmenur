<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AsesmenNapzaRawatJalanNonIPWL extends Model
{
    protected $connection = "kasus";
    protected $table = "asesmen_napza_rawat_jalan_non_ipwl";
    use SoftDeletes;

    public function creator() {
        return $this->hasOne("App\User", "id", "created_by");
    }
    public function updater() {
        return $this->hasOne("App\User", "id", "updated_by");
    }

    
}