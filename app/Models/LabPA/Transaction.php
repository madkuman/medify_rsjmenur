<?php

namespace App\Models\LabPA;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use ScoutElastic\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\FrontOffice\InsuranceCompany;
use Carbon\Carbon;
use App\Models\Pasien\Pasien;
use App\Models\Keuangan\TarifMaster;
use App\Models\Hospital\Lokasi;
use App\Models\Pasien\PasienPembayaran;
use App\Models\LabPA\TransactionDetail;
use DB;

class Transaction extends Model
{
	use DataLogger;   
    use SoftDeletes;
    // use Searchable;

    protected $connection = 'lab_pa';
    protected $table = 'transaction';

    protected $dates = ['deleted_at', 'verified_at', 'pemeriksaan_start'];

    public function toSearchableArray()
    {
        return $this->toArray();
    }

    public function pasien()
    {
         return $this->hasOne('App\Models\Pasien\Pasien','id','patient_id');   
    }


    public function photos()
    {
        return $this->hasMany('App\Models\LabPA\Photo', 'transaction_id', 'id');
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
        return $this->hasMany('App\Models\LabPA\TransactionDetail', 'transaction_id');
    }

    public function detail_real()
    {
        return $this->hasMany('App\Models\LabPA\TransactionDetail', 'transaction_id')->where('status', '!=', 'ask');
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

    public function pemeriksa()
    {
        return $this->hasOne('App\User', 'id', 'result_created_by');
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

    public function pembayaran()
    {
        return $this->hasOne('App\Models\Pasien\PasienPembayaran', 'id', 'pasien_pembayaran_id')->withTrashed();
    }
    public function asal()
    {
        return $this->hasOne('App\Models\Hospital\Lokasi', 'id', 'lokasi_id');
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
        return $query->whereIn('patient_id', $pasien_id);
    }

    public function scopePasienHasNoRm($query, $pasien_rm)
    {
        $pasien_id = Pasien::where('no_rm', $pasien_rm)->get()->map->only(['id']);
        return $query->whereIn('patient_id', $pasien_id);
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

    public function getKetepatanPelayananAttribute()
    {
        if(is_null($this->pemeriksaan_start))
            return '-';
        return $this->verified_at->diffInHours($this->pemeriksaan_start);       
    }

    public function scopeHasTarifDetail($query, $tarif_ids, $start, $end)
    {

        $trans_id = TransactionDetail::whereBetween(DB::raw('DATE(created_at)'), array($start, $end))
                    ->whereIn('tarif_id', $tarif_ids)->get()->map->only(['transaction_id']);
        return $query->whereIn('id', $trans_id);
    }
}