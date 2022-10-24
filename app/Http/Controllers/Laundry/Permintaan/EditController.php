<?php

namespace App\Http\Controllers\Laundry\Permintaan;

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
    public function acceptLaundry($permintaan)
    {
        try {
        	// dd($permintaan);
        	// dd($permintaan['isi'][1]['detail1']);
            $jumlah = $permintaan['jumlah'];
            for ($i=1; $i <= $jumlah; $i++) {
            	$accept = TransaksiDetail::find($permintaan['isi'][$i]['detail'.$i]);
              $accept->keterangan_terima = $permintaan['isi'][$i]['ket'.$i];
            	// dd($accept);
            	$accept->diterima = $permintaan['isi'][$i]['barang'.$i];
            	$accept->save();
            	}

            return array(
                'layanan' => $accept,
                'status' => 1
            );

        } catch (Exception $e) {
            return array(
                'layanan' => $e->getMessage(),
                'status' => 0
            );
        }
    }

    public function editLaundry($permintaan)
    {
        try {
          // dd($permintaan);
          // dd($permintaan['isi'][1]['detail1']);
            $jumlah = $permintaan['jumlah'];
            for ($i=1; $i <= $jumlah; $i++) {
              $edit = TransaksiDetail::find($permintaan['isi'][$i]['detail'.$i]);
              // dd($accept);
              if (!is_null($permintaan['isi'][$i]['ket'.$i])) $edit->keterangan = $permintaan['isi'][$i]['ket'.$i];
              if (!is_null($permintaan['isi'][$i]['barang'.$i])) $edit->diserahkan = $permintaan['isi'][$i]['barang'.$i];
              $edit->save();
              }

            return array(
                'layanan' => $edit,
                'status' => 1
            );

        } catch (Exception $e) {
            return array(
                'layanan' => $e->getMessage(),
                'status' => 0
            );
        }
    }

    public function editProsesCuciLaundry($permintaan)
    {
        try {
          // dd($permintaan);
          // dd($permintaan['isi'][1]['detail1']);
            $jumlah = $permintaan['jumlah'];
            for ($i=1; $i <= $jumlah; $i++) {
              $edit = TransaksiDetail::find($permintaan['isi'][$i]['detail'.$i]);
              // dd($accept);
              if (!is_null($permintaan['isi'][$i]['ket'.$i])) $edit->keterangan_terima = $permintaan['isi'][$i]['ket'.$i];
              if (!is_null($permintaan['isi'][$i]['barang'.$i])) $edit->diterima = $permintaan['isi'][$i]['barang'.$i];
              $edit->save();
              }

            return array(
                'layanan' => $edit,
                'status' => 1
            );

        } catch (Exception $e) {
            return array(
                'layanan' => $e->getMessage(),
                'status' => 0
            );
        }
    }

    public function addPermintaan($permintaan)
    {
      try {
        // dd($permintaan);
        // dd($permintaan['isi'][1]['detail1']);
          $grup = new Transaksi;
          $grup->group_id = $permintaan['grup'];
          $grup->status_id = 1;
          $grup->created_by = Auth::user()->id;
          $grup->save();

          $transaksi = Transaksi::get();
          $transaksi_id = $transaksi->last()->id;
          // dd($permintaan);
          $jumlah = $permintaan['jumlah'];
          for ($i=1; $i <= $jumlah; $i++) {
              $accept = new TransaksiDetail;
              // dd($accept);
              $accept->transaksi_id = $transaksi_id;
              $accept->barang_id = $permintaan['isi'][$i]['barang_id'];
              $accept->diserahkan = $permintaan['isi'][$i]['barang'.$i];
              $accept->keterangan = $permintaan['isi'][$i]['ket'.$i];
              $accept->created_by = Auth::user()->id;
              $accept->save();
          }
          $penanggungjawab = new PenanggungJawab;
          $penanggungjawab->transaksi_id = $transaksi_id;
          $penanggungjawab->save();

          return array(
              'id' => $transaksi_id,
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

    public function updatePermintaan($id)
    {
        try {
            $DataLaundry = Transaksi::find($id);

  		      $DataPenanggungjawab = PenanggungJawab::where('transaksi_id',$id)->first();

  		      if ($DataLaundry->status_id === 1) {
  		        $DataPenanggungjawab->penerima_pencucian = Auth::user()->name;
  		        $DataPenanggungjawab->waktu_penerima = Carbon::now();
  		        $DataPenanggungjawab->save();
  		      }
            else if ($DataLaundry->status_id === 2) {
              $DataPenanggungjawab->selesai_pencucian = Auth::user()->name;
              $DataPenanggungjawab->waktu_selesai_pencucian = Carbon::now();
              $DataPenanggungjawab->save();
            }
  		      else if ($DataLaundry->status_id === 3) {
  		        $DataPenanggungjawab->menyerahkan_pencucian = Auth::user()->name;
  		        $DataPenanggungjawab->waktu_menyerahkan = Carbon::now();
  		        $DataPenanggungjawab->save();
  		      }
  		      else if ($DataLaundry->status_id === 4) {
  		        $DataPenanggungjawab->menerima_ruangan = Auth::user()->name;
  		        $DataPenanggungjawab->waktu_menerima = Carbon::now();
  		        $DataPenanggungjawab->save();
  		      }
            $DataLaundry->status_id += 1;
            $DataLaundry->save();

            return array(
                'layanan' => $DataLaundry,
                'status' => 1
            );

        } catch (Exception $e) {
            return array(
                'layanan' => $e->getMessage(),
                'status' => 0
            );
        }
    }

    public function rejectLaundry($permintaan){
      try {
        $DataLaundry = Transaksi::find($permintaan['idTransaksi']);

        $DataLaundry->keterangan_tolak = $permintaan['keterangan_tolak'];
        $DataLaundry->status_id = -1;
        $DataLaundry->save();

        return array(
            'layanan' => $DataLaundry,
            'status' => 1
        );
      } catch (\Exception $e) {
          return array(
              'layanan' => $e->getMessage(),
              'status' => 0
          );
      }

    }
}
