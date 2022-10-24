<?php

namespace App\Models\LabPA;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use App\Models\Keuangan\TarifDetail;

class TransactionDetail extends Model
{
	use DataLogger;
    protected $connection = 'lab_pa';
    protected $table = 'transaction_detail';
    
    public function tarif()
    {
        return $this->belongsTo('App\Models\Keuangan\TarifMaster', 'tarif_id')->withTrashed();
    }

    public function transaction()
    {
         return $this->hasOne('App\Models\LabPA\Transaction', 'id', 'transaction_id');
    }

    public function getHargaAttribute()
    {
        $kelas = $this->transaction->kelas->id;
        $tipe_id = $this->transaction->tarif_tipe_id;
        return $this->tarif->getHarga($kelas, $tipe_id);
    }

    public function getTarifHargaAttribute()
    {
        $kelas = $this->transaction->kelas->id;
        $tipe_id = $this->transaction->tarif_tipe_id;
        return $this->tarif->getTarif($kelas, $tipe_id);
    }
}