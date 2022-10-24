<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MutuKegiatanPengendalian extends Model
{
    protected $connection = "kasus";
    protected $table = "mutu_kegiatan_pengendalian";
    use SoftDeletes;

    public function creator()
    {
        return $this->hasOne("App\User", "id", "created_by");
    }
}
