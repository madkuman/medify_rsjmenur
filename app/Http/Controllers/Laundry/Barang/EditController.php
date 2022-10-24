<?php

namespace App\Http\Controllers\Laundry\Barang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Laundry\TransaksiDetail;
use App\Models\Laundry\Transaksi;
use App\Models\Laundry\PenanggungJawab;
use App\Models\Laundry\Barang;
use carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
class EditController extends Controller
{
  public function addBarang($nama)
  {
      try {
            // dd($nama);
            $new = new Barang;
            $new->nama = $nama[0];
            $new->detail = $nama[1];
            $new->save();


          return array(
              'layanan' => $new,
              'status' => 1
          );

      } catch (Exception $e) {
          return array(
              'layanan' => $e->getMessage(),
              'status' => 0
          );
      }
  }

  public function editBarang($barang)
  {
      try {
        $editBarang = Barang::find($barang['idBarang']);

        $editBarang->nama = $barang['namaBarangNew'] ?? $editBarang->nama;
        $editBarang->detail = $barang['detailBarangNew'] ?? $editBarang->detail;
        $editBarang->save();

          return array(
              'layanan' => $editBarang,
              'status' => 1
          );

      } catch (Exception $e) {
          return array(
              'layanan' => $e->getMessage(),
              'status' => 0
          );
      }
  }
}
