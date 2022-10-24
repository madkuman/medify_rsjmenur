<?php

namespace App\Models\Urikkes;

use App\Models\Hospital\Kelas;
use App\Models\Keuangan\Tarif;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class PaketTarif extends Model
{
	use DataLogger;
	protected $connection = 'urikkes';
	protected $table = 'paket_tarif';
    protected $appends = ['harga'];

	public function paket()
	{
		return $this->hasOne('App\Models\Urikkes\Paket', 'id', 'paket_id');
	}
	public function tarifMaster()
	{
		return $this->hasOne('App\Models\Keuangan\TarifMaster', 'id', 'tarif_id');
	}

	public function getHargaAttribute()
    {
        $kls = Kelas::where('medical_checkup', 1)->first();
        $tarif_kelas[] = $kls->id;
        $tarif_kelas[] = "0";
        $tarif = Tarif::where('tarif_master_id',$this->tarif_id)->whereIn('kelas_id',$tarif_kelas)->first();
        $return = Tarif::where('tarif_master_id',$this->tarif_id)->where('kelas_id',$tarif->kelas_id)->where('tipe_id',$this->tipe)->first()->harga ?? 0;
        return $return;
    }
}
