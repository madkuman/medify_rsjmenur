<?php

namespace App\Http\Controllers\Pasien\KonfirmasiAntrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\MesinAntrianPasien;
use App\Models\RawatJalan\Transaksi;
use App\Models\Pasien\Pasien;
use Carbon\Carbon;
use DB;
use Auth;

class PostController extends Controller
{
    public function halamanKonfirmasi(Request $request, $id)
    {
        DB::connection('patients')->beginTransaction();
        try
        {
            // dd($request->pembayaran_utama_id);
            $antrian = MesinAntrianPasien::find($id);

            $sep = $request->sep;
            $sep_manual = $request->custom_sep;
            $tunai = $request->pembayaran_utama_id;
            $mesin_antrian = new Transaksi;
            $mesin_antrian->poliklinik_id = $request->poliklinik_id;
            $mesin_antrian->dokter_id = $request->dokter_id;
            $mesin_antrian->pasien_id = $request->pasien_id;
            $mesin_antrian->nomor_antrian = $request->antrian;
            $mesin_antrian->dokter_jadwal_id = $request->dokter_jadwal;
            $mesin_antrian->pasien_pembayaran_id = $request->pembayaran_utama_id ?? null;
            $mesin_antrian->ordered_at = Carbon::now();
            $mesin_antrian->waktu_masuk = Carbon::now();
            $mesin_antrian->is_mesin_antrian = 1;

            if (isset($sep)) {
                $mesin_antrian->nomor_sep = json_decode($sep)->no_sep;
                $antrian->konfirmasi_by = Auth::user()->id;
                $mesin_antrian->save();
                $antrian->save();
            }elseif (isset($tunai)){
                $mesin_antrian->nomor_sep = null;
                $antrian->konfirmasi_by = Auth::user()->id;
                $mesin_antrian->save();
                $antrian->save();
            }
            else{
                $mesin_antrian->nomor_sep = $sep_manual;
                $antrian->konfirmasi_by = Auth::user()->id;
                $mesin_antrian->save();
                $antrian->save();
            }

            DB::connection('patients')->commit();

            $status = 0;
            $message = 'Pasien berhasil di konfirmasi';
            $title = 'Sukses!';

            return redirect('/rawatjalan/transaksi/pendaftaran/'.$mesin_antrian->id)
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);


        } catch (\Exception $e) {

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('patients')->rollback();

            $status = 0;
            $message = 'Cara pembayaran gagal di edit';
            $title = 'Gagal!';
            return redirect()->back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        }
    }

    public function batalkan(Request $request)
    {
        $status = 1;
        $message = 'Transaksi Berhasil Dibatalkan';
        $title = 'Berhasil!';

        DB::connection('patients')->beginTransaction();
        DB::connection('rawatjalan')->beginTransaction();
        DB::connection('rekammedis')->beginTransaction();
        try {
            $mesin_antrian = MesinAntrianPasien::find($request->id);
            $mesin_antrian->cancel_by = Auth::user()->id;
            $mesin_antrian->save();

            if (!empty($mesin_antrian->transaksi_rawat_jalan_id)) {
                $cancel_data['id'] = $mesin_antrian->transaksi_rawat_jalan_id;
                $cancel_data['keterangan'] = $request->keterangan;
                $request_data = new Request($cancel_data);
                $cancel_transaksi_rajal = app('App\Http\Controllers\RawatJalan\Transaksi\PostController')->cancel($request_data);
            }

            DB::connection('patients')->commit();
            DB::connection('rawatjalan')->commit();
            DB::connection('rekammedis')->commit();
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('patients')->rollback();
            DB::connection('rawatjalan')->rollback();
            DB::connection('rekammedis')->rollback();

            $status = -1;
            $message = 'Transaksi Gagal Dibatalkan';
            $title = 'Gagal!';
        }
        return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
    }
}
