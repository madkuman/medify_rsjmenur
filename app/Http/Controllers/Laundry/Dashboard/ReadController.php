<?php

namespace App\Http\Controllers\Laundry\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Laundry\Transaksi;
use App\Models\Laundry\TransaksiDetail;
use App\Models\Laundry\PenanggungJawab;
use App\Models\Laundry\Barang;
use App\Models\Hospital\Grup;
use carbon\Carbon;
class ReadController extends Controller
{
    //

    public function getTotalPermintaan(){
      $today = Carbon::today();
      $data[0] = Transaksi::count();
      $data[1] = Transaksi::whereDate('created_at', '<', $today)
                  ->count();
      if ($data[1] !=0 && $data[0] !=0) {
          $data[1] = ($data[0] - $data[1])/$data[1] * 100;
      }
      return $data;
    }

    public function getTotalPengembalianToday(){
      $data = Transaksi::where('status_id','=',3)->count();
      return $data;
    }

    public function getTotalBarangCuci(){
      $data = Transaksi::where('status_id','=',2)->count();
      return $data;
    }

    public function getTotalBarangSelesaiCuci(){
      $data = Transaksi::where('status_id','=',5)->count();
      return $data;
    }

    public function GetPermintaan()
    {
        $pa = Transaksi::where('status_id','=',1)->with('getStatus')->with('creator')->with('getGroupName')->orderBy('created_at','desc')->paginate(10);
        foreach ($pa as $key) {
          $penanggung = PenanggungJawab::where('transaksi_id',$key->id)->first();

          $key->nama_status = $key->getStatus->nama;
          $key->group_id = $key->getGroupName->name;
          $key->waktu_diserahkan = $key->created_at->formatLocalized('%d %B %Y , %H:%M');
          if (!empty($penanggung->waktu_penerima)) {
            $key->waktu_diterima = \Carbon\Carbon::parse($penanggung->waktu_penerima)->formatLocalized('%d %B %Y , %H:%M');
          } else {
            $key->waktu_diterima = '';
          }
          $key->nama_penerima = $penanggung->penerima_pencucian;
          if (!empty($penanggung->waktu_menyerahkan)) {
            $key->waktu_dikembalikan = \Carbon\Carbon::parse($penanggung->waktu_menyerahkan)->formatLocalized('%d %B %Y , %H:%M');
          } else {
            $key->waktu_dikembalikan = '';
          }
        }
        return $pa;
    }
}
