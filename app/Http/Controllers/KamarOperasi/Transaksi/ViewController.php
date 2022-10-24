<?php

namespace App\Http\Controllers\KamarOperasi\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Transaksi;
use App\Models\Gudang\ItemsTemplate;
use App\Models\KamarOperasi\Rencana;
use App\Models\KamarOperasi\Pengembalian;
use App\Models\KamarOperasi\Pemakaian;
use App\Models\KamarOperasi\RencanaAlat;
use App\Models\KamarOperasi\PengembalianObat;
use App\Models\KamarOperasi\PengembalianAlat;
use App\Models\KamarOperasi\Tim;
use App\Models\KamarOperasi\Pasca;
use App\Models\KamarOperasi\JenisOperasi;
use App\Models\KamarOperasi\JenisSpesialisOperasi;
use App\Models\KamarOperasi\PeranTim;
use App\Models\Kasus\BPJSSEP;
use App\Models\Keuangan\TarifTipe;
use Carbon\Carbon;
use App\Models\Farmasi\Farmasi;
use Mpdf\Mpdf;
use App\User;
use View;
use DOMPDF;

define('relasi', ['pasien_detail','ruangan','dokter','hasil','tim', 'child', 'parent', 'parent.pasien_detail','parent.ruangan','parent.dokter','parent.hasil', 'kasus.pasien', 'kasus.identitas', 'kasus.lokasi.lokasi', 'kasus.pembayaran.perusahaan', 'kasus.pembayaran.perusahaan.tipe', 'kasus.diagnosisUtama.icd10', 'jenis_spesialis', 'pembuat_jadwal']);

class ViewController extends Controller
{
    public function pemesanan()
    {
    	$transaksi = Transaksi::with(relasi)->whereNull('parent_id')->where([['status',0],['ruangan_id',NULL]])->orderBy('created_at','desc')->get();
    	$data['transaksi'] = $transaksi;
        // dd($transaksi);
        $data['routeFlag'] = 1;
        
        $data['spesialis_operasi'] = JenisSpesialisOperasi::all();
        return view('kamaroperasi.transaksi.permintaan',$data);
    }

    public function tambahPermintaan()
    {
      $data['permintaan'] = null;
      $data['spesialis_operasi'] = JenisSpesialisOperasi::all();
      return view('kamaroperasi.transaksi.pendaftaran.base', $data);
    }

    public function printHasil($id)
    {
        $data['transaksi'] = Transaksi::with(relasi)->find($id);
        $grouped = [];
        $peran = PeranTim::all();
        foreach($peran as $item)
        {
            $item->members = Tim::with('detail')->where('operasi_id', $id)->where('role_id',$item->id)->get();
        }
        $data['peran'] = $peran;

        return view('kamaroperasi.pelaksanaan.pasca.print',$data);

        /*$view = View::make('kamaroperasi.pelaksanaan.pasca.print',$data);

        $mpdf = new Mpdf;
        $mpdf->WriteHTML($view);
        return $mpdf->Output();*/
    }

    public function index()
    {
        $data['asuransi'] = app('App\Http\Controllers\KamarOperasi\Transaksi\ReadController')->getAsuransi();
        $data['perusahaan_kerjasama'] = app('App\Http\Controllers\KamarOperasi\Transaksi\ReadController')->getPerusahaan();
        $data['routeFlag'] = 1;
        return view('kamaroperasi.transaksi.index',$data);
    }

    public function pendaftaran($id = NULL)
    {
      $data['ruangans'] = app('App\Http\Controllers\KamarOperasi\Ruangan\ReadController')->getAll();
      if ($id) {
        $data['permintaan'] = Transaksi::with('pasien_detail', 'dokter', 'ruangan')->findOrFail($id);
      }
      else
        $data['permintaan'] = NULL;

        $data['is_pendaftaran'] = 1;

      $data['spesialis_operasi'] = JenisSpesialisOperasi::all();
      return view('kamaroperasi.transaksi.pendaftaran.daftarkan', $data);
    }

    public function tanggal()
    {
        $data['routeFlag'] = 1;
        return view('kamaroperasi.transaksi.tanggal',$data);
    }

    public function pelaksanaan($id)
    {

        $data['transaksi'] = Transaksi::with(relasi)->find($id);
        if(is_null($data['transaksi']))
            abort(404);
        $data['rencana'] = Rencana::where('operasi_id',$id)->get();
        $data['pengembalian'] = Pengembalian::where('operasi_id',$id)->get();
        $data['pemakaian'] = Pemakaian::where('operasi_id',$id)->get();
        $data['alkes'] = $data['rencana']->filter(function($val, $key){ return $val->jenis == "alkes"; });   
        $data['matkes'] = $data['rencana']->filter(function($val, $key){ return $val->jenis == "matkes"; });   
        $data['obat'] = $data['rencana']->filter(function($val, $key){ return $val->jenis == "obat"; });
        $data['implan'] = $data['rencana']->filter(function($val, $key){ return $val->jenis == "implan"; });   
        // dd($data['transaksi']);       

        $data['jenis_operasi'] = JenisOperasi::all();
        $data['peran_tim'] = PeranTim::all();
        $data['users'] = User::all();

        if ($data['transaksi']->kasus_id || $data['transaksi']->parent->kasus_id)
        {
            if(!isset($data['transaksi']->parent_id)){
          		$data['sep_list'] = BPJSSEP::where('kasus_id', $data['transaksi']->kasus_id)->orderBy('id','desc')->get();
                $data['tagihan'] = app('App\Http\Controllers\Kasus\Tagihan\ReadController')->getOKTagihan($data['transaksi']->id);
            }else{
                $data['sep_list'] = BPJSSEP::where('kasus_id', $data['transaksi']->parent->kasus_id)->orderBy('id','desc')->get();
                $data['tagihan'] = app('App\Http\Controllers\Kasus\Tagihan\ReadController')->getOKTagihan($data['transaksi']->id);
            }
        }
        // //dd($data['user']);
        $data['tims'] = Tim::with('detail','role')->where('operasi_id',$id)->get();
        // $data['ruang']= app('App\Http\Controllers\KamarOperasi\Transaksi\ReadController')->listKamar();
        $data['dokters']= app('App\Http\Controllers\KamarOperasi\Transaksi\ReadController')->listDokter();
        //dd(json_encode($data['tim']));
        $data['tarif_tipe'] = TarifTipe::all();
        $data['suggest_diagnosis'] = app('App\Http\Controllers\Kasus\Diagnosis\ReadController')->fetchSuggestDiagnosis();
        $data['farmasi'] = Farmasi::whereIn('jenis',[1,2])->get();
        return view('kamaroperasi.pelaksanaan.home',$data);
    }

    public function jadwalRekap()
    {
        $data['navbar_active'] = 'jadwal_rekap';
        return view('kamaroperasi.jadwal.rekap',$data);
    }

    public function download(Request $request)
    {   
        //dd($request);
        $data['jadwal'] = app('App\Http\Controllers\KamarOperasi\Transaksi\ReadController')->printJadwal($request);
        //dd(json_decode($data));
        //$data['jadwal'] = json_decode($data['jadwal']);
        $data['dokter'] = $request->get('dokter_id');
        $data['dokter_obj'] = User::find($request->get('dokter_id'));
        $data['jenis_spesialis'] = $request->get('jenis_spesialis');
        $data['jenis_spesialis_obj'] = JenisSpesialisOperasi::find($request->get('jenis_spesialis'));
        $data['search_box'] = $request->get('search_box');
        $data['tanggal_min'] = $request->get('tanggal_min');
        $data['tanggal_max'] = $request->get('tanggal_max');
        $data['kamar_operasi'] = $request->get('ruangan_id');
        
        //dd($data);
        $pdf = DOMPDF::loadView('kamaroperasi.ruangan.download',$data)->setPaper('a4', 'landscape');
        $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        $filename = 'Tabel Permintaan Operasi.pdf';
        return $pdf->stream($filename);
    }
}
