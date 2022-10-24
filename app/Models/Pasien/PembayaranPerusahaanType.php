<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembayaranPerusahaanType extends Model
{
	use DataLogger;
        use SoftDeletes;
    	protected $connection = 'patients';
    	protected $table = 'pembayaran_perusahaan_tipe';


    	public function perusahaan()
		{
			return $this->hasMany('App\Models\Pasien\PembayaranPerusahaan', 'type', 'id');
		}
}
