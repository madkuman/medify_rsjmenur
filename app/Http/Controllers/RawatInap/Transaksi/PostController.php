<?php

namespace App\Http\Controllers\RawatInap\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\TransaksiObatTelaahObat;
use App\Models\RawatInap\Transaksi;
use App\Models\RawatInap\Bangsal;
use App\Models\RawatInap\TempatTidur;
use App\Models\Pasien\Pasien;
use Carbon\Carbon;
use App\Models\Kasus\Lokasi;
use App\Models\Kasus\Identitas;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Tagihan;
use App\Models\Kasus\TagihanDetail;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifTipe;
use App\User;
use Auth;
use DB;
use Bugsnag;
use DateTime;
use App\Models\IGD\Transaksi as IGDTransaksi;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Models\Hospital\UserGroup;
use App\Models\Kasus\Kolaborator;


class PostController extends Controller
{
	public function pendaftaranPasien($id)
	{
		DB::connection('rawatinap')->beginTransaction();
		DB::connection('kasus')->beginTransaction();
		try
		{
			$transaksi_global = app('App\Http\Controllers\Hospital\Transaksi\CreateController')->create(3,1,$id);

			$transaksi = new Transaksi;
			$transaksi->pasien_id = $id;
			$transaksi->transaksi_masuk_detail_id = $transaksi_global->id;
			$transaksi->kasus_id = 0;
			$transaksi->status = 0;
			$transaksi->created_by = Auth::user()->id;
			$transaksi->save();


			$transaksi_global = app('App\Http\Controllers\Hospital\Transaksi\EditController')->edit($transaksi_global->id,$transaksi->id);

			$status = 1;
			$message = 'Pasien berhasil didaftarkan';
			$title = 'Berhasil!';

			
			DB::connection('rawatinap')->commit();
			DB::connection('kasus')->commit();
			return redirect('rawatinap/transaksi/pendaftaran/ruangan?transaksi_id='.$transaksi->id)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('rawatinap')->rollback();
			DB::connection('kasus')->rollback();

		}
	}

	public function printFinal($id) //setelah konfirmasi
    {
        $data['transaksi'] = Transaksi::find($id);
        $data['bed'] = TempatTidur::find($data['transaksi']->tempat_tidur_id);
        $data['pasien'] = Pasien::find($data['transaksi']->pasien_id);
        $data['routeFlag'] = 1;
        $data['link'] = "transaksi/pendaftaran/permintaan";
        return view('rawatinap.transaksi.pendaftaran.print-baru',$data);
    }

	public function pendaftaranKonfirmasi(Request $request)
	{
		$transaksi_id = $request->transaksi_id;
		$bed_id = $request->bed_id;
		$booking = $request->is_booking;
		$transaksi = Transaksi::find($transaksi_id);
		$bed = TempatTidur::find($bed_id);
		$pasien = Pasien::find($transaksi->pasien_id);
		$kasus = Kasus::where('id', $transaksi->kasus_id)->with('pembayaran.perusahaan')->first();
		$kasus->sep = $kasus->active_sep;
		$sep = app('App\Http\Controllers\BPJS\SEP\ReadController')->getByNomorPasien($pasien->id);
		$sep = json_decode($sep);

		if(!empty($bed->transaksi)){
			if($transaksi->kasus_id == $bed->transaksi->kasus_id)
			{
				$status = -1;
				$message = 'Anda mendaftarkan pasien ke bed pasien saat ini.';
				$title = 'Gagal!';
				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}

		$data['bed'] = $bed;
		$data['booking'] = $booking;
		$data['transaksi'] = $transaksi;
		$data['pasien'] = $pasien;
		$data['kasus'] = $kasus;
		$data['nomor_kasus'] = $request->nomor_kasus;
		$data['routeFlag'] = 1;
		$data['sep']=$sep;
		$data['link'] = "transaksi/pendaftaran/permintaan";
		return view('rawatinap.transaksi.pendaftaran.konfirmasi',$data);
		

	}

	public function pendaftaranKonfirmasiPembayaran(Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('rawatinap')->beginTransaction();
		try
		{
			$transaksi = Transaksi::find($request->transaksi);
			$transaksi->is_bayar_changed = 1;
			$transaksi->save();


			$kasus_id = $transaksi->kasus_id;
        		$kasus = Kasus::find($kasus_id);
			$pembayaran_utama_id = $request->pembayaran_utama_id;
			$pembayaran_tambahan = $request->pembayaran_tambahan;

			$edit = app('App\Http\Controllers\Kasus\Identitas\EditController')
			->updateMetodeBayar($kasus->nomor_kasus,$pembayaran_utama_id,$pembayaran_tambahan);
			

			DB::connection('kasus')->commit();
			DB::connection('rawatinap')->commit();


			$status = 0;
			$message = 'Cara pembayaran berhasil di edit';
			$title = 'Gagal!';
			return redirect('rawatinap/transaksi/pendaftaran/ruangan?transaksi_id='.$transaksi->id)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);


		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('rawatinap')->rollback();

			$status = 0;
			$message = 'Cara pembayaran gagal di edit';
			$title = 'Gagal!';
			return redirect('rawatinap/transaksi/pendaftaran/ruangan?transaksi_id='.$transaksi->id)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
		

	}

	public function konfirmasiDatang(Request $req, $id)
	{
		DB::connection('rawatinap')->beginTransaction();
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try {
			$transaksi = Transaksi::find($id);
			
			if($transaksi->status == 2){		
				$bed = TempatTidur::where('booking_id', $id)->first();
			}
			else
			{
				$bed = TempatTidur::where('transaksi_id', $id)->first();
				$toi_log = app('App\Http\Controllers\RawatInap\ToiLog\EditController')
				->updateMrs($bed->id,$transaksi->id);
			}

			$lokasi = $bed->ruangan->lokasi_id;
			$kelas = $bed->ruangan->kelas;

			$this->changeKasusLokasi($transaksi->kasus_id,$lokasi);

			//nambah tagihan
			$tagihan = $this->tambahTagihan($transaksi->kasus_id,$transaksi);
			//undang perawat
			$undangan = $this->undangPerawat($transaksi->kasus_id,$bed, TRUE);
			//ganti kelas
			$this->changeKasusKelas($transaksi->kasus_id,$kelas);

			$kasus = Kasus::find($transaksi->kasus_id);
			if(empty($kasus->mrs_at)){
				$kasus->mrs_at = $transaksi->waktu_masuk;
			}
			$kasus->tipe_ri = 1;
			$kasus->save();
			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','administrasi-rawatinap-masuk',$transaksi->id);

			$pasien = Pasien::find($transaksi->pasien_id);
			$transaksi->usia_masuk = $pasien->getAgeDayAttribute(Carbon::today()->toDateString());
			$transaksi->los = 1;
			$transaksi->kedatangan_at = Carbon::now();
			$transaksi->lokasi_departemen_id = $kasus->lokasi->lokasi->lokasi_departemen_id;
			$transaksi->save();

			$tanggal = Carbon::today()->startOfDay();
			$hari_perawatan = app('App\Http\Controllers\RawatInap\StatistikHariPerawatan\CreateController')->create($tanggal, $transaksi->tempat_tidur_id, $transaksi->id);

			$ruangan = $bed->ruangan;
			$kelas_applicare = $ruangan->kelas_applicare;
			$name_ruang = $ruangan->nama_applicare;
			$kode_ruang = $ruangan->kode_applicare;
			$tersedia =  empty($ruangan->count_empty) ? 0 : $ruangan->count_empty;
			$kapasitas = $ruangan->count_bed;

			DB::connection('rawatinap')->commit();
			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();

			$status = 1;
			$message = 'Kedatangan pasien berhasil dikonfirmasi';
			$title = 'Berhasil!';

			return redirect('kasus/'.$kasus->nomor_kasus)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
			
		} catch (\Exception $e) {
			DB::connection('rawatinap')->rollback();
			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			$status = 0;
			$message = 'Kedatangan pasien gagal di konfirmasi';
			$title = 'Gagal!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}		
	}

	public function pendaftaranSubmit(Request $request)
	{
		DB::connection('rawatinap')->beginTransaction();
		DB::connection('kasus')->beginTransaction();
		DB::connection('rekammedis')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{
			$transaksi_id = $request->transaksi_id;
			$bed_id = $request->bed_id;
			$is_booking = $request->is_booking;
			$tempat_tidur_bayi = $request->tempat_tidur_bayi;
			$nomor_kasus = $request->nomor_kasus;
			$no_sep = $request->no_sep;

			$transaksi = Transaksi::find($transaksi_id);
			if($transaksi->status != 0)
			{
				return redirect('rawatinap/transaksi/pendaftaran')
				->with('message', 'Pasien Telah Didaftarkan')
				->with('title','Gagal')
				->with('status', -1);
			}
			$bed = TempatTidur::find($bed_id);

			if(isset($bed->transaksi_id) && $is_booking == 0){
				$is_booking = 1;
			}elseif(isset($bed->booking_id) && $is_booking == 1){
				return redirect('rawatinap/transaksi/pendaftaran/ruangan?transaksi_id='.$transaksi_id)
				->with('message', 'Ruangan Telah Dibooking Pasien Lain')
				->with('title','Gagal!')
				->with('status', -1);
			}

			#persiapan untuk kasus
			$judul_kasus = 'Rawat Inap #'.$transaksi_id;
			$pasien = Pasien::find($transaksi->pasien_id);
			$lokasi = $bed->ruangan->lokasi_id;
			//jika belum punya kasus
			#maka dia buat baru

			$kasus = Kasus::find($transaksi->kasus_id);
			#kasus menunjuk ke transaksi detail yang sedang aktif saat ini
			#kasus menghapus record penginapan sebelumnya IGD atau Rawat Inap didalam edit controllernya
			$remove = app('App\Http\Controllers\Kasus\Kasus\EditController')->removeKasusPrevTransaksi($kasus->id);
			//$newTransaksiMasukDetail = app('App\Http\Controllers\Kasus\Kasus\EditController')->changeActiveTransaksiMasukDetail($kasus->id,$transaksi->transaksi_masuk_detail_id);
			
			$transaksi->tempat_tidur_bayi = $tempat_tidur_bayi;
			$transaksi->tempat_tidur_id = $bed_id;
			$transaksi->waktu_masuk = Carbon::now();

			//$pasien = Pasien::find($item->pasien_id);
			$undangan = $this->undangPerawat($transaksi->kasus_id,$bed, FALSE);

			if($is_booking==1){
				$transaksi->status = 2;
				$bed->booking_id = $transaksi_id;
				$message = 'Pasien berhasil memesan kamar di rawat inap';
				$title = 'Berhasil!';
			}
			else if($is_booking==0){
				$transaksi->status = 1;
				$bed->transaksi_id = $transaksi_id;
				$message = 'Pasien berhasil didaftarkan ke rawat inap';
				$title = 'Berhasil!';
			}
			$status = 1;
			$kasus->save();
			$transaksi->save();
			$bed->save();

			$rm_transaksi = $this->permintaanRekamMedis($transaksi);
			$transaksi = app('App\Http\Controllers\RawatInap\Transaksi\EditController')->editTransaksiRM($transaksi->id,$rm_transaksi->id);

			$nomor_kasus_gizi = $kasus->nomor_kasus;
			
			$desc = "Terdapat Kasus Rawat Inap Baru, No kasus ".$nomor_kasus_gizi."";
			$url = "kasus/".$nomor_kasus_gizi."";
			$ahli_gizi = User::where('profesi',10)->get();
			foreach ($ahli_gizi as $ag) 
			{
				$notify = app('App\Http\Controllers\Users\Notification\CreateController')->create($ag->id, 1, $desc, $url);
			}
			if(isset($no_sep)){
				$request['custom_sep'] = $request->no_sep;
				app('App\Http\Controllers\Kasus\Identitas\PostController')->editSEPKasus($request,$kasus->nomor_kasus);
			}




			DB::connection('rawatinap')->commit();
			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();
			DB::connection('rekammedis')->commit();
			return redirect('rawatinap/transaksi/pendaftaran/print-final/'.$transaksi_id)
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('rawatinap')->rollback();
			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();
			DB::connection('rekammedis')->rollback();

		}
	}



	public function pendaftaranTolak(Request $request)
	{
		DB::connection('rawatinap')->beginTransaction();
		DB::connection('kasus')->beginTransaction();
		try
		{
			$id = $request->transaksi_id;
			$keterangan = $request->keterangan;

			$transaksi = Transaksi::find($id);
			$transaksi->status = -1;
			$transaksi->tolak_keterangan = $keterangan;
			$transaksi->save();

			#done
			$status = 1;
			$message = 'Permintan rawat inap berhasil ditolak';
			$title = 'Berhasil!';

			
			DB::connection('rawatinap')->commit();
			DB::connection('kasus')->commit();
			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('rawatinap')->rollback();
			DB::connection('kasus')->rollback();

		}
	}

	public function changeKasusLokasi($kasus_id,$lokasi)
	{
		$id_user = Auth::user()->id;
		// TODO Pindah RUangan Pemesanan
		//app('App\Http\Controllers\Gizi\Pemesanan\PostController')->pindahRuangan($kasus_id,$lokasi);
		$data = new Lokasi;
		$data->kasus_id = $kasus_id;
		$data->lokasi_id = $lokasi;
		$data->created_by = $id_user;
		$data->save();


		return 1;
	}

	public function changeKasusKelas($kasus_id,$kelas)
	{
		$id_user = Auth::user()->id;

		$data = Kasus::find($kasus_id);
		$data->kelas_id = $kelas;
		$data->save();
		return 1;
	}

	public function tambahTagihan($kasus_id,$transaksi)
	{
		$tipe_default = TarifTipe::where('slug','default')->first();
		$kasus = $transaksi->kasus;
		$tarif = $transaksi->tempat_tidur->ruangan->tarif;
		if(empty($tarif)){
			return back()
			->with('message', 'Tarif tidak ditemukan. Silahkan masukkan tarif ruangan melalui menu pengaturan bangsal.')
			->with('title','Gagal')
			->with('status', -1);

		}
		$data['kasus_id'] = $kasus->id;
		$data['tarif_kelas_id'] = $tarif->kelas->id;
		$data['tarif_tipe_id'] = $tipe_default->id;
		$data['desc'] = $tarif->master->deskripsi;
		$data['kategori_id'] = $kasus->lokasi->lokasi->kategori_keuangan_id;
		$data['lokasi'] = $kasus->lokasi->lokasi->id;
		$data['unit_price'] = $tarif->harga;
		$data['qty'] = 1;
		$data['daftar_harga_id'] = null;
		$data['tarif_id'] = $tarif->id;
		if(!empty($kasus->active_sep))
			$data['sep_id'] = $kasus->active_sep->id;
		else
			$data['sep_id'] = null;

		$data['departemen_id'] = 3; 

		$saveToTagihan = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($data);

		if($transaksi->is_pindah == 0){
		    foreach ($transaksi->tempat_tidur->ruangan->tarif_lain ?? [] as $item){
		        $tarif = $item->tarif;
                $data['kasus_id'] = $kasus->id;
                $data['tarif_kelas_id'] = $tarif->kelas_id != 0 ? $tarif->kelas_id : $transaksi->tempat_tidur->ruangan->kelas;
                $data['tarif_tipe_id'] = $tipe_default->id;
                $data['desc'] = $tarif->master->deskripsi;
                $data['kategori_id'] = $kasus->lokasi->lokasi->kategori_keuangan_id;
                $data['lokasi'] = $kasus->lokasi->lokasi->id;
                $data['unit_price'] = $tarif->harga;
                $data['qty'] = 1;
                $data['daftar_harga_id'] = null;
                $data['tarif_id'] = $tarif->id;
                app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($data);
            }
        }


	}

	private function undangPerawat($kasus_id,$bed, $datang){
		//notif ke grup bangsal
		$kolaborator = Kolaborator::where('kasus_id',$kasus_id)->pluck('user_id')->toArray();
		$kasus = Kasus::find($kasus_id);
		if (!empty($bed->ruangan->bangsal->group_id)) {
			$group_id = $bed->ruangan->bangsal->group_id;
			$member = UserGroup::where('group_id',$group_id)->get();
			if (!empty($member)) {
				foreach ($member as $item) 
					if(!empty($user->profesi)){{
						$user = User::find($item->users_id);
						if($user->profesi=='2' && !in_array($user->id, $kolaborator) && $datang){
							$data = new Kolaborator;
							$data->kasus_id = $kasus->id;
							$data->user_id = $item->users_id;
							$data->admin = 0;
							$data->invitation = 0;
							$data->created_by = Auth::user()->id;
							$data->save();
						}
						$notif = app('App\Http\Controllers\Users\Notification\CreateController')->create($user->id, Auth::user()->id, Auth::user()->name.' mengundang anda pada Kasus', 'kasus/'.$kasus->nomor_kasus);
					}
				}
			}
		}
	}



    private function permintaanRekamMedis($transaksi)
    {
        $holder_group_id = $transaksi->tempat_tidur->ruangan->bangsal->group_id;
        $lokasi = $transaksi->tempat_tidur->ruangan->lokasi->nama;

        $data_rm = [];
        $data_rm['pasien_id'] = $transaksi->pasien_id;
        $data_rm['status'] = 1; //konfirm pengiriman
        $data_rm['holder_type'] = 2; //group
        $data_rm['holder_user_id'] = null;
        $data_rm['holder_group_id'] = $holder_group_id;
        $data_rm['holder_keterangan'] = null;

        $data_rm['tujuan_id'] = 1; //Pelayanan pasien
        $data_rm['lokasi'] = $lokasi;
        $data_rm['jenis'] = 2;//transfer

        $data_rm['sender_confirmed_at'] = Carbon::now();
        $data_rm['sender_confirmed_by'] = Auth::user()->id;
        $data_rm['sender_keterangan'] = null;

        $rm_trans = app('App\Http\Controllers\RekamMedis\Transaksi\CreateController')->create($data_rm);
        return $rm_trans;
    }

    
    public function konfirmasiFile($transaksi_id)
    {
    	$transaksi = Transaksi::find($transaksi_id);
    	$data = app('App\Http\Controllers\RekamMedis\Transaksi\EditController')->konfirmasiPenerimaan($transaksi->rm_transaksi_id);
    	$status = 1;
    	$message = $data['message'];
    	$title = 'Berhasil!';

    	return back()
    	->with('message', $message)
    	->with('active_nav','cppt')
    	->with('title',$title)
    	->with('status', $status);
    	return back();
    }

	public function serahTerimaObat(Request $request, $transaksi_id) {
		
		try {
			if (!is_countable($request->transaksi_farmasi_id) || count($request->transaksi_farmasi_id) == 0) {
				return back()->with([
					'status' => -1,
					'title' => 'Gagal',
					'message' => 'Pilih Transaksi Farmasi terlebih dahulu',
				]);
			}
			DB::connection('farmasi')->beginTransaction();
			foreach ($request->transaksi_farmasi_id as $transaksi_farmasi_id) {
				$transaksi_obat_telaah_obat = TransaksiObatTelaahObat::where('slug', 'penerimaan_perawat')->where('transaksi_id', $transaksi_farmasi_id)->first();
				if ($transaksi_obat_telaah_obat == null) {
					$transaksi_obat_telaah_obat = new TransaksiObatTelaahObat;
					$transaksi_obat_telaah_obat->transaksi_id = $transaksi_farmasi_id;
					$transaksi_obat_telaah_obat->slug = 'penerimaan_perawat';
					foreach ($request->telaah['penerimaan_perawat'] ?? [] as $key => $value) {
						$transaksi_obat_telaah_obat->$key = $value;
					}
					$transaksi_obat_telaah_obat->telaah_at = now()->toDateTimeString();
					$transaksi_obat_telaah_obat->telaah_by = auth()->id();
				}
				$serah_terima_aturan = json_decode($transaksi_obat_telaah_obat->serah_terima_aturan, true) ?? [];
				$serah_terima_aturan[] = [
					'tanggal' => Carbon::createFromFormat('d/m/Y', $request->tanggal_serah)->toDateString(),
					'timestamp' => now()->toDateTimeString(),
					'aturan_pakai' => array_values($request->aturan_pakai),
				];
				$transaksi_obat_telaah_obat->serah_terima_aturan = json_encode($serah_terima_aturan);
				
				$transaksi_obat_telaah_obat->save();
			}
			DB::connection('farmasi')->commit();

			return back()->with([
				'window_close' => true,
			]);
		} catch (\Exception $e) {
			DB::connection('farmasi')->rollback();
			app(\App\Http\Controllers\Error\Handler::class)->bugsnag($e);

			return back()->with([
				'status' => -1,
				'title' => 'Gagal!',
				'message' => 'Terjadi Kesalahan Server',
			]);
		}
	}
}
