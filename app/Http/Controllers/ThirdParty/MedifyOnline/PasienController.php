<?php

namespace App\Http\Controllers\ThirdParty\MedifyOnline;

use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\Pasien\PembayaranPerusahaanType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Poliklinik;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PasienPembayaran;

class PasienController extends Controller
{
	public function getPasien(Request $req)
	{
		app('debugbar')->disable();
		$pasien = Pasien::where('no_rm',$req['no_rm'])
		->where('date_of_birth',$req['tanggal_lahir'])->first();

		if(empty($pasien)) return json_encode([]);

		$pasien_new = new \stdClass();
		$pasien_new->no_identitas = $pasien->no_identitas ?? '';
		$pasien_new->name = $pasien->name ?? '';
		$pasien_new->photo_thumb = $pasien->photo_thumb ?? '';
		$pasien_new->id = $pasien->id ?? '';
		$pasien_new->no_rm = $pasien->no_rm ?? '';
		$pasien_new->gender = $pasien->gender ?? '';
		$pasien_new->place_of_birth = $pasien->place_of_birth ?? '';
		$pasien_new->date_of_birth = $pasien->date_of_birth ?? '';
		$pasien_new->address = $pasien->text_alamat ?? '';
		$pasien_new->usia = $pasien->detailed_age_short ?? '';
		$pasien_new->age = $pasien->age ?? '';


		return json_encode($pasien_new);
	}

	public function getPasienPembayaran(Request $req)
	{
		app('debugbar')->disable();
		$pasien = Pasien::where('no_rm',$req['no_rm'])
		->where('date_of_birth',$req['tanggal_lahir'])->first();
		$tipe_tunai = PembayaranPerusahaanType::where('slug','tunai')->first();
		$perusahaan_id = PembayaranPerusahaan::where('type',$tipe_tunai->id)->get()->pluck('id');

		$pembayaran = PasienPembayaran::where('pasien_id',$pasien->id)->with('perusahaan.tipe','kelas');
		if($req->is_video == 1){
		   $pembayaran = $pembayaran->whereIn('perusahaan_id',$perusahaan_id);
        }
		$pembayaran = $pembayaran->get();

		$new_pembayaran = [];
		foreach($pembayaran as $item)
		{
			$temp = new \stdClass();
			$temp->id = $item->id;
			$temp->nama = $item->perusahaan->nama ?? '';
			$temp->no_asuransi = $item->no_asuransi ?? '';
			$temp->kelas = $item->kelas->nama ?? '';
			$temp->utama = $item->utama ?? 0;
			$temp->tipe = $item->perusahaan->tipe->slug ?? '';
			$new_pembayaran[] = $temp;
		}


		return json_encode($new_pembayaran);
	}


    public function getRujukan(Request $req)
    {
        app('debugbar')->disable();
        $pasien = Pasien::with(['pembayaran.perusahaan.tipe', 'pembayaran.kelas'])
                        ->where('no_rm',$req['no_rm'])
                        ->where('date_of_birth',$req['tanggal_lahir'])->first();
        if($pasien){
            $rujukanBPJS = [];
            foreach ($pasien->pembayaran as $pembayaran) {
                if($pembayaran->perusahaan->type == 1){
                    $request = new Request;
                    $request->merge([
                        'nomor_kartu' => $pembayaran->no_asuransi,
                        'multiple' => "true"
                    ]);
                    $no_rujukan = app('App\Http\Controllers\BPJS\API\Rujukan\ReadController')->getRujukanKartu($request);
                    $no_rujukan = json_decode($no_rujukan);
                    foreach ($no_rujukan->response->rujukan as $item) {
                    	$poli = Poliklinik::where('bpjs_id', $item->poliRujukan->kode)->first();
                    	if($poli){
                    		$item->poliklinik = $poli;
                     	   array_push($rujukanBPJS, $item);
                    	}
                    }
                }
            }
            $rujukRS = app('App\Http\Controllers\RawatJalan\PermintaanRujuk\ReadController')->getTujuanRujuk($req->no_rm, $req->tanggal_lahir);
            return json_encode([
                "rujukanBPJS" => $rujukanBPJS,
                "rujukRS" => $rujukRS
            ]);
        }
        else
            return json_encode([]);
    }

	public function checkApprovalAsuransi(Request $request)
	{
		app('debugbar')->disable();
		$pembayaran_id = $request->pembayaran_id;
		$tanggal_pemesanan = $request->tanggal_pemesanan;

		$pasien_pembayaran = PasienPembayaran::find($pembayaran_id);
		if(empty($pasien_pembayaran->id)) {
			return json_encode
			([
				'payment_status' => 'deny',
				'message' => 'Metode Bayar Tidak Ditemukan'
			]);
		}
		elseif($pasien_pembayaran->perusahaan->tipe->slug == 'bpjs')
		{
			$request_data = new \Illuminate\Http\Request();
			$request_data->replace([
				'nomor_kartu' => $pasien_pembayaran->no_asuransi,
				'multiple' => 1,
			]);

			$rujukan = app('App\Http\Controllers\BPJS\API\Rujukan\ReadController')->getRujukanKartu($request_data);
			$rujukan = json_decode($rujukan);
			$data_rujukan = $rujukan->response->rujukan ?? [];
			if(count($data_rujukan) == 0)
			{
				return json_encode
				([
					'payment_status' => 'deny',
					'message' => 'Rujukan Tidak Ditemukan. Untuk mendapatkan rujukan ke faskes ini silahkan berobat ke faskes tingkat pertama (Puskesmas) terdekat.'
				]);
			}
			else
			{
				return json_encode
				([
					'payment_status' => 'settlement',
					'message' => 'Rujukan Ditemukan. Total Rujukan : '.count($data_rujukan),
				]);
			}

		}

		elseif($pasien_pembayaran->perusahaan->tipe->slug == 'asuransi')
		{
			return json_encode
			([
				'payment_status' => 'settlement',
				'message' => 'Approve Asuransi',
			]);
		}
		else{
			return json_encode
			([
				'payment_status' => 'deny',
				'message' => 'Metode Pembayaran Tidak Valid, Silahkan Coba Lagi.'
			]);
		}
	}

	public function createPasien(Request $request)
	{
        app('debugbar')->disable();
		$request->merge([
			'is_jkn' => 1
		]);
		return app('App\Http\Controllers\Pasien\Pasien\PostController')->APICreatePasien($request);
	}
}
