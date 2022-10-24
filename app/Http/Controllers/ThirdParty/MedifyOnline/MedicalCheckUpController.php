<?php

namespace App\Http\Controllers\ThirdParty\MedifyOnline;

use App\Models\Hospital\Kelas;
use App\Models\Keuangan\Tarif;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\Urikkes\Paket;
use App\Models\Urikkes\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MedicalCheckUpController extends Controller
{
    public function getPaketAll(Request $req)
    {
        app('debugbar')->disable();
        $paket = Paket::orderBy('nama')->get();

        return json_encode($paket);
    }

    public function getPaketSingle(Request $req)
    {
        app('debugbar')->disable();
        $paket = Paket::with(['tarifPaket.tarifMaster'])->find($req->id);

        $paket_new = new \stdClass();
        $paket_new->id = $paket->id;
        $paket_new->nama = $paket->nama;
        $paket_new->total = $paket->total;
        $detail=[];
        foreach ($paket->tarifPaket as $index => $item)
        {
            $tarif = Tarif::where('tarif_master_id',$item->tarif_id)->first();
            $detail[$index]['layanan'] = $item->tarifMaster->deskripsi ?? '';
            $detail[$index]['harga'] = $tarif->harga ?? 0;
        }
        $paket_new->detail = $detail;

        return json_encode($paket_new);
    }

    public function pendaftaranBaru(Request $request)
    {
        app('debugbar')->disable();
        $pasien = Pasien::where('no_rm',$request->pasien_id)->first();
        $pasien_pembayaran = PembayaranPerusahaan::where('id',$request->bayar_id)->first();
        $kelas_id = Kelas::where('medical_checkup', 1)->first()->id;

        $request_data = new \Illuminate\Http\Request();
        $request_data->replace([
            'is_online' => 1,
            'pasien_id' => $pasien->id,
            'pasien_data' => $pasien,
            'bayar_id' => $request->bayar_id,
            'tanggal_pemesanan' => $request->tanggal_pemesanan,
            'layanan' => 3, // medical-checkup
            'kelas' => $pasien_pembayaran->kelas_id ?? $kelas_id,
            'paket_urikkes' => $request->paket_id,
        ]);

        $data = app('App\Http\Controllers\Pasien\Pasien\PostController')->APIPendaftaranPasien($request_data);

        $data = json_decode($data);
        $transaksi_mcu = Transaksi::find($data->transaksi_id);

        $data_return['nomor_antrian'] = $transaksi_mcu->nomor_antrian;
        $data_return['estimasi_waktu'] = $transaksi_mcu->ordered_at ? Carbon::parse($transaksi_mcu->ordered_at)->toDateTimeString() : '';
        $data_return['transaksi_id'] = $transaksi_mcu->id;

        return json_encode($data_return);

    }

    public function getPaketById(Request $req)
    {
        app('debugbar')->disable();
        $pakets = Paket::whereIn('id', explode(',', $req->id))
            ->get()->mapWithKeys(function($paket){
                return [$paket->id => $paket];
            });
        return json_encode($pakets->toArray());
    }
}
