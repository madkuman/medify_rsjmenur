<?php

namespace App\Models\Kasir;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tagihan extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kasir';
	protected $table = 'tagihan';
	protected $fillable = ['id'];
	protected $dates = ['deleted_at'];

	public function detail()
	{
		return $this->hasMany('App\Models\Kasir\TagihanDetail','tagihan_id','id')->orderBy('created_at');
	}

	public function pasien()
	{
		return $this->hasOne('App\Models\Pasien\Pasien','id','pasien_id');
	}

	public function pasien_pembayaran()
	{
		return $this->hasOne('App\Models\Pasien\PasienPembayaran','id','pasien_pembayaran_id')->withTrashed();
	}

	public function latest_lokasi()
	{
		return $this->hasOne('App\Models\Kasir\TagihanDetail','tagihan_id','id')->orderBy('created_at','desc')->limit(1);
	}

	public function kasir()
	{
		return $this->hasOne('App\Models\Kasir\Kasir','id','kasir_id')->withTrashed();
	}
	public function pemasukanDetail()
	{
		return $this->hasMany('App\Models\Keuangan\PemasukanDetail','tagihan_id','id');
	}
	public function piutangDetail()
	{
		return $this->hasMany('App\Models\Keuangan\PiutangDetail','tagihan_id','id');
	}

	public function lokasi()
	{
		return $this->hasOne('App\Models\Hospital\Lokasi','id','lokasi_id')->withTrashed();
	}

	public function kategori()
	{
		return $this->hasOne('App\Models\Keuangan\Kategori','id','kategori_id')->withTrashed();
	}
	public function akun()
	{
		return $this->hasOne('App\Models\Keuangan\Akun','id','akun_id')->withTrashed();
	}
	

	public function kasus() {
		return $this->hasOne('App\Models\Kasus\Kasus', 'id', 'kasus_id');
	}

}
