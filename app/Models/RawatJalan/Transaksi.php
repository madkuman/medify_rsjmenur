<?php

namespace App\Models\RawatJalan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
	use DataLogger;
  protected $connection = 'rawatjalan';
	protected $table = 'transaksi';
  use SoftDeletes;
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'waktu_masuk',
        'waktu_keluar',
        'cancel_at',
        'waktu_pemeriksaan'
    ];


    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function cancel_user() {
        return $this->hasOne('App\User', 'id', 'cancel_by');
    }
    
  	public function pasien_detail() {
	   return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');
  	}
  public function pasien() {
    return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');
    }

  	public function kasus()
  	{
  		return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
  	}

  	public function poliklinik()
  	{
  		return $this->hasOne('App\Models\RawatJalan\Poliklinik','id','poliklinik_id');
  	}

    public function transaksi_global()
    {
      return $this->hasOne('App\Models\Hospital\Transaksi','id','transaksi_global_id');
    }

    public function pasien_pembayaran()
    {
      return $this->hasOne('App\Models\Pasien\PasienPembayaran','id','pasien_pembayaran_id')->withTrashed();
    }

    public function rujukan()
    {
      return $this->hasOne('App\Models\Pasien\AsalRujukan','id','asal_rujukan');
    }
    public function permintaan_rujuk()
    {
      return $this->hasOne('App\Models\RawatJalan\PermintaanRujuk','id','permintaan_rujuk_id');
    }
    public function rm_transaksi()
    {
      return $this->hasOne('App\Models\RekamMedis\Transaksi','id','rm_transaksi_id');
    }
    public function rm_transaksi_pengembalian()
    {
      return $this->hasOne('App\Models\RekamMedis\Transaksi','id','rm_transaksi_pengembalian_id');
    }

    public function antrian()
    {
        return $this->hasOne('App\Models\RawatJalan\AntrianCall', 'transaksi_id', 'id');
    }

    public function dokter()
    {
        return $this->hasOne('App\Models\RawatJalan\Dokter', 'id', 'dokter_id');
    }
    public function piutang_online_tunai()
    {
        return $this->hasOne('App\Models\Keuangan\Piutang', 'id', 'piutang_id');
    }

    public function dokter_jadwal()
    {
        return $this->hasOne('App\Models\RawatJalan\DokterJadwal', 'id', 'dokter_jadwal_id');
    }

    public function transaksi_video()
    {
        return $this->hasOne('App\Models\RawatJalan\Video', 'transaksi_id', 'id');
    }

    public function ruangan_poli()
    {
        return $this->hasOne('App\Models\RawatJalan\Ruangan', 'poliklinik_id', 'poliklinik_id')->where('dokter_id',($this->dokter->user->id ?? -1));
    }
}
