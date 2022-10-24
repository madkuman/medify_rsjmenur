<?php

namespace App\Models\KamarOperasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Pasca extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kamaroperasi';
	protected $table = 'pasca';
	protected $dates = ['deleted_at'];

	public function getTanggalOperasiAttribute($val)
	{
		return Carbon::parse($val);
	}

	public function kasus()
	{
		return $this->hasOne('App\Models\Kasus\Kasus', 'id', 'kasus_id');
	}

	public function transaksi()
	{
		return $this->hasOne('App\Models\KamarOperasi\Transaksi', 'hasil_id', 'id');
	}
	public function jenis()
	{
		return $this->hasOne('App\Models\KamarOperasi\JenisOperasi', 'id', 'jenis_operasi')->withTrashed();
	}

	public function creator()
	{
		return $this->hasOne('App\User','id','created_by');
	}

	public function praBedah()
	{
		return $this->hasOne('App\Models\Kasus\AlatBantu', 'kasus_id', 'kasus_id');
	}

	/*public function transaksi() {
	  return $this->hasMany('App\Models\RawatJalan\Transaksi', 'poliklinik_id', 'id');
	}*/

}
