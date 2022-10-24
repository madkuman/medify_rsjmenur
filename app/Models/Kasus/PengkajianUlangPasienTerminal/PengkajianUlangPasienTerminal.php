<?php

namespace App\Models\Kasus\PengkajianUlangPasienTerminal;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengkajianUlangPasienTerminal extends Model
{
	use DataLogger;
    protected $connection = "kasus";
    protected $table = "pengkajian_ulang_pasien_terminal";
    use SoftDeletes;

    public function creator() {
        return $this->hasOne("App\User", "id", "created_by");
    }
    
}