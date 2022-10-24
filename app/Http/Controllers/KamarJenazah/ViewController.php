<?php

namespace App\Http\Controllers\KamarJenazah;

use Illuminate\Http\Request;
use MPDF;
use App\Http\Controllers\Controller;
use App\Models\KamarJenazah\Tarif;
use App\Models\KamarJenazah\Transaksi;
use App\Models\KamarJenazah\Permintaan;

class ViewController extends Controller
{
    //
    public function index(){
      $data['totalPermintaan'] = app('App\Http\Controllers\KamarJenazah\ReadController')->getTotalPermintaan();
      $data['permintaanBaruCount'] = app('App\Http\Controllers\KamarJenazah\ReadController')->getTotalPermintaanToday();
      $data['totalTransaksi'] = app('App\Http\Controllers\KamarJenazah\ReadController')->getTotalTransaksi();
      $data['sidebar_active'] = "dashboard";
      return view('kamarjenazah.index',$data);
    }

    public function permintaan(){
      $data['flag'] = 0;
      $data['sidebar_active'] = "dashboard";
      return view('kamarjenazah.jemput',$data);
    }

    public function layanan(){
      $data['sidebar_active'] = "layanan";
      return view('kamarjenazah.layanan',$data);
    }

    public function buatlayanan(){
      $data['sidebar_active'] = "layanan";
      return view('kamarjenazah.layananbaru',$data);
    }

    public function editlayanan(){
      $data['sidebar_active'] = "layanan";
      $data['form']['layanan'] = Tarif::all();
      return view('kamarjenazah.layananedit',$data);
    }

    public function deletelayanan(){
      $data['sidebar_active'] = "layanan";
      $data['form']['layanan'] = Tarif::all();
      return view('kamarjenazah.layanandelete',$data);
    }

    public function transaksi($id_permintaan){
      // dd($id_permintaan);
      $data['sidebar_active'] = "transaksi";
      $permintaan = Permintaan::find($id_permintaan);
      $data['pasien'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($permintaan->pasien_id);
      $data['form']['layanan'] = Tarif::all();
      $data['permintaan'] = $id_permintaan;
      // dd($data);
      return view('kamarjenazah.transaksi',$data);
    }

    public function editTransaksi($transaksi_id){
      $transaksi = Transaksi::find($transaksi_id);
      $permintaan = Permintaan::find($transaksi->permintaan_id);
      $data['sidebar_active'] = "transaksi";
      $data['pasien'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($permintaan->pasien_id);
      $data['form']['layanan'] = Tarif::all();
      $data['transaksi'] = $transaksi_id;
      return view('kamarjenazah.transaksiedit',$data);
    }

    public function historyTransaksi(){
      $data['sidebar_active'] = "transaksi";
      $data['transaksi'] = Transaksi::with('permintaan')->get();
      $data['form']['layanan'] = Tarif::all();
      return view('kamarjenazah.transaksihistory',$data);
    }

    public function permintaanJemput(Request $request,$id){
      $data = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($id);
      $data['kasus_id'] = $request->get('kasus_id');
      $data['flag'] = 1;
      $data['sidebar_active'] = "dashboard";
      // dd($data);
      return view('kamarjenazah.jemput',$data);
    }

    public function detilPermintaan($id_permintaan){
      setlocale(LC_TIME, 'Indonesian');
      $permintaan = Permintaan::find($id_permintaan);
      $data['sidebar_active'] = "dashboard";
      $data['pasien'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($permintaan->pasien_id);
      $data['jenazah'] = app('App\Http\Controllers\KamarJenazah\ReadController')->detilPermintaan($permintaan->pasien_id, $id_permintaan);
      $data['jenazah']['permintaan'][0]['waktu_meninggal'] = \Carbon\Carbon::parse($data['jenazah']['permintaan'][0]['waktu_meninggal'])->formatLocalized('%A , %d %B %Y pukul %I:%M');
      $data['jenazah']['permintaan'][0]['waktu_jemput'] = \Carbon\Carbon::parse($data['jenazah']['permintaan'][0]['waktu_jemput'])->formatLocalized('%A , %d %B %Y pukul %I:%M');
      // dd($data);
      return view('kamarjenazah.detailpermintaan',$data);
    }

    public function detilTransaksi($transaksi_id){
      $transaksi = Transaksi::find($transaksi_id);
      $permintaan = Permintaan::find($transaksi->permintaan_id);
      $data['sidebar_active'] = "transaksi";
      $data['pasien'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($permintaan->pasien_id);
      $data['jenazah'] = app('App\Http\Controllers\KamarJenazah\ReadController')->detilPermintaan($permintaan->pasien_id, $permintaan->id);
      $data['invoice'] = app('App\Http\Controllers\KamarJenazah\ReadController')->getInvoice($permintaan->pasien_id, $permintaan->id);
      // dd($data);
      return view('kamarjenazah.detiltransaksi',$data);
    }

    // public function sertifikat($id_permintaan){
    //   $permintaan = Permintaan::find($id_permintaan);
    //   $data['pasien'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($permintaan->pasien_id);
    //   $data['jenazah'] = app('App\Http\Controllers\KamarJenazah\ReadController')->detilPermintaan($permintaan->pasien_id, $permintaan->id);
    //   return view('kamarjenazah.print.kopisertif',$data);
    // }

    public function sertifikat($id_permintaan){
      setlocale(LC_TIME, 'Indonesian');
      $permintaan = Permintaan::find($id_permintaan);
      $data['pasien'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($permintaan->pasien_id);
      $data['jenazah'] = app('App\Http\Controllers\KamarJenazah\ReadController')->detilPermintaan($permintaan->pasien_id, $permintaan->id);
      if ( NULL !== (Transaksi::where('permintaan_id',$id_permintaan)->first())) {
        $data['invoice'] = app('App\Http\Controllers\KamarJenazah\ReadController')->getInvoice($permintaan->pasien_id, $permintaan->id);
      }

      $data['jenazah']['permintaan'][0]['waktu_meninggal'] = \Carbon\Carbon::parse($data['jenazah']['permintaan'][0]['waktu_meninggal'])->formatLocalized('%d %B %Y pukul %I:%M');
      // dd($data['jenazah']['permintaan'][0]['created_at']->formatLocalized('%d %B %Y pukul %I:%M'));
      $data['created_at'] = $data['jenazah']['permintaan'][0]['created_at']->formatLocalized('%d %B %Y pukul %I:%M');
      $data['jenazah']['dikubur'][0]['dikubur'] = \Carbon\Carbon::parse($data['jenazah']['dikubur'][0]['dikubur'])->formatLocalized('%d %B %Y pukul %I:%M');
      // dd($data['jenazah']);
      $filename = $permintaan->pasien_id.'-sertifikat.pdf';
      $pdf = MPDF::loadView('kamarjenazah.print.sertifikat', $data, [], [
            'mode' => 'utf-8',
            'format' => 'A4'
        ]);
      return $pdf->stream($filename);
    }

    public function invoice($id_permintaan){
      $permintaan = Permintaan::find($id_permintaan);
      $data['pasien'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($permintaan->pasien_id);
      $data['jenazah'] = app('App\Http\Controllers\KamarJenazah\ReadController')->detilPermintaan($permintaan->pasien_id, $permintaan->id);
      $data['invoice'] = app('App\Http\Controllers\KamarJenazah\ReadController')->getInvoice($permintaan->pasien_id, $permintaan->id);
      $filename = $permintaan->pasien_id.'-invoice.pdf';
      $pdf = MPDF::loadView('kamarjenazah.print.invoice', $data, [], [
            'mode' => 'utf-8',
            'format' => 'A4'
        ]);
      return $pdf->stream($filename);
    }
}
