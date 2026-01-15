<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkriningGiziAnak extends Model
{
    protected $connection = "kasus";
    protected $table = "skrining_gizi_anak";
    use SoftDeletes;

    public function creator()
    {
        return $this->hasOne("App\User", "id", "created_by");
    }
    public function updater()
    {
        return $this->hasOne("App\User", "id", "updated_by");
    }
}
