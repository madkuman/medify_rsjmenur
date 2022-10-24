<?php

namespace App\Http\Controllers\Laundry\Permintaan;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use App\Models\Laundry\Transaksi;
use App\Models\Laundry\TransaksiDetail;
use App\Models\Laundry\PenanggungJawab;
use App\Models\Laundry\Barang;
use App\Models\Hospital\Grup;
use carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

setlocale(LC_TIME, 'Indonesian');

class ReadController extends Controller
{

    public function GetPermintaanDetail($id)
    {
        $pa = TransaksiDetail::where('transaksi_id',$id)->paginate(10);
        $nomor = 1;
        // dd($pa);
        foreach ($pa as $p) {
            $p->nama_barang = Barang::withTrashed()->where('id', $p->barang_id)->first()->nama;
            $p->detail_id = $p->id;
            $p->nomor = $nomor;
            $nomor++;
        }
        $pa->jumlah = TransaksiDetail::where('transaksi_id',$id)->get()->count();
        $pa->id = TransaksiDetail::where('transaksi_id',$id)->get()->last()->transaksi_id;
        // dd($pa);
        return $pa;
    }

    public function GetAddPermintaan($group_id = 0)
    {
        $nomor = 1;
        $pa['barang'] = Barang::all();
        foreach ($pa['barang'] as $p) {
          $p->nomor = $nomor;
          $nomor++;
        }
        if ($group_id == 0) {
          $pa['grup'] = Grup::all();
        }
        else{
          $pa['grup'] = Grup::where('id', $group_id)->get();
        }
        $pa['grup']->jumlah = $pa['grup']->count();
        $pa['barang']->jumlah = $pa['barang']->count();
        // dd($pa);
        return $pa;
    }

    public function GetPermintaan(Request $request)
    {
      // dd($request);
      $tgl_min = $request->get('tgl_min');
      $tgl_max = $request->get('tgl_max');
      $tgl_min2 = $request->get('tgl_min2');
      $tgl_max2 = $request->get('tgl_max2');
      $ruangan = $request->get('grup');
      $counter = $request->get('counter');
      $proses = $request->get('proses');
      // dd(\Carbon\Carbon::now()->startOfDay());

      if( empty($tgl_min) && empty($tgl_min2) && empty($tgl_max) && empty($tgl_max2) && empty($ruangan) && empty($proses) )
        $query = Transaksi::with('getStatus')->with('creator')->with('getGroupName')->orderBy('id','desc');
      else
        $query = Transaksi::with('getStatus')->with('creator')->with('getGroupName')->orderBy('id','desc');

      if (!is_null($tgl_min) || !is_null($tgl_max)){
        if (!is_null($tgl_min)) $tgl_min = \Carbon\Carbon::parse($tgl_min)->format('Y-m-d 00:00');
        if (!is_null($tgl_max)) $tgl_max = \Carbon\Carbon::parse($tgl_max)->format('Y-m-d 23:59');
        // dd($tgl_max, $tgl_min);

        if (!is_null($tgl_min) && is_null($tgl_max)) {
          $waktu = PenanggungJawab::whereDate('waktu_penerima','>=', $tgl_min)->pluck('transaksi_id')->toArray();
        }
        elseif (!is_null($tgl_max) && is_null($tgl_min)) {
          $waktu = PenanggungJawab::whereDate('waktu_penerima','<=', $tgl_max)->pluck('transaksi_id')->toArray();

        }
        else{
          $waktu = PenanggungJawab::whereBetween('waktu_penerima', [$tgl_min, $tgl_max])->pluck('transaksi_id')->toArray();
        }

        $query = $query->whereIn('id', $waktu);
      }

      if (!is_null($tgl_min2) || !is_null($tgl_max2)){
        if (!is_null($tgl_min2)) $tgl_min2 = \Carbon\Carbon::parse($tgl_min2)->format('Y-m-d 00:00');
        if (!is_null($tgl_max2)) $tgl_max2 = \Carbon\Carbon::parse($tgl_max2)->format('Y-m-d 23:59');

        if (!is_null($tgl_min2) && is_null($tgl_max2)) {
          $waktu2 = PenanggungJawab::whereDate('waktu_menyerahkan','>=', $tgl_min2)->pluck('transaksi_id')->toArray();
        }
        elseif (!is_null($tgl_max2) && is_null($tgl_min2)) {
          $waktu2 = PenanggungJawab::whereDate('waktu_menyerahkan','<=', $tgl_max2)->pluck('transaksi_id')->toArray();
        }
        else{
          $waktu2 = PenanggungJawab::whereBetween('waktu_menyerahkan', [$tgl_min2, $tgl_max2])->pluck('transaksi_id')->toArray();
        }
        $query = $query->whereIn('id', $waktu2);
      }

      if (!is_null($ruangan))
      {
        if($ruangan != 0)
          $query = $query->where('group_id',$ruangan);
      }

      if (!is_null($proses)){
        $proses = explode(',',$proses);
        $query = $query->whereIn('status_id',$proses);
      }

      $pa = $query->orderBy('id','desc')->paginate(10);

      foreach ($pa as $key) {
        $penanggung = PenanggungJawab::where('transaksi_id',$key->id)->first();

        $key->nama_status = $key->getStatus->nama;
        $key->warna_status = $key->getStatus->class;
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

    public function GetLaundryData($id){
        $DataLaundry = Transaksi::where('id',$id)->with('getStatus')->with('creator')->with('getGroupName')->first();
        $penanggung = PenanggungJawab::where('transaksi_id',$id)->first();
        if (!empty($penanggung->waktu_penerima)) {
          $DataLaundry->waktu_diterima = \Carbon\Carbon::parse($penanggung->waktu_penerima)->formatLocalized('%d %B %Y , %H:%M');
        } else {
          $DataLaundry->waktu_diterima = '';
        }
        return $DataLaundry;
    }

    public function GetPenanggungjawab($id){
        $DataPenanggungjawab = PenanggungJawab::where('transaksi_id',$id)->first();

        if (!empty($DataPenanggungjawab->waktu_penerima))
          $DataPenanggungjawab->waktu_penerima = \Carbon\Carbon::parse($DataPenanggungjawab->waktu_penerima)->formatLocalized('%d %B %Y, %H:%M');
        else {
          $DataPenanggungjawab->waktu_penerima = '';
        }
        if (!empty($DataPenanggungjawab->waktu_selesai_pencucian))
          $DataPenanggungjawab->waktu_selesai_pencucian = \Carbon\Carbon::parse($DataPenanggungjawab->waktu_selesai_pencucian)->formatLocalized('%d %B %Y, %H:%M');
          else {
            $DataPenanggungjawab->waktu_selesai_pencucian = '';
          }
        if (!empty($DataPenanggungjawab->waktu_menyerahkan))
          $DataPenanggungjawab->waktu_menyerahkan = \Carbon\Carbon::parse($DataPenanggungjawab->waktu_menyerahkan)->formatLocalized('%d %B %Y, %H:%M');
          else {
            $DataPenanggungjawab->waktu_menyerahkan = '';
          }
        if (!empty($DataPenanggungjawab->waktu_menerima))
          $DataPenanggungjawab->waktu_menerima = \Carbon\Carbon::parse($DataPenanggungjawab->waktu_menerima)->formatLocalized('%d %B %Y, %H:%M');
          else {
            $DataPenanggungjawab->waktu_menerima = '';
          }
        // dd($DataPenanggungjawab);
        return $DataPenanggungjawab;
    }

    public function FilterPermintaan(Request $request){
      $ruangan = $request->get('ruangan');
      $tgl_min_terima = $request->get('tgl_min_terima');
      $tgl_max_terima = $request->get('tgl_max_terima');
      $tgl_min_kembali = $request->get('tgl_min_kembali');
      $tgl_max_kembali = $request->get('tgl_max_kembali');

      if (empty($ruangan) && empty($tgl_min_terima) && empty($tgl_max_terima) && empty($tgl_min_kembali) && empty($tgl_max_kembali)) {
        $query = Transaksi::with('getStatus')->with('creator')->with('getGroupName')->paginate(10);
      }

      else {
        $pa = Transaksi::search('*')->with('getStatus')->with('creator')->paginate(10);
        foreach ($pa as $key) {
          $penanggung = PenanggungJawab::where('transaksi_id',$key->id)->first();

          $key->nama_status = $key->getStatus->nama;
          $key->waktu_diserahkan = $key->created_at->formatLocalized('%d %B %Y , %H:%M');
          $key->waktu_diterima = \Carbon\Carbon::parse($penanggung->waktu_penerima)->formatLocalized('%d %B %Y , %H:%M');
          $key->nama_penerima = $penanggung->penerima_pencucian;
          $key->waktu_dikembalikan = \Carbon\Carbon::parse($penanggung->waktu_menyerahkan)->formatLocalized('%d %B %Y , %H:%M');
        }
      }

      if (!empty($tgl_min_terima)) {
        $query = Transaksi::with('getStatus')->paginate(10);
      }
    }

}
