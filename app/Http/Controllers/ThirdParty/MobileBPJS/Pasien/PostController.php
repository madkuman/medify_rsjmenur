<?php

namespace App\Http\Controllers\ThirdParty\MobileBPJS\Pasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Transaksi;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PembayaranPerusahaanType;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\Pasien\PasienPembayaran;
use Validator;
use DB;
use Carbon\Carbon;

class PostController extends Controller
{
    public function checkIn(Request $request)
    {
        DB::connection('thirdp')->beginTransaction();
        try {
            app('debugbar')->disable();
            $headers['token'] = $request->header('x-token');
            $headers['username'] = $request->header('x-username');
            $user_token = app('App\Http\Controllers\ThirdParty\MobileBPJS\ReadController')->cekUserToken($headers);
            if (empty($user_token)) {
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')->errorAuth();
            }

            /** validator */
            $rules =  [
                'kodebooking' => 'required',
                'waktu'    => 'required',
            ];
            $alert = [
                'required' => ':attribute harus diisi',
            ];
            $validator = Validator::make($request->all(), $rules, $alert);

            if (!$validator->passes()) {
                $message = $validator->errors()->all();
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->error(null, 201, $message);
            }
            /** end validator */

            $data = [
                'kodebooking' => $request->kodebooking,
                'waktu' => $request->waktu
            ];

            $transaksi = Transaksi::where('id', $data['kodebooking'])->where('status', '!=', -1)->first();
            if (empty($transaksi)) {
                $message = 'Transaksi dengan kodebooking ' . $data['kodebooking'] . ' tidak ditemukan';
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->error(null, 201, $message);
            }

            if ($transaksi->status == -1) {
                $message = 'Transaksi dengan kodebooking ' . $data['kodebooking'] . ' telah dibatalkan sebelumnya';
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->error(null, 201, $message);
            }


            // $waktu_start = Carbon::createFromTimestamp($data['waktu'] / 1000)->toDateTimeString();
            // $waktu_end = Carbon::parse($waktu_start)->endOfDay()->toDateTimeString();
            // $waktu_transaksi = Transaksi::where('id', $transaksi->id)
            // 					->whereBetween('ordered_at', [$waktu_start, $waktu_end])
            // 					->first();

            // if (empty($waktu_transaksi)) {
            // 	$message = 'Transaksi antara waktu '.$waktu_start.' sampai '.$waktu_end.' tidak ditemukan';
            // 	return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
            // 		->error(null, 201, $message);
            // }

            $response = [];
            $log = [
                'url'           => 'pasien/check-in',
                'jenis_request' => 'post',
                'param'         => json_encode($data),
                'response'      => json_encode($response),
                'created_by'    => $user_token->created_by,
            ];
            app('App\Http\Controllers\ThirdParty\MobileBPJS\CreateController')->createLog($log);
            DB::connection('thirdp')->commit();
            $message = 'OK, mohon ke loket daftar online';
            return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                ->error($response, 200, $message);
        } catch (\Exception $e) {
            DB::connection('thirdp')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                ->error();
        }
    }

    public function pasienBaru(Request $request)
    {
        DB::connection('thirdp')->beginTransaction();
        DB::connection('patients')->beginTransaction();
        try {
            app('debugbar')->disable();
            $headers['token'] = $request->header('x-token');
            $headers['username'] = $request->header('x-username');
            $user_token = app('App\Http\Controllers\ThirdParty\MobileBPJS\ReadController')->cekUserToken($headers);
            if (empty($user_token)) {
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')->errorAuth();
            }

            /** validator */
            $rules =  [
                'nomorkartu' => 'required|min:5',
                'nik' => 'required|min:5',
                'nomorkk' => 'required',
                'nama' => 'required',
                'jeniskelamin' => 'required|in:L,P',
                'tanggallahir' => 'required|date_format:Y-m-d',
                'nohp' => 'required|min:6',
                'alamat' => 'required',
                'kodeprop' => 'required',
                'namaprop' => 'required',
                'kodedati2' => 'required',
                'namadati2' => 'required',
                'kodekec' => 'required',
                'namakec' => 'required',
                'kodekel' => 'required',
                'namakel' => 'required',
                'rw' => 'required',
                'rt' => 'required',
            ];
            $alert = [
                'required' => ':attribute harus diisi',
                'in' => ':attribute tidak sesuai',
                'date_format' => ':attribute format harus Y-m-d',
            ];
            $validator = Validator::make($request->all(), $rules, $alert);

            if (!$validator->passes()) {
                $message = $validator->errors()->all();
                if (count($message))
                    $message = $message[0];
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->error(null, 201, $message);
            }
            /** end validator */

            $today = Carbon::now();
            $tanggal_lahir = Carbon::parse($request->tanggallahir);
            if ($tanggal_lahir > $today) {
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->error(null, 201, 'Tanggal lahir lebih dari hari ini!');
            }

            $data = [
                'nomorkartu' => $request->nomorkartu,
                'nik' => $request->nik,
                'nomorkk' => $request->nomorkk,
                'nama' => $request->nama,
                'jeniskelamin' => $request->jeniskelamin,
                'tanggallahir' => $request->tanggallahir,
                'nohp' => $request->nohp,
                'alamat' => $request->alamat,
                'kodeprop' => $request->kodeprop,
                'namaprop' => $request->namaprop,
                'kodedati2' => $request->kodedati2,
                'namadati2' => $request->namadati2,
                'kodekec' => $request->kodekec,
                'namakec' => $request->namakec,
                'kodekel' => $request->kodekel,
                'namakel' => $request->namakel,
                'rw' => $request->rw,
                'rt' => $request->rt
            ];

            $nomor_kartu = $request->nomorkartu;
            if (!is_numeric($nomor_kartu) || strlen($nomor_kartu) != 13) {
                $message = 'Format Nomor Kartu Tidak Sesuai';
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->error(null, 201, $message);
            }

            $nik = $request->nik;
            if (!is_numeric($nik) || strlen($nik) != 16) {
                $message = 'Format NIK Tidak Sesuai';
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->error(null, 201, $message);
            }

            // cek pasien berdasarkan nik
            $cek_nik = Pasien::where('no_identitas', $request->nik)->first();
            if (!empty($cek_nik)) {
                $message = 'Pasien dengan nik ' . $request->nik . ' sudah terdaftar';
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->error(null, 201, $message);
            }

            // cek kartu bpjs sudah pernah daftar atau belum
            // $cek_no_bpjs = PasienPembayaran::where('no_asuransi', $request->nomorkartu)->first();
            // if (!empty($cek_no_bpjs)) {
            //     $message = 'Pasien dengan nomor kartu '.$request->nomorkartu.' sudah pernah daftar';
            // 	return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
            // 		->error(null, 201, $message);
            // }

            // cek provinsi
            $prov = app('App\Http\Controllers\Pasien\AlamatProvinsi\ReadController')->getProvinsiByNama($request->namaprop);
            // if (empty($prov)) {
            //     $message = 'Provinsi dengan kode '.$request->kodeprop.' dan nama '.$request->namaprop.' tidak ditemukan';
            // 	return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
            // 		->error(null, 201, $message);
            // }

            // cek kota / kabupaten
            $kode = implode('-', [$request->kodeprop, $request->kodedati2]);
            $kota = app('App\Http\Controllers\Pasien\AlamatKota\ReadController')->getKotaByNama($request->namadati2);
            // if (empty($kota)) {
            //     $message = 'Kota/kabupaten dengan kode '.$request->kodedati2.' dan nama '.$request->namadati2.' tidak ditemukan';
            // 	return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
            // 		->error(null, 201, $message);
            // }

            // cek kecamatan
            $kec = app('App\Http\Controllers\Pasien\AlamatKecamatan\ReadController')->getKecamatanByNama($request->namakec);
            // if (empty($kec)) {
            //     $message = 'Kecamatan dengan kode '.$request->kodekec.' tidak ditemukan';
            // 	return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
            // 		->error(null, 201, $message);
            // }

            // cek kelurahan
            $kel = app('App\Http\Controllers\Pasien\AlamatKelurahan\ReadController')->getKelurahanByNama($request->namakel);
            // if (empty($kel)) {
            //     $message = 'Kelurahan dengan kode '.$request->kodekel.' tidak ditemukan';
            // 	return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
            // 		->error(null, 201, $message);
            // }

            $merge = [
                'city' => $kota->id ?? null,
                'district' => $kec->id ?? null,
                'kelurahan' => $kel->id ?? null,
            ];
            $request = $request->merge($merge);
            $pasien = $this->APICreatePasien($request);
            if (!$pasien) {
                $message = ['Gagal menambah pasien. kesalahan server, silahkan hubungi admin'];
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->error(null, 201, $message);
            }

            $message = "Harap datang ke admisi untuk melengkapi data rekam medis";
            $response = [
                'norm' => $pasien['pasien']->no_rm
            ];
            $log = [
                'url'           => 'pasien/baru',
                'jenis_request' => 'post',
                'param'         => json_encode($data),
                'response'      => json_encode($response),
                'created_by'    => $user_token->created_by,
            ];
            app('App\Http\Controllers\ThirdParty\MobileBPJS\CreateController')->createLog($log);
            DB::connection('thirdp')->commit();
            DB::connection('patients')->commit();

            return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                ->success($response, $message);
        } catch (\Exception $e) {
            DB::connection('thirdp')->rollback();
            DB::connection('patients')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                ->error();
        }
    }

    private function APICreatePasien($request)
    {
        try {
            $pasien = [
                'jenis_kartu_identitas_id' => 1,
                'nomor_identitas' => $request->nik,
                'name' => $request->nama,
                'gender' => $request->jeniskelamin == "L" ? 1 : 2,
                'marriage' => NULL,
                'place_of_birth' => NULL,
                'date_of_birth' => $request->tanggallahir,
                'address' => $request->alamat,
                'address_domisili' => $request->alamat,
                'city' => $request->city,
                'district' => $request->district,
                'kelurahan' => $request->kelurahan,
                'phone' => $request->nohp,
                'job' => NULL,
                'agama' => NULL,
                'bahasa' => NULL,
                'suku' => NULL,
                'alergi' => NULL,
                'nama_ayah' => NULL,
                'nama_ibu' => NULL,
                'nama_suami' => NULL,
                'nama_istri' => NULL,
                'identity' => NULL,
                'identity_thumb' => NULL,
                'pendidikan' => NULL,
                'is_anggota' => NULL,
                'tni_nrp' => NULL,
                'tni_keanggotaan_id' => NULL,
                'tni_pangkat_id' => NULL,
                'tni_kotama_id' => NULL,
                'tni_satker_id' => NULL,
                'tni_korps_id' => NULL,
                'tni_jabatan' => NULL,
                'tni_pangkat_singkat' => NULL,
                'avatar' => 'assets/img/placeholder.jpg',
                'avatar_thumb' => 'assets/img/placeholder.jpg',
                'is_baru' => 1,
                'kategori_pasien' => 5,
                'is_jkn' => 1
            ];

            $kerabat = [
                'ktp' => NULL,
                'name' => NULL,
                'gender' => NULL,
                'birthplace' => NULL,
                'birthdate' => NULL,
                'address' => NULL,
                'city' => NULL,
                'district' => NULL,
                'kelurahan' => NULL,
                'phone' => NULL,
                'relative' => NULL,
                'is_anggota' => NULL,
                'tni_nama_kerabat' => NULL,
                'tni_nrp_kerabat' => NULL,
                'tni_keanggotaan_kerabat' => NULL,
                'tni_pangkat_kerabat' => NULL,
                'tni_kotama_kerabat' => NULL,
                'tni_satker_kerabat' => NULL,
                'tni_relative_kerabat' => NULL,
            ];

            $new_pasien = app('App\Http\Controllers\Pasien\Pasien\CreateController')->create($pasien);
            $new_kerabat = app('App\Http\Controllers\Pasien\PasienWali\CreateController')->create($kerabat);

            $pasien_rel = Pasien::find($new_pasien['pasien']['id']);
            $pasien_rel->relatives_id = $new_kerabat['kerabat']['id'];
            $pasien_rel->relatives_type = NULL;
            $pasien_rel->save();

            $perusahaan_pembayaran_id = 1; // BPJS Mandiri
            $param = [
                'pasien_id' => $new_pasien['pasien']['id'],
                'no_asuransi' => $request->nomorkartu,
                'perusahaan_id' => $perusahaan_pembayaran_id, // BPJS Mandiri
                'kelas_id' => 3,
                'utama' => 1
            ];
            // save pembayaran untuk bpjs
            app('App\Http\Controllers\Pasien\PasienPembayaran\CreateController')->create($param);

            $perusahaan_pembayaran = PembayaranPerusahaan::find($perusahaan_pembayaran_id);
            if ($perusahaan_pembayaran->tipe->slug != 'tunai') {
                $tunai_tipe = PembayaranPerusahaanType::where('slug', 'tunai')->first();
                $perusahaan_tunai = PembayaranPerusahaan::where('type', $tunai_tipe->id)->first();
                $param['no_asuransi'] = '';
                $param['perusahaan_id'] = $perusahaan_tunai->id;
                $param['utama'] = 0;
            }

            // save pembayran untuk tunai
            app('App\Http\Controllers\Pasien\PasienPembayaran\CreateController')->create($param);

            return $new_pasien;
        } catch (\Exception $e) {
            $return['status'] = -1;

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

        return $return;
    }
}
