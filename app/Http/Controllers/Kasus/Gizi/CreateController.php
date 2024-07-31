<?php

namespace App\Http\Controllers\Kasus\Gizi;

use App\Models\Kasus\CPPT;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\GiziPermintaan;
use App\Models\Kasus\Identitas;
use App\Models\Kasus\Kasus;
use App\User;
use Illuminate\Http\Request;
use App\Models\Hospital\TransaksiMasukDetail;
use App\Models\RawatInap\Transaksi;
use App\Models\Nutrition\Order;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Lokasi;
use DB;
use Bugsnag;

class CreateController extends Controller
{
    public function createNewPermintaanMakanan(Request $request) {


        $nomorKasus = $request->input('nomor-kasus');

//        $kasusId = Kasus::where('nomor_kasus', $nomorKasus)->pluck('id')->first();

        $kasus = Kasus::where('nomor_kasus', $nomorKasus)->first();

        $kasusId = $kasus->id;

        $data = $request->all();

        $identitasId = $request->input('identitas-id');

        $identitas = Identitas::where('id', $identitasId)->first();

        $order = new Order();
        $order->kasus_id = $kasus->id;
        $order->kelas = $kasus->kelas;

        $order->nurse_name = User::where('id', 0)->pluck('name')->first();
        $order->patient_id = $request->input('identitas-id');
        $order->patient_name = $identitas->nama;
        $order->patient_age = $identitas->age;


        if( $request->input('checkbox-pagi') ) {
            $order->is_morning = 1;
        }

        if( $request->input('checkbox-siang') ) {
            $order->is_afternoon = 1;
        }

        if( $request->input('checkbox-malam') ) {
            $order->is_afternoon = 1;
        }

        $order->diet = $request->input('hidden-diet');
        $order->diet_selection = $request->input('hidden-diet-detail');
        $order->energy_sources = $request->input('hidden-sumber-energi');
        $order->description = $request->input('input-keterangan');
        $order->date_target = $request->input('date-target');

        $modulId = TransaksiMasukDetail::where('id', $kasus->transaksi_masuk_detail_id)->pluck('modul_id')->first();

        if ( $modulId == 3 ) {
            $transaksiRawatInap = Transaksi::with(['tempat_tidur', 'tempat_tidur.ruangan', 'tempat_tidur.ruangan.bangsal'])->where('transaksi_masuk_detail_id', $kasus->transaksi_masuk_detail_id)->first();
            $order->no_bedroom = $transaksiRawatInap->tempat_tidur->nama;
            $order->bangsal_id = $transaksiRawatInap->tempat_tidur->ruangan->bangsal->id;
            $order->ruangan_id = $transaksiRawatInap->tempat_tidur->ruangan->id;
        }


        $order->save();

        $permintaanGizi = new GiziPermintaan();
        $permintaanGizi->order_id = $order->id;
        $permintaanGizi->kasus_id = $kasus->id;
        $permintaanGizi->save();


        $status = 1;
        $message = 'Permintaan makanan baru berhasil dibuat!';
        $title = 'Berhasil!';

        return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
    }

    public function permintaan($request)
    {
        $kasus = $request->kasus;
        $waktu_makan = $request->waktu_makan ?? [];
        $lokasi_id_selected = $request->lokasi_id ?? null;
        $lokasi = Lokasi::find($lokasi_id_selected);
        $last_batch_kasus = GiziPermintaan::where('kasus_id', $kasus->id)->max('batch') ?? 0;
        $update_old_order = GiziPermintaan::where('kasus_id', $kasus->id)->update(['status' => 0]);
        ++$last_batch_kasus;

        foreach ($waktu_makan as $id => $value) {
            $order = new GiziPermintaan();
            $order->waktu_makan_id = $id;
            $order->kasus_id = $kasus->id;
            $order->diet_id = $request->diet;
            $order->bentuk_makanan_id = $request->bentuk_makanan;
            $order->lokasi_id = $lokasi_id_selected;
            $order->bangsal_id = $lokasi->ruangan->bangsal_id ?? null;
            $order->batch = $last_batch_kasus;
            $order->status = 1;
            $order->catatan = $request->catatan ?? null;
            $order->created_by = auth()->user()->id;
            $order->save();
        }
    }
}
