<?php

namespace App\Http\Controllers\Kasus\Kasus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Identitas;
use App\Models\Kasus\Kasus;
use App\Models\Hospital\TransaksiMasuk as GlobalTransaksiMasuk;
use App\Models\Hospital\TransaksiMasukDetail as GlobalTransaksiMasukDetail;

use App\Models\IGD\Transaksi as IGDTransaksi;
use App\Models\RawatInap\Transaksi as RawatInapTransaksi;
use App\Models\RawatJalan\Transaksi as RawatJalanTransaksi;
use App\Models\RawatInap\TempatTidur;
use Carbon\Carbon;
use App\Models\Kasus\BPJSSEP;
use DB;
use Bugsnag;


use Illuminate\Support\Facades\Session;

class EditController extends Controller
{
	public function updateIdentitas(Request $request, $nomorKasus) 
	{
		$kasus = Kasus::where('nomor_kasus', $nomorKasus)->first();
		$identitas = Identitas::where('kasus_id', $kasus->id)->first();
		$identitas->nama = $request->input('nama');
		$identitas->save();

		return back()->with('message', 'Identitas Pasien berhasil diubah!');
	}


	public function removeKasusPrevTransaksi($kasus_id)
	{
		$transaksi_igd = IGDTransaksi::where('kasus_id',$kasus_id)->whereNull('waktu_keluar')->update(['waktu_keluar' => Carbon::now()]);

		$transaksi_rawatinap = RawatInapTransaksi::where('kasus_id',$kasus_id)->whereNull('waktu_keluar')->whereIn('status',[1,2])->get();

		foreach($transaksi_rawatinap as $t_inap_transaksi)
		{
			$bed = TempatTidur::find($t_inap_transaksi->tempat_tidur_id);
			if(!empty($bed))
			{
				//JIKA ADA YANG BOOKING UNTUK KAMAR TERSEBUT
				if (!empty($bed->booking_id)) {
					
					#jika dia booking, dia belum sempet nempatin ruangan, tapi udah KRS
					if ($bed->booking_id == $t_inap_transaksi->id) {
						$t_inap_transaksi->status=3; #set status keluar
						$t_inap_transaksi->save();

						$bed->booking_id = NULL;
						$bed->save();
					} 
					elseif($bed->transaksi_id == $t_inap_transaksi->id) {
						
						#orang pertama pindah
						$bed->transaksi_id = $bed->booking_id;
						$bed->booking_id = NULL;
						$bed->save();
						if ($t_inap_transaksi->status==1) {
							$t_inap_transaksi->status=3; #set status keluar
							$t_inap_transaksi->save();

							$toi_log = app('App\Http\Controllers\RawatInap\ToiLog\EditController')
							->updateKrs($bed->id,$t_inap_transaksi->id);

							//mindah pasien yang booking (kasus)
							$new_trans_inap = RawatInapTransaksi::find($bed->transaksi_id);
							if(!empty($new_trans_inap->kedatangan_at)){
								#kalo dia sudah konfirmasi kedatangan, maka toi log akan di update
								#jika belum datang, nanti updateMrs toilog nya waktu dia konfirm kedatangan
								$toi_log = app('App\Http\Controllers\RawatInap\ToiLog\EditController')
								->updateMrs($bed->id,$new_trans_inap->id);
							}

							$new_trans_inap->status=1;
							$new_trans_inap->save();
						}						
					}					
				}
				else {

					$toi_log = app('App\Http\Controllers\RawatInap\ToiLog\EditController')
					->updateKrs($bed->id,$t_inap_transaksi->id);

					$bed->transaksi_id = NULL;
					$bed->save();
				}



				$ruangan = $bed->ruangan;
				$name_ruang = $ruangan->nama_applicare;
				$kode_ruang = $ruangan->kode_applicare;
				$tersedia =  empty($ruangan->count_empty) ? 0 : $ruangan->count_empty;
				$kapasitas = $ruangan->count_bed;
				if(!empty($ruangan->kelas_applicare && config("app.bpjs_enable"))){
					$data['kelas_applicare'] = $ruangan->kelas_applicare;
					$data['kode_ruang'] = $kode_ruang;
					$data['nama_ruang'] = $name_ruang;
					$data['tersedia'] = $tersedia;
					$data['kapasitas'] = $kapasitas;
					$res_applicare = app('App\Http\Controllers\BPJS\API\Applicare\EditController')->editRuangan($data);
					if(isset($kelas_applicare) && $res_applicare->metadata->code == 1)
						$ruangan->kelas_applicare = $kelas_applicare;
				}
			}
			$t_inap_transaksi->waktu_keluar = Carbon::now();
			$t_inap_transaksi->save();
		}

		$transaksi_rawatjalan = RawatJalanTransaksi::where('kasus_id',$kasus_id)->whereNull('waktu_keluar')->get();
		foreach ($transaksi_rawatjalan as $item)
		{
			$poli = RawatJalanTransaksi::find($item->id);
			
			$poli->waktu_keluar = Carbon::now();
			$poli->status = 2;
			$poli->save();
		}
	}

	public function changeActiveSEPtoLatestSEP($kasus_id)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{
			$sep = BPJSSEP::whereHas('kasus', function($q)use ($kasus_id){
				$q->where('kasus_id', $kasus_id);
			})->orderBy('id','desc')->first();
			$kasus = Kasus::find($kasus_id);
			$kasus->sep_id = $sep->id;
			$kasus->save();

			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();
			return $kasus;

		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();

		}
	}

	public function updateKasusBaru($kasus_id)
	{
		$kasus = Kasus::find($kasus_id);
		$kasus->is_baru = 1;
		$kasus->save();
	}

	public function editPasienPembayaran($kasus_id,$pasien_pembayaran_id)
	{	
		$kasus = Kasus::find($kasus_id);
		$kasus->pasien_pembayaran_id = $pasien_pembayaran_id;
		$kasus->save();
		return $kasus;

	}
    public function updateDatangIgd($kasus_id,$datangigd_at)
    {
        $kasus = Kasus::find($kasus_id);
        if(empty($kasus->datangigd_at)){
        $kasus->datangigd_at = $datangigd_at;
        $kasus->save();
        }
    }
    public function updateLayaniIgd($kasus_id,$layani_igd_at)
    {
        $kasus = Kasus::find($kasus_id);
            $kasus->layani_igd_at = $layani_igd_at;
            $kasus->save();
    }

    public function updateDataKasus($kasus_id,$pasien,$bayar_id,$nomor_sep)
	{
		$kasus = Kasus::find($kasus_id);

		if (!empty($pasien->id)) {
			$kasus->pasien_id = $pasien->id;
		}
		$kasus->pasien_pembayaran_id = $bayar_id;
		$kasus->sep_id = $nomor_sep; // bisa kosong
		$kasus->save();

		if ($bayar_id!=null) {
			$pasien_pembayaran = PasienPembayaran::find($bayar_id);
		}
		else {
			$pasien_pembayaran = null;
		}

		$identitas = app('App\Http\Controllers\Kasus\Kasus\CreateController')->insertIdentitas($kasus, $pasien, $pasien_pembayaran);
		
		if (!empty($pasien_pembayaran)) {
			// dd($kasus->lokasi);
			$total_plafon = 0;
			if(!empty($kasus->lokasi->lokasi))
			{
				if ($kasus->lokasi->lokasi->departemen->id == 2)
					if($transaksi_lokal_id != null)
					{
						$total_plafon = app('App\Http\Controllers\Kasus\Kasus\CreateController')->getPoliPlafon($transaksi_lokal_id); //bisa kosong
					}	
			}
			else
				$total_plafon = 0;

			if($pasien_pembayaran->perusahaan->tipe->slug == 'bpjs')
			{
				$request = new \Illuminate\Http\Request();
				$request['custom_sep'] = $nomor_sep;
				
				app('App\Http\Controllers\Kasus\Identitas\PostController')->editSEPKasus($request,$kasus->nomor_kasus);
			}
		}
		return $kasus;
	}
}
