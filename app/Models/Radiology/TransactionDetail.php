<?php

namespace App\Models\Radiology;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use App\Models\Keuangan\TarifDetail;
use App\Models\Keuangan\TarifMaster;
use App\Models\Radiology\TemplateHasil;

class TransactionDetail extends Model
{
	use DataLogger;
    protected $connection = 'radiology';
    protected $table = 'transaction_detail';
    
    public function transaction()
    {
        return $this->hasOne('App\Models\Radiology\Transaction', 'id', 'transaction_id');
    }

    public function tarif()
    {
        return $this->belongsTo('App\Models\Keuangan\TarifMaster', 'tarif_id')->withTrashed();
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

    public function scopeTarifHistoriFilter($query, $name)
    {
        $tarif = TarifMaster::whereHas('kategori', function($q){
                $q->where('departemen_id', self::$departemen_id);
            });
        if($name == "konvensional")
        {
            $tarif_id = $tarif->whereRaw("LOWER(deskripsi) LIKE '%mri%'")->orWhereRaw("LOWER(deskripsi) LIKE '%ct scan%'")->orWhereRaw("LOWER(deskripsi) LIKE '%ct %'")
                                ->orWhereRaw("LOWER(deskripsi) LIKE '%usg%'")->get()->map->only(['id']);
            return $query->whereNotIn('tarif_id', $tarif_id);
        }
        else{
            if($name == "ct scan")
                $tarif_id = $tarif->whereRaw("LOWER(deskripsi) LIKE '%ct scan%'")->orWhereRaw("LOWER(deskripsi) LIKE '%ct %'")->get()->map->only(['id']);
            else
                $tarif_id = $tarif->whereRaw("LOWER(deskripsi) LIKE '%".$name."%'")->get()->map->only(['id']);
            return $query->whereIn('tarif_id', $tarif_id);
        }
    }

    public function getTemplateHasilAttribute()
    {
        $template = TemplateHasil::where('tarif_id', $this->tarif_id)->first();
        if($template)
            return $template->konten;
        else
            return "";            
    }
}