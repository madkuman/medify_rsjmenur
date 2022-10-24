<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PsikogramVisum extends Model
{
    protected $connection = "kasus";
    protected $table = "psikogram_visum";
    use SoftDeletes;

    public function creator() {
        return $this->hasOne("App\User", "id", "created_by");
    }
    public function updater() {
        return $this->hasOne("App\User", "id", "updated_by");
    }
    public function kasus() {
        return $this->hasOne('App\Models\Kasus\Kasus', 'id', 'kasus_id');
    }
    
}