<?php

namespace App\Http\Controllers\Kasus\Kasus;

use App\Models\Gizi\JenisMakanan;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Kasus\Identitas;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AsesmenAwal;
use App\Models\Kasus\AsesmenAwal2;
use App\Models\Kasus\AsesmenAwal3;
use App\Models\Kasus\Tindakan;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\ICD10;
use App\Models\Gizi\Pemesanan;
use App\Models\RawatInap\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisPekerjaan;
use App\Models\Keuangan\TarifTipe;
use DOMPDF;
use Session;

define('relasi', ['pasien', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation.user', ]);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus', $nomor_kasus)->first();
        $data['header'] = app('App\Http\Controllers\Kasus\Kasus\ReadController')->getHeader($kasus->id,$kasus->sep_id,$kasus->last_lokasi_id);
        $data['sidebar_active'] = '';
        $data['kasus'] = $kasus;
        return view('kasus.home.home',$data);
    }

    public function datamedis($nomorKasus)
    {
        $kasus = Kasus::where('nomor_kasus', $nomorKasus)->with(relasi)->first();
        if(!empty($kasus->lokasi->lokasi->departemen->id))
        {
            $depart = $kasus->lokasi->lokasi->departemen->id;
        }
        else
        {
            $depart = 0;
        }
        $identitas = Identitas::where('kasus_id', $kasus->id)->first();
        $data['kasus'] = $kasus;
        $data['identitas'] = $identitas;
        $data['nomor_kasus'] = $nomorKasus;
        $data['orders'] = Pemesanan::with(['diet', 'pembuat'])->where('kasus_id', $kasus->id)->orderBy('jadwal_pengantaran','desc')->get();
        $data['pharmacies'] = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getAll();
        $data['cppts'] = app('App\Http\Controllers\Kasus\CPPT\ReadController')->fetchKasusCPPT($kasus->id);
        $data['diagnosis'] = app('App\Http\Controllers\Kasus\Diagnosis\ReadController')->fetchAllDiagnosis($kasus->id);
        $data['suggest_diagnosis'] = app('App\Http\Controllers\Kasus\Diagnosis\ReadController')->fetchSuggestDiagnosis();
        $data['metode'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->metode($identitas->pasien_id);
        
        $data['tindakan'] = app('App\Http\Controllers\Kasus\Tindakan\ReadController')->fetchKasusTindakan($kasus->id, 0);
        $data['tindakan_icd9'] = app('App\Http\Controllers\Kasus\Tindakan\ReadController')->fetchKasusTindakan($kasus->id, 1);
        $data['suggest_icd9'] = app('App\Http\Controllers\Kasus\Tindakan\ReadController')->fetchSuggestICD9();
        
        $data['tarif_tipe'] = TarifTipe::all();
        $data['lokasi'] = app('App\Http\Controllers\Kasus\Lokasi\ReadController')->fetchLokasiKasus($kasus->id);
        $data['resep'] = app('App\Http\Controllers\Kasus\Resep\ReadController')->fetchResepKasus($kasus->id);
        $data['autoselect_id'] = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getAutoSelect($kasus);
        $data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getDokter();
        $data['tipe_obat'] = app('App\Http\Controllers\Farmasi\TipeObat\ReadController')->getAll();
        $data['vitals'] = app('App\Http\Controllers\Kasus\VitalSign\ReadController')->fetchAllVitals($kasus->id, $identitas->berat_badan);
        $data['user'] = Auth::user();

        $data['sidebar_active'] = 'datamedis';
        $data['active_nav'] = 'identitas';

        $log = app('App\Http\Controllers\Kasus\Log\CreateController')
        ->create($kasus->id,'view','datamedis',null);
        return view(' kasus.datamedis.index', $data);
    }

    public function identitas($nomorKasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus', $nomorKasus)->with('identitas.update_user','pembayaran.kelas')->first();
        $data['kasus'] = $kasus;
        $data['identitas'] = $kasus->identitas;
        $data['metode'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->metode($kasus->identitas->pasien_id);
        $data['sidebar_active'] = 'datamedis';
        $data['active_nav'] = 'identitas';
        $data['nomor_kasus'] = $nomorKasus;
        $data['has_gigi_salah'] = count(app('App\Http\Controllers\Kasus\Tindakan\ReadController')->getByCodesAndKasus($kasus->id, ['23.1', '23.19'])) > 0;
        $data['has_trauma_bur_gigi'] = count(app('App\Http\Controllers\Kasus\Tindakan\ReadController')->getByCodesAndKasus($kasus->id, ['23.2', '23.71'])) > 0;
        
        $log = app('App\Http\Controllers\Kasus\Log\CreateController')
        ->create($kasus->id,'view','identitas',null);
        //dd($kasus);
        $data['waktu_masuk'] = isset($kasus->TransaksiRawatInap[0]) ? $kasus->TransaksiRawatInap[0]->waktu_masuk : null;

        return view('kasus.datamedis.index', $data);
    }

    public function cppt($nomorKasus)
    {
        $relasi = relasi;
        $relasi[] = 'covid_status';
        $relasi[] = 'covid_status_histori.creator';
        $kasus = Kasus::where('nomor_kasus', $nomorKasus)->with($relasi)->first();
        $data['has_covid_diagnosis'] = app('App\Http\Controllers\Kasus\Diagnosis\ReadController')->hasDiagnosis($kasus->id,'B34.2');

        $last_asesmen_awal = [];
        if($kasus->lokasi->lokasi->departemen->id == 2)
            $last_asesmen_awal = app('App\Http\Controllers\Kasus\AsesmenAwal\ReadController')->getWarningAsesmenAwal($kasus->id);

        $data['kasus'] = $kasus;
        //$data['identitas'] = $kasus->identitas;
        $data['cppts'] = app('App\Http\Controllers\Kasus\CPPT\ReadController')->fetchKasusCPPT($kasus->id);
        $data['sidebar_active'] = 'datamedis';
        $data['nomor_kasus'] = $nomorKasus;
        $data['active_nav'] = 'cppt';
        $data['last_asesmen_awal'] = $last_asesmen_awal;

        $log = app('App\Http\Controllers\Kasus\Log\CreateController')
        ->create($kasus->id,'view','cppt',null);
        return view('kasus.datamedis.index', $data);
    }

    public function vitalSign($nomorKasus)
    {
        $kasus = Kasus::where('nomor_kasus', $nomorKasus)->with(relasi)->first();
        $all_kasus = Kasus::where('pasien_id', $kasus->pasien->id)->with(relasi)->pluck('id');
        $data['kasus'] = $kasus;
        $data['vitals'] = new \Illuminate\Database\Eloquent\Collection;
        foreach ($all_kasus as $semua_kasus) {
            $temp = app('App\Http\Controllers\Kasus\VitalSign\ReadController')->fetchAllVitals($semua_kasus);
            $data['vitals'] = $data['vitals']->merge($temp);
        }
        $data['vitals'] = $data['vitals']->sortByDesc('created_at');
        $data['sidebar_active'] = 'datamedis';
        $data['nomor_kasus'] = $nomorKasus;
        $data['active_nav'] = 'vital';

        $log = app('App\Http\Controllers\Kasus\Log\CreateController')
        ->create($kasus->id,'view','vital',null);
        return view('kasus.datamedis.index', $data);
    }

    public function diagnosis($nomorKasus)
    {
        $kasus = Kasus::where('nomor_kasus', $nomorKasus)->with(relasi)->first();
        $data['kasus'] = $kasus;
        
        $data['diagnosis'] = app('App\Http\Controllers\Kasus\Diagnosis\ReadController')->fetchAllDiagnosis($kasus->id);
        $data['suggest_diagnosis'] = app('App\Http\Controllers\Kasus\Diagnosis\ReadController')->fetchSuggestDiagnosis();


        $data['sidebar_active'] = 'diagnosis';
        $data['nomor_kasus'] = $nomorKasus;
        $data['active_nav'] = 'diagnosis';

        $log = app('App\Http\Controllers\Kasus\Log\CreateController')
        ->create($kasus->id,'view','diagnosis',null);
        return view('kasus.datamedis.index', $data);
    }

    public function tindakan($nomorKasus)
    {
        $kasus = Kasus::where('nomor_kasus', $nomorKasus)->with(relasi)->first();
        $data['kasus'] = $kasus;
        
        $data['tindakan'] = app('App\Http\Controllers\Kasus\Tindakan\ReadController')->fetchKasusTindakan($kasus->id, 0);
        $data['tarif_tipe'] = TarifTipe::all();
        
        $data['sidebar_active'] = 'tindakan';
        $data['nomor_kasus'] = $nomorKasus;
        $data['active_nav'] = 'tindakan';

        $log = app('App\Http\Controllers\Kasus\Log\CreateController')
        ->create($kasus->id,'view','tindakan',null);
        return view('kasus.datamedis.index', $data);
    }

    public function tindakanICD9($nomorKasus)
    {
        $kasus = Kasus::where('nomor_kasus', $nomorKasus)->with(relasi)->first();
        $data['kasus'] = $kasus;
        
        $data['tindakan_icd9'] = app('App\Http\Controllers\Kasus\Tindakan\ReadController')->fetchKasusTindakan($kasus->id, 1);
        $data['suggest_icd9'] = app('App\Http\Controllers\Kasus\Tindakan\ReadController')->fetchSuggestICD9();
        
        $data['tarif_tipe'] = TarifTipe::all();
        
        $data['sidebar_active'] = 'icd9';
        $data['nomor_kasus'] = $nomorKasus;
        $data['active_nav'] = 'icd9';

        $log = app('App\Http\Controllers\Kasus\Log\CreateController')
        ->create($kasus->id,'view','icd9',null);
        return view('kasus.datamedis.index', $data);
    }



    public function resep($nomorKasus)
    {
        $kasus = Kasus::where('nomor_kasus', $nomorKasus)->with(relasi)->first();
        // dd($kasus);
        $data['kasus'] = $kasus;
        
        $data['resep'] = app('App\Http\Controllers\Kasus\Resep\ReadController')->fetchResepKasus($kasus->id);
        // dd($data['resep'][0]->resepDetail[0]->expected_reorder_at);
        $data['tipe_obat'] = app('App\Http\Controllers\Farmasi\TipeObat\ReadController')->getAll();
        $data['pharmacies'] = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getAll();
        $data['autoselect_id'] = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getAutoSelect($kasus);
        
        $data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getDokter();
        $data['user'] = Auth::user();
        $data['sidebar_active'] = 'datamedis';
        $data['nomor_kasus'] = $nomorKasus;
        $data['aturan'] = app('App\Http\Controllers\Farmasi\AturanObat\ReadController')->getAll();
        $data['active_nav'] = 'resep';

        $log = app('App\Http\Controllers\Kasus\Log\CreateController')
        ->create($kasus->id,'view','resep',null);
        return view('kasus.datamedis.index', $data);
    }
    
    public function gizi($nomorKasus)
    {
        $kasus = Kasus::where('nomor_kasus', $nomorKasus)->with(relasi)->first();
        $data['kasus'] = $kasus;
        $data['orders'] = Pemesanan::with(['diet', 'pembuat'])->where('kasus_id', $kasus->id)->orderBy('jadwal_pengantaran','desc')->get();
        $data['skrining'] = app('App\Http\Controllers\Kasus\AlatBantu\Gizi\ViewController')->getData($kasus->id);

        $data['asesmen'] = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)
                ->where('type', 'Asuhan Gizi')->orderBy('id','desc')->get();

        $data['diet'] = app('App\Http\Controllers\Gizi\Pemesanan\ReadController')->getDiet();
        $data['jenis_makanan_utama'] = JenisMakanan::where('utama',JenisMakanan::UTAMA)->get();
        $data['jenis_makanan_tambahan'] = JenisMakanan::where('utama',JenisMakanan::TAMBAHAN)->get();

        $active_nav = Session('active_nav') ?? 'skrining-ulang';

        $data['sidebar_active'] = 'datamedis';
        $data['nomor_kasus'] = $nomorKasus;
        $data['sidebar_active'] = 'gizi';
        $data['active_nav'] = $active_nav;

        $log = app('App\Http\Controllers\Kasus\Log\CreateController')->create($kasus->id,'view','gizi',null);
        return view('kasus.gizi.index', $data);
    }
    
    public function lokasi($nomorKasus)
    {
        $kasus = Kasus::where('nomor_kasus', $nomorKasus)->with(relasi)->first();
        $data['kasus'] = $kasus;
        
        $data['lokasi'] = app('App\Http\Controllers\Kasus\Lokasi\ReadController')->fetchLokasiKasus($kasus->id);
        
        $data['sidebar_active'] = 'datamedis';
        $data['nomor_kasus'] = $nomorKasus;
        $data['active_nav'] = 'lokasi';

        $log = app('App\Http\Controllers\Kasus\Log\CreateController')
        ->create($kasus->id,'view','lokasi',null);
        return view('kasus.datamedis.index', $data);
    }

    public function asesmenawal($nomorKasus)
    {
        $kasus = Kasus::where('nomor_kasus', $nomorKasus)->with(relasi)->first();
        $data['kasus'] = $kasus;
        $data['rapts'] = app('App\Http\Controllers\Kasus\CPPT\ReadController')->fetchKasusCPPT($kasus->id, 'rapt');
        $asesmen2 = AsesmenAwal2::with('creator.specialty_detail','verifikatorDokter','verifikatorNers')->where('kasus_id', $kasus->id)->orderBy('id', 'desc')
        ->get()
        ->keyBy('id');

        $asesmen2_ids = $asesmen2->pluck('id');
        $asesmen = AsesmenAwal::whereIn('id', $asesmen2_ids)->orderBy('id', 'desc')
        ->get()
        ->keyBy('id');
        $asesmen3 = AsesmenAwal3::whereIn('id', $asesmen2_ids)->orderBy('id', 'desc')
        ->get()
        ->keyBy('id');
        $asesmen2 =$asesmen2->toArray();
        $asesmen =$asesmen->toArray();
        $asesmen3 =$asesmen3->toArray();
        $merged = [];
        foreach ($asesmen2 as $key => $value) {
            $temp = array_merge($value, $asesmen[$key]);
            $merged[$key] = $temp;
        }
        foreach ($asesmen3 as $key => $value) {
            $temp = array_merge($value, $merged[$key]);
            $merged[$key] = $temp;
        }

        $last_asesmen_awal = [];
        if($kasus->lokasi->lokasi->departemen->id == 2)
            $last_asesmen_awal = app('App\Http\Controllers\Kasus\AsesmenAwal\ReadController')->getWarningAsesmenAwal($kasus->id);


        $data['last_asesmen_awal'] = $last_asesmen_awal;
        $data['asesmen'] = $merged;
        $data['sidebar_active'] = 'datamedis';
        $data['nomor_kasus'] = $nomorKasus;
        $data['active_nav'] = 'asesmenawal';
        $data['icd_10'] = ICD10::SELECT('id','code_icd')->get()->keyBy('id')->toArray();
        return view('kasus.datamedis.index', $data);
    }

    public function asesmenawalPrint($nomorKasus, $jenis, $asesmen_id)
    {
        $kasus = Kasus::where('nomor_kasus', $nomorKasus)->with(relasi)->first();
        $data['identitas'] = $kasus->identitas;
        $data['kasus'] = $kasus;
        $data['jenis'] = $jenis;
        // $data['rapts'] = app('App\Http\Controllers\Kasus\CPPT\ReadController')->fetchKasusCPPT($kasus->id, 'rapt');
        $asesmen = AsesmenAwal::find($asesmen_id);
        $asesmen2 = AsesmenAwal2::with('creator')->find($asesmen_id);
        $asesmen3 = AsesmenAwal3::find($asesmen_id);
        $this->checkToAbort($asesmen);

        $asesmen = collect($asesmen)->except(['id'])->toArray();
        $asesmen2 = collect($asesmen2)->except(['id'])->toArray();
        $asesmen3 = collect($asesmen3)->except(['id'])->toArray();
        $all_asesmen = array_merge($asesmen, $asesmen2, $asesmen3);
        $data['asesmen'] = $all_asesmen;
        $data['sidebar_active'] = 'datamedis';
        $data['nomor_kasus'] = $nomorKasus;
        $data['active_nav'] = 'asesmenawal';
        $pdf = DOMPDF::loadView('kasus.datamedis.content.asesmenawal.print',$data);
   
        return $pdf->stream('print', $data);
    }
}
