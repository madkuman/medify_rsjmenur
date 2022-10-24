<?php

namespace App\Models\UnitTindakan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
	use DataLogger;
	use SoftDeletes;

	protected $connection = 'unit_tindakan';
	protected $table = 'transaksi';

	public function kasus()
	{
		return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
	}
	public function unit_tindakan()
	{
		return $this->hasOne('App\Models\UnitTindakan\UnitTindakan','id','unit_tindakan_id');
	}
	public function pasien()
	{
		return $this->hasOne('App\Models\Pasien\Pasien','id','pasien_id');
	}

	public function createdAtFormatted()
	{
		return $this->created_at->format('d M Y');
	}
}
