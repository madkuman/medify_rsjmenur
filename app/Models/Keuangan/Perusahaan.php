<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perusahaan extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'perusahaan';
	protected $fillable = ['id'];
	protected $dates = ['deleted_at'];


	public function getPiutangCountAttribute()
	{
		$piutang = Piutang::where('perusahaan_id',$this->id)->where(function( $query){
			$query->where('total_paid','<','jumlah')->orWhereNull('total_paid');
		})->count();

		return $piutang;
	}

	public function perusahaan_pasien()
	{
		return $this->hasMany(\App\Models\Pasien\PembayaranPerusahaan::class, 'perusahaan_keuangan_id', 'id');
	}

}