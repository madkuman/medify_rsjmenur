<?php

namespace App\Http\Controllers\KamarJenazah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\KamarJenazah\Tarif;
use App\Models\KamarJenazah\Transaksi;
use App\Models\KamarJenazah\Transaksi_tarif;
use App\Models\KamarJenazah\Permintaan;

class DeleteController extends Controller
{
    //
    public function deleteTarif($tarif)
    {
          try {
              $layanan = Tarif::find($tarif['id']);
              $layanan->delete();

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

    public function deleteTransaksi($req)
    {
          try {
              $transaksi = Transaksi::where('id', $req['id'])->get();
              $transaksi_tarif = Transaksi_tarif::where('transaksi_id', $transaksi[0]->id)->delete();

              $status_permintaan = Permintaan::where('id',$transaksi[0]->permintaan_id)->first();
              $status_permintaan->status = 1;
              $status_permintaan->save();

              Transaksi::where('id', $req['id'])->delete();

              return array(
                  'layanan' => $transaksi,
                  'status' => 1
              );

          } catch (Exception $e) {
              return array(
                  'layanan' => $e->getMessage(),
                  'status' => 0
              );
          }
      }

    public function deleteTransaksiTarif($req)
    {
          try {
              $transaksi = Transaksi::where('id', $req['id'])->get();
              $transaksi_tarif = Transaksi_tarif::where('transaksi_id', $transaksi[0]->id)->delete();

              return array(
                  'layanan' => $transaksi,
                  'status' => 1
              );

          } catch (Exception $e) {
              return array(
                  'layanan' => $e->getMessage(),
                  'status' => 0
              );
          }
      }

    public function deletePermintaan($minta)
    {
          try {
              // dd($minta);
              $permintaan = Permintaan::where('pasien_id', $minta['id']);
              // dd($permintaan);
              $permintaan->delete();

              return array(
                  'permintaan' => $permintaan,
                  'status' => 1
              );

          } catch (Exception $e) {
              return array(
                  'permintaan' => $e->getMessage(),
                  'status' => 0
              );
          }
      }
}
