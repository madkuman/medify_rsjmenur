<?php

namespace App\Models\LabPK;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Pasien\Pasien;
use App\Models\Keuangan\TarifMaster;
use App\Models\Hospital\Lokasi;
use App\Models\Pasien\PasienPembayaran;

class Transaksi extends Model
{
	use DataLogger;
    use SoftDeletes;
	protected $connection = 'lab_pk';
	protected $table = 'transaksi';
    protected $dates = ['verified_at','result_created_at','spesimen_terima_at'];

	public function detail()
	{
		return $this->hasMany('App\Models\LabPK\TransaksiDetail','transaksi_id','id');
	}

    public function spesimen()
    {
        return $this->hasMany('App\Models\LabPK\TransaksiSpesimen','transaksi_id','id');
    }

    public function detail_real()
    {
        return $this->hasMany('App\Models\Radiology\TransactionDetail', 'transaction_id')->where('status', '!=', 'ask');
    }

	public function pasien()
	{
		return $this->hasOne('App\Models\Pasien\Pasien','id','pasien_id');
	}

	public function creator()
	{
		return $this->hasOne('App\User','id','created_by');
	}

    public function result_creator()
    {
        return $this->hasOne('App\User','id','result_created_by');        
    }

    public function verificator()
    {
        return $this->hasOne('App\User','id','verified_by');        
    }

    public function kelas()
    {
        return $this->hasOne('App\Models\Hospital\Kelas', 'id', 'class');
    }

    public function inspect_creator()
    {
        return $this->hasOne('App\User','id','inspected_at_by');   
    }
    public function tipe()
    {
        if($this->tarif_tipe_id == 2){
            return "CITO";
        } else {
            return "Biasa";
        }
    }

    public function daysRemaining()
    {
        $now = Carbon::now()->subDay();
        $inspectDate = Carbon::parse($this->inspected_at);
        return $now->diffInDays($inspectDate);
    }

    public function getInspectedAtFormattedAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['inspected_at'])->format('d F Y');
    }

    public function getResultCreatedAtFormattedAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['result_created_at'])->format('d F Y. H:i');
    }

    public function pembayaran()
    {
        return $this->hasOne('App\Models\Pasien\PasienPembayaran', 'id', 'pasien_pembayaran_id')->withTrashed();
    }
    public function asal()
    {
        return $this->hasOne('App\Models\Hospital\Lokasi', 'id', 'lokasi_id');
    }
    public function kasus()
    {
        return $this->belongsTo('App\Models\Kasus\Kasus', 'kasus_id', 'id');
    }

    public function transaksiSep()
    {
        return $this->hasOne('App\Models\Kasus\BPJSSEP', 'id', 'sep');
    }

    public function getHargaTotalAttribute()
    {
        $total = 0;
        foreach($this->detail as $d){
            $total += $d->harga;
        }
        return $total;
    }

    public function tarif_tipe()
    {
        return $this->hasOne('App\Models\Keuangan\TarifTipe', 'id', 'tarif_tipe_id');
    }

    public function scopePasienHasName($query, $pasien_name)
    {
        $pasien_id = Pasien::search($pasien_name)->take(10000)->get()->map->only(['id']);
        return $query->whereIn('pasien_id', $pasien_id);
    }

    public function scopePasienHasNoRm($query, $pasien_rm)
    {
        $pasien_id = Pasien::where('no_rm', $pasien_rm)->get()->map->only(['id']);
        return $query->whereIn('pasien_id', $pasien_id);
    }

    public function scopeAsalFilter($query, $asal)
    {
        if($asal == 'none'){
            return $query->whereNull('lokasi_id');
        } else {
            $lokasi = Lokasi::where('lokasi_departemen_id', $asal)->get()->map->only(['id']);
            return $query->whereIn('lokasi_id', $lokasi);
        }
    }

    public function scopeJenisPembayaranFilter($query, $asal)
    {
        $pasien_pembayaran = PasienPembayaran::whereHas('perusahaan', function($q) use($asal){
            $q->where('type', $asal);
        })->get()->map->only(['id']);
        return $query->whereIn('pasien_pembayaran_id', $pasien_pembayaran);
    }

    public function scopeStatusFilter($query, $status)
    {
        if($status == 'batal'){
            return $query->where('status',-1);
        } elseif($status == 'belum_verifikasi') {
            return $query->where('status',1)->whereNull('verified_at');
        }elseif($status == 'sudah_verifikasi') {
            return $query->where('status',1)->whereNotNull('verified_at');
        }
        return $query;
    }

    public function hasil()
    {
        return $this->hasMany('App\Models\LabPK\Hasil', 'transaksi_id', 'id');
    }

    public function hasil_golongan_darah()
    {
        return $this->hasOne('App\Models\LabPK\Hasil', 'transaksi_id', 'id')
                ->whereRaw('JSON_EXTRACT(lis_result, "$[*].ext_code0") LIKE "%46%"');        
    }

    public function hasTarifKategori($tarif_kategori)
    {
        $tarif_id = TarifMaster::where('kategori_id', $tarif_kategori)->get()->pluck('id')->toArray();
        foreach($this->detail as $d)
        {
            if(in_array($d->tarif_id, $tarif_id))
                return TRUE;
        }
        return FALSE;
    }

    public function hasil_transfusi()
    {
        return $this->hasMany('App\Models\LabPK\HasilTransfusi', 'transaksi_id', 'id');
    }

    public function dokumen()
    {
        return $this->hasMany('App\Models\LabPK\Dokumen', 'transaksi_id', 'id');
    }
}