<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Laravel\Scout\Searchable;

class LaporanTransaksi extends Model
{
	use DataLogger;
	protected $connection = 'farmasi';
	protected $table = 'laporan_transaksi';
	//use Searchable;




    protected $jenis = [
        'LogTransaksi' => 'App\Models\Farmasi\LogTransaksi',
        'LogPengadaan' => 'App\Models\Farmasi\LogPengadaan',
        'LogPenghapusan' => 'App\Models\Farmasi\LogPenghapusan',
        'LogDistribusi' => 'App\Models\Farmasi\LogDistribusi',
    ];

	public function pasien_detail()
	{
		return $this->hasOne('App\Models\Pasien\Pasien','id', 'pasien_id');
	}

	public function kasus()
	{
		return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
	}

	public function pembayaran_detail()
	{
		return $this->hasOne('App\Models\Pasien\PasienPembayaran','id', 'metode_pembayaran_id')->withTrashed();
	}

	public function kasus_detail()
	{
		return $this->hasOne('App\Models\Kasus\Kasus','id', 'kasus_id');
	}

	public function lokasi()
	{
		return $this->hasOne('App\Models\Hospital\Lokasi', 'id', 'lokasi_id');
	}

	public function dokter()
	{
		return $this->hasOne('App\User', 'id', 'dokter_id');
	}

	public function farmasi_asal()
	{
		return $this->hasOne('App\Models\Farmasi\Farmasi','id','farmasi_id');
	}

	public function item_farmasi()
	{
		return $this->hasOne('App\Models\Farmasi\ItemsFarmasi','id','item_farmasi_id');
	}

	public function item_template()
	{
		return $this->hasOne('App\Models\Farmasi\ItemsTemplate','id','template_id');
	}

	public function jenis()
	{
        return $this->morphTo();
	}

    public function getJenisTypeAttribute($type) {
        // transform to lower case
        // $type = strtolower($type);
        if(!$type) {
            return null;
        }
        // to make sure this returns value from the array
        return array_get($this->jenis, $type, $type);

        // which is always safe, because new 'class'
        // will work just the same as new 'Class'
    }
}