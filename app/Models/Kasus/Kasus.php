<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;
use Auth;
use App\Models\Kasus\Kolaborator;
use App\Models\Kasus\Tagihan;
use App\Models\Kasus\OperasiPermintaan;
use App\Models\RawatJalan\Transaksi;
use App\Models\Gizi\Pemesanan;
use App\Models\Gizi\PemesananDetail;
use App\Models\Hospital\Sugesti;
use ScoutElastic\Searchable;
use App\Models\Kasus\Resep;
use DB;

class Kasus extends Model
{
    use DataLogger;
    //use Searchable;
    protected $connection = 'kasus';
    protected $table = 'kasus';
    protected $indexConfigurator = \App\IndexConfig\Kasus::class;
    // protected $appends = ['format_krs', 'dpjp', 'lokasi'];
    protected $dates = [
        'created_at',
        'updated_at',
        'krs_at',
        'mrs_at'
    ];


    protected $mapping = [
        'properties' => [
            'judul_kasus' => [
                'type' => 'text',
                "analyzer" => "partial",
                "search_analyzer" => "exact"
            ],
            'created_at' => [
                'type' => 'date'
            ],
            'nama_pasien' => [
                'type' => 'text',
                "analyzer" => "partial",
                "search_analyzer" => "exact"
            ],
            'user' => [
                'type' => 'long'
            ],
            'end_at' => [
                'type' => 'keyword'
            ]
        ]
    ];

    public function toSearchableArray()
    {
        $nama_pasien = $this->pasien->name ?? '';
        $created_at = $this->created_at->toDateString() ?? '';
        $updated_at = $this->created_at->toDateString() ?? '';
        $user = $this->kolaborator()->pluck('user_id')->toArray() ?? '';

        if (isset($this->end_at))
            $end_at = Carbon::parse($this->end_at)->toDateString() ?? '';
        else
            $end_at = $this->end_at ?? '';

        if (isset($this->krs_at))
            $krs_at = $this->krs_at->toDateString() ?? '';
        else
            $krs_at = $this->krs_at ?? '';

        $res =  [
            'nama_pasien' => $nama_pasien,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
            'krs_at' => $krs_at,
            'user' => $user,
            'end_at' => $end_at
        ];
        $res1 = array_merge($this->toArray(), $res);
        unset($res1['pasien']);
        unset($res1['kolaborator']);
        // dd($res, $res1);
        return ($res1);
    }
    public function scopePemesananTanggal($query, $tanggal)
    {
        $start = Carbon::parse($tanggal)->startOfDay();
        $end = Carbon::parse($tanggal)->endOfDay();
        // $detail = PemesananDetail::with('pemesanan.kasus')->whereBetween('untuk_tanggal',[$start,$end])->get()->groupBy('pemesanan.kasus.id');
        $detail = DB::connection('gizi')->select(DB::raw("select distinct p.kasus_id from pemesanan_detail pd , pemesanan p where pd.pemesanan_id = p.id and pd.untuk_tanggal >= '" . $start . "' and pd.untuk_tanggal <= '" . $end . "'"));
        // dd($detail);
        $hasil = array_map(function ($q) {
            return $q->kasus_id;
        }, $detail);
        // dd($hasil);
        return $query->whereIn('id', $hasil);
    }
    public function pemesanan()
    {
        return $this->hasMany('App\Models\Gizi\Pemesanan', 'kasus_id', 'id')->latest();
    }

    public function operasiTransaksi()
    {
        return $this->hasMany('App\Models\KamarOperasi\Transaksi', 'kasus_id', 'id')->whereNotNull('hasil_id')->latest();
    }

    public function lokasi()
    {
        return $this->hasOne('App\Models\Kasus\Lokasi', 'kasus_id', 'id')->orderBy('id', 'desc');
    }

    public function lokasi_first()
    {
        return $this->hasOne('App\Models\Kasus\Lokasi', 'kasus_id', 'id');
    }

    public function lokasi_last()
    {
        return $this->hasOne('App\Models\Kasus\Lokasi', 'kasus_id', 'id')->latest();
    }

    public function lokasiAll()
    {
        return $this->hasMany('App\Models\Kasus\Lokasi', 'kasus_id', 'id')->orderBy('created_at', 'desc');
    }

    public function kelas()
    {
        return $this->hasOne('App\Models\Hospital\Kelas', 'id', 'kelas_id');
    }

    public function transaksi_global_detail()
    {
        return $this->hasOne('App\Models\Hospital\TransaksiMasukDetail', 'id', 'transaksi_masuk_detail_id');
    }

    public function tagihan()
    {
        return $this->hasOne('App\Models\Kasus\Tagihan', 'kasus_id', 'id')->whereNull('checkout')->orderBy('id', 'asc');
    }

    public function daftar_tagihan()
    {
        return $this->hasMany('App\Models\Kasus\Tagihan', 'kasus_id', 'id');
    }

    public function daftar_tagihan_belum_checkout()
    {
        return $this->hasMany('App\Models\Kasus\Tagihan', 'kasus_id', 'id')->whereNull('checkout');
    }

    public function daftarTagihanLatest()
    {
        return $this->hasOne('App\Models\Kasus\Tagihan', 'kasus_id', 'id')->latest();
    }

	public function getTagihanTotalAttribute()
	{
		$tagihans = Tagihan::where('kasus_id',$this->id)->sum('total_bill');
		return $tagihans;
	}

    public function dpjp_detail()
    {
        return $this->hasOne('App\User', 'id', 'dpjp');
    }

    public function pasien()
    {
        return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');
    }

    public function identitas()
    {
        return $this->hasOne('App\Models\Kasus\Identitas', 'kasus_id', 'id');
    }

    public function kolaborator()
    {
        return $this->hasMany('App\Models\Kasus\Kolaborator', 'kasus_id', 'id');
    }

    public function kolaboratorExceptAdmin()
    {
        return $this->hasMany('App\Models\Kasus\Kolaborator', 'kasus_id', 'id')->where('admin', 0);
    }

    public function operasi()
    {
        return $this->hasMany('App\Models\Kasus\OperasiPermintaan', 'kasus_id', 'id')->withTrashed();
    }

    public function operasiDone()
    {
        return $this->hasMany('App\Models\Kasus\OperasiPermintaan', 'kasus_id', 'id')->whereHas('transaksi', function ($q) {
            $q->from(config('app.db_name') . '_kamar_operasi.transaksi')->where('status', 1);
        })->withTrashed();
    }

    public function getOperasiSelesaiAttribute()
    {
        $operasi = OperasiPermintaan::where('kasus_id', $this->id)->whereHas('transaksi', function ($q) {
            $q->from(config('app.db_name') . '_kamar_operasi.transaksi')->where('status', 1);
        })->get();

        return $operasi;
    }

    public function admin()
    {
        return $this->hasOne('App\Models\Kasus\Kolaborator', 'kasus_id', 'id')->where('admin', 1);
    }

    public function end_by_creator()
    {
        return $this->hasOne('App\User', 'id', 'end_by');
    }

    public function bpjs()
    {
        return $this->belongsToMany('App\Models\Kasus\BPJSSEP', 'bpjs_sep_kasus', 'kasus_id', 'bpjs_sep_id')->with(['tagihan_detail.creator', 'tagihan_detail'])->orderBy('id', 'desc');
    }

    public function bpjs_without_eager()
    {
        return $this->belongsToMany('App\Models\Kasus\BPJSSEP', 'bpjs_sep_kasus', 'kasus_id', 'bpjs_sep_id')->with('sisaPlafon')->orderBy('id', 'desc');
    }

    public function getActiveSepAttribute()
    {
        $sep = BPJSSEP::where('id', $this->attributes['sep_id'])->first();
        return $sep;
    }

    public function sep()
    {
        return $this->hasOne('App\Models\Kasus\BPJSSEP', 'id', 'sep_id');
    }

    public function getEndAtTanggalAttribute()
    {
        return Carbon::parse($this->end_at)->format('d F Y H:i');
    }

    public function rawat_jalan_transaksi_first()
    {
        return $this->hasOne('App\Models\RawatJalan\Transaksi', 'kasus_id', 'id');
    }

    public function rawat_inap_transaksi_first()
    {
        return $this->hasOne('App\Models\RawatInap\Transaksi', 'kasus_id', 'id')->whereNotNull('kedatangan_at');
    }

    public function rawat_inap_transaksi_last()
    {
        return $this->hasOne('App\Models\RawatInap\Transaksi', 'kasus_id', 'id')->whereNotNull('kedatangan_at')->latest();
    }

    public function rawat_inap_transaksi()
    {
        return $this->hasMany('App\Models\RawatInap\Transaksi', 'kasus_id', 'id')->whereNotNull('kedatangan_at');
    }

    public function urikkes()
    {
        return $this->hasOne('App\Models\Urikkes\Transaksi', 'kasus_id', 'id');
    }

    public function urikkes_penunjang_baru()
    {
        return $this->hasOne('App\Models\Urikkes\Transaksi', 'kasus_id', 'id')->where('status_penunjang', 0)->orWhereNull('status_penunjang');
    }

    public function urikkes_transaksi()
    {
        return $this->hasOne('App\Models\Urikkes\Transaksi', 'kasus_id', 'id');
    }

    public function getLamaPerawatanAttribute()
    {
        $created_at = $this->created_at;
        $krs_at = Carbon::parse($this->attributes['krs_at']);
        $diff = $created_at->diff($krs_at);
        $day = $diff->format('%d');
        if ($day < 1) return 1;
        else return $day;
    }

    public function myRole()
    {
        return $this->hasOne('App\Models\Kasus\Kolaborator', 'kasus_id', 'id')
            ->whereHas('kasus', function ($q) {
                $q->whereNull('end_at');
            })
            ->where('user_id', Auth::id())
            ->where('invitation', 1);
    }

    public function getMyRoleAttribute()
    {
        // dd($this, 'aedawde');
        // if relation is not loaded already, let's do it first
        if (!array_key_exists('myRole', $this->relations))
            $this->load('myRole');

        $related = $this->getRelation('myRole');
        // then return the count directly
        return ($this->end_at == null) ? $related : null;
    }

    // public function getMyRoleAttribute()
    // {
    //     dd($this);
    //     $kolaborator = Kolaborator::where('user_id',Auth::user()->id)
    //                     ->where('kasus_id',$this->id)
    //                     ->where('invitation',1)->first();
    //     if($this->end_at != null)
    //     {
    //         return null;
    //     }
    //     else
    //     {
    //         return $kolaborator;    
    //     }
    // }

    public function myRoleWithoutEnd()
    {
        return $this->hasOne('App\Models\Kasus\Kolaborator', 'kasus_id', 'id')
            ->where('user_id', Auth::id())
            ->where('invitation', 1);
    }

    public function getMyRoleWithoutEndAttribute()
    {

        // if relation is not loaded already, let's do it first
        if (!array_key_exists('myRoleWithoutEnd', $this->relations))
            $this->load('myRoleWithoutEnd');

        $related = $this->getRelation('myRoleWithoutEnd');

        // then return the count directly
        return ($related) ? $related : null;
    }

    public function myInvitation()
    {
        return $this->hasOne('App\Models\Kasus\Kolaborator', 'kasus_id', 'id')
            ->where('user_id', Auth::id());
    }

    public function getMyInvitationAttribute()
    {
        // if relation is not loaded already, let's do it first
        if (!array_key_exists('myInvitation', $this->relations))
            $this->load('myInvitation');

        $related = $this->getRelation('myInvitation');

        // then return the count directly
        return ($related) ? $related : null;
    }

    public function pembayaran()
    {
        return $this->hasOne('App\Models\Pasien\PasienPembayaran', 'id', 'pasien_pembayaran_id')->withTrashed();
    }

    public function pembayaranTambahan()
    {
        return $this->hasMany('App\Models\Kasus\PembayaranTambahan', 'kasus_id', 'id')->orderBy('urutan');
    }

    public function getPembayaranShortAttribute()
    {


        $pasien_pembayaran_id = $this->attributes['pasien_pembayaran_id'];
        $query = '
        SELECT 
            pembayaran_perusahaan.`nama`,
            pembayaran_perusahaan.`type`
        FROM 
            `' . config('app.db_name') . '_patients`.`pasien_pembayaran`, 
            `' . config('app.db_name') . '_patients`.`pembayaran_perusahaan`, 
            `' . config('app.db_name') . '_patients`.`pembayaran_perusahaan_tipe`
        WHERE pasien_pembayaran.id = ' . $pasien_pembayaran_id . '
        AND pasien_pembayaran.`perusahaan_id` = pembayaran_perusahaan.`id`
        AND pembayaran_perusahaan.`type` = pembayaran_perusahaan_tipe.`id`
        ';

        $data = DB::connection('patients')->select($query);
        return $data[0];
    }

    public function diagnosis()
    {
        return $this->hasMany('App\Models\Kasus\Diagnosis', 'kasus_id', 'id');
    }
    public function tindakan_icd9()
    {
        return $this->hasMany('App\Models\Kasus\Tindakan', 'kasus_id', 'id')->whereNotNull('icd_9');
    }

    public function diagnosisUtama()
    {
        return $this->hasOne('App\Models\Kasus\Diagnosis', 'kasus_id', 'id')->where('type', 'utama');
    }

    public function diagnosisUtamaBpjs()
    {
        return $this->hasOne('App\Models\Kasus\Diagnosis', 'kasus_id', 'id')->where('type', 'utama')->whereHas('icd10', function ($q) {
            $q->where('bpjs_support', 1);
        });
    }

    public function diagnosisSekunder()
    {
        return $this->hasMany('App\Models\Kasus\Diagnosis', 'kasus_id', 'id')->where('type', 'sekunder');
    }

    public function diagnosisKomplikasi()
    {
        return $this->hasMany('App\Models\Kasus\Diagnosis', 'kasus_id', 'id')->where('type', 'komplikasi');
    }

    public function diagnosisTambahan()
    {
        return $this->hasMany('App\Models\Kasus\Diagnosis', 'kasus_id', 'id')->where('utama', 0);
    }

    public function diagnosisTambahanBpjs()
    {
        return $this->hasMany('App\Models\Kasus\Diagnosis', 'kasus_id', 'id')->where('utama', 0)->whereHas('icd10', function ($q) {
            $q->where('bpjs_support', 1);
        });
    }

    public function tindakan_icd9_bpjs()
    {
        return $this->hasMany('App\Models\Kasus\Tindakan', 'kasus_id', 'id')->whereHas('icd9', function ($q) {
            $q->where('bpjs_support', 1);
        });;
    }

    public function jenazah()
    {
        return $this->hasOne('App\Models\KamarJenazah\Permintaan', 'kasus_id', 'id');
    }
    public function TransaksiRawatJalan()
    {
        return $this->hasMany('App\Models\RawatJalan\Transaksi', 'kasus_id', 'id');
    }
    public function TransaksiRawatInap()
    {
        return $this->hasMany('App\Models\RawatInap\Transaksi', 'kasus_id', 'id');
    }
    public function TransaksiIGD()
    {
        return $this->hasMany(\App\Models\IGD\Transaksi::class, 'kasus_id', 'id');
    }

    public function telingaUrikkes()
    {
        return  $this->hasMany('App\Models\Kasus\Telinga', 'nomor_kasus', 'nomor_kasus')->orderBy('id', 'desc');
    }

    public function mataUrikkes()
    {
        return  $this->hasMany('App\Models\Kasus\Mata', 'nomor_kasus', 'nomor_kasus')->orderBy('id', 'desc');
    }

    public function gigiUrikkes()
    {
        return  $this->hasMany('App\Models\Kasus\Mata', 'nomor_kasus', 'nomor_kasus')->orderBy('id', 'desc');
    }

    public function darahUrikkes()
    {
        return  $this->hasMany('App\Models\Kasus\DarahLengkap', 'kasus_id', 'id')->orderBy('id', 'desc');
    }
    public function immuUrikkes()
    {
        return  $this->hasMany('App\Models\Kasus\Immunologi', 'kasus_id', 'id')->orderBy('id', 'desc');
    }
    public function urineUrikkes()
    {
        return  $this->hasMany('App\Models\Kasus\Urine', 'kasus_id', 'id')->orderBy('id', 'desc');
    }
    public function fisikUrikkes()
    {
        return  $this->hasMany('App\Models\Kasus\EvaluasiKlinis', 'nomor_kasus', 'nomor_kasus')->orderBy('id', 'desc');
    }
    public function papsmearUrikkes()
    {
        return  $this->hasMany('App\Models\Kasus\PapSmear', 'kasus_id', 'id')->orderBy('id', 'desc');
    }
    public function resumeUrikkes()
    {
        return $this->hasMany('App\Models\Kasus\Lain_Urikkes', 'nomor_kasus', 'nomor_kasus')->orderBy('id', 'desc');
    }

    public function resume()
    {
        return $this->hasOne('App\Models\Kasus\Resume', 'kasus_id', 'id');
    }

    public function ringkasanPasienPulang()
    {
        return $this->hasOne('App\Models\Kasus\RingkasanPasienPulang', 'kasus_id', 'id');
    }

    public function anak()
    {
        return $this->hasMany('App\Models\Kasus\Kasus', 'kasus_id_ibu', 'id');
    }

    public function ibu()
    {
        return $this->hasOne('App\Models\Kasus\Kasus', 'id', 'kasus_id_ibu');
    }

    public function getSugestiAttribute()
    {
        $sugesti = Sugesti::where('lokasi_id', $this->lokasi->lokasi->id)->get();
        return $sugesti;
    }

    public function rujuk_luar()
    {
        return $this->hasOne('App\Models\Kasus\RujukLuar', 'nomor_kasus', 'nomor_kasus');
    }

    public function resep()
    {
        return $this->hasMany('App\Models\Kasus\Resep', 'kasus_id', 'id');
    }
    public function resep_bulan($bulan)
    {
        $tahun = Carbon::now()->year;
        $start = Carbon::createFromFormat('Y-m', $tahun . '-' . $bulan)->startOfMonth();
        $end = Carbon::createFromFormat('Y-m', $tahun . '-' . $bulan)->endOfMonth();
        $id = $this->id;
        $resep = Resep::where('kasus_id', $id)->whereBetween('created_at', [$start, $end])
            ->orderBy('created_at', 'DESC')->first();
        return $resep;
    }

    public function getTanggalAttribute()
    {
        if (isset($this->attributes['created_at'])) {
            return Carbon::parse($this->attributes['created_at'])->format('d m Y');
        }
    }


    public function krs_by_user()
    {
        return $this->hasOne('App\User', 'id', 'krs_by');
    }


    public function getDpjpAttribute()
    {
        $kolaborator_id = $this->kolaborator->map(function ($item) {
            return $item->id;
        });
        return Kolaborator::whereIn('id', $kolaborator_id)->where('admin', 1)->with('user')->first();
    }

    // public function getTanggalMasukAttribute()
    // {   
    //     if(isset($this->attributes['mrs_at']))
    //     {
    //         $date = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($this->attributes['mrs_at'],'%d %B %Y');
    //     }
    //     else
    //     {
    //         $date = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($this->attributes['created_at'],'%d %B %Y');
    //     }
    //     // dd($date);
    //     return $date;
    // }

    public function getJamMasukAttribute()
    {
        if (isset($this->attributes['mrs_at'])) {
            $date = Carbon::parse($this->attributes['mrs_at'])->format('H:i');
        } else {
            $date = Carbon::parse($this->attributes['created_at'])->format('H:i');
        }
        // dd($date);
        return $date;
    }

    public function getHeaderAttribute()
    {
        $kasus_id = $this->attributes['id'];
        $lokasi_id = $this->attributes['last_lokasi_id'];
        $bpjs_sep_id = $this->attributes['sep_id'];
        if (empty($bpjs_sep_id)) $bpjs_sep_id = 0;

        // dd($this, $bpjs_sep_id);
        $query = '
            SELECT 
                kasus.`id` AS kasus_id, 
                kasus.`judul_kasus` AS kasus_judul_kasus, 
                kasus.`kasus_id_ibu`,
                kasus_kelas.kelas_nama, 
                kasus_identitas.`avatar_thumb` AS identitas_avatar_thumb, 
                kasus_identitas.`jenis_kelamin` AS identitas_jenis_kelamin,  
                kasus_identitas.`nama` AS identitas_nama , 
                kasus_identitas.`tanggal_lahir` AS identitas_tanggal_lahir, 
                kasus_lokasi.nama AS lokasi_nama, 
                kasus_lokasi.lokasi_departemen_nama,
                kasus_lokasi.lokasi_departemen_id,
                kasus_sep.sep_total_plafon,
                kasus_sep.sep_total_pemakaian,
                kasus_sep.sep_id
            FROM `' . config('app.db_name') . '_kasus`.`kasus`
            LEFT JOIN (
                SELECT kasus.id AS kasus_id, kelas.`nama` AS kelas_nama FROM `' . config('app.db_name') . '_kasus`.kasus, `' . config('app.db_name') . '`.`kelas`
                WHERE kelas.`id` = kasus.kelas_id
                AND kasus.`id` = ' . $kasus_id . '
            ) kasus_kelas
            ON kasus.`id` = kasus_kelas.kasus_id
            LEFT JOIN (
                SELECT kasus.id AS kasus_id, identitas.`avatar_thumb`, identitas.`jenis_kelamin`, identitas.`nama`, identitas.`tanggal_lahir`
                FROM `' . config('app.db_name') . '_kasus`.kasus, `' . config('app.db_name') . '_kasus`.`identitas`
                WHERE kasus.id = identitas.`kasus_id`
                AND kasus.id = ' . $kasus_id . '
            ) kasus_identitas
            ON kasus_identitas.kasus_id = kasus.id
            LEFT JOIN (
                SELECT lokasi_kasus.`kasus_id`, lokasi_master.`nama`,lokasi_master.`lokasi_departemen_id`, lokasi_departemen.`nama` AS lokasi_departemen_nama
                FROM 
                    `' . config('app.db_name') . '_kasus`.`lokasi` lokasi_kasus,
                    `' . config('app.db_name') . '`.lokasi lokasi_master,
                    `' . config('app.db_name') . '`.`lokasi_departemen`,
                    (
                        SELECT MAX(id) AS id
                        FROM `' . config('app.db_name') . '_kasus`.lokasi 
                        WHERE kasus_id =  ' . $kasus_id . '
                    ) lokasi_last
                WHERE
                    lokasi_last.id = lokasi_kasus.id
                    AND lokasi_kasus.lokasi_id = lokasi_master.id
                    AND lokasi_departemen.`id` = lokasi_master.`lokasi_departemen_id`
                GROUP BY lokasi_kasus.`kasus_id`, lokasi_master.`nama`,lokasi_master.`lokasi_departemen_id`
            ) kasus_lokasi
            ON kasus.id = kasus_lokasi.kasus_id
            LEFT JOIN (
                SELECT 
                    bpjs_sep.id AS sep_id,
                    bpjs_sep.`total_plafon` AS sep_total_plafon, 
                    bpjs_sep.`no_sep` AS sep_nomor, 
                    sep_total_tagihan.sep_total_tagihan AS sep_total_pemakaian,
                    ( bpjs_sep.`total_plafon` - sep_total_tagihan.sep_total_tagihan) AS sep_sisa
                FROM `' . config('app.db_name') . '_kasus`.`bpjs_sep`
                LEFT JOIN
                    (
                        SELECT tagihan_detail.`sep_id`, SUM(tagihan_detail.`subtotal`) AS sep_total_tagihan 
                        FROM `' . config('app.db_name') . '_kasus`.`tagihan_detail`
                        WHERE tagihan_detail.`sep_id` = ' . $bpjs_sep_id . '
                        AND tagihan_detail.`deleted_at` IS NULL
                    ) sep_total_tagihan
                ON sep_total_tagihan.sep_id = bpjs_sep.`id`
                WHERE id = ' . $bpjs_sep_id . '
            ) kasus_sep
            ON kasus.`sep_id` = kasus_sep.sep_id
            WHERE kasus.id = ' . $kasus_id . ';
        ';

        $data = DB::select($query);
        // dd($query, $data);
        return $data[0];
    }

    public function penunjangRadiologi()
    {
        return $this->hasMany('App\Models\Radiology\Transaction', 'kasus_id', 'id');
    }

    public function penunjang_labpk()
    {
        return $this->hasMany('App\Models\LabPK\Transaksi', 'kasus_id', 'id');
    }

    public function penunjangRadiologiBelomSelesai()
    {
        return $this->hasMany('App\Models\Radiology\Transaction', 'kasus_id', 'id')->where('status','=',0);
    }

    public function penunjang_labpkBelomSelesai()
    {
        return $this->hasMany('App\Models\LabPK\Transaksi', 'kasus_id', 'id')->where('status','=',0);
    }
    public function transaksi_farmasiBelomSelesai()
    {
        return $this->hasMany('App\Models\Farmasi\TransaksiObat', 'kasus_id', 'id')->whereNull('paid_at');
    }

    public function penunjangRadiologiPermintaan()
    {
        return $this->hasMany('App\Models\Radiology\Transaction', 'kasus_id', 'id')->whereNull('verified_at');
    }

    public function penunjangLabPKPermintaan()
    {
        return $this->hasMany('App\Models\LabPK\Transaksi', 'kasus_id', 'id')->whereNull('verified_at');
    }

    public function persalinan()
    {
        return $this->hasMany('App\Models\Kasus\AlatBantu', 'kasus_id', 'id')->where('type', 'Persalinan');
    }

    public function ket_kelahiran()
    {
        return $this->hasMany('App\Models\Kasus\KetKelahiran', 'kasus_id', 'id');
    }

    public function alatBantu()
    {
        return $this->hasMany('App\Models\Kasus\AlatBantu', 'kasus_id', 'id');
    }

    public function covid_status()
    {
        return $this->hasOne('App\Models\Kasus\Covid19Status', 'kasus_id', 'id')->latest();
    }

    public function covid_status_histori()
    {
        return $this->hasMany('App\Models\Kasus\Covid19Status', 'kasus_id', 'id')->orderBy('id', 'desc');
    }

    public function pengawasan_covid()
    {
        return $this->hasOne('App\Models\Kasus\AlatBantu', 'kasus_id', 'id')->where('type', 'covid')->latest();
    }

    public function transaksi_farmasi()
    {
        return $this->hasMany('App\Models\Farmasi\TransaksiObat', 'kasus_id', 'id');
    }

    public function transaksiObat()
    {
        return $this->hasMany(\App\Models\Farmasi\TransaksiObat::class, 'kasus_id', 'id');
    }

    public function transaksiObatBelumKonfirm()
    {
        return $this->hasMany(\App\Models\Farmasi\TransaksiObat::class, 'kasus_id', 'id')->whereNull('paid_at');
    }
    public function inacbg_latest()
    {
        return $this->hasOne('App\Models\Kasus\HasilINACBG', 'kasus_id', 'id')->latest();
    }

    public function lokasi_select($lokasi_id)
    {
        return $this->hasOne('App\Models\Kasus\Lokasi', 'kasus_id', 'id')
            ->where('lokasi_id', $lokasi_id)
            ->first();
    }
    public function penunjangLabPA(){
        return $this->hasMany(\App\Models\LabPA\Transaction::class, 'kasus_id', 'id');
    }

    public function penunjangLabPAPermintaan(){
        return $this->hasMany(\App\Models\LabPA\Transaction::class, 'kasus_id', 'id')->where('status', 0);
    }

    public function asalRujukan(){
        return $this->hasOne(\App\Models\Pasien\AsalRujukan::class, 'id', 'asal_rujukan_id');
    }

    public function sirsLayananKhusus(){
        return $this->hasOne(\App\Models\Hospital\MasterSIRSKegiatanPelayananKhusus::class, 'id', 'sirs_pelayanan_khusus_id');
    }

    public function krs_ke()
    {
        return $this->hasOne('App\Models\Pasien\AsalRujukan', 'id', 'krs_keterangan');
    }

    public function catatan_pengobatan_pasien()
    {
        return $this->hasMany(\App\Models\Kasus\CatatanPengobatanPasien::class, 'kasus_id', 'id');
    }

    public function getAttrMrsAtAttribute()
    {
        return $this->mrs_at != null ? $this->mrs_at : $this->created_at;
    }

    public function alasan_krs()
    {
        return $this->hasOne(\App\Models\Hospital\MasterCaraPulang::class, 'id', 'krs_alasan')->withTrashed();
    }

    public function status_krs()
    {
        return $this->hasOne('App\Models\Hospital\MasterStatusPulang', 'id', 'krs_status')->withTrashed();
    }

    public function cppts()
    {
        return $this->hasMany('App\Models\Kasus\CPPT', 'kasus_id', 'id');
    }

    public function rencana_asuhan_keperawatan_first()
    {
        return $this->hasOne('App\Models\Kasus\Keperawatan', 'kasus_id', 'id');
    }

    public function rencana_asuhan_keperawatan_latest()
    {
        return $this->hasOne('App\Models\Kasus\Keperawatan', 'kasus_id', 'id')->latest();
    }

    public function verifikasiKoderKasus()
    {
        return $this->hasMany('App\Models\Kasus\VerifikasiKoder', 'kasus_id', 'id');
    }

    public function sirs_v3_laporan_covid()
    {
        return $this->hasOne(\App\Models\SIRS\LaporanCovid19::class, 'kasus_id', 'id');
    }
    
    public function getRawatJalanTransaksiLastAttrAttribute()
    {
        return $this->hasMany(\App\Models\RawatJalan\Transaksi::class, 'kasus_id', 'id')->where('status', '<>', -1)->orderBy('id','DESC')->first();
    }
}
