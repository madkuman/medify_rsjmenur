<?php

namespace App\Http\Controllers\Radiology\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PembayaranPerusahaanType;
use App\Models\Hospital\Kelas;
use App\Models\Hospital\Lokasi;
use App\Models\Keuangan\TarifTipe;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Radiology\Transaction\ReadController;
use DOMPDF;
use Auth;

class ViewController extends Controller
{
    static protected $departemen_slug = 'radiologi';
    static protected $link = "radiologi";
    static protected $alasan_direject = ['Duplikasi Printing', 'Ukuran Salah', 'Salah/ Tanpa Identitas/ Marker', 'Densitas Tidak Sesuai'];
    static protected $ukuran_film = ['20x25cm', '28x35cm', '35x43cm', '35x35cm'];
    static protected $alasan_ulang = ['Terpotong Gambarnya', 'Kabur Gambarnya', 'Artefak', 'Salah Posisi'];

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
        $data['pemeriksaan'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getFromDepartemen(self::$departemen_slug);
        $data['link'] = self::$link;
        return view('radiolog.transaksi.index',$data);
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
        $data['poli'] = Lokasi::get();
        $data['kelas_default'] = config('const.iii_ac');
        return view('radiolog.transaksi.new', $data);
    }

    public function periksa($slug)
    {
        $data['header'] = "transaksi";
        $transaction_patient = $this->readController->getPatientService($slug);
        if(is_null($transaction_patient) || $transaction_patient->status == -1)   abort(404);

        if($transaction_patient->status)
            return redirect('radiologi/transaksi/hasil/'.$slug);
        $data['key'] = Hash::make(Carbon::now()->toDateTimeString());
        $data['transaksi'] = $transaction_patient;
        $data['layanan'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getTarifFilter(self::$departemen_slug, $data['transaksi']->kelas->id);
        $data['action'] = 'input';
        $data['departemen_id'] = self::$departemen_slug;
        $data['link'] = self::$link;
        $data['ukuran'] = self::$ukuran_film;
        $data['alasan_ulang'] = self::$alasan_ulang;
        $data['alasan_direject'] = self::$alasan_direject;
        $data['template'] = app('App\Http\Controllers\Radiology\Pengaturan\ReadController')->getAllTemplate();
        app('App\Http\Controllers\Radiology\Transaction\EditController')->startPemeriksaan($transaction_patient);
        return view('radiolog.transaksi.pemeriksaan',$data);
    }

    public function permintaan($slug)
    {
        $transaction_patient = $this->readController->getPatientService($slug);
        if(is_null($transaction_patient) || $transaction_patient->status == -1)   abort(404);
        if($transaction_patient->status)
            return redirect('radiologi/transaksi/hasil/'.$slug);
        $data['header'] = "transaksi";
        $data['link'] = self::$link;
        $data['transaksi'] = $transaction_patient;
        $data['action'] = 'input';
        return view('radiolog.transaksi.permintaan', $data);
    }
    
    public function editResult($slug)
    {
        $data['header'] = "transaksi";
        $transaction_patient = $this->readController->getPatientService($slug);
        if(is_null($transaction_patient) || $transaction_patient->status == -1)   abort(404);

        $data['key'] = Hash::make(Carbon::now()->toDateTimeString());
        $photos = $this->readController->getPhotos($transaction_patient->id);
        $data['transaksi'] = $transaction_patient;
        $data['layanan'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getTarifFilter(self::$departemen_slug, $data['transaksi']->kelas->id);
        $data['pasien'] = $transaction_patient;
        $data['photos'] = $photos;
        $data['departemen_id'] = self::$departemen_slug;
        $data['link'] = self::$link;
        $data['ukuran'] = self::$ukuran_film;
        $data['alasan_ulang'] = self::$alasan_ulang;
        $data['alasan_direject'] = self::$alasan_direject;
        $data['template'] = app('App\Http\Controllers\Radiology\Pengaturan\ReadController')->getAllTemplate();
        return view('radiolog.transaksi.edit', $data);
    }

    public function hasil($slug)
    {
        $data['header'] = "transaksi";
        $transaction_patient = $this->readController->getPatientService($slug);
        if(is_null($transaction_patient) || $transaction_patient->status == -1)   abort(404);

        $photos = $this->readController->getPhotosPenunjang($transaction_patient->id);
        $data['transaksi'] = $transaction_patient;
        $data['pasien'] = $transaction_patient;
        $data['photos'] = $photos;
        $data['link'] = self::$link;
        $data['is_dokter'] = Auth::user()->profesi == config('const.profesi_dokter');
        if(!is_null($transaction_patient->kasus))
        {
            $data['kasus'] = $transaction_patient->kasus;
            $data['nomor_kasus'] = $transaction_patient->kasus->nomor_kasus;
            $data['suggest_icd9'] = app('App\Http\Controllers\Kasus\Tindakan\ReadController')->fetchSuggestICD9();

        }
        return view('radiolog.transaksi.hasil', $data);
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
        return view('radiolog.transaksi.histori',$data);
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
        return view('radiolog.transaksi.verifikasi',$data);        
    }

    public function cetakPermintaan($slug)
    {
        $dept = 'radiologi';
        $data['all_transaksi'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getFromLabPrint($dept);
        $data['transaksi'] = $this->readController->getPatientService($slug);
        $data['departemen'] = 'Radiologi';
        if(is_null($data['transaksi']))   abort(404);    


        $tarif_selected = [];
        foreach($data['transaksi']->detail as $detail)
        {
            $tarif_selected[] = $detail->tarif_id;
        }
        $data['tarif_selected'] =$tarif_selected;   
        
        $pdf = DOMPDF::loadView('layouts.components2.lab.cetak.permintaan',$data);
        return $pdf->stream('permintaan.pdf');
    }

    public function cetakBuktiLayanan($slug)
    {
        $data['transaksi'] = $this->readController->getBySlug($slug, ['detail_real', 'asal', 'kasus', 'kasus.diagnosisUtama.icd10', 'pasien']);
        if(is_null($data['transaksi']))   abort(404);       
        
        // return view('radiolog.transaksi.cetak.bukti-layanan',$data);
        $customPaper = array(0,0,432,612);
        $pdf = DOMPDF::loadView('radiolog.transaksi.cetak.bukti-layanan',$data)->setPaper($customPaper);
        return $pdf->stream('bukti-layanan.pdf');
    }

    public function cetakKwitansi($slug)
    {
        $data['transaksi'] = $this->readController->getBySlug($slug, ['detail_real', 'asal']);
        if(is_null($data['transaksi']))   abort(404);       
        
        // return view('radiolog.transaksi.cetak.kwitansi',$data);
        $data['terbilang'] = app('App\Http\Controllers\Functions\SpellMoney')
                            ->spellMoney($data['transaksi']->harga_total);
        $pdf = DOMPDF::loadView('radiolog.transaksi.cetak.kwitansi',$data);
        return $pdf->stream('kwitansi.pdf');
    }
}