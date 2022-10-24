<?php

namespace App\Models\LabPK;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use App\Models\Keuangan\TarifDetail;

class TransaksiDetail extends Model
{
	use DataLogger;
	protected $connection = 'lab_pk';
	protected $table = 'transaksi_detail';

	public function tarif()
    {
        return $this->belongsTo('App\Models\Keuangan\TarifMaster', 'tarif_id')->withTrashed();
    }

	public function pemeriksaan()
	{
		return $this->hasOne('App\Models\LabPK\Pemeriksaan','transaksi_detail_id','id');
	}

	public function form()
	{
		return $this->hasMany('App\Models\LabPK\PemeriksaanForm', 'tarif_id', 'tarif_id');
	}

	public function transaksi()
	{
		return $this->hasOne('App\Models\LabPK\Transaksi', 'id', 'transaksi_id');
	}

	public function hasil()
	{
		return $this->hasMany('App\Models\LabPK\Hasil', 'transaksi_detail_id', 'id');
	}

    public function getHargaAttribute()
    {
        $kelas = $this->transaksi->kelas->id;
        $tipe_id = $this->transaksi->tarif_tipe_id;
        return $this->tarif->getHarga($kelas, $tipe_id);
    }

    public function getTarifHargaAttribute()
    {
        $kelas = $this->transaksi->kelas->id;
        $tipe_id = $this->transaksi->tarif_tipe_id;
        return $this->tarif->getTarif($kelas, $tipe_id);
    }

    public function tagihan_detail()
    {
        return $this->hasOne('App\Models\Kasus\TagihanDetail', 'id', 'tagihan_detail_id');
    }
}