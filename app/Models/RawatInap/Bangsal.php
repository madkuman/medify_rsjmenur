<?php

namespace App\Models\RawatInap;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\TempatTidur;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;



class Bangsal extends Model
{
	use DataLogger;
	protected $connection = 'rawatinap';
	protected $table = 'bangsal';
	use SoftDeletes;
	protected $dates = ['deleted_at'];

	public function ruangan()
	{
		return $this->hasMany('App\Models\RawatInap\Ruangan', 'bangsal_id', 'id');
	}

	public function order()
	{
		return $this->hasMany('App\Models\Nutrition\Order', 'bangsal_id', 'id');
	}

	public function grup()
	{
		return $this->hasOne('App\Models\Hospital\Grup', 'id', 'group_id');
	}

	public function getCountTempatTidurKosongAttribute()
	{
		$ruangan = Ruangan::where('bangsal_id', $this->id)->get()->pluck('id')->toArray();
		$tempat_tidur = TempatTidur::whereIn('ruangan_id', $ruangan)->whereNull('booking_id')->whereNull('transaksi_id')->count();
		return $tempat_tidur;
	}


	public function getCountTempatTidurTotalAttribute()
	{
		$count = 0;
		foreach ($this->ruangan as $item) {
			$count += $item->bed->count();
		}
		return $count;
	}

	public function getCountPasienAttribute()
	{
		$ruangan = Ruangan::where('bangsal_id', $this->id)->get()->pluck('id')->toArray();
		$tempat_tidur = TempatTidur::whereIn('ruangan_id', $ruangan)->whereNotNull('transaksi_id')->count();
		return $tempat_tidur;
	}

	public function getCountBedAttribute()
	{
		$ruangan = Ruangan::where('bangsal_id', $this->id)->get()->pluck('id')->toArray();
		$tempat_tidur = TempatTidur::whereIn('ruangan_id', $ruangan)->count();
		return $tempat_tidur;
	}

	public function getCountBedStatisticAttribute()
	{
		$total = 0;
		foreach ($this->ruangan as $ruangan) {
			$total += $ruangan->bed_statistic->count();
		}
		return $total;
	}

	public function tarif()
	{
		return $this->hasOne('App\Models\Keuangan\Tarif', 'id', 'tarif_id');
	}
}
