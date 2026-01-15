<?php

namespace App\Http\Controllers\LabPK\Transaksi;

use App\Models\Hospital\Grup;
use App\Models\Hospital\Profesi;
use App\Models\Hospital\UserGroup;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PembayaranPerusahaanType;
use App\Models\Hospital\Kelas;
use App\Models\Hospital\Lokasi;
use App\Models\Keuangan\TarifTipe;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\LabPK\Transaksi\ReadController;
use Auth;
use DOMPDF;

class ViewController extends Controller
{
    static protected $departemen_slug = 'lab-pk';
    static protected $link = "labpk";
    static protected $departemen = "Patologi Klinis";
    static protected $karbapenemase = ['Tidak Terjadi Infeksi', 'Acyneto Bacter Baumanii', 'E Coli', 'Pseudomonas', 'Aeroginosa', 'Klebsiella'];
    static protected $esbl = ['Tidak Terjadi Infeksi', 'E Coli', 'Klebsiella'];
    static protected $goldar = ['A', 'B', 'AB', 'O'];
    static protected $rhesus = ['+', '-'];
    static protected $hasil_cross = ['+', '-'];

    public function __construct()
    {
        $this->readController = new ReadController();
    }

    public function index(Request $request)
    {
        $date = $request->date;
        if(is_null($date)){
            $date = Carbon::now();
            $data['tanggal'] = $date->format('d-m-Y');
            $date_start = $date->copy()->startOfDay();
            $date_end = $date->copy()->endOfDay();
            //$transactions = $this->readController->getUnread($date_start,$date_end);
	$transactions = $this->readController->getUnread();
        } else {
            $date = Carbon::createFromFormat('d-m-Y', $date);
            $data['tanggal'] = $date->format('d-m-Y');
            $date_start = $date->copy()->startOfDay();
            $date_end = $date->copy()->endOfDay();

            $transactions = $this->readController->getUnread($date_start,$date_end);
        }

        $data['header'] = "transaksi";
        $data['transaksi'] = $transactions;
        $data['pemeriksaan'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getFromDepartemen(self::$departemen_slug);
        $data['link'] = self::$link;
        return view('labpk.transaksi.index',$data);
    }

	public function new()
	{
        $data['header'] = "transaksi";
        $data['kelas'] = Kelas::get();
        $data['lokasi'] = Lokasi::get();
        $data['departemen'] = self::$departemen_slug;
        $data['link'] = self::$link;
        $data['tipe'] = TarifTipe::get();
        $data['user'] = Auth::user();
        $data['dokter'] = \App\User::get();
        return view('labpk.transaksi.new', $data);
	}
	
    public function periksa($slug)
    {
        $data['header'] = "transaksi";
        $transaction_patient = $this->readController->getPatientService($slug);
        $this->checkToAbort($transaction_patient);
        if($transaction_patient->status)
            return redirect('labpk/transaksi/hasil/'.$slug);
        $data['key'] = Hash::make(Carbon::now()->toDateTimeString());
		$data['transaksi'] = $transaction_patient;
		$data['action'] = 'input';
        $data['link'] = self::$link;
        $data['karbapenemase'] = self::$karbapenemase;
        $data['esbl'] = self::$esbl;
        $data['has_transfusi'] = $transaction_patient->hasTarifKategori(config('const.tk_transfusi'));
        $data['departemen'] = self::$departemen_slug;
        $tarif = new Request();
        $tarif->kelas = $transaction_patient->class;
        $tarif->tipe = $transaction_patient->tarif_tipe_id;
        $tarif->departemen = self::$departemen_slug;
        $data['tarif'] = json_decode(app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getFromLab($tarif));
        //dd($data['tarif']);
        
        $form_created = $transaction_patient->created_at;
        $pasien_tgl_lahir = $transaction_patient->pasien->date_of_birth;
        $pasien_tgl_lahir = Carbon::parse($pasien_tgl_lahir);
        $data['usia_px'] = $form_created->diffInYears($pasien_tgl_lahir);

        $data['goldar'] = self::$goldar;
        $data['rhesus'] = self::$rhesus;
        $data['hasil_cross'] = self::$hasil_cross;

        $profesi_id = Profesi::where('slug',"dokter")->first()->id;
        $group_id = Grup::where('slug',"lab-pk")->first()->id;
        $group_member = UserGroup::where('group_id',$group_id)->pluck("users_id")->toArray();
        $data['list_user'] = User::whereIn('id', $group_member)->get();

        $data['is_dokter'] = $profesi_id;

        return view('labpk.transaksi.pemeriksaan',$data);
    }

    public function permintaan($slug)
    {
        $transaction_patient = $this->readController->getPatientService($slug);
        $this->checkToAbort($transaction_patient);
        if($transaction_patient->status)
            return redirect('labpk/transaksi/hasil/'.$slug);
        $data['header'] = "transaksi";
        $data['link'] = self::$link;
        $data['transaksi'] = $transaction_patient;
        $data['action'] = 'input';
        return view('labpk.transaksi.permintaan', $data);
    }

    public function editResult($slug)
    {
        try {
            $data['header'] = "transaksi";
            $transaction_patient = $this->readController->getPatientService($slug);
            $document = $this->readController->getDocument($transaction_patient->id);
            $data['photos'] = $document;
            $data['key'] = Hash::make(Carbon::now()->toDateTimeString());
            $data['transaksi'] = $transaction_patient;
            $data['action'] = 'input';
            $data['link'] = self::$link;
            $data['karbapenemase'] = self::$karbapenemase;
            $data['esbl'] = self::$esbl;
            $data['has_transfusi'] = $transaction_patient->hasTarifKategori(config('const.tk_transfusi'));
            $data['goldar'] = self::$goldar;
            $data['rhesus'] = self::$rhesus;
            $data['hasil_cross'] = self::$hasil_cross;


            $form_created = $transaction_patient->created_at;
            $pasien_tgl_lahir = $transaction_patient->pasien->date_of_birth;
            $pasien_tgl_lahir = Carbon::parse($pasien_tgl_lahir);
            $data['usia_px'] = $form_created->diffInYears($pasien_tgl_lahir);

            $profesi_id = Profesi::where('slug',"dokter")->first()->id;
            $group_id = Grup::where('slug',"lab-pk")->first()->id;
            $group_member = UserGroup::where('group_id',$group_id)->pluck("users_id")->toArray();
            $data['list_user'] = User::whereIn('id', $group_member)->get();

            $data['is_dokter'] = $profesi_id;


            return view('labpk.transaksi.edit', $data);
        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    public function hasil($slug)
    {
        $data['header'] = "transaksi";
        $transaction_patient = $this->readController->getPatientService($slug);
        $this->checkToAbort($transaction_patient);
        $document = $this->readController->getDocument($transaction_patient->id);
        $data['photos'] = $document;
        $data['key'] = Hash::make(Carbon::now()->toDateTimeString());
        $data['transaksi'] = $transaction_patient;
        $data['action'] = 'input';
        $data['link'] = self::$link;
        $data['is_dokter'] = Auth::user()->profesi == config('const.profesi_dokter');
        $data['has_transfusi'] = $transaction_patient->hasTarifKategori(config('const.tk_transfusi'));

        $form_created = $transaction_patient->created_at;
        $pasien_tgl_lahir = $transaction_patient->pasien->date_of_birth;
        $pasien_tgl_lahir = Carbon::parse($pasien_tgl_lahir);
        $data['usia_px'] = $form_created->diffInYears($pasien_tgl_lahir);

        return view('labpk.transaksi.hasil', $data);
    }

    public function histori(Request $req)
    {
        if($req->ajax()){
            $transactions = $this->readController->getHistori($req);
            return $transactions;
        }
        $data['pembayaran'] = PembayaranPerusahaanType::get();
        $data['header'] = "histori";
        $data['lokasi'] = Lokasi::get();
        $data['tipe'] = TarifTipe::get();
        $data['link'] = self::$link;
        $data['pemeriksaan'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getFromDepartemen(self::$departemen_slug);
        return view('labpk.transaksi.histori',$data);
    }

    public function verifikasi(Request $request)
    {
        $date = $request->date;
        if($request->all){
            $transactions = $this->readController->getUnread();
        } else {
            $date = is_null($date) ? Carbon::createFromFormat('d-m-Y', date('d-m-Y')) : Carbon::createFromFormat('d-m-Y', $date);
            $data['tanggal'] = is_null($date) ? null : $date->format('d-m-Y');
            $date_start = $date->copy()->startOfDay();
            $date_end = $date->copy()->endOfDay();

            $transactions = $this->readController->getUnverifiedTransaction($date_start,$date_end);
        }

        $data['transaksi'] = $transactions;
        $data['header'] = "verifikasi";
        $data['link'] = self::$link;
        return view('labpk.transaksi.verifikasi',$data);        
    }

    public function cetakPermintaan($slug, $param_download = [])
    {
        $dept = 'lab-pk';
        $data['all_transaksi'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getFromLabPrint($dept);
        $data['transaksi'] = $this->readController->getPatientService($slug);
        $tarif_selected = [];
        foreach($data['transaksi']->detail as $detail)
        {
            $tarif_selected[] = $detail->tarif_id;
        }
        $data['tarif_selected'] =$tarif_selected;
        $data['departemen'] = 'LABORATORIUM KLINIK';
        $data['spesimen_list'] = app('App\Http\Controllers\LabPK\MikrobiologiSpesimenKategori\ReadController')->get();


        $spesimen_selected = [];
        foreach($data['transaksi']->spesimen as $spesimen)
        {
            $spesimen_selected[] = $spesimen->spesimen_id;
        }
        $data['spesimen_selected'] =$spesimen_selected;

        if(is_null($data['transaksi']))   abort(404);       
        
        $pdf = DOMPDF::loadView('layouts.components2.lab.cetak.permintaan',$data);
        if (($param_download['is_download'] ?? null) != null) {
            $filename = $param_download['filename'] ?? 'Print_Permintaan_Lab_PK_.'.$data['transaksi']->id.'.pdf';
            if (file_exists($param_download['path'] . $filename)) 
                unlink($param_download['path'] . $filename);
            $pdf->save($param_download['path'] . $filename);
            return $filename;
        }
        return $pdf->stream('permintaan.pdf');
    }

    public function cetakBuktiLayanan($slug)
    {
        $data['transaksi'] = $this->readController->getBySlug($slug, ['detail_real', 'asal', 'kasus', 'kasus.diagnosisUtama.icd10', 'pasien']);
        if(is_null($data['transaksi']))   abort(404);       
        $data['departemen'] = self::$departemen;

        $customPaper = array(0,0,432,612);
        $pdf = DOMPDF::loadView('layouts.components2.lab.cetak.bukti-layanan',$data)->setPaper($customPaper);
        return $pdf->stream('bukti-layanan.pdf');
    }

    public function cetakKwitansi($slug)
    {
        $data['transaksi'] = $this->readController->getBySlug($slug, ['detail_real', 'asal']);
        if(is_null($data['transaksi']))   abort(404);       
        
        $customPaper = array(0,0,432,612);
        $data['terbilang'] = app('App\Http\Controllers\Functions\SpellMoney')
                            ->spellMoney($data['transaksi']->harga_total);
        $pdf = DOMPDF::loadView('layouts.components2.lab.cetak.kwitansi',$data)->setPaper($customPaper);
        return $pdf->stream('kwitansi.pdf');
    }

    public function cetakBuktiPenyerahanDarah($slug)
    {
        $data['transaksi'] = $this->readController->getBySlug($slug, ['detail_real', 'pasien', 'asal', 'hasil_transfusi']);
        $pdf = DOMPDF::loadView('layouts.components2.lab.cetak.print-bukti-penyerahan-darah',$data)->setPaper('a5', 'landscape');
        return $pdf->stream('permintaan.pdf');
    }
}
