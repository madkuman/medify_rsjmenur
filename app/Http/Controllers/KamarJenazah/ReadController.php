<?php

namespace App\Http\Controllers\KamarJenazah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Pasien\Pasien;
use App\Models\KamarJenazah\Tarif;
use App\Models\KamarJenazah\Transaksi;
use App\Models\KamarJenazah\Diagnosis;
use App\Models\KamarJenazah\Permintaan;
use App\Models\KamarJenazah\Sebab_kematian;
use App\Models\KamarJenazah\Transaksi_tarif;
use App\Models\KamarJenazah\Tempat_meninggal;
use App\Models\KamarJenazah\Diagnosis_permintaan;

class ReadController extends Controller
{
    //

    public function getLayanan(Request $request){
      $search = $request->get('keyword');
      if(!empty($search))
        $tarif = Tarif::where('nama_layanan','like','%'.$search.'%')->orderBy('nama_layanan','asc')->paginate(10);
      else
        $tarif = Tarif::Paginate(10);
      return $tarif;
    }

    public function gethistoryTransaksi(Request $request){
      setlocale(LC_TIME, 'Indonesian');
      $histori = Transaksi::with('permintaan')->Paginate(10);

      foreach ($histori as $key) {
        $permintaan_id = Permintaan::where('pasien_id', $key->permintaan->pasien_id)->first()->id;
        $waktu_pembuatan = Transaksi::where('permintaan_id', $permintaan_id)->first()->created_at;
        $key->nama = Pasien::where('id',$key->permintaan->pasien_id)->first()->name;
        $key->waktu_kematian = \Carbon\Carbon::parse($key->permintaan->waktu_meninggal)->formatLocalized('%A %d %B %Y , %I:%M:%S');
        $key->waktu_pembuatan = \Carbon\Carbon::parse($waktu_pembuatan)->formatLocalized('%A %d %B %Y , %I:%M:%S');
        $key->total_invoice = Transaksi::where('permintaan_id', $permintaan_id)->first()->total_transaksi;
        $key->pasien_id = Permintaan::where('id', $permintaan_id)->first()->pasien_id;
      }
      return $histori;
    }

    public function getPermintaan(Request $request){
      $search = $request->get('keyword');
      if(!empty($search)){
        // $permintaan = Permintaan::search($search)->paginate(5);
        $katakunci = '%'.$search.'%';
        $permintaan = Permintaan::with('patient')->with(['patient' => function($q)use($katakunci){
          $q->where('name','like',$katakunci)->get();
        }])->get();

      }else
        $permintaan = Permintaan::with('patient')->with('lokasi')->where('status','=',1)->Paginate(10);

      foreach ($permintaan as $item) {
        if(!empty($search)){
        $item->nama = $item->patient['name'];
        }
        else{
        setlocale(LC_TIME, 'Indonesian');
        $item->waktu_meninggal = \Carbon\Carbon::parse($item->waktu_meninggal)->formatLocalized('%d %B %Y , %I:%M');
        $item->waktu_jemput = \Carbon\Carbon::parse($item->waktu_jemput)->formatLocalized('%d %B %Y , %I:%M');
        $item->nama = $item->patient->name;
        $item->tempat_meninggal = $item->lokasi->nama_tempat;
        }
      }

      // dd($permintaan);
      return $permintaan;
    }

    public function getTotalPermintaan()
    {
        $today = Carbon::today();
        $data[0] = Permintaan::count();
        $data[1] = Permintaan::whereDate('created_at', '<', $today)
                    ->count();
        if ($data[1] !=0 && $data[0] !=0) {
            $data[1] = ($data[0] - $data[1])/$data[1] * 100;
        }
        return $data;
    }

    public function getTotalTransaksi()
    {
        $total = 0;
        $data = Transaksi::get();
        foreach ($data as $harga) {
          $total += $harga->total_transaksi;
        }

        $total_digit = strlen($total);
        if($total_digit > 5 && $total_digit < 10)
        {
            $total = ceil($total/1000000);
            $card_total = $total.'jt';
        }
        elseif($total_digit <= 5)
        {
            $total = ceil($total/1000);
            $card_total = $total.'rb';
        }
        elseif($total_digit >= 10)
        {

            $total = ceil($total/1000000000);
            $card_total = $total.'M';
        }

        return $card_total;
    }

    public function getTotalPermintaanToday()
    {
        $today = Carbon::today();
        $data[0] = Permintaan::whereDate('created_at', '=', $today)
                    ->count();
        return $data;
    }

    public function getInvoice($id, $id_permintaan)
    {
        $layanan['transaksi_id'] = Transaksi::where('permintaan_id',$id_permintaan)->first()->id;
        $transaksi = Transaksi_tarif::where('transaksi_id', $layanan['transaksi_id'])->get();
        $jumlah = count($transaksi);
        // dd($transaksi);
        for ($i=0; $i < $jumlah ; $i++) {
          $id = $transaksi[$i]->tarif_id;
          $layanan[$i] = Tarif::select(['id', 'nama_layanan', 'harga_layanan'])->where('id', $id)->get();
        }
        $layanan['jumlah'] = $jumlah-1;
        $layanan['total'] = Transaksi::where('id', $layanan['transaksi_id'])->first()->total_transaksi;
        // dd($layanan);
        if(!empty($layanan)) return $layanan;
    }

    public function detilPermintaan($id, $id_permintaan)
    {
        $data['permintaan'] = Permintaan::select(['id', 'waktu_meninggal', 'waktu_jemput', 'detail_tempat', 'detail_kematian', 'created_at'])->where('id', $id_permintaan)->get();
        $data['penyebab'] = Permintaan::select(['sebab_kematian_id'])->where('id', $id_permintaan)->get();
        $data['sebab_kematian'] = Sebab_kematian::find($data['penyebab']);
        $data['tempat'] = Permintaan::select(['tempat_meninggal'])->where('id', $id_permintaan)->get();
        $data['tempat_kematian'] = Tempat_meninggal::find($data['tempat']);
        $data['nama_pemeriksa'] = Permintaan::select(['nama_pemeriksa'])->where('id', $id_permintaan)->get();
        $data['nik'] = Permintaan::select(['nik'])->where('id', $id_permintaan)->get();
        $data['nokk'] = Permintaan::select(['nokk'])->where('id', $id_permintaan)->get();
        $data['status_kependudukan'] = Permintaan::select(['status_kependudukan'])->where('id', $id_permintaan)->get();
        $data['status_jenazah'] = Permintaan::select(['status_jenazah'])->where('id', $id_permintaan)->get();
        $data['hubungan_keluarga'] = Permintaan::select(['hubungan_keluarga'])->where('id', $id_permintaan)->get();
        $data['dikubur'] = Permintaan::select(['dikubur'])->where('id', $id_permintaan)->get();
        $data['nama_penanggung'] = Permintaan::select(['nama_penanggung'])->where('id', $id_permintaan)->get();
        $data['usia_penanggung'] = Permintaan::select(['usia_penanggung'])->where('id', $id_permintaan)->get();
        $data['kelamin_penanggung'] = Permintaan::select(['kelamin_penanggung'])->where('id', $id_permintaan)->get();
        $data['hubungan_penanggung'] = Permintaan::select(['hubungan_penanggung'])->where('id', $id_permintaan)->get();

        $data['diagnosis_id'] = Diagnosis_permintaan::where('permintaan_id',$id_permintaan)->get();
        $counterdiagnosis = count($data['diagnosis_id']);

        for ($i=0; $i < $counterdiagnosis; $i++) {
          if ($data['diagnosis_id'][$i]->diagnosis_id === 6) {
            $data['nama_diagnosis'][$i] = 'Lainnya'.' : '.$data['diagnosis_id'][$i]->keterangan;
          }
          else
            $data['nama_diagnosis'][$i] = Diagnosis_permintaan::find($data['diagnosis_id'][$i]->id)->diagnosis()->first()->nama_diagnosis;
        }
        // dd($data);
        return $data;
    }
  }
