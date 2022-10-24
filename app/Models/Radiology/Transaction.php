<?php

namespace App\Models\Radiology;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use ScoutElastic\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\FrontOffice\InsuranceCompany;
use App\Models\Pasien\Pasien;
use App\Models\Keuangan\TarifMaster;
use App\Models\Hospital\Lokasi;
use App\Models\Pasien\PasienPembayaran;

class Transaction extends Model
{
	use DataLogger;   
    use SoftDeletes;

    protected $connection = 'radiology';
    protected $table = 'transaction';

    protected $dates = ['deleted_at', 'verified_at', 'pemeriksaan_start_at'];

    static protected $departemen_id = 8;

    public function pasien()
    {
        return $this->hasOne('App\Models\Pasien\Pasien','id','patient_id');   
    }
    public function transaction_total()
    {
        $details = $this->transaction_detail()->with('transactionDetail_service')->getResults();
        $total = 0;
        // dd($details);
        foreach($details as $d)
        {
            if($d->status != 'ask')
                $total += $d->transactionDetail_service->fee;
        }
        return $total;
    }
    public function transaction_patientInsurance()
    {
        return $this->belongsTo('App\Models\FrontOffice\PatientsInsurance', 'patient_id', 'pasien_id');
    }

    public function detail()
    {
        return $this->hasMany('App\Models\Radiology\TransactionDetail', 'transaction_id');
    }

    public function detail_real()
    {
        return $this->hasMany('App\Models\Radiology\TransactionDetail', 'transaction_id')->where('status', '!=', 'ask');
    }

    public function searchableAs()
    {
        return 'radiology_transaction';
    }

    public function kasus()
    {
        return $this->belongsTo('App\Models\Kasus\Kasus', 'kasus_id', 'id');
    }

    public function permintaan()
    {
        return $this->hasOne('App\Models\Kasus\PenunjangPermintaan', 'transaksi_id','id');
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
    public function sepOrigin()
    {
        return $this->hasOne('App\Models\Kasus\BPJSSEP', 'id', 'sep');
    }

    public function photos()
    {
        return $this->hasMany('App\Models\Radiology\Photo', 'transaction_id', 'id');
    }

    public function pemeriksa()
    {
        return $this->hasOne('App\User', 'id', 'result_created_by');
    }

    public function getHargaTotalAttribute()
    {
        $total = 0;
        foreach($this->detail as $d){
            $total += $d->harga;
        }
        return $total;
    }

    public function getHargaTotalRealAttribute()
    {
        $total = 0;
        foreach($this->detail_real as $d){
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
        return $query->whereIn('patient_id', $pasien_id);
    }

    public function scopePasienHasNoRm($query, $pasien_rm)
    {
        $pasien_id = Pasien::where('no_rm', $pasien_rm)->get()->map->only(['id']);
        return $query->whereIn('patient_id', $pasien_id);
    }

    public function scopeTarifHistoriFilter($query, $name)
    {
        $tarif = TarifMaster::whereHas('kategori', function($q){
                $q->where('departemen_id', self::$departemen_id);
            });
        if($name == "konvensional")
        {
            $tarif_id = $tarif->whereRaw("LOWER(deskripsi) LIKE '%mri%'")->orWhereRaw("LOWER(deskripsi) LIKE '%ct scan%'")->orWhereRaw("LOWER(deskripsi) LIKE '%ct %'")
                                ->orWhereRaw("LOWER(deskripsi) LIKE '%usg%'")->get()->map->only(['id']);
            return $query->whereHas('detail', function($q) use($tarif_id){
                $q->whereNotIn('tarif_id', $tarif_id);
            });
        }
        else{
            if($name == "ct scan")
                $tarif_id = $tarif->whereRaw("LOWER(deskripsi) LIKE '%ct scan%'")->orWhereRaw("LOWER(deskripsi) LIKE '%ct %'")->get()->map->only(['id']);
            else
                $tarif_id = $tarif->whereRaw("LOWER(deskripsi) LIKE '%".$name."%'")->get()->map->only(['id']);
            return $query->whereHas('detail', function($q) use($tarif_id){
                $q->whereIn('tarif_id', $tarif_id);
            });
        }
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

    public function getDetailTextAttribute()
    {
        $text = "";
        foreach ($this->detail as $key => $val) {
            $text .= $val->tarif->deskripsi;
            if($key < count($this->detail))
                $text .= " ";
        }
        return $text;
    }

    public function tindakan()
    {
        return $this->hasMany('App\Models\Kasus\Tindakan', 'radiologi_transaksi_id', 'id');
    }
}