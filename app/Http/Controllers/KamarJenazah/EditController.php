<?php

namespace App\Http\Controllers\KamarJenazah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\KamarJenazah\Tarif;
use App\Models\KamarJenazah\Transaksi;
use App\Models\KamarJenazah\Permintaan;
use App\Models\KamarJenazah\Transaksi_tarif;

class EditController extends Controller
{
  public function editTarif($tarif)
  {
        try {
            $layanan = Tarif::find($tarif['id']);
            $layanan->nama_layanan = $tarif['namalayanan'] ?? $layanan->nama_layanan;
            $layanan->harga_layanan = $tarif['hargalayanan'] ?? $layanan->harga_layanan;
            $layanan->save();

            return array(
                'layanan' => $layanan,
                'status' => 1
            );

        } catch (Exception $e) {
            return array(
                'layanan' => $e->getMessage(),
                'status' => 0
            );
        }
    }

    public function editTransaksi($transaksi, $layanan)
  {
        try {
        $idminta = Permintaan::where('pasien_id', $transaksi['idJenazah'])->first()->id;
        $idtransaksi['id'] = Transaksi::where('permintaan_id', $idminta)->first()->id;
        $transaksiEdit = Transaksi::find($transaksi['id']);

        $delete = app('App\Http\Controllers\KamarJenazah\DeleteController')->deleteTransaksiTarif($idtransaksi);

        $transaksiEdit->permintaan_id= $idminta;
        $transaksiEdit->total_transaksi= $transaksi['total'];
        $transaksiEdit->save();

        //data peti
        if ($transaksi['selectPeti'] != -1) {
          // code...
          $ttfBaruu = new Transaksi_tarif;
          $ttfBaruu->transaksi_id = $idtransaksi['id'];
          $ttfBaruu->tarif_id = $transaksi['selectPeti'];
          $ttfBaruu->save();
        }
        //data formalin
        if ($transaksi['formalin'] != -1) {
          $ttfBaruuu = new Transaksi_tarif;
          $ttfBaruuu->transaksi_id = $idtransaksi['id'];
          $ttfBaruuu->tarif_id = $transaksi['formalin'];
          $ttfBaruuu->save();
        }

        //data layanan
        if ($layanan != null) {
          // code...
          foreach ($layanan as $datalayanan) {
            $ttfBaru = new Transaksi_tarif;
            $ttfBaru->transaksi_id = $idtransaksi['id'];
            $ttfBaru->tarif_id = $datalayanan;
            $ttfBaru->save();
          }
        }

        return array(
                'layanan' => $transaksiEdit,
                'status' => 1
            );

        }

        catch (Exception $e) {
            return array(
                'layanan' => $e->getMessage(),
                'status' => 0
            );
        }
    }
}
