<?php

namespace App\Http\Controllers\ThirdParty\MedifyOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PasienPembayaran;
use App\Models\RawatJalan\Dokter;
use App\Models\RawatJalan\Transaksi;
use App\Models\RawatJalan\PermintaanRujuk;
use App\User;
use App\Models\Hospital\Lokasi;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\Perusahaan;
use App\Models\Keuangan\Akun;
use App\Models\Keuangan\TarifTipe;
use App\Models\Hospital\Kelas;
use App\Models\Kasir\Kasir;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RawatJalanController extends Controller
{
    public function pendaftaranBaru(Request $request)
    {
        app('debugbar')->disable();
        $check_tgl_pemesanan = $this->checkTanggalPemesanan($request);
        if($check_tgl_pemesanan === false){
            $data_return['nomor_antrian']   = 0;
            $data_return['estimasi_waktu']  = 0;
            $data_return['transaksi_id']    = 0;
            $data_return['error']           = "Hanya dapat memesan di tgl sekarang ".indonesian_date(Carbon::now()->format('d-m-Y'))."sampai dengan H+7 kedepan atau ".Indonesian_date(Carbon::now()->addDays(7)->format('d-m-Y'));
            return json_encode($data_return);
        }
    	$pasien = Pasien::where('id',$request->pasien_id)->first();
        $no_rm = $request->pasien_id;
    	$pasien_pembayaran = PasienPembayaran::where('id',$request->bayar_id)->first();
        $kelas_id = Kelas::where('rawat_jalan', 1)->first()->id;

    	$dokter= Dokter::find($request->dokter_id);
        $is_video = $request->is_video ?? 0;
        $durasi = $request->durasi ?? null;
    	$user_dokter = User::where('dokter_id',$dokter->id)->orderBy('id','desc')->first();
 		if($pasien_pembayaran->perusahaan->tipe->slug == 'bpjs') $is_bpjs = 1;
 		else $is_bpjs = 0;

        if($pasien_pembayaran->perusahaan->tipe->slug == 'tunai') $is_tunai = 1;
        else $is_tunai = 0;

        $tarifRetribusi = app('App\Http\Controllers\Keuangan\Tarif\ReadController')->getTarifAdministrasiRawatJalan($pasien_pembayaran->kelas_id ?? $kelas_id, $is_tunai);
        $tagihan = $tarifRetribusi;

        $rujuk = PermintaanRujuk::where('pasien_id', $request->pasien_id)
                    ->where('poli_tujuan_id', $request->poliklinik_id)
                    ->where('status', 0)
                    ->first();

        $request_data = new \Illuminate\Http\Request();
        $request_data->replace([
            'is_online' => 1,
            'is_video' => $is_video,
            'pasien_id' => $pasien->id,
            'pasien_data' => $pasien,
            'bayar_id' => $request->bayar_id,
            'tanggal_pemesanan' => $request->tanggal_pemesanan,
            'is_bpjs' => $is_bpjs,
            'dokter_id' => $request->dokter_id,
            'layanan' => 1, // rawat jalan
            'poliklinik_id' => $request->poliklinik_id,
            'rujuk_id' => $rujuk->id ?? null,
            'kelas' => $pasien_pembayaran->kelas_id ?? $kelas_id,
            'durasi' => $durasi,
        ]);

        if(!$is_tunai){
            $request_data->merge([
                'retribusi' => $tagihan,
            ]);
        }

        $data = app('App\Http\Controllers\Pasien\Pasien\PostController')->APIPendaftaranPasien($request_data);

        $data = json_decode($data);
        $transaksi_rj = Transaksi::find($data->transaksi_id);

        if($is_tunai)
        {
            if(count($tagihan) > 0) 
            {
                $piutang = $this->kirimKasir($tagihan,$user_dokter,$request_data,$transaksi_rj,$no_rm);
                $transaksi_rj->piutang_id = $piutang->id ?? null;
                $transaksi_rj->save();
            }
        }

        $data_return['nomor_antrian'] = $transaksi_rj->nomor_antrian;
        $data_return['estimasi_waktu'] = $transaksi_rj->ordered_at;
        $data_return['transaksi_id'] = $transaksi_rj->id;

		return json_encode($data_return);

    }

    private function kirimKasir($biaya,$user_dokter,$request_data,$transaksi_rj,$no_rm)
    {
    	$lokasi_loket = Lokasi::where('slug', 'administrasi')->first();
    	$total_retribusi = 0;
        $transaksi = [];

        $tarif_kelas_id = Kelas::where('rawat_jalan', 1)->first()->id;
        $tarif_tipe_id = TarifTipe::where('slug', 'default')->first()->id;
    	foreach ($biaya as $key => $item_array) {

    		$item = (object) $item_array;
    		if($item->tarif_id == 0) continue;

    		$tarif = Tarif::find($item->tarif_id);

    		if($tarif->master->kategori->slug == 'rawat-jalan-konsultasi-dokter') $creator = $user_dokter->id ?? 1;
    		else $creator = 1;

    		$newtrans = new \stdClass();
    		$newtrans->tarif_id = $item->tarif_id;
    		$newtrans->deskripsi = $item->nama;
    		$newtrans->kelas_id = $transaksi_rj->kelas_id ?? $tarif_kelas_id;
    		$newtrans->tarif_tipe_id = $tarif_tipe_id;
    		$newtrans->harga = $item->harga;
    		$newtrans->diskon = 0;
    		$newtrans->jumlah = 1;
    		$newtrans->subtotal = $item->harga;
    		$newtrans->keterangan = null;
    		$newtrans->lokasi_id = $lokasi_loket->id;
    		$newtrans->kategori_id = $lokasi_loket->kategori_keuangan_id;
    		$newtrans->created_at = Carbon::now();
    		$newtrans->updated_at = Carbon::now();
    		$newtrans->created_by = $creator;
    		$transaksi[] = $newtrans;

    		$total_retribusi += $item->harga;
    	}

    	$jumlah = $total_retribusi;
        $diskon = 0;
        $total = $total_retribusi;
        $pasien_id = $request_data['pasien_id'];
        $judul = 'Retribusi Pendaftaran Rawat Jalan Online - '.$no_rm.' - '.$request_data['pasien_data']->name;
        $kasir_id = Kasir::where('slug','LIKE','%kasir-rawat-jalan%')->first()->id;

        $lokasi_id = $transaksi_rj->poliklinik->lokasi->id;
        $created_at = Carbon::now();
        $updated_at = Carbon::now();
        $transaksi_details = $transaksi;
        $pasien_pembayaran_id = $request_data['bayar_id'];

        $lokasiNow = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getSingleLokasi($lokasi_id);
        $kategori_id = $lokasiNow->kategori_keuangan_id;
        $pihak_ketiga = "TUNAI";
        $perusahaan_id = Perusahaan::where('tunai', 1)->first()->id; ///tunai perusahaan keuangan
        $kasus_id = null;

        if (!empty($transaksi)) {
            $transaksi_kasir = app('App\Http\Controllers\Keuangan\Piutang\CreateController')
            ->create($kasir_id,$judul,$jumlah,$diskon,$total,$pasien_id,$pihak_ketiga,$kategori_id,
                $created_at,$created_at,$updated_at,
                $transaksi_details,$pasien_pembayaran_id,$lokasi_id,
                null,$perusahaan_id,'Administrasi Pendaftaran Pasien Online - '.$no_rm,null, null, $user_dokter->id ?? null);
        }
        else $transaksi_kasir = null;

        return $transaksi_kasir;
    }


    
    public function getTransaksiToday(Request $req)
    {

        app('debugbar')->disable();
        $pasien = Pasien::with(['pembayaran.perusahaan.tipe', 'pembayaran.kelas'])
                        ->where('no_rm',$req['no_rm'])
                        ->where('no_rm',$req['no_rm'])
                        ->where('date_of_birth',$req['tanggal_lahir'])->first();

        if($pasien){
            $antrian_today = Transaksi::with('poliklinik')
                        ->where([['pasien_id',$pasien->id]])
                        ->whereDate('ordered_at', '=', Carbon::today()->toDateString())
                        ->whereIn('status', [0,3]) // waiting & perlu dikonfirmasi
                        ->orderBy('ordered_at')
                        ->get();
            $antrian_besok = Transaksi::with('poliklinik')
                        ->where([['pasien_id',$pasien->id]])
                        ->whereDate('ordered_at', '=', Carbon::today()->addDays(1)->toDateString())
                        ->whereIn('status', [0,3]) // waiting & perlu dikonfirmasi
                        ->orderBy('ordered_at')
                        ->get();

            return json_encode([
                "transaksi_today" => $antrian_today,
                "transaksi_besok" => $antrian_besok,
            ]);
        }
        else
            return json_encode([]);
        
    }

    public function cancelAppointment(Request $request)
    {
        $alasan = $request->alasan;
        $transaksi_id = $request->transaksi_id;
        $payment_online_tipe = $request->payment_online_tipe;
        $transaksi = Transaksi::with('dokter')->find($transaksi_id);
        $transaksi->cancel_keterangan = $alasan;
        $transaksi->status = -1;
        $transaksi->cancel_at = Carbon::now();
        $transaksi->cancel_by = Auth::user()->id ?? 1;
        $transaksi->payment_online_tipe = $payment_online_tipe;
        $transaksi->payment_online_nomor = null;
        $transaksi->refund_status = $transaksi->pasien_pembayaran->perusahaan->tipe->slug == 'tunai' ? 1 : 2;
        $transaksi->refund_status_by = Auth::user()->id ?? 1;
        $transaksi->save();

        $data_return['message'] = 'berhasil batal appointment';
        $data_return['code'] = 200;
        return json_encode($data_return);
    }

    private function checkTanggalPemesanan($request)
    {   
        #rule batas H+7 dari hari ini.
        $tanggal_pesan = Carbon::parse($request->tanggal_pemesanan)->startOfDay(); 
        $batas_tanggal_pesan = Carbon::now()->addDays(7)->startOfDay();

        if($tanggal_pesan < Carbon::now()->startOfDay() || $tanggal_pesan > $batas_tanggal_pesan)
            return false;
        else
            return true;     
    }
}
