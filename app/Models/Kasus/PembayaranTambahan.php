<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembayaranTambahan extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kasus';
	protected $table = 'pembayaran_tambahan';

	
	public function pembayaran()
	{
		return $this->hasOne('App\Models\Pasien\PasienPembayaran', 'id', 'pasien_pembayaran_id')->withTrashed();
	}

}
