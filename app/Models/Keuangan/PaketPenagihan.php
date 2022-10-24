<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Keuangan\PemasukanDetail;
use App\Models\Keuangan\Piutang;
use App\Models\Kasir\Tagihan;
class PaketPenagihan extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'paket_penagihan';
	protected $dates = ['deleted_at'];

	public function detail()
	{
		return $this->hasMany('App\Models\Keuangan\Piutang','paket_penagihan_id','id');
	}

    public function detail_bpjs()
    {
        return $this->hasMany('App\Models\Keuangan\PenagihanBPJS','paket_penagihan_id','id');
    }

    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function akun() {
    	return $this->hasOne('App\Models\Keuangan\Akun', 'id', 'akun_id');
    }
	
	public function perusahaan()
	{
		return $this->hasOne('App\Models\Keuangan\Perusahaan','id','perusahaan_id');
	}

    public function getPasienIdAttribute() {
    	$res = [];
    	foreach($this->detail as $d)
    	{
    		array_push($res, $d->pasien_id);
    	}
    	return array_unique($res);
    }

    public function paket_pemasukan()
    {
        return $this->hasOne('App\Models\Keuangan\PaketPemasukan','id','paket_pemasukan_id');
    }    
}