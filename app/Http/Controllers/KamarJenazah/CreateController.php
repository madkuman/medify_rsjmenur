<?php

namespace App\Http\Controllers\KamarJenazah;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Models\KamarJenazah\Transaksi;
use App\Models\KamarJenazah\Transaksi_tarif;
use App\Models\KamarJenazah\Tarif;
use App\Models\KamarJenazah\Permintaan;
use App\Models\KamarJenazah\Diagnosis_permintaan;

use Auth;

class CreateController extends Controller
{
    //
    public function createTarif($tarif)
    {
      try{
        $layanan = new Tarif;
        $layanan->nama_layanan= $tarif['namalayanan'];
        $layanan->harga_layanan= $tarif['hargalayanan'];
        $layanan->kategori= $tarif['jenislayanan'];
        $layanan->save();

        return array(
          'layanan' => $layanan,
          'status' => 1
        );
      }

      catch (\Exception $e) {
        return array(
          'layanan' => $e->getMessage(),
          'status' => 0
        );
      }


    }

    public function newTransaksi($transaksi,$layanan)
    {
      try{
        $idminta = Permintaan::where('pasien_id', $transaksi['idJenazah'])->first();
        $transaksiCari = Transaksi::where('permintaan_id',$idminta->id)->first();
        if (is_null($transaksiCari)) {
          $transaksiBaru = new Transaksi;
          $transaksiBaru->permintaan_id= $idminta->id;
          $transaksiBaru->total_transaksi= $transaksi['total'];
          $transaksiBaru->save();
        }else {
          $transaksiCari->permintaan_id= $idminta->id;
          $transaksiCari->total_transaksi= $transaksi['total'];
          $transaksiCari->save();
        }
        $idminta->status = 2;
        $idminta->save();

        $idx = Transaksi::max('id');
        //data peti
        if ($transaksi['selectPeti'] != -1) {
          // code...
          $ttfBaruu = new Transaksi_tarif;
          $ttfBaruu->transaksi_id = $idx;
          $ttfBaruu->tarif_id = $transaksi['selectPeti'];
          $ttfBaruu->save();
        }
        //data formalin
        if ($transaksi['formalin'] != -1) {
          $ttfBaruuu = new Transaksi_tarif;
          $ttfBaruuu->transaksi_id = $idx;
          $ttfBaruuu->tarif_id = $transaksi['formalin'];
          $ttfBaruuu->save();
        }

        //data layanan
        if ($layanan != null) {
          // code...
          foreach ($layanan as $datalayanan) {
            $ttfBaru = new Transaksi_tarif;
            $ttfBaru->transaksi_id = $idx;
            $ttfBaru->tarif_id = $datalayanan;
            $ttfBaru->save();
          }
        }

        return array(
          'transaksi' => $transaksiBaru,
          'status' => 1
        );
      }

      catch (\Exception $e) {
        return array(
          'transaksi' => $e->getMessage(),
          'status' => 0
        );
      }


    }

    public function createPermintaan($permintaan,$diagnosis)
    {
      try{

        $permintaanBaru = Permintaan::firstOrNew(['pasien_id' => $permintaan['pasienid']]);

        $permintaanBaru->pasien_id= $permintaan['pasienid'];
        $permintaanBaru->kasus_id= $permintaan['kasus_id'];
        $permintaanBaru->waktu_meninggal= $permintaan['waktuMeninggal'];
        $permintaanBaru->waktu_jemput= $permintaan['waktuJemput'];
        $permintaanBaru->sebab_kematian_id= $permintaan['kematian'];
        $permintaanBaru->detail_kematian= $permintaan['detailKematian'];
        $permintaanBaru->tempat_meninggal= $permintaan['tempat'];
        $permintaanBaru->detail_tempat= $permintaan['detailTempat'];
        $permintaanBaru->nama_pemeriksa= $permintaan['nama_pemeriksa'];
        $permintaanBaru->nik= $permintaan['nik'];
        $permintaanBaru->nokk= $permintaan['nokk'];
        $permintaanBaru->status_kependudukan= $permintaan['status_kependudukan'];
        $permintaanBaru->status_jenazah= $permintaan['status_jenazah'];
        $permintaanBaru->hubungan_keluarga= $permintaan['hubungan_keluarga'];
        $permintaanBaru->dikubur= $permintaan['dikubur'];
        $permintaanBaru->nama_penanggung= $permintaan['namapenanggung'];
        $permintaanBaru->usia_penanggung= $permintaan['usiapenanggung'];
        $permintaanBaru->kelamin_penanggung= $permintaan['kelaminpenanggung'];
        $permintaanBaru->hubungan_penanggung= $permintaan['hubunganpenanggung'];
        $permintaanBaru->status= 1;
        $permintaanBaru->save();
        // dd($permintaanBaru);

        $permintaanId = Permintaan::max('id');
        foreach ($diagnosis as $diagnosis_id) {
          $diagnosis_permintaanBaru = new Diagnosis_permintaan;
          $diagnosis_permintaanBaru->permintaan_id = $permintaanId;
          $diagnosis_permintaanBaru->diagnosis_id = $diagnosis_id;
          if ($diagnosis_id === 6) {
            $diagnosis_permintaanBaru->keterangan = $permintaan['detailDiagnosis'];
          }
          $diagnosis_permintaanBaru->save();
        }

        // DB::table('permintaan')->insert(['pasien_id' => '2213', 'diagnosis_id' => '1', 'sebab_kematian_id' => '1']);

        return array(
          'permintaanBaru' => $permintaanBaru,
          'status' => 1
        );
      }
      catch (\Exception $e) {
        return array(
          'permintaanBaru' => $e->getMessage(),
          'status' => 0
        );
      }

    }

}
