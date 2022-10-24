<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Keuangan\PemasukanDetail;
use App\Models\Keuangan\Piutang;
use App\Models\Kasir\Tagihan;
class PaketPemasukan extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'paket_pemasukan';

	protected $dates = ['deleted_at'];

	public function detail()
	{
		return $this->hasMany('App\Models\Keuangan\Pemasukan','paket_pemasukan_id','id');
	}
	
    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function bk() {
    	return $this->hasOne('App\Models\Keuangan\BukuKas', 'id', 'bk_id');
    }
}