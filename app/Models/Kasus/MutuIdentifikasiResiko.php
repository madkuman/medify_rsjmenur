<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MutuIdentifikasiResiko extends Model
{
    protected $connection = "kasus";
    protected $table = "mutu_identifikasi_resiko";
    use SoftDeletes;

    public function creator()
    {
        return $this->hasOne("App\User", "id", "created_by");
    }

    public function indikator()
    {
		    return $this->hasOne('App\Models\Kasus\MutuIndikator', 'id', 'indikator_id');
    }
}
