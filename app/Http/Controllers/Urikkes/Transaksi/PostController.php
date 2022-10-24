<?php

namespace App\Http\Controllers\Urikkes\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Urikkes\Transaksi;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\Kasus;
use App\Models\Hospital\Lokasi;
use App\Models\Hospital\Kelas;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifKategori;
use App\Models\Urikkes\Paket;
use App\Models\Urikkes\TransaksiDetail;
use Carbon\Carbon;
use DB;
use Auth;

class PostController extends Controller
{

	public function layani(Request $request)
	{
		DB::connection('urikkes')->beginTransaction();
        DB::connection('kasus')->beginTransaction();
        try
        {
            $transaksi_id = $request->input('transaksi_id');

            $transaksi = Transaksi::find($transaksi_id);
            $judul_kasus = 'Medical Checkup #'.$transaksi_id;
            $pasien = Pasien::find($transaksi->pasien_id);
            //ID Kelas Urikkes
            $kelas = Kelas::where('medical_checkup',1)->first()->id;
            //ID Lokasi Urikkes
            $lokasi = Lokasi::where('slug','medical-checkup')->first()->id;

            $paket_id = $transaksi->transaksi_detail[0]->paket_id;
            $paket = Paket::find($paket_id);

            if(empty($transaksi->kasus_id))
            {
                $kasus = app('App\Http\Controllers\Kasus\Kasus\CreateController')
                ->createKasus($judul_kasus,$pasien,$lokasi,$transaksi->id,$kelas,$transaksi->pasien_pembayaran_id,'');
                $kasus->tipe_mc = 1;
                $kasus->save();
                
                $transaksi->status=1;
                $transaksi->kasus_id=$kasus->id;
                $transaksi->save();
                $transaksi->waktu_pemeriksaan = Carbon::now();
                $transaksi->save();

                //Kirim permintaan penunjang
                app('App\Http\Controllers\Urikkes\Transaksi\CreateController')->permintaanPenunjang($request, $paket, $kasus);

            }


            DB::connection('kasus')->commit();
            DB::connection('urikkes')->commit();
            return redirect('kasus/'.$transaksi->kasus->nomor_kasus.'/urikkes');

       } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('urikkes')->rollback();
            DB::connection('kasus')->rollback();
            
        }
	}


    public function reshapeKasir($data)
    {
        $newtrans = new \stdClass();
        $newtrans->tarif_id = $data['tarif_id'];
        $newtrans->deskripsi = $data['desc'];
        $newtrans->tarif_tipe_id = $data['tarif_tipe_id'];
        $newtrans->tarif_kelas_id = $data['tarif_kelas_id'];
        $newtrans->kelas_id = $data['tarif_kelas_id'];
        $newtrans->harga = $data['unit_price'];
        $newtrans->diskon = 0;
        $newtrans->jumlah = $data['qty'];
        $newtrans->subtotal = $data['unit_price']*$data['qty'];
        $newtrans->keterangan = null;
        $newtrans->lokasi_id = $data['lokasi'];
        $newtrans->kategori_id = $data['kategori_id'];
        $newtrans->created_at = Carbon::now();
        $newtrans->updated_at = Carbon::now();
        $newtrans->created_by = Auth::user()->id;
        return $newtrans;
    }

    public function batalkan($transaksi_id)
    {
        DB::connection('urikkes')->beginTransaction();
        try
        {
            $detail = TransaksiDetail::where('transaksi_id', $transaksi_id)->get();
            foreach ($detail as $value) {
                $value->delete();
            }
            $transaksi = Transaksi::find($transaksi_id);
            if(isset($transaksi->piutang) && !empty($transaksi->piutang) && count($transaksi->piutang->pemasukan) == 0)
            {
                app('App\Http\Controllers\Keuangan\Piutang\DeleteController')->deleteAct($transaksi->piutang_id,0);
            }elseif (isset($transaksi->piutang) && !empty($transaksi->piutang) && count($transaksi->piutang->pemasukan) > 0)
            {
                DB::connection('urikkes')->rollback();
                return back()->with('message', 'Transaksi Urikkes gagal dibatalkan, tagihan pasien telah terbayar')
                    ->with('title','Gagal!')
                    ->with('status', -1);
            }
            $transaksi->delete();
            $status = 1;
            $message = 'Transaksi Urikkes berhasil dibatalkan';
            $title = 'Berhasil!';
            DB::connection('urikkes')->commit();
            return back()
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('urikkes')->rollback();
            return back()->with('message', 'Terjadi Kesalahan Server')
                ->with('title','Gagal!')
                ->with('status', -1);
        }
    }
}
