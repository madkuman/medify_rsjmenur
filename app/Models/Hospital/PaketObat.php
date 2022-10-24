<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class PaketObat extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'mysql';
	protected $table = 'paket_obat';

	public function detail(){
		return $this->hasMany('App\Models\Hospital\PaketObatDetail','paket_obat_id', 'id');
	}

	
	public function creator() {
		return $this->hasOne('App\User', 'id', 'created_by');
	}

	
	public function subscribe() {
		return $this->hasOne('App\Models\Hospital\PaketObatSubscribe', 'paket_obat_id', 'id')->where('created_by',Auth::user()->id);
	}
}
