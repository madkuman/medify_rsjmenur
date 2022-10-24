<?php

namespace App\Models\IGD;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
	use DataLogger;
    use SoftDeletes;
  	protected $connection = 'igd';
	 protected $table = 'transaksi';
    protected $dates = ['deleted_at'];

	public function pasien_detail() {
	  return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');
  	}
  public function pasien() {
    return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');
    }

  	public function ruangan()
  	{
  		return $this->hasOne(\App\Models\IGD\Ruangan::class,'id','ruangan_id')->withTrashed();
  	}
  	
  	public function kasus()
  	{
  		return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
  	}
    
    public function pasien_pembayaran()
    {
      return $this->hasOne('App\Models\Pasien\PasienPembayaran','id','pasien_pembayaran_id')->withTrashed();
    }

    public function rujukan()
    {
      return $this->hasOne('App\Models\Pasien\AsalRujukan','id','asal_rujukan');
    }
    
    public function rm_transaksi()
    {
      return $this->hasOne('App\Models\RekamMedis\Transaksi','id','rm_transaksi_id');
    }
}
