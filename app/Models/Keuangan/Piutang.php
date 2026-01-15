<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Pasien\Pasien;
use App\Models\Hospital\Lokasi;

class Piutang extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'piutang';
	protected $fillable = ['id'];
	protected $dates = ['deleted_at'];

	public function detail()
	{
		return $this->hasMany('App\Models\Keuangan\PiutangDetail','piutang_id','id')->orderBy('created_at', 'desc');
	}
	public function pasien()
	{
		return $this->hasOne('App\Models\Pasien\Pasien','id','pasien_id');
	}
	public function scopePasienHasNameOrRM($query, $pasien_name)
    {
        $pasien_id = Pasien::search($pasien_name)->take(10000)->get()->map->only(['id']);
        return $query->whereIn('pasien_id', $pasien_id);
    }
	public function pasienPembayaran()
	{
		return $this->hasOne('App\Models\Pasien\PasienPembayaran','id','pasien_pembayaran_id')->withTrashed();
	}
	public function kategori()
	{
		return $this->hasOne('App\Models\Keuangan\Kategori','id','kategori_id');
	}
	public function pemasukan()
	{
		return $this->hasMany('App\Models\Keuangan\Pemasukan','piutang_id','id');
	}
	public function pemasukanLast()
	{
		return $this->hasOne('App\Models\Keuangan\Pemasukan','piutang_id','id')->latest();
	}
	public function lokasi()
	{
		return $this->hasOne('App\Models\Hospital\Lokasi','id','lokasi_id')->withTrashed();
	}
	public function perusahaan()
	{
		return $this->hasOne('App\Models\Keuangan\Perusahaan','id','perusahaan_id');
	}

	public function kasusTagihan()
	{
		return $this->hasOne('App\Models\Kasus\Tagihan','id','kasus_tagihan_id');
	}

	public function kasusTagihanSister()
	{
		return $this->hasMany('App\Models\Keuangan\Piutang','kasus_tagihan_id','kasus_tagihan_id')->where('id','!=',$this->id);
	}

	public function sister()
	{
		return $this->hasMany('App\Models\Keuangan\Piutang','piutang_parent_id','piutang_parent_id')->where('id','!=',$this->id);
	}

	public function getTotalTerbilangAttribute()
	{
		return app('App\Http\Controllers\Functions\SpellMoney')->spellMoney($this->total,4);
	}

	public function petugas_kasir()
	{
		return $this->hasOne('App\User', 'id', 'cashier_by');
	}

	public function kasir()
	{
		return $this->hasOne('App\Models\Kasir\Kasir', 'id', 'kasir_id');
	}

    public function scopeAsalFilter($query, $asal)
    {
        if($asal == 'none'){
            return $query->whereNull('lokasi_id');
        } else {
            return $query->whereIn('lokasi_id', $asal);
        }
    }


    public function scopeOrderBySEP($query)
    {
    	return $query->orderBy('kasusTagihan.kasus.sep.no_sep');
    }

    public function getKategoriBpjsArrayAttribute()
    {
    	return $this->detail->pluck('kategori_bpjs_id')->toArray();
    }

    public function piutang_pivot()
    {
    	return $this->hasMany('App\Models\Keuangan\PiutangPivot', 'piutang_id', 'id');
    }
    public function dokter()
    {
        return $this->hasOne('App\User', 'id', 'dokter_user_id');
    }
	public function transaksi_rawat_jalan()
	{
		return $this->hasOne('App\Models\RawatJalan\Transaksi','piutang_id','id');
	}
}