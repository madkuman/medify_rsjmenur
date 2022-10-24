<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResumeNonJiwa extends Model
{
    protected $connection = "kasus";
    protected $table = "resume_non_jiwa";
    use SoftDeletes;

    public function creator() {
        return $this->hasOne("App\User", "id", "created_by");
    }
    public function updater() {
        return $this->hasOne("App\User", "id", "updated_by");
    }
    public function poli() {
        return $this->hasOne('App\Models\RawatJalan\Poliklinik', 'id', 'poli_id');
    }
}