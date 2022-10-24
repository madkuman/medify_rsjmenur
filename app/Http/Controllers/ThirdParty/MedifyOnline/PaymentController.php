<?php

namespace App\Http\Controllers\ThirdParty\MedifyOnline;

use App\Models\RawatJalan\MasterTelekonsultasi;
use App\Models\Urikkes\Paket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\TarifMaster;
use App\Models\Keuangan\Tarif;
use App\Models\Pasien\PasienPembayaran;
use App\Models\RawatJalan\Poliklinik;

class PaymentController extends Controller
{
	public function getDaftarBiaya(Request $request)
	{
		app('debugbar')->disable();
		if(!empty($request->paket_id))
        {
            $daftar_biaya = $this->daftarBiayaMedicalCheckup($request);
        }else{
		    $daftar_biaya = $this->daftarBiayaRawatJalan($request);
        }

		return json_encode($daftar_biaya);

	}

	public function daftarBiayaRawatJalan($request)
    {
        $slugs_biaya = ['karcis-poli'];
        $daftar_biaya = [];
        $tarif_master = TarifMaster::whereIn('slug',$slugs_biaya)->get();
        $pasien_pembayaran = PasienPembayaran::where('id',$request->metode_bayar_id)->first();
        $poliklinik = Poliklinik::where('id',$request->klinik_id)->first();
        foreach($tarif_master as $item)
        {
            $tarif = Tarif::where('tarif_master_id',$item->id)->first();
            if(empty($tarif)) continue;

            $temp = new \stdClass();
            $temp->nama = $item->deskripsi;
            $temp->harga = $tarif->harga;
            $temp->id = $tarif->id;
            $daftar_biaya[] = $temp;
        }


        $temp = new \stdClass();
        $temp->nama = $poliklinik->tarif_dokter_spesialis->master->deskripsi;
        $temp->harga =  $poliklinik->tarif_dokter_spesialis->harga;
        $temp->id =  $poliklinik->tarif_dokter_spesialis->id;
        $daftar_biaya[] = $temp;

        return $daftar_biaya;
    }

    public function daftarBiayaMedicalCheckup($request)
    {
        $daftar_biaya = [];
        $paket = Paket::find($request->paket_id);
        $temp = new \stdClass();
        $temp->nama = $paket->nama;
        $temp->harga = $paket->total;
        $temp->id = $paket->id;
        $daftar_biaya[] = $temp;
        return $daftar_biaya;
    }

    public function getDaftarBiayaTelekonsultasi(Request $request)
    {
        app('debugbar')->disable();
        $daftar_biaya = [];
        $master_telekonsultasi = MasterTelekonsultasi::where('poliklinik_id',$request->klinik_id)->get();
        foreach ($master_telekonsultasi as $item)
        {
            $temp = new \stdClass();
            $temp->nama = $item->tarif->master->deskripsi;
            $temp->harga = $item->tarif->harga;
            $temp->id = $item->tarif_id;
            $temp->durasi = $item->durasi;
            $daftar_biaya[] = $temp;
        }
        return json_encode($daftar_biaya);

    }
}
