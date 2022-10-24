<?php

namespace App\Http\Controllers\Pasien\PasienWali;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PasienWali;
use DB;
use Auth;

class EditController extends Controller
{
	public function APIEditKerabatPasien(Request $request)
	{
		DB::beginTransaction();
		try
		{
			$id = $request->input('id');
			$wali = PasienWali::find($id);
			$wali->name = $request->input('name');
			$wali->gender = $request->input('gender');
			$wali->address = $request->input('address');
			$wali->city = $request->input('city');
			$wali->district = $request->input('district');
			$wali->kelurahan = $request->input('kelurahan');
			$wali->phone = $request->input('phone');
			$wali->birthplace = $request->input('birthplace');
			$wali->birthdate = $request->input('birthdate');
			$wali->ktp = $request->input('ktp');
			$wali->pasien_template_id = $request->input('pasien_template_id');
			$wali->is_anggota = $request->input('is_anggota');
			$wali->tni_nama = $request->input('tni_nama');
			$wali->tni_nrp = $request->input('tni_nrp');
			$wali->tni_keanggotaan_id = $request->input('tni_keanggotaan_id');
			$wali->tni_pangkat_id = $request->input('tni_pangkat_id');
			$wali->tni_kotama_id = $request->input('tni_kotama_id');
			$wali->tni_satker_id = $request->input('tni_satker_id');
			$wali->tni_hubungan_type = $request->input('tni_hubungan_type');
			$wali->created_by = Auth::user()->id;

			$wali->save();

			$pasien_id = $request->input('pasien_id');
			$pasien = Pasien::find($pasien_id);
			$pasien->relatives_type = $request->input('relatives_type');
			$pasien->save();

			DB::commit();

			$url = $request->input('redirect_to');

			$data['type'] = 'success';
			$data['title'] = 'Berhasil';
			$data['text'] = 'Data penanggung jawab pasien berhasil diubah';
			$data['url'] = 'pasien/'.$pasien_id.'/'.$url;



		}

		catch (\Exception $e) {
			DB::rollBack();

			$data['type'] = 'error';
			$data['title'] = 'Oops! Gagal';
			$data['text'] = 'Data penanggung jawab pasien gagal diubah. Kesalahan server hubungi admin!';
			$data['url'] = 0;

		}

        	return json_encode($data);


	}
}
