<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\DataRincianIGD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
		$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

		$total = Kasus::where('tipe_igd',1)->whereBetween('created_at',[$start,$end])->count('id');


		return json_encode([
			'status' => 200,
			'data' => $total
		]);
    }

    public function getData(Request $request)
    {
    	$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();
		$data_fetched = $request->datafetched;
		$limit = $request->limit;


		$data = Kasus::where('tipe_igd',1)->whereBetween('created_at',[$start,$end])->with('pasien', 'pasien.alamat_kota.provinsi','pasien.alamat_kecamatan','pasien.alamat_kelurahan','pasien.agama', 'pasien.pendidikan','pasien.pernikahan', 'pasien.tni_keanggotaan', 'pasien.tni_kotama', 'pasien.tni_satker', 'pasien.tni_pangkat', 'pasien.wali',
			'pasien.wali.tni_keanggotaan', 'pasien.wali.tni_kotama', 'pasien.wali.tni_satker', 
			'pasien.wali.tni_pangkat','pasien.jenis_hubungan_keluarga','sep', 'pembayaran', 
			'pembayaran.perusahaan', 'pembayaran.kelas', 'identitas', 'lokasi_first.lokasi',
			'diagnosisUtama.icd10','diagnosisTambahan.icd10','tindakan_icd9.icd9','admin.user')
		->skip($data_fetched)->take($limit)->orderBy('id')->get();

		$array_data = [];
		foreach($data as $index => $item)
		{
			$new_item = new \StdClass();
			$new_item->no = $data_fetched + $index + 1;
			$new_item->no_rm = $item->pasien->no_rm ?? '';
			$new_item->nama = $item->pasien->name ?? '';
			$new_item->nik = $item->pasien->no_identitas ?? '';
			$new_item->alamat = $item->pasien->address ?? '';
			$new_item->provinsi = $item->pasien->alamat_kota->provinsi->nama ?? '';
			$new_item->kota = $item->pasien->alamat_kota->nama ?? '';
			$new_item->kecamatan = $item->pasien->alamat_kecamatan->nama ?? '';
			$new_item->kelurahan = $item->pasien->alamat_kelurahan->nama ?? '';
			$new_item->jenis_kelamin = $item->pasien->jenis_kelamin_lp ?? '';
			$new_item->status_pernikahan = $item->pasien->pernikahan->nama ?? '';
			$new_item->no_hp = $item->pasien->phone ?? '';
			$new_item->tempat_lahir = $item->pasien->place_of_birth ?? '';
			$new_item->tanggal_lahir = $item->pasien->date_of_birth ?? '';
			$new_item->usia = $item->identitas->age ?? '';
			$new_item->pekerjaan = $item->identitas->pekerjaan ?? '';
			$new_item->agama = $item->pasien->agama->nama ?? '';
			$new_item->pendidikan = $item->pasien->pendidikan->nama ?? '';
			$new_item->suku = $item->pasien->suku ?? '';
			$new_item->metode_bayar_perusahaan = $item->pembayaran->perusahaan->nama ?? '';
			$new_item->metode_bayar_kelas = $item->pembayaran->kelas->nama ?? '';
			$new_item->metode_bayar_no_asuransi = $item->pembayaran->no_asuransi ?? '';
			$new_item->no_sep = $item->sep->no_sep ?? '';
			$new_item->lokasi = $item->lokasi_first->lokasi->nama ?? '';
			$new_item->tgl_kunjungan = date("d-m-Y", strtotime($item->created_at));
			$new_item->jam_kunjungan = date("H:i", strtotime($item->created_at));
			$new_item->is_baru = $item->is_baru ? 'Baru' : 'Lama';
			$new_item->dpjp = $item->admin->user->name ?? '';
			$new_item->diagnosisUtama = $item->diagnosisUtama->icd10->code_icd ?? '';

			$array_diagnosa_tambahan = [];

			foreach($item->diagnosisTambahan as $diagnosis)
			{
				$code_icd_temp = $diagnosis->icd10->code_icd ?? '';
				$array_diagnosa_tambahan[] = $code_icd_temp;
			}

			$new_item->diagnosisTambahan = implode(",", $array_diagnosa_tambahan);


			$array_icd9 = [];

			foreach($item->tindakan_icd9 as $tindakan)
			{
				$code_icd_temp = $tindakan->icd9->code_icd ?? '';
				$array_icd9[] = $code_icd_temp;
			}

			$new_item->icd9 = implode(",", $array_icd9);

			if(config('app.is_military'))
			{
				if($item->pasien->is_anggota)
				{
					$new_item->tni_nrp = $item->pasien->tni_nrp ?? '';
					$new_item->tni_keanggotaan = $item->pasien->tni_keanggotaan->nama ?? '';
					$new_item->tni_pangkat = $item->pasien->tni_pangkat->nama ?? '';
					$new_item->tni_kotama = $item->pasien->tni_kotama->nama ?? '';
					$new_item->tni_satker = $item->pasien->tni_satker->nama ?? '';
				}
				else
				{
					$new_item->tni_nrp = '';
					$new_item->tni_keanggotaan = '';
					$new_item->tni_pangkat = '';
					$new_item->tni_kotama = '';
					$new_item->tni_satker = '';
				}
			}

			$new_item->wali_nama = $item->pasien->wali->name ?? '';
			$new_item->wali_nohp = $item->pasien->wali->phone ?? '';
			$new_item->wali_hubungan = $item->pasien->jenis_hubungan_keluarga->nama ?? '';

			if(config('app.is_military'))
			{
				$new_item->wali_tni_nama = $item->pasien->wali->name ?? '';
				$new_item->wali_tni_nrp = $item->pasien->wali->tni_nrp ?? '';
				$new_item->wali_tni_keanggotaan = $item->pasien->wali->tni_keanggotaan->nama ?? '';
				$new_item->wali_tni_pangkat = $item->pasien->wali->tni_pangkat->nama ?? '';
				$new_item->wali_tni_kotama = $item->pasien->wali->tni_kotama->nama ?? '';
				$new_item->wali_tni_satker = $item->pasien->wali->tni_satker->nama ?? '';
				$new_item->wali_tni_hubungan = $item->pasien->wali->tni_hubungan->nama ?? '';
			}
			
			$array_data[] = $new_item;
		}




		return json_encode([
			'status' => 200,
			'data' => $array_data
		]);



    }
}
