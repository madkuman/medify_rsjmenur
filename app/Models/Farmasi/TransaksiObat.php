<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Laravel\Scout\Searchable;

class TransaksiObat extends Model
{
	use DataLogger;
	protected $connection = 'farmasi';
	protected $table = 'transaksi_obat';
	protected $dates = ['paid_at','dikerjakan_at','lima_benar_at'];
	use SoftDeletes;

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

	public function sep_detail()
	{
		return $this->hasOne('App\Models\Kasus\BPJSSEP','id', 'sep_id');
	}

	public function owner_detail()
	{
		return $this->hasOne('App\Models\Farmasi\Farmasi','id', 'farmasi_id')->withTrashed();
	}

	public function created_by_detail()
	{
		return $this->hasOne('App\User','id', 'created_by');
	}

	public function ori_detail()
	{
		return $this->hasOne('App\Models\Farmasi\Resep','id', 'resep_original');
	}

	public function final_detail()
	{
		return $this->hasOne('App\Models\Farmasi\Resep','id', 'resep_final');
	}

	public function copy_resep()
	{
		return $this->hasMany('App\Models\Farmasi\TransaksiObat','transaksi_asal_id', 'id');
	}

	public function transaksi_asal()
	{
		return $this->hasOne('App\Models\Farmasi\TransaksiObat','id', 'transaksi_asal_id');
	}

	public function dokter()
	{
		return $this->hasOne('App\User', 'id', 'dokter_id');
	}

	public function farmasi_asal()
	{
		return $this->hasOne('App\Models\Farmasi\Farmasi','id','farmasi_id');
	}

	public function paidBy()
	{
		return $this->hasOne('App\User', 'id', 'paid_by');
	}

	public function lima_benar_creator()
	{
		return $this->hasOne('App\User', 'id', 'lima_benar_created_by');
	}

	public function analisa_resep_creator()
	{
		return $this->hasOne('App\User', 'id', 'analisa_resep_by');
	}

	public function dikerjakan_creator()
	{
		return $this->hasOne('App\User', 'id', 'dikerjakan_by');
	}

    public function konfirmasi_penyiapan_creator()
    {
        return $this->hasOne('App\User', 'id', 'konfirmasi_penyiapan_by');
    }

    public function retur()
    {
        return $this->hasMany('App\Models\Farmasi\Resep','transaksi_id', 'id')->where('retur','=',1);
    }

	public function piutang(){
		return $this->hasOne(\App\Models\Keuangan\Piutang::class, 'id','piutang_id');
	}

	public function getEstimasiSelesaiAttribute()
	{
		return date('d-m-Y H:i:s', strtotime($this->waktu_estimasi_selesai));
	}

	public function loket_antrian()
	{
		return $this->hasOne(\App\Models\Farmasi\LoketAntrian::class, 'id','loket_id');
	}

}