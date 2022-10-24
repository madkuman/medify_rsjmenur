<?php

namespace App\Http\Controllers\Urikkes\Transaksi;

use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifMaster;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Models\Urikkes\Transaksi;
use  App\Models\Urikkes\TransaksiDetail;
use  App\Models\Urikkes\Paket;
use App\Models\Hospital\Lokasi;
use DB;
use Carbon\Carbon;

class CreateController extends Controller
{

    static protected $slug_kasir = 'kasir-medical-checkup';

	public function create($data)
	{
		try{
			$data_request = (object) $data;
			$paket = Paket::find($data_request->paket_urikkes);
			$this->updateAllLastToZero($data_request->pasien_id);
            $data_request->tanggal_pemesanan = !empty($data_request->tanggal_pemesanan) ? Carbon::parse($data_request->tanggal_pemesanan)->toDateString() : Carbon::now()->toDateString();
			$data_request = $this->getAntrian($data_request);
			$transaksi = new Transaksi();
			$transaksi->pasien_id = $data_request->pasien_id;
			$transaksi->nomor_antrian = $data_request->nomor_antrian;
			$transaksi->pasien_pembayaran_id = $data_request->bayar_id;
			$transaksi->total_harga = $paket->total;


			$transaksi->status = 0;
			//ID lokasi dan group Urikkes
			$transaksi->lokasi_id = Lokasi::where('slug','medical-checkup')->first()->id;
			$transaksi->is_last = 1;

			$transaksi->ordered_at = $data_request->ordered_at;
			$transaksi->save();


			$transaksi_detail = $this->createDetail($transaksi->id,$data_request->paket_urikkes, $data_request);


			$tarif_master = TarifMaster::find($paket->tarif_master_id);
			$tarif = $tarif_master->tarif->first();

            $data_tarif['tarif_id'] = $tarif->id;
            $data_tarif['tarif_tipe_id'] = $tarif->tipe_id;
            $data_tarif['tarif_kelas_id'] = $tarif->kelas_id;
            $data_tarif['desc'] = $tarif->deskripsi_temp;

            $data_tarif['unit_price'] = $transaksi->total_harga ?? 0;
            $data_tarif['qty'] = 1;
            $data_tarif['lokasi'] = $transaksi->lokasi_id;
            $data_tarif['kategori_id'] = $transaksi->lokasi->kategori_keuangan->id;

			$transaksi_details[] = app('App\Http\Controllers\Urikkes\Transaksi\PostController')->reshapeKasir($data_tarif);

            $kasir_id = app('App\Http\Controllers\Kasir\Manajemen\ReadController')->getBySlug(self::$slug_kasir)->id;
            $judul = 'Medical Checkup '.$paket->nama.' - '.$transaksi->pasien_detail->name;
            $jumlah = 1;
            $diskon = 0;
            $total = $transaksi->total_harga;
            $pasien_id = $transaksi->pasien_id;
            $pihak_ketiga = "TUNAI";
            $kategori_id = $transaksi->lokasi->kategori_keuangan->id;
            $created_at = Carbon::now();
            $updated_at = Carbon::now();
            $perusahaan_id = 2; ///tunai perusahaan keuangan

            $transaksi_kasir = app('App\Http\Controllers\Keuangan\Piutang\CreateController')
                ->create($kasir_id,$judul,$jumlah,$diskon,$total,$pasien_id,$pihak_ketiga,$kategori_id,
                    $created_at,$created_at,$updated_at,
                    $transaksi_details,$transaksi->pasien_pembayaran_id,$transaksi->lokasi_id,
                    null,$perusahaan_id,'Administrasi Pendaftaran Pasien',null,null,null);

            $transaksi->piutang_id = $transaksi_kasir->id;
            $transaksi->save();

			return $transaksi;
		}catch(Exception $e){
			return null;
		}
	}

	private function createDetail($transaksi_id,$paket_id)
	{
		$paket = Paket::find($paket_id);
		foreach($paket->tarifPaket as $item)
		{
			$detail = app('App\Http\Controllers\Urikkes\TransaksiDetail\CreateController')
				->create($transaksi_id,$item->tarif_id,$paket_id);
		}
	}

	private function updateAllLastToZero($pasien_id)
	{
		$transaksi = Transaksi::where('pasien_id',$pasien_id)->update(['is_last' => 0]);
	}

	public function updateStatusPenunjang($transaksi_id)
	{
		$trans = Transaksi::find($transaksi_id);
		$trans->status_penunjang = 1;
		$trans->save();
	}

	public function permintaanPenunjang($request, $paket, $kasus)
	{
		$req['pasien'] = $kasus->pasien_id;
		$req['kasus_id'] = $kasus->id;
		$req['tipe_layanan'] = 1;
		$req['kirim_kasir'] = 0;
		$req['no_bpjs'] = null;
		$req['tanpa_kasus'] = null;
		$req['pasien_pembayaran_id'] = $kasus->pembayaran->id;
		$req['kelas_pasien'] = $kasus->kelas_id;
		$req['asal_ruang'] = $kasus->lokasi->lokasi->id;
		
		$layanan['radiologi'] = [];
		$layanan['pa'] = [];
		$layanan['pk'] = [];
		$transaksi = Transaksi::find($request->transaksi_id);
		foreach ($transaksi->transaksi_detail as $item) {
			$departemen = ($item->tarif->kategori->slug ?? null);
			switch ($departemen) {
				case 'radiologi':
					array_push($layanan['radiologi'], $item->tarif_id);
					break;
				case 'lab-pa':
					array_push($layanan['pa'], $item->tarif_id);
					break;
				case 'lab-pk':
					array_push($layanan['pk'], $item->tarif_id);
					break;
				default:
					break;
			}
		}
		if (!empty($layanan['radiologi'])) {
			$req['layanan'] = $layanan['radiologi'];
			$request->merge($req);
			$new_radiologi = app('App\Http\Controllers\Radiology\Transaction\CreateController')->APICreate($request, 1); //1 untuk fill status agar tidak dikirim tagihan lagi
			$new_transaksi = app('App\Http\Controllers\Kasus\PenunjangPermintaan\CreateController')->radiologi($request,$new_radiologi);
		}
		if(!empty($layanan['pa'])) {
			$req['layanan'] = $layanan['pa'];
			$request->merge($req);
			$new_labpa = app('App\Http\Controllers\LabPA\Transaction\CreateController')->APICreate($request, 1); //1 untuk fill status agar tidak dikirim tagihan lagi
			$new_transaksi = app('App\Http\Controllers\Kasus\PenunjangPermintaan\CreateController')->labpa($request,$new_labpa);
		}
		if(!empty($layanan['pk'])) {
			$req['layanan'] = $layanan['pk'];
			$request->merge($req);
			$new_labpk = app('App\Http\Controllers\LabPK\Transaksi\CreateController')->APICreate($request, 1); //1 untuk fill status agar tidak dikirim tagihan lagi
			$new_transaksi = app('App\Http\Controllers\Kasus\PenunjangPermintaan\CreateController')->labpk($request,$new_labpk);
		}
		if(!is_null($kasus->urikkes_penunjang_baru))
			app('App\Http\Controllers\Urikkes\Transaksi\CreateController')->updateStatusPenunjang($kasus->urikkes_penunjang_baru->id);
	}

	public function getAntrian($data,$estimasi_px = 3)
    {
        $transaksi = Transaksi::whereDate('ordered_at',$data->tanggal_pemesanan);

        //nomor antrian
        $new_antrian = (clone $transaksi)->get()->count() + 1;
        $new_antrian = str_pad($new_antrian, 3, "0", STR_PAD_LEFT);
        $kode= 'MCU-';
        $data->nomor_antrian = $kode.$new_antrian;

        //waktu estimasi
        $latest_transaksi = (clone $transaksi)->latest()->first();
        if(!empty($latest_transaksi)){
            $estimasi = Carbon::parse($latest_transaksi->ordered_at)->addMinutes($estimasi_px);
        }else{
            $estimasi = Carbon::parse($data->tanggal_pemesanan)->addHours(8);
        }
        $data->ordered_at = $estimasi;

        return $data;
    }
}
