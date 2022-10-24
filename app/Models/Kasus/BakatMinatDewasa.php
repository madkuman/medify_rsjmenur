<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BakatMinatDewasa extends Model
{
    protected $connection = "kasus";
    protected $table = "bakat_minat_dewasa";
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