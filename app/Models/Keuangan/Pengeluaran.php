<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Keuangan\Utang;

class Pengeluaran extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'pengeluaran';
	protected $fillable = ['id'];
	protected $dates = ['deleted_at'];

	public function detail()
	{
		return $this->hasMany('App\Models\Keuangan\PengeluaranDetail','pengeluaran_id','id');
	}
	// public function pasien()
	// {
	// 	return $this->hasOne('App\Models\Pasien\Pasien','id','pasien_id');
	// }
	// public function kategori()
	// {
	// 	return $this->hasOne('App\Models\Keuangan\Kategori','id','kategori_id');
	// }
	public function scopeNomorPJK($query, $nomor_pjk)
    {
        $pjk = Utang::whereHas('UJIDetail')->get()
        		->filter(function($item) use ($nomor_pjk){
			        return $item->nomor_pjk === $nomor_pjk;
			    })
        		->map->only(['id']);
        return $query->whereIn('utang_id', $pjk);
    }
	public function akun()
	{
		return $this->hasOne('App\Models\Keuangan\Akun','id','akun_id');
	}
	public function spp()
	{
		return $this->belongsTo('App\Models\Keuangan\Utang', 'utang_id', 'id');
	}
	
	public function utang()
	{
		return $this->hasOne('App\Models\Keuangan\Utang','id','utang_id');
	}

	public function bk()
	{
		return $this->hasOne('App\Models\Keuangan\BukuKas','id','bk_id');
	}
}
