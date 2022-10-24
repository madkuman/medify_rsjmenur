<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Keuangan\PemasukanDetail;

class PenagihanBPJS extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'penagihan_bpjs';

	public function kategori_bpjs()
	{
		return $this->hasOne('App\Models\Keuangan\KategoriBPJS', 'id', 'kategori_bpjs_id');
	}

	public function piutang_pivot_detail()
	{
		return $this->hasMany('App\Models\Keuangan\PiutangPivot', 'penagihan_bpjs_id', 'id');
	}

	public function confirmator()
	{
		return $this->hasOne('App\User', 'id', 'confirmed_by');
	}

	public function paket_penagihan()
	{
		return $this->belongsTo('App\Models\Keuangan\PaketPenagihan');
	}

	public function getPaketPemasukanAttribute()
	{
		$sister = $this->paket_penagihan->detail_bpjs->pluck('id');
		
		$pemasukan_detail = PemasukanDetail::whereIn('penagihan_bpjs_id', $sister)->first();
		
		return $pemasukan_detail->pemasukan->paket ?? NULL;
	}
}