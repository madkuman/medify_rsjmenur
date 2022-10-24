<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengkajianPraInduksiAnestesiDanSedasi extends Model
{
	use DataLogger;
    protected $connection = "kasus";
    protected $table = "pengkajian_pra_induksi_anestesi_dan_sedasi";
    use SoftDeletes;

    public function creator() {
        return $this->hasOne("App\User", "id", "created_by");
    }
    
}