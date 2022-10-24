<?php

namespace App\Http\Controllers\Kasus\Urikkes\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Illuminate\Support\Facades\Auth;
use App\Models\Kasus\Identitas;
use App\Models\Kasus\Lain_Urikkes;
use App\Models\Kasus\EvaluasiKlinis;
use App\Models\Kasus\Mata;
use App\Models\Kasus\Telinga;
use App\Models\Kasus\Gigi;
use App\Models\Urikkes\LabPKForm;
use App\Models\Urikkes\DokterUrikkes;
use App\Models\Urikkes\Transaksi;
use App\Models\Pasien\Pasien;
use App\Http\Controllers\Functions\DateFormatter;
use DB;
use Carbon\Carbon;
use Bugsnag;
use DOMPDF;

class EditController extends Controller
{
    public function index(Request $request, $nomor_kasus){
      //dd($request->all());
      ini_set('max_execution_time', 300);
      $kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
      $data['identitas'] = Identitas::where('kasus_id', $kasus->id)->first();
      $data['pasien'] = Pasien::find($kasus->pasien_id);
      $data['resume'] = Lain_Urikkes::where('nomor_kasus',$nomor_kasus)->orderBy('updated_at','desc')->first();
      $data['klinis'] = EvaluasiKlinis::where('nomor_kasus',$nomor_kasus)->orderBy('updated_at','desc')->first();
      $data['telinga'] = Telinga::where('nomor_kasus',$nomor_kasus)->orderBy('updated_at','desc')->first();
      $data['mata'] = Mata::where('nomor_kasus',$nomor_kasus)->orderBy('updated_at','desc')->first();
      $data['gigi'] = Gigi::where('nomor_kasus',$nomor_kasus)->orderBy('updated_at','desc')->first();

      $transaksi = Transaksi::where('kasus_id',$kasus->id)->first();
      $transaksi->waktu_pemeriksaan = Carbon::createFromFormat('d-m-Y', $request->waktu_pemeriksaan);
      $transaksi->save();
      $waktu_print = Carbon::createFromFormat('d-m-Y', $request->waktu_print);

      $date = new DateFormatter;
      $data['waktu_pemeriksaan'] = $date->timestampFormat($transaksi->waktu_pemeriksaan, '%d %B %Y');
      $data['waktu_print'] = $date->timestampFormat($waktu_print, '%d %B %Y');
      $data['tgl_periksa'] = $date->timestampFormat($kasus->created_at, '%d %B %Y');
      $data['tgl_lahir'] = $date->dateFormat($data['identitas']->tanggal_lahir, '%d %B %Y');
      $data['tgl_lahir_short'] = $date->dateFormat($data['identitas']->tanggal_lahir, '%d-%m-%Y');
      $data['sekarang'] = Carbon::now()->formatLocalized('%d %B %Y');
      $data['ket_dokter'] = $request->ket_dokter;
      $data['masa_kerja'] = $request->masa_kerja;
      $data['dokter'] = DokterUrikkes::where('id',$request->dokter)->first();
      $data['dokter2'] = DokterUrikkes::where('id',$request->dokter2)->first();
      $data['darah'] = app('App\Http\Controllers\Kasus\PemeriksaanLab\ReadController')->getLast($kasus->id);
      $data['urine'] = app('App\Http\Controllers\Kasus\PemeriksaanLab\ReadController')->getLastUrine($kasus->id);
      $data['imun'] = app('App\Http\Controllers\Kasus\PemeriksaanLab\ReadController')->getLastImun($kasus->id);
      $data['smear'] = app('App\Http\Controllers\Kasus\PemeriksaanLab\ReadController')->getLastSmear($kasus->id);
      $data['feces'] = app('App\Http\Controllers\Kasus\PemeriksaanLab\ReadController')->getLastFeces($kasus->id);
      //dd($data['pasien']);

      $data['print_all'] = $request->laporan_all;
      $data['print_fisik'] = $request->laporan_fisik;
      $data['print_mata'] = $request->laporan_mata;
      $data['print_telinga'] = $request->laporan_telinga;
      $data['print_gigi'] = $request->laporan_gigi;
      $data['narkoba'][0] = $request->narkoba_morhpin;
      $data['narkoba'][1]  = $request->narkoba_metamphetamine;
      $data['narkoba'][2]  = $request->narkoba_amphetamine;
      $data['narkoba'][3]  = $request->narkoba_diazepam;
      $data['narkoba'][4]  = $request->narkoba_ganja;
      $data['narkoba_show'][0] = 0;
      $data['narkoba_show'][1]  = 0;
      $data['narkoba_show'][2]  = 0;
      $data['narkoba_show'][3]  = 0;
      $data['narkoba_show'][4]  = 0;

      $count_narkoba = 0;
      foreach($data['narkoba'] as $item)
      {
        if($item == 1) $count_narkoba++;
      }
      if($count_narkoba > 4) $count_narkoba = 4;
      $data['count_narkoba'] = $count_narkoba;


      $data['imun_custom'][0] = $request->imun_hbsag;
      $data['imun_custom'][1]  = $request->imun_antihiv;
      $data['imun_custom'][2]  = $request->imun_antihcv;
      $data['imun_custom'][3]  = $request->imun_ictmalaria;
      $data['imun_custom'][4]  = $request->imun_vdrl;
      $data['imun_custom'][5]  = $request->imun_coomb;
      $data['imun_custom'][6]  = $request->imun_hbeag;
      $data['imun_show'][0] = 0;
      $data['imun_show'][1]  = 0;
      $data['imun_show'][2]  = 0;
      $data['imun_show'][3]  = 0;
      $data['imun_show'][4]  = 0;
      $data['imun_show'][5]  = 0;
      $data['imun_show'][6]  = 0;

      $count_imun = 0;
      foreach($data['imun_custom'] as $item)
      {
        if($item == 1) $count_imun++;
      }
      if($count_imun > 4) $count_imun = 4;
      $data['count_imun'] = $count_imun;

      $data['laborat'] = $request->laborat;
      $data['saran'] = $request->saran;
      $data['kesimpulan'] = $request->kesimpulan;
      $data['tanggal_hari_ini'] = $date->timestampFormat(Carbon::now(), '%d %B %Y');
      $data['jari_jari'] = $request->jari_jari;

      $data['nama_ttd'] = $request->nama_ttd;
      $data['sipds_ttd'] = $request->sipds_ttd;
      $data['jabatan_ttd'] = $request->jabatan_ttd;
      $data['instansi_ttd'] = $request->instansi_ttd;
      $data['keterangan_ttd'] = $request->keterangan_ttd;
      $data['nama_peminta'] = $request->nama_peminta;
      $data['sipds_peminta'] = $request->sipds_peminta;
      $data['jabatan_peminta'] = $request->jabatan_peminta;
      $data['instansi_peminta'] = $request->instansi_peminta;
      $data['perihal'] = $request->perihal;

      $data['nomor_surat'] = $request->nomor_surat;
      $data['bulan_romawi'] = (new DateFormatter)->numberToRoman(date("m", strtotime($request->tanggal_surat)));
      if(!empty($request->tanggal_surat))
      {
        $data['tanggal_surat'] = Carbon::createFromFormat('d-m-Y', $request->tanggal_surat);
        $data['tanggal_surat_format_ind'] = (new DateFormatter)->dateFormat($data['tanggal_surat']->format('Y-m-d'),'%d %B %Y');
      }


      if(!empty($request->tanggal_pemeriksaan))
      {
        $data['tanggal_pemeriksaan'] = Carbon::createFromFormat('d-m-Y', $request->tanggal_pemeriksaan);
        $data['tanggal_pemeriksaan_format_ind'] = (new DateFormatter)->dateFormat($data['tanggal_pemeriksaan']->format('Y-m-d'),'%d %B %Y');
      }

      $data['tgl_fisik'] = $date->timestampFormat(Carbon::parse($request->tgl_fisik), '%d %B %Y');
      $data['tgl_psikiatrik'] = $date->timestampFormat(Carbon::parse($request->tgl_psikiatrik), '%d %B %Y');
      $data['tgl_tambahan'] = $date->timestampFormat(Carbon::parse($request->tgl_tambahan), '%d %B %Y');

      $data['jam_fisik'] = $request->jam_fisik;
      $data['jam_psikiatrik'] = $request->jam_psikiatrik;
      $data['jam_tambahan'] = $request->jam_tambahan;

      $data['keperluan'] = $request->keperluan;
      //dd($data['nama_ttd']);
      //id sidebar form pemeriksaan lab == 1
      $form = app('App\Http\Controllers\Kasus\FormHasil\ReadController')->all($nomor_kasus);
      //$lab = app('App\Http\Controllers\Kasus\FormLabPKHasil\ReadController')->all($nomor_kasus);


      /*foreach ($lab as $key => $value) {
          $data['input_lab'.$value->id] = $value->all_input;
      }*/

      foreach ($form as $key => $value) {
          $data['input_form'.$value->id] = $value->input;
      }
      //dd($request->jenis_pasien);
      //return view('kasus.urikkes.content.laporan.pdf.dinas2', $data);
      if($request->jenis_pasien == 'umum1'){
        $pdf = DOMPDF::loadView('kasus.urikkes.content.laporan.pdf.umum1',$data)->setPaper('legal','landscape');
        $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        $filename = $kasus->judul_kasus.'-umum1.pdf';
        return $pdf->stream($filename); 

      }elseif($request->jenis_pasien == 'umum2'){
        $pdf = DOMPDF::loadView('kasus.urikkes.content.laporan.pdf.umum2',$data)->setPaper('legal','landscape');
        $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        $filename = $kasus->judul_kasus.'-umum2.pdf';
        return $pdf->stream($filename);

      }elseif ($request->jenis_pasien == 'dinas1') {
        $pdf = DOMPDF::loadView('kasus.urikkes.content.laporan.pdf.dinas1',$data)->setPaper('legal', 'potrait');
        $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        $filename = $kasus->judul_kasus.'-dinas1.pdf';
        return $pdf->stream($filename); 

      }elseif ($request->jenis_pasien == 'dinas2') {
        $pdf = DOMPDF::loadView('kasus.urikkes.content.laporan.pdf.dinas2',$data)->setPaper('legal', 'potrait');
        $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        $filename = $kasus->judul_kasus.'-dinas2.pdf';
        return $pdf->stream($filename);

      }elseif ($request->jenis_pasien == 'rsal') {
        $pdf = DOMPDF::loadView('kasus.urikkes.content.laporan.pdf.rsal',$data)->setPaper('legal', 'potrait');
        $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        $filename = $kasus->judul_kasus.'-resume.pdf';
        return $pdf->stream($filename); 

      }elseif ($request->jenis_pasien == 'fisik') {
        $pdf = DOMPDF::loadView('kasus.urikkes.content.laporan.pdf.fisik',$data)->setPaper('legal', 'potrait');
        $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        $filename = $kasus->judul_kasus.'-resume.pdf';
        return $pdf->stream($filename); 

      }elseif ($request->jenis_pasien == 'napza') {
        $pdf = DOMPDF::loadView('kasus.urikkes.content.laporan.pdf.napza',$data)->setPaper('legal', 'potrait');
        $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        $filename = $kasus->judul_kasus.'-resume.pdf';
        return $pdf->stream($filename); 

      }elseif($request->jenis_pasien == 'sk_keswa'){
        $pdf = DOMPDF::loadView('kasus.urikkes.content.laporan.pdf.sk_keswa', $data)->setPaper('legal', 'potrait');
        $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        $filename = 'Surat Keterangan Keswa.pdf';
        return $pdf->stream($filename);
        
      }elseif($request->jenis_pasien == 'sk_dokter1' || $request->jenis_pasien == 'sk_dokter2'){
        $pdf = DOMPDF::loadView('kasus.urikkes.content.laporan.pdf.sk_dokter', $data)->setPaper('legal', 'potrait');
        $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        $filename = 'Surat Keterangan Dokter.pdf';
        return $pdf->stream($filename); 
      
      }
    }
}
