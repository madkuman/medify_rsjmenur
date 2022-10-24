<?php

namespace App\Http\Controllers\Radiology\Transaction;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Radiology\Transaction;
use App\Models\Hospital\Lokasi;
use App\Models\Radiology\TransactionDetail;
use App\Models\Pasien\Pasien;
use App\Models\Keuangan\Tarif;
use App\Models\Kasus\Penunjang;
use DB;
use Bugsnag;
use DateTime;
use Auth;
use Carbon\Carbon;

class PostController extends Controller
{
    static protected $lokasi_slug = "radiologi";
    static protected $slug = 'lab-radiologi';
    static protected $slug_kasir = 'kasir-radiologi';

    public function kirimKasir($transaction, $detail_data)
    {

        $lokasi = Lokasi::where('slug', self::$lokasi_slug)->first();//id lokasi loket

        $nama_layanan = $transaction->kelas->nama;
        $kasir = app('App\Http\Controllers\Kasir\Manajemen\ReadController')->getBySlug(self::$slug_kasir);
        $kasir_id = $kasir->id;

        $transaksi_details = [];
        $jumlah = 0;
        foreach($detail_data as $d){
            $detail_res = $this->reshapeKasir((object)$d, $lokasi);
            $jumlah += ($d['unit_price']*$d['qty']);
            array_push($transaksi_details, $detail_res);
        }
        $transaksi_details = (object)$transaksi_details;

        $diskon = 0;
        $total = $jumlah;
        $pasien_id = $transaction->patient_id;
        $judul = 'Penunjang Radiologi '.$nama_layanan.' - '.$transaction->pasien->name;
        $kasir_id = $kasir_id;
        $asal_layanan = $transaction->asal->nama ?? 'Tanpa Kasus';
        $lokasi_id = $lokasi->id;
        $created_at = Carbon::now();
        $updated_at = Carbon::now();
        $pasien_pembayaran_id = $transaction->pasien_pembayaran_id;

        $lokasiNow = $lokasi;
        $kategori_id = $lokasiNow->kategori_keuangan_id;
        $pihak_ketiga = "TUNAI";
        $perusahaan_id = 2; ///tunai perusahaan keuangan
        $akun_id = 1; //cash
        $kasus_id = null;

        $transaksi_kasir = app('App\Http\Controllers\Keuangan\Piutang\CreateController')
            ->create($kasir_id,$judul,$jumlah,$diskon,$total,$pasien_id,$pihak_ketiga,$kategori_id,
                $created_at,$created_at,$updated_at,
                $transaksi_details,$pasien_pembayaran_id,$lokasi_id,
                null,$perusahaan_id,'Administrasi Pendaftaran Pasien',null);
        $this->updateDetail($detail_data, $transaksi_kasir);

        return $transaksi_kasir;
    }

    private function updateDetail($details, $transaksi_kasir)
    {
        foreach($details as $d)
        {
            $transaksi_detail = TransactionDetail::find($d['transaction_detail_id']);
            $transaksi_detail->piutang_id = $transaksi_kasir->id;
            $transaksi_detail->save();
        }
    }

    private function reshapeKasir($data,$lokasi_loket)
    {
        $tarif = Tarif::find($data->tarif_id);
        $newtrans = new \stdClass();
        $newtrans->tarif_id = $data->tarif->id;
        $newtrans->deskripsi = $data->desc;
        $newtrans->tarif_tipe_id = $data->tarif_tipe_id;
        $newtrans->tarif_kelas_id = $data->tarif_kelas;
        $newtrans->kelas_id = $data->tarif_kelas;
        $newtrans->harga = $data->unit_price;
        $newtrans->diskon = 0;
        $newtrans->jumlah = $data->qty;
        $newtrans->subtotal = $data->unit_price*$data->qty;
        $newtrans->keterangan = null;
        $newtrans->lokasi_id = $lokasi_loket->id;
        $newtrans->kategori_id = $lokasi_loket->kategori_keuangan_id;
        $newtrans->created_at = Carbon::now();
        $newtrans->updated_at = Carbon::now();
        $newtrans->created_by = Auth::user()->id;
        return $newtrans;
    }

    public function kirimTagihan($slug)
    {
        try {
            DB::connection('kasus')->beginTransaction();
            DB::connection('radiology')->beginTransaction();
            DB::connection('keuangan')->beginTransaction();

            $transaksi = Transaction::where('slug', $slug)->first();
            $detail_data = [];
            foreach($transaksi->detail as $d){
                $temp = app('App\Http\Controllers\Radiology\Transaction\CreateController')->saveTagihanData($transaksi, $d);
                if($transaksi->kirim_kasir)
                    array_push($detail_data, $temp);
                else {
                    $saveToTagihan = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($temp);
                    $d->tagihan_detail_id = $saveToTagihan->id;
                    $d->save();
                }
            }
            if($transaksi->kirim_kasir)
                $this->kirimKasir($transaksi, $detail_data);
            $transaksi->is_checkout = 1;
            $transaksi->save();
            DB::connection('keuangan')->commit();
            DB::connection('kasus')->commit();
            DB::connection('radiology')->commit();

            $status = 'success';
            $message = 'Berhasil Mengirim Tagihan';
        } catch (\Exception $e) {
            DB::connection('keuangan')->rollback();
            DB::connection('kasus')->rollback();
            DB::connection('radiology')->rollback();                
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $status = 'error';
            $message = 'Gagal Mengirim Tagihan';
        }
       return redirect('radiologi/transaksi/permintaan/'.$slug)->with($status, $message); 
    }
}