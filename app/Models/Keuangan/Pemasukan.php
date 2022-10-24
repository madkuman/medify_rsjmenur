<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Keuangan\PemasukanDetail;
use App\Models\Keuangan\Piutang;
use App\Models\Kasir\Tagihan;
class Pemasukan extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'pemasukan';
	protected $fillable = ['id'];
	protected $dates = ['deleted_at'];

	public function detail()
	{
		return $this->hasMany('App\Models\Keuangan\PemasukanDetail','pemasukan_id','id');
	}

	public function pasien()
	{
		return $this->hasOne('App\Models\Pasien\Pasien','id','pasien_id');
	}
	public function pasienPembayaran()
	{
		return $this->hasOne('App\Models\Pasien\PasienPembayaran','id','pasien_pembayaran_id')->withTrashed();
	}
	public function piutang()
	{
		return $this->belongsTo('App\Models\Keuangan\Piutang','piutang_id','id');
	}
	public function kategori()
	{
		return $this->hasOne('App\Models\Keuangan\Kategori','id','kategori_id');
	}
	public function akun()
	{
		return $this->hasOne('App\Models\Keuangan\Akun','id','akun_id');
	}
	public function getKasusAttribute()
	{
		if(!empty($this->detail[0]->piutang_id->kasusTagihan->kasus)) $kasus = $this->detail[0]->piutang->kasusTagihan->kasus;
		elseif(!empty($this->detail[0]->tagihan->tagihan->kasus)) $kasus = $this->detail[0]->tagihan->kasus;
		else $kasus = null;
		return $kasus;
	}

	public function bk()
	{
		return $this->hasOne('App\Models\Keuangan\BukuKas','id','bk_id');
	}
	
    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function paket() {
    	return $this->hasOne('App\Models\Keuangan\PaketPemasukan', 'id', 'paket_pemasukan_id');
    }

    public function perusahaan() {
    	return $this->hasOne('App\Models\Keuangan\Perusahaan', 'id', 'perusahaan_id');
    }

    public function getDetailForLaporanAttribute()
    {
    	$detail = $this->detail;
    	$result = [];
    	foreach($detail as $d)
    	{
    		if(isset($result[$d->kategori_id]))
	    		$result[$d->kategori_id] += $d->subtotal;
	    	else
	    		$result[$d->kategori_id] = $d->subtotal;
    	}
    	return $result;
    }

    public function getDetailForLaporanBpjsAttribute()
    {
    	$detail = $this->detail;
    	$result = [];
    	foreach($detail as $d)
    	{
    		if(isset($result[$d->kategori_bpjs_id]))
	    		$result[$d->kategori_bpjs_id] += $d->subtotal;
	    	else
	    		$result[$d->kategori_bpjs_id] = $d->subtotal;
    	}
    	return $result;
    }

    public function getDetailKategoriIdAttribute()
    {
    	return $this->detail->pluck('kategori_id')->toArray();
    }

    public function piutang_pivot()
    {
    	return $this->hasOne('App\Models\Keuangan\PiutangPivot', 'id', 'piutang_pivot_id');
    }
}