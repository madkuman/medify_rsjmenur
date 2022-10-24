<?php

namespace App\Http\Controllers\LabPA\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PembayaranPerusahaanType;
use App\Models\Hospital\Kelas;
use App\Models\Hospital\Lokasi;
use App\Models\Keuangan\TarifTipe;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\LabPA\Transaction\ReadController;
use Auth;
use DOMPDF;

class ViewController extends Controller
{
    static protected $departemen_slug = 'lab-pa';
    static protected $link = "labpa";
    static protected $departemen = "Patologi Anatomi";

    public function __construct()
    {
        $this->readController = new ReadController();
    }

    public function index(Request $request)
    {
        $date = $request->date;
        if(is_null($date)){
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
        $data['link'] = self::$link;
        return view('labpa.transaksi.index',$data);
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
        $data['kelas_default'] = config('const.iii_ac');
        return view('labpa.transaksi.new', $data);
	}
	
    public function periksa($slug)
    {
        $data['header'] = "transaksi";
        $transaction_patient = $this->readController->getPatientService($slug);
        if(is_null($transaction_patient) || $transaction_patient->status == -1)   abort(404);
        if($transaction_patient->status)
            return redirect('labpa/transaksi/hasil/'.$slug);
        $data['key'] = Hash::make(Carbon::now()->toDateTimeString());
        $data['departemen_id'] = self::$departemen_slug;
		$data['transaksi'] = $transaction_patient;
        $data['layanan'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getTarifFilter(self::$departemen_slug, $data['transaksi']->kelas->id);
        $data['action'] = 'input';
        $data['departemen_id'] = self::$departemen_slug;
        $data['link'] = self::$link;
        app('App\Http\Controllers\LabPA\Transaction\EditController')->startPemeriksaan($transaction_patient);
        return view('labpa.transaksi.pemeriksaan',$data);
    }

    public function permintaan($slug)
    {
        $transaction_patient = $this->readController->getPatientService($slug);
        if(is_null($transaction_patient) || $transaction_patient->status == -1)   abort(404);
        if($transaction_patient->status)
            return redirect('labpa/transaksi/hasil/'.$slug);
        $data['header'] = "transaksi";
        $data['link'] = self::$link;
        $data['transaksi'] = $transaction_patient;
        $data['action'] = 'input';
        return view('labpa.transaksi.permintaan', $data);
    }
    
    public function editResult($slug)
    {
        $data['header'] = "transaksi";
        $transaction_patient = $this->readController->getPatientService($slug);
        if(is_null($transaction_patient) || $transaction_patient->status == -1)   abort(404);

        $data['key'] = Hash::make(Carbon::now()->toDateTimeString());
        $photos = $this->readController->getPhotos($transaction_patient->id);
        $data['result'] = $this->readController->getFormResult($transaction_patient->id);
        $data['transaksi'] = $transaction_patient;
        $data['layanan'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getTarifFilter(self::$departemen_slug, $data['transaksi']->kelas->id);
        $data['pasien'] = $transaction_patient;
        $data['photos'] = $photos;
        $data['departemen_id'] = self::$departemen_slug;
        $data['link'] = self::$link;
        return view('labpa.transaksi.edit', $data);
    }

    public function hasil($slug)
    {
        $transaction_patient = $this->readController->getPatientService($slug);
        if(is_null($transaction_patient) || $transaction_patient->status == -1)   abort(404);

        $photos = $this->readController->getPhotos($transaction_patient->id);
        $result = $this->readController->getFormResult($transaction_patient->id);
        $data = $this->transformResult($result);
        foreach($data as $key => $value){
            $data[$key] = $value;
        }
        $data['header'] = "transaksi";
        $data['result'] = $result;
        $data['transaksi'] = $transaction_patient;
        $data['pasien'] = $transaction_patient;
        $data['photos'] = $photos;
        $data['link'] = self::$link;
        $data['is_dokter'] = Auth::user()->profesi == config('const.profesi_dokter');
        return view('labpa.transaksi.hasil', $data);
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
        return view('labpa.transaksi.histori',$data);
    }

    private function transformResult($data)
    {
    $formClass = isset($data->sitologi_class) && ($data->sitologi_class != "null") ? json_decode($data->sitologi_class) : [];
    $formInfection = isset($data->sitologi_infection) && ($data->sitologi_infection != "null") ? json_decode($data->sitologi_infection) : [];
    $formSpecimen = isset($data->sitologi_specimen) && ($data->sitologi_specimen != "null") ? json_decode($data->sitologi_specimen) : [];
    $formReactive = isset($data->sitologi_reactive) && ($data->sitologi_reactive != "null") ? json_decode($data->sitologi_reactive) : [];
    $formGeneral = isset($data->sitologi_general) && ($data->sitologi_general != "null") ? json_decode($data->sitologi_general) : [];
        return [
            'formClass' => $formClass,
            'formInfection' => $formInfection,
            'formSpecimen' => $formSpecimen,
            'formReactive' => $formReactive,
            'formGeneral' => $formGeneral
        ];
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
        return view('labpa.transaksi.verifikasi',$data);        
    }

    public function cetakPermintaan($kelas_id, $slug)
    {
        $dept = 'lab-pa';
        $data['all_transaksi'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getFromLabPrint($dept,$kelas_id);
        $data['transaksi'] = $this->readController->getPatientService($slug);
        $data['departemen'] = self::$departemen;
        if(is_null($data['transaksi']))   abort(404);       
        
        $pdf = DOMPDF::loadView('layouts.components2.lab.cetak.permintaan',$data);
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
}