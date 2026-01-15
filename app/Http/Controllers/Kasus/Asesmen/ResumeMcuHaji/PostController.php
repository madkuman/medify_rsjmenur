<?php

namespace App\Http\Controllers\Kasus\Asesmen\ResumeMcuHaji;

use DB;
use App\User;
use Carbon\Carbon;
use App\Models\Kasus\Kasus;
use Illuminate\Http\Request;
use App\Models\Kasus\AlatBantu;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
	public function __construct()
	{
		$this->asesmen_title = 'Resume MCU Haji';
		$this->asesmen_namespace = 'App\Http\Controllers\Kasus\Asesmen\ResumeMcuHaji';
		$this->asesmen_slug = 'resume-mcu-haji';
	}

	public function submitForm($nomor_kasus, Request $request)
	{
		DB::connection('kasus')->beginTransaction();

		try {
			// dd($request->all());
			$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
			$id = $request->id;
			// $tanggal = Carbon::createFromFormat('Y-m-d', $request->tanggal_pemeriksaan)->format('d-m-Y');

			$hasil = [];
			$riwayat_penyakit_keluarga = [];
			$input = $request->all();
			foreach ($input as $key => $val) {
				if ($key == '_token')    continue;
				if ($key == 'kasus')    continue;
				if ($key == 'nomor_porsi') $hasil[$key] = $val;
				if ($key == 'tanggal_pemeriksaan') $hasil[$key] = $val;
				if ($key == 'psikolog') $hasil[$key] = $val;
				if ($key == 'dokter_umum') $hasil[$key] = $val;
				if ($key == 'dokter_sppd') $hasil[$key] = $val;
				if ($key == 'keluhan_saat_ini') $hasil[$key] = $val;
				if ($key == 'riwayat_penyakit_dahulu') $hasil[$key] = $val;
				if ($key == 'obat_yang_rutin_dikonsumsi') $hasil[$key] = $val;
				if ($key == 'data_alergi_obat') $hasil[$key] = $val;
				if ($key == 'riwayat_penyakit_keluarga') $hasil[$key] = $val;
				if ($key == 'riwayat_penyakit_keluarga_lainnya') $hasil[$key] = $val;
				if ($key == 'riwayat_sosial') $hasil[$key] = $val;
				if ($key == 'riwayat_sosial_lainnya') $hasil[$key] = $val;
				if ($key == 'is_riwayat_jantung') $hasil[$key] = $val;
				if ($key == 'terakhir_kali_serangan') $hasil[$key] = $val;
				if ($key == 'sistol') $hasil[$key] = $val;
				if ($key == 'diastol') $hasil[$key] = $val;
				if ($key == 'nadi') $hasil[$key] = $val;
				if ($key == 'suhu') $hasil[$key] = $val;
				if ($key == 'rr') $hasil[$key] = $val;
				if ($key == 'lingkar_perut') $hasil[$key] = $val;
				if ($key == 'visus_od') $hasil[$key] = $val;
				if ($key == 'visus_os') $hasil[$key] = $val;
				if ($key == 'bb') $hasil[$key] = $val;
				if ($key == 'tb') $hasil[$key] = $val;
				if ($key == 'bmi') $hasil[$key] = $val;
				if ($key == 'kategori_bmi') $hasil[$key] = $val;
				if ($key == 'postur_tubuh') $hasil[$key] = $val;
				if ($key == 'inspeksi_dan_palpasi') $hasil[$key] = $val;
				if ($key == 'kekuatan_otot_ekstremitas_upper') $hasil[$key] = $val;
				if ($key == 'kekuatan_otot_ekstremitas_lower') $hasil[$key] = $val;
				if ($key == 'refleks') $hasil[$key] = $val;
				if ($key == 'pemeriksaan_ekg') $hasil[$key] = $val;
				if ($key == 'srq') $hasil[$key] = $val;
				// if ($key == 'pemeriksaan_kognitif') $hasil[$key] = $val;
				if ($key == 'clockTestInput') $hasil[$key] = $val;
				if ($key == 'clockTestStatus') $hasil[$key] = $val;
				if ($key == 'kataTestInput') $hasil[$key] = $val;
				if ($key == 'kataTestStatus') $hasil[$key] = $val;
				if ($key == 'amt') $hasil[$key] = $val;
				if ($key == 'category_amt') $hasil[$key] = $val;
				if ($key == 'barthel') $hasil[$key] = $val;
				if ($key == 'category_barthel') $hasil[$key] = $val;
				if ($key == 'hasil_lab_abnormal') $hasil[$key] = $val;
				if ($key == 'hasil_plano_test') $hasil[$key] = $val;
				if ($key == 'hasil_cxr') $hasil[$key] = $val;
				if ($key == 'resume') $hasil[$key] = $val;
				if ($key == 'icd10_1') $hasil[$key] = $val;
				if ($key == 'icd10_2') $hasil[$key] = $val;
				if ($key == 'icd10_3') $hasil[$key] = $val;
				if ($key == 'icd10_4') $hasil[$key] = $val;
				if ($key == 'icd10_5') $hasil[$key] = $val;
				if ($key == 'icd10_6') $hasil[$key] = $val;
				if ($key == 'ppok_dan_emfisema') $hasil[$key] = $val;
				if ($key == 'stroke') $hasil[$key] = $val;
				if ($key == 'tumor') $hasil[$key] = $val;
				if ($key == 'gagal_jantung') $hasil[$key] = $val;
				if ($key == 'tuberkulosis') $hasil[$key] = $val;
				if ($key == 'hiv_aids') $hasil[$key] = $val;
				if ($key == 'fraktur_tungkai') $hasil[$key] = $val;
				if ($key == 'tindak_lanjut') $hasil[$key] = $val;
				if ($key == 'tgl_hasil_tindak_lanjut') $hasil[$key] = $val;
				if ($key == 'hasil_tindak_lanjut') $hasil[$key] = $val;
				if ($key == 'status_istitaah') $hasil[$key] = $val;
				if ($key == 'alasan_tidak_memenuhi_syarat_istitaah_kesehatan_haji_sementara') $hasil[$key] = $val;
				if ($key == 'alasan_tidak_memenuhi_syarat_istitaah_kesehatan_haji') $hasil[$key] = $val;
				if ($key == 'saran') $hasil[$key] = $val;
			}
			if ($id != null) {
				$alatBantu = AlatBantu::find($id);
				$alatBantu->updated_by = Auth::user()->id;
				$alatBantu->updated_by = Auth::user()->id;
			} else {
				$alatBantu = new AlatBantu;
				$alatBantu->created_by = Auth::user()->id;
				$alatBantu->created_by = Auth::user()->id;
			}

			$alatBantu->kasus_id = $kasus->id;
			$alatBantu->type = 'resume-mcu-haji';
			$alatBantu->val = json_encode($hasil);
			$alatBantu->save();

			DB::connection('kasus')->commit();

			if ($id != null) {
				return redirect('kasus/' . $nomor_kasus . '/asesmen/' . $this->asesmen_slug . '/edit/' . $id)
					->with('status', 1)
					->with('title', 'Sukses')
					->with('message', 'Resume Haji Berhasil Diperbaharui!');
			} else {
				return redirect('kasus/' . $nomor_kasus . '/asesmen/' . $this->asesmen_slug)
					->with('status', 1)
					->with('title', 'Sukses')
					->with('message', 'Resume Haji Berhasil Dibuat!');
			}
		} catch (\Exception $e) {
			DB::connection('kasus')->rollBack();
			$data['type'] = 'error';
			$data['title'] = 'Gagal';
			$data['text'] = 'Gagal : Kesalahan Server, silahkan hubungi admin';
			$data['url'] = 0;
			$data['error'] = $e->getMessage();

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}

	public function delete(Request $request)
	{
		DB::connection('kasus')->beginTransaction();

		try {
			$id = $request->id;

			$form = AlatBantu::find($id);
			$form->delete();

			DB::connection('kasus')->commit();

			return back()
				->with('status', 1)
				->with('title', 'Sukses')
				->with('message', 'Resume Haji Berhasil di Hapus');
		} catch (\Exception $e) {
			DB::connection('kasus')->rollBack();
			$data['type'] = 'error';
			$data['title'] = 'Gagal';
			$data['text'] = 'Gagal : Kesalahan Server, silahkan hubungi admin';
			$data['url'] = 0;
			$data['error'] = $e->getMessage();

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}

	public function searchUser(Request $request)
	{
		$parameter = $request->name ?? '';
		$user = User::select('id', 'name', 'ttd')
			->where('profesi', 1)
			->where('name', 'like', "%" . $parameter . '%')
			->paginate(10);

		$data['code'] = 200;
		$data['message'] = 'Success';
		$data['data'] = $user;
		return json_encode($data);
	}

	public function searchUserPsikolog(Request $request)
	{
		$parameter = $request->name ?? '';
		$user = User::select('id', 'name', 'ttd')
			->where('profesi', 4)
			->where('name', 'like', "%" . $parameter . '%')
			->paginate(10);

		$data['code'] = 200;
		$data['message'] = 'Success';
		$data['data'] = $user;
		return json_encode($data);
	}

	public function addTTD(Request $request)
	{
		DB::connection('kasus')->beginTransaction();

		try {
			// ttd
			// upload image from canvas
			$img_base64 = $request->imgBase64;
			$img_base64 = str_replace('data:image/png;base64,', '', $img_base64);
			$img_base64 = str_replace(' ', '+', $img_base64);
			$img_data = base64_decode($img_base64);
			$img_dir = app('App\Http\Controllers\Functions\ImageUploader')->upload($img_data, 'ttd');
			$success = file_put_contents($img_dir['file_original'], $img_data);

			if ($success) {
				$alat_bantu = AlatBantu::find($request->id);

				$newVal = (object) json_decode($alat_bantu->val);
				if ($request->type == 'ttd_persetujuan_pasien') {
					$newVal->persetujuan_pasien = $request->persetujuan_pasien;
					$newVal->ttd_persetujuan_pasien = $img_dir['file_original'];
				}
				$alat_bantu->val = json_encode($newVal);
				$alat_bantu->updated_by = Auth::user()->id;
				$alat_bantu->save();

				$data['type'] = 'success';
				$data['title'] = 'Berhasil';
				$data['text'] = 'Berhasil menandatangani form ini';

				DB::connection('kasus')->commit();
			} else {
				$data['type'] = 'error';
				$data['title'] = 'Gagal';
				$data['text'] = 'Gagal mengunggah tanda tangan. Silahkan hapus tanda tangan dan coba lagi.';
			}

			return response()->json($data, 200);
		} catch (\Exception $e) {
			DB::connection('kasus')->rollBack();
			$data['type'] = 'error';
			$data['title'] = 'Gagal';
			$data['text'] = 'Gagal mengunggah tanda tangan : Kesalahan Server, silahkan hubungi admin';
			$data['url'] = 0;
			$data['error'] = $e->getMessage();

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}
}
