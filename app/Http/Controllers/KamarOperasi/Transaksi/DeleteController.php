<?php

namespace App\Http\Controllers\KamarOperasi\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Transaksi;
use DB, Auth;
use Carbon\Carbon;

class DeleteController extends Controller
{
    public function pemesanan($id)
    {
        $transaksi = Transaksi::find($id);
        $connection = DB::connection('kamaroperasi');
        $connection->beginTransaction();

        try {
            if ($transaksi->status == 2)
            {
                $pergantian = $transaksi->getCurrentPergantianJadwal();
                $pergantian->status = 9;
                $pergantian->save();
                $transaksi->status = 0;
                $transaksi->save();
            }
            else
            {
                $transaksi->deleted_by = Auth::user()->id;
                $transaksi->save();
                $transaksi->delete();
            }

            $connection->commit();

            $status = 1;
            $message = 'Penolakan pasien berhasil dilakukan.';
            $title = 'Berhasil!';

            return redirect('kamaroperasi/pemesanan')
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
        } catch (\Exception $e) {
            $connection->rollback();

            $status = -1;
            $message = $e;
            $title = 'Error!!';

            return redirect('kamaroperasi/pemesanan')
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
        }
    }

    public function kasus($kasus,$waktu)
    {   
     
        $waktu = Carbon::parse($waktu)->format('Y-m-d');
        $transaksi = Transaksi::where('kasus_id',$kasus)
        ->where('jadwal_operasi','>',$waktu)
        ->orWhere('jadwal_operasi',null)
        ->get();
        foreach ($transaksi as $item) 
        {
            $item->deleted_by = Auth::user()->id;
            $item->alasan_batal = "Pasien KRS - dibatalkan melalui KRS";
            $item->save();
            $item->delete();
        }
        return 1;
    }

    public function batalKasus($id)
    {   
        //dd($id);
        $connection = DB::connection('kamaroperasi');
        $connection->beginTransaction();
        try
        {   
            $transaksi = Transaksi::where('id',$id)
                            ->first();
            /*dd($transaksi);*/
            $transaksi->alasan_batal = "Dibatalkan dari kasus";
            $transaksi->deleted_by = Auth::user()->id;
            $transaksi->save();
            $transaksi->delete();
            $connection->commit();
            return;
        }
        catch(\Exception $e)
          {
              app('App\Http\Controllers\Error\Handler')->bugsnag($e);
              $connection->rollback();
          }

    }
}
