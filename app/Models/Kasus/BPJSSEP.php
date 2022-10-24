<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;
use App\Models\Kasus\TagihanDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Pasien\PembayaranPerusahaan;

class BPJSSEP extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kasus';
	protected $table = 'bpjs_sep';

	public function getCreatedAtFormattedAttribute($value)
	{
		return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('d F Y, H:i');
	}


	//TODO ganti ke no_sep
	public function tagihan_detail()
	{
		return $this->hasMany('App\Models\Kasus\TagihanDetail', 'sep_id', 'id');
	}

	public function pasien_pembayaran()
	{
		$bpjs_perusahaan = PembayaranPerusahaan::where('type',1)->pluck('id')->toArray();
		return $this->hasOne('App\Models\Pasien\PasienPembayaran', 'no_asuransi', 'no_bpjs')->whereIn('perusahaan_id',$bpjs_perusahaan);
	}

	public function sisaPlafon()
	{
		return $this->hasOne('App\Models\Kasus\TagihanDetail', 'sep_id', 'id')
				->selectRaw('sep_id, sum(`subtotal`) as agg')
				->groupBy('sep_id');
	}

	public function getSisaPlafonAttribute($value)
	{
		// $sep_id =  $this->attributes['id'];
		// $total = TagihanDetail::where('sep_id',$sep_id)->sum('subtotal');
		// $sisa = $this->attributes['total_plafon'] - $total;
		// return $sisa;

		if ( ! array_key_exists('sisaPlafon', $this->relations)) 
			$this->load('sisaPlafon');

		$related = $this->getRelation('sisaPlafon');

		// then return the count directly
		$var = ($related) ? (int) $this->total_plafon - $related->agg : $this->total_plafon;
		return $var;
	}

	public function kasus()
	{
		return $this->belongsToMany('App\Models\Kasus\Kasus', 'bpjs_sep_kasus', 'bpjs_sep_id', 'kasus_id');
	}

	public function pasien()
	{
		return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');
	}
	
	public function poli()
	{
		return $this->hasOne('App\Models\RawatJalan\Poliklinik', 'bpjs_id', 'poli_tujuan');
	}

	public function dokter()
	{
		return $this->hasOne('App\Models\RawatJalan\Dokter', 'bpjs_kode_dpjp', 'dpjp');
	}
	
	public function user_dpjp()
	{
		return $this->hasOne('App\Models\RawatJalan\Dokter', 'bpjs_kode_dpjp', 'dpjp');
	}

	public function diagnosis()
	{
		return $this->hasOne('App\Models\Kasus\ICD10', 'code_icd', 'diagnosa_awal')->withTrashed();		
	}
}
