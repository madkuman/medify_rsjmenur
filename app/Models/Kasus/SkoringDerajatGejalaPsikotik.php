<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkoringDerajatGejalaPsikotik extends Model
{
    protected $connection = "kasus";
    protected $table = "skoring_derajat_gejala_psikotik";
    use SoftDeletes;

    public function creator() {
        return $this->hasOne("App\User", "id", "created_by");
    }
    public function updater() {
        return $this->hasOne("App\User", "id", "updated_by");
    }
    
}