<?php

namespace App\Http\Controllers\Pasien\Pasien;

use App\Jobs\QueueArtisan;
use App\Models\RawatJalan\Transaksi;
use Illuminate\Http\Request;
use App\Exports\Pasien\InvoiceMorbiditas;

use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PasienWali;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Pasien\PembayaranPerusahaanType;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\Hospital\Lokasi;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifTipe;
use App\Models\RawatJalan\Transaksi as TransaksiRajal;
use App\Models\Kasus\Tagihan;
use App\Models\Kasus\Kasus;
use App\Models\RawatJalan\Poliklinik;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use App\Models\Kasir\Kasir;
use App\Models\Pasien\AsalRujukan;
use Carbon\Carbon;
use DB;
use Bugsnag;
use Auth;
use Illuminate\Support\Facades\Artisan;


class PostController extends Controller
{

    public function updateDaftarOnline(Request $request, $id)
    {
        DB::connection('rawatjalan')->beginTransaction();
        try {
            $sep = $request->sep;
            $sep_manual = $request->custom_sep;
            $tunai = $request->pembayaran_utama_id;

            $transaksi = TransaksiRajal::find($id);
            $transaksi->status = 0;
            $transaksi->konfirmasi_by = Auth::user()->id;
            $transaksi->konfirmasi_at = Carbon::now();
            if (isset($sep)) {
                $transaksi->nomor_sep = json_decode($sep)->no_sep;
            } elseif (isset($tunai)) {
                $transaksi->nomor_sep = null;
            } else {
                $transaksi->nomor_sep = $sep_manual;
            }
            $transaksi->save();

            if (config('medify.third-party.jkn_online.on')) {
                if ($transaksi->is_online == 1) { // task id 1-3 untuk daftar online, untuk daftar offline ada apipendaftaranpasien
                    $carbon_today = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                    $carbon_today = strtotime($carbon_today);
                    $pasien = $transaksi->pasien;
                    if ($pasien->is_baru == 1) {
                        $waktu = ($carbon_today - (rand(300, 600))) * 1000;
                        $data_1['kodebooking'] = $transaksi->id;
                        $data_1['taskid'] = 1;
                        $data_1['waktu'] = $waktu;

                        dispatch(new QueueArtisan('command:update-task-jkn-id', ['kodebooking' => $transaksi->id, 'taskid' => 1, 'waktu' => $waktu, 'jenisresep' => 'Tidak ada']));
                        //$returned = app(\App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean\PostController::class)->updateTaskId($data_1);
                        //$returned = json_decode($returned);
                        //$metadata = isset($returned->metadata) ? $returned->metadata : $returned->metaData;
                        //if ($metadata->code != "200") {
                        //$data_log['kodebooking'] = $transaksi->id;
                        //$data_log['response'] = json_encode($returned);

                        //app(\App\Http\Controllers\ThirdParty\LogErrorJkn\CreateController::class)->create($data_log);
                        //} else {
                        //$data_log['kodebooking'] = $transaksi->id;
                        //$data_log['task_id'] = 1;
                        //$data_log['waktu'] = $waktu;
                        //$data_log['response'] = json_encode($returned);
                        //$data_log['request'] = $data_1;

                        //app(\App\Http\Controllers\ThirdParty\LogJkn\CreateController::class)->create($data_log);
                        //}
                        $transaksi = Transaksi::find($transaksi->id);
                        $transaksi->task_id_jkn = 1;
                        $transaksi->save();

                        $waktu = ($carbon_today - (rand(60, 300))) * 1000;
                        $data_2['kodebooking'] = $transaksi->id;
                        $data_2['taskid'] = 2;
                        $data_2['waktu'] = $waktu;

                        dispatch(new QueueArtisan('command:update-task-jkn-id', ['kodebooking' => $transaksi->id, 'taskid' => 2, 'waktu' => $waktu]));
                        //$returned = app(\App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean\PostController::class)->updateTaskId($data_2);
                        //$returned = json_decode($returned);
                        //$metadata = isset($returned->metadata) ? $returned->metadata : $returned->metaData;
                        //if ($metadata->code != "200") {
                        //$data_log['kodebooking'] = $transaksi->id;
                        //$data_log['response'] = json_encode($returned);

                        //app(\App\Http\Controllers\ThirdParty\LogErrorJkn\CreateController::class)->create($data_log);
                        //} else {
                        //$data_log['kodebooking'] = $transaksi->id;
                        //$data_log['task_id'] = 2;
                        //$data_log['waktu'] = $waktu;
                        //$data_log['response'] = json_encode($returned);
                        //$data_log['request'] = $data_2;

                        //app(\App\Http\Controllers\ThirdParty\LogJkn\CreateController::class)->create($data_log);
                        //}
                        $transaksi = Transaksi::find($transaksi->id);
                        $transaksi->task_id_jkn = 2;
                        $transaksi->save();
                    }
                    $carbon_today = $carbon_today * 1000;
                    $data['kodebooking'] = $transaksi->id;
                    $data['taskid'] = 3;
                    $data['waktu'] = $carbon_today;
                    dispatch(new QueueArtisan('command:update-task-jkn-id', ['kodebooking' => $transaksi->id, 'taskid' => 3, 'waktu' => $carbon_today]));
                    //$returned = app(\App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean\PostController::class)->updateTaskId($data);
                    //$returned = json_decode($returned);
                    //$metadata = isset($returned->metadata) ? $returned->metadata : $returned->metaData;
                    //if ($metadata->code != "200") {
                    //$data_log['kodebooking'] = $transaksi->id;
                    //$data_log['response'] = json_encode($returned);

                    //app(\App\Http\Controllers\ThirdParty\LogErrorJkn\CreateController::class)->create($data_log);
                    //} else {
                    //$data_log['kodebooking'] = $transaksi->id;
                    //$data_log['task_id'] = 3;
                    //$data_log['waktu'] = $waktu;
                    //$data_log['response'] = json_encode($returned);
                    //$data_log['request'] = $data;

                    //app(\App\Http\Controllers\ThirdParty\LogJkn\CreateController::class)->create($data_log);
                    //}
                    $transaksi = Transaksi::find($transaksi->id);
                    $transaksi->task_id_jkn = 3;
                    $transaksi->save();
                }
            }

            DB::connection('rawatjalan')->commit();

            $status = 0;
            $message = 'Cara pembayaran berhasil di edit';
            $title = 'Sukses!';

            return redirect('/rawatjalan/transaksi/pendaftaran/' . $id)
                ->with('message', $message)
                ->with('title', $title)
                ->with('status', $status);
        } catch (\Exception $e) {

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('rawatjalan')->rollback();

            $status = 0;
            $message = 'Cara pembayaran gagal di edit';
            $title = 'Gagal!';

            return back()
                ->with('message', $message)
                ->with('title', $title)
                ->with('status', $status);
        }
    }

    public function APICreatePasien(Request $request)
    {

        /*UNTUK REQUEST BUAT PASIEN BARU VIA JQUERY AJAX JSON*/
        app('debugbar')->disable();
        DB::connection('patients')->beginTransaction();

        try {
            $birthdate = Carbon::createFromFormat('Y-m-d', $request->input('birthdate'))->toDateString();

            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $image = app('App\Http\Controllers\Functions\ImageUploader')->upload($avatar, 'pasien');
                $avatar = $image['file_original'];
                $avatar_thumb = $image['file_thumbnail'];
            } else {
                $avatar = 'assets/img/placeholder.jpg';
                $avatar_thumb = $avatar;
            }

            // Image Identity
            if ($request->hasFile('foto_identitas')) {
                $identity = $request->file('foto_identitas');
                $image = app('App\Http\Controllers\Functions\ImageUploader')->upload($identity, 'identitypasien');
                $identity = $image['file_original'];
                $identity_thumb = $image['file_thumbnail'];
            } else {
                $identity = 'assets/img/placeholder.jpg';
                $identity_thumb = $identity;
            }

            if ($request->hasFile('file_ktp')) {
                $berkas_ktp = $request->file('file_ktp');
                $image = app('App\Http\Controllers\Functions\ImageUploader')->upload($berkas_ktp, 'pasien');
                $file_ktp = $image['file_original'];
                $file_ktp_thumb = $image['file_thumbnail'];
            } else {
                $file_ktp = NULL;
                $file_ktp_thumb = NULL;
            }

            if ($request->hasFile('file_kk')) {
                $berkas_kk = $request->file('file_kk');
                $image = app('App\Http\Controllers\Functions\ImageUploader')->upload($berkas_kk, 'pasien');
                $file_kk = $image['file_original'];
                $file_kk_thumb = $image['file_thumbnail'];
            } else {
                $file_kk = NULL;
                $file_kk_thumb = NULL;
            }

            if ($request->hasFile('file_kartu_asuransi')) {
                $berkas_kartu_asuransi = $request->file('file_kartu_asuransi');
                $image = app('App\Http\Controllers\Functions\ImageUploader')->upload($berkas_kartu_asuransi, 'pasien');
                $file_kartu_asuransi = $image['file_original'];
                $file_kartu_asuransi_thumb = $image['file_thumbnail'];
            } else {
                $file_kartu_asuransi = NULL;
                $file_kartu_asuransi_thumb = NULL;
            }

            $pasien = array(
                'jenis_kartu_identitas_id' => $request->input('jenis_kartu_identitas'),
                'nomor_identitas' => $request->nomor_identitas,
                'kategori_pasien' => $request->input('kategori_pasien') ?? 0,
                'name' => $request->input('name'),
                'gender' => $request->input('gender'),
                'marriage' => $request->input('marriage'),
                'place_of_birth' => $request->input('birthplace'),
                'date_of_birth' => $birthdate,
                'address' => $request->input('address'),
                'address_domisili' => $request->input('address_domisili'),
                'city' => $request->input('city'),
                'district' => $request->input('district'),
                'kelurahan' => $request->input('kelurahan'),
                'phone' => $request->input('phone'),
                'job' => $request->input('occupation'),
                'agama' => $request->input('agama'),
                'suku' => $request->input('suku'),
                'alergi' => $request->input('alergi'),
                'nama_ayah' => $request->input('nama_ayah'),
                'nama_ibu' => $request->input('nama_ibu'),
                'nama_suami' => $request->input('nama_suami'),
                'nama_istri' => $request->input('nama_istri'),
                'pendidikan' => $request->input('pendidikan'),
                'is_anggota' => $request->input('is_anggota'),
                'tni_nrp' => $request->input('tni_nrp'),
                'tni_keanggotaan_id' => $request->input('tni_keanggotaan'),
                'tni_pangkat_id' => $request->input('tni_pangkat'),
                'tni_kotama_id' => $request->input('tni_kotama'),
                'tni_satker_id' => $request->input('tni_satker'),
                'tni_korps_id' => $request->input('tni_korps'),
                'tni_jabatan' => $request->input('tni_jabatan'),
                'tni_pangkat_singkat' => $request->input('tni_pangkat_singkat'),
                'avatar' => $avatar,
                'avatar_thumb' => $avatar_thumb,
                'file_ktp' => $file_ktp,
                'file_ktp_thumb' => $file_ktp_thumb,
                'file_kk' => $file_kk,
                'file_kk_thumb' => $file_kk_thumb,
                'file_kartu_asuransi' => $file_kartu_asuransi,
                'file_kartu_asuransi_thumb' => $file_kartu_asuransi_thumb,
                'is_jkn' => $request->is_jkn ?? 0
            );

            $kerabat = array(
                'ktp' => NULL,
                'name' => $request->input('nameKerabat'),
                'gender' => $request->input('genderKerabat'),
                'birthplace' => NULL,
                'birthdate' => NULL,
                'address' => $request->input('addressKerabat'),
                'city' => NULL,
                'district' => NULL,
                'kelurahan' => NULL,
                'phone' => $request->input('phoneKerabat'),
                'relative' => $request->input('relativeTypeKerabat'),
                'is_anggota' => $request->input('isAnggota'),
                'tni_nama_kerabat' => $request->input('tni_nama_kerabat'),
                'tni_nrp_kerabat' => $request->input('tni_nrp_kerabat'),
                'tni_keanggotaan_kerabat' => $request->input('tni_keanggotaan_kerabat'),
                'tni_pangkat_kerabat' => $request->input('tni_pangkat_kerabat'),
                'tni_kotama_kerabat' => $request->input('tni_kotama_kerabat'),
                'tni_satker_kerabat' => $request->input('tni_satker_kerabat'),
                'tni_relative_kerabat' => $request->input('tni_relative_kerabat'),
            );

            $new_pasien = app('App\Http\Controllers\Pasien\Pasien\CreateController')->create($pasien);
            $new_kerabat = app('App\Http\Controllers\Pasien\PasienWali\CreateController')->create($kerabat);

            $pasien_rel = Pasien::find($new_pasien['pasien']->id);
            $pasien_rel->relatives_id = $new_kerabat['kerabat']['id'];
            $pasien_rel->relatives_type = $request->input('relativeTypeKerabat');
            $pasien_rel->save();

            /*PROSES PEMBUATAN METODE PEMBAYARAN UNTUK PASIEN*/
            $pasien_id = $new_pasien['pasien']['id'];
            $nomor_asuransi = $request->nomor_asuransi;
            $perusahaan_pembayaran_id = $request->perusahaan_pembayaran_id;
            $kelas = $request->kelas;
            $utama = 1;

            if (!empty($perusahaan_pembayaran_id) && empty(!$kelas)) {

                $pasienPembayaran = $this->createPasienPembayaran(
                    $pasien_id,
                    $nomor_asuransi,
                    $perusahaan_pembayaran_id,
                    $kelas,
                    $utama
                );

                $perusahaan_pembayaran = PembayaranPerusahaan::find($perusahaan_pembayaran_id);
                if ($perusahaan_pembayaran->tipe->slug != 'tunai') {
                    $tunai_tipe = PembayaranPerusahaanType::where('slug', 'tunai')->first();
                    $perusahaan_tunai = PembayaranPerusahaan::where('type', $tunai_tipe->id)->first();
                    $pasienPembayaranTunai =
                        $this->createPasienPembayaran(
                            $pasien_id,
                            '',
                            $perusahaan_tunai->id,
                            $kelas,
                            0
                        );
                }
            } else {
                $tunai_tipe = PembayaranPerusahaanType::where('slug', 'tunai')->first();
                $perusahaan_tunai = PembayaranPerusahaan::where('type', $tunai_tipe->id)->first();
                $pasienPembayaranTunai =
                    $this->createPasienPembayaran(
                        $pasien_id,
                        '',
                        $perusahaan_tunai->id,
                        1,
                        1
                    );
            }

            /*DONE*/

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Pasien berhasil didaftarkan';
            $data['url'] = 'pasien/' . $new_pasien['pasien']['id'];
            $data['pasien'] = $new_pasien;
            DB::connection('patients')->commit();
        } catch (\Exception $e) {
            DB::connection('patients')->rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Pasien gagal didaftarkan : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

        return json_encode($data);
    }

    public function APIPembayaranBaru(Request $request)
    {
        DB::connection('patients')->beginTransaction();

        try {
            $pasien_id = $request->pasien_id;
            $nomor_asuransi = $request->nomor_asuransi;
            $perusahaan_id = $request->perusahaan_pembayaran_id;
            $kelas = $request->kelas;
            $utama = 1;

            $pasienPembayaran = $this->createPasienPembayaran($pasien_id, $nomor_asuransi, $perusahaan_id, $kelas, $utama);

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Metode pembayaran berhasil ditambahkan';
            $data['url'] = 'pasien/' . $pasien_id;
            DB::connection('patients')->commit();
        } catch (\Exception $e) {
            DB::connection('patients')->rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Pasien gagal didaftarkan : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

        return json_encode($data);
    }

    public function APIPembayaranEdit(Request $request)
    {
        DB::connection('patients')->beginTransaction();

        try {
            $pasien_id = $request->pasien_id;
            $bayar_id = $request->bayar_id;
            $nomor_asuransi = $request->nomor_asuransi;
            $perusahaan_id = $request->perusahaan_pembayaran_id;
            $kelas = $request->kelas;
            $utama = $request->utama;

            $pasienPembayaran = array(
                'bayar_id' => $bayar_id,
                'perusahaan_id' => $perusahaan_id,
                'jenis_pembayaran' => 6,
                'utama' => $utama,
                'kelas_id' => $kelas,
                'no_asuransi' => $nomor_asuransi,
                'nama' => NULL,
                'alamat' => NULL,
                'ktp' => NULL,
                'telp' => NULL
            );

            $pembayaran = app('App\Http\Controllers\Pasien\PasienPembayaran\EditController')->edit($pasienPembayaran);

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Metode pembayaran berhasil diubah!';
            $data['url'] = 'pasien/' . $pasien_id;
            DB::connection('patients')->commit();
        } catch (\Exception $e) {
            DB::connection('patients')->rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Metode pembayaran gagal diubah : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

        return json_encode($data);
    }

    public function createPasienPembayaran($pasien_id, $nomor_asuransi, $perusahaan_id, $kelas, $utama)
    {
        $pasienPembayaran = array(
            'pasien_id' => $pasien_id,
            'perusahaan_id' => $perusahaan_id,
            'utama' => $utama,
            'kelas_id' => $kelas,
            'no_asuransi' => $nomor_asuransi,
        );

        $pembayaran = app('App\Http\Controllers\Pasien\PasienPembayaran\CreateController')->create($pasienPembayaran);

        return $pembayaran;
    }

    public function APIEditPasien(Request $request)
    {
        /*UNTUK REQUEST EDIT PASIEN BARU VIA JQUERY AJAX JSON*/

        DB::connection('patients')->beginTransaction();

        $birthdate = Carbon::createFromFormat('Y-m-d', $request->input('birthdate'))->toDateTimeString();


        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $image = app('App\Http\Controllers\Functions\ImageUploader')->upload($avatar, 'pasien');
            $avatar = $image['file_original'];
            $avatar_thumb = $image['file_thumbnail'];
        } else {
            $avatar = NULL;
            $avatar_thumb = $avatar;
        }

        if ($request->hasFile('file_ktp')) {
            $berkas_ktp = $request->file('file_ktp');
            $image = app('App\Http\Controllers\Functions\ImageUploader')->upload($berkas_ktp, 'pasien');
            $file_ktp = $image['file_original'];
            $file_ktp_thumb = $image['file_thumbnail'];
        } else {
            $file_ktp = NULL;
            $file_ktp_thumb = NULL;
        }

        if ($request->hasFile('file_kk')) {
            $berkas_kk = $request->file('file_kk');
            $image = app('App\Http\Controllers\Functions\ImageUploader')->upload($berkas_kk, 'pasien');
            $file_kk = $image['file_original'];
            $file_kk_thumb = $image['file_thumbnail'];
        } else {
            $file_kk = NULL;
            $file_kk_thumb = NULL;
        }

        if ($request->hasFile('file_kartu_asuransi')) {
            $berkas_kartu_asuransi = $request->file('file_kartu_asuransi');
            $image = app('App\Http\Controllers\Functions\ImageUploader')->upload($berkas_kartu_asuransi, 'pasien');
            $file_kartu_asuransi = $image['file_original'];
            $file_kartu_asuransi_thumb = $image['file_thumbnail'];
        } else {
            $file_kartu_asuransi = NULL;
            $file_kartu_asuransi_thumb = NULL;
        }

        $pasien = array(
            'id' => $request->input('id'),
            'no_rm' => $request->input('no_rm'),
            'jenis_kartu_identitas_id' => $request->input('jenis_kartu_identitas'),
            'nomor_identitas' => $request->nomor_identitas,
            'kategori_pasien' => $request->input('kategori_pasien'),
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'marriage' => $request->input('marriage'),
            'place_of_birth' => $request->input('birthplace'),
            'date_of_birth' => $birthdate,
            'address' => $request->input('address'),
            'address_domisili' => $request->input('address_domisili'),
            'city' => $request->input('city'),
            'district' => $request->input('district'),
            'kelurahan' => $request->input('kelurahan'),
            'phone' => $request->input('phone'),
            'job' => $request->input('occupation'),
            'agama' => $request->input('agama'),
            'pendidikan' => $request->input('pendidikan'),
            'is_anggota' => $request->input('is_anggota'),
            'suku' => $request->input('suku'),
            'alergi' => $request->input('alergi'),
            'nama_ayah' => $request->input('nama_ayah'),
            'nama_ibu' => $request->input('nama_ibu'),
            'nama_suami' => $request->input('nama_suami'),
            'nama_istri' => $request->input('nama_istri'),
            'tni_nrp' => $request->input('tni_nrp'),
            'tni_keanggotaan_id' => $request->input('tni_keanggotaan'),
            'tni_pangkat_id' => $request->input('tni_pangkat'),
            'tni_kotama_id' => $request->input('tni_kotama'),
            'tni_satker_id' => $request->input('tni_satker'),
            'tni_korps_id' => $request->input('tni_korps'),
            'tni_jabatan' => $request->input('tni_jabatan'),
            'tni_pangkat_singkat' => $request->input('tni_pangkat_singkat'),
            'relatives_type' => $request->input('relativeTypeKerabat'),
            'avatar' => $avatar,
            'avatar_thumb' => $avatar_thumb,
            'file_ktp' => $file_ktp,
            'file_ktp_thumb' => $file_ktp_thumb,
            'file_kk' => $file_kk,
            'file_kk_thumb' => $file_kk_thumb,
            'file_kartu_asuransi' => $file_kartu_asuransi,
            'file_kartu_asuransi_thumb' => $file_kartu_asuransi_thumb,
            'is_konfirmasi' => $request->input('is_konfirmasi')
        );
        //dd($pasien);

        $kerabat = array(
            'id' => $request->input('idKerabat'),
            'ktp' => $request->input('noIdentitasKerabat'),
            'name' => $request->input('nameKerabat'),
            'gender' => $request->input('genderKerabat'),
            'birthplace' => $request->input('birthplaceKerabat'),
            'birthdate' => $request->input('birthdateKerabat'),
            'address' => $request->input('addressKerabat'),
            'city' => $request->input('cityKerabat'),
            'district' => $request->input('districtKerabat'),
            'kelurahan' => $request->input('kelurahanKerabat'),
            'phone' => $request->input('phoneKerabat'),
            'is_anggota2' => $request->input('is_anggota2'),
            'tni_nama_kerabat' => $request->input('tni_nama_kerabat'),
            'tni_nrp_kerabat' => $request->input('tni_nrp_kerabat'),
            'tni_keanggotaan_kerabat' => $request->input('tni_keanggotaan_kerabat'),
            'tni_pangkat_kerabat' => $request->input('tni_pangkat_kerabat'),
            'tni_kotama_kerabat' => $request->input('tni_kotama_kerabat'),
            'tni_satker_kerabat' => $request->input('tni_satker_kerabat'),
            'tni_relative_kerabat' => $request->input('tni_relative_kerabat'),
        );

        $edited_pasien = app('App\Http\Controllers\Pasien\Pasien\EditController')->edit($pasien, $kerabat);

        if ($edited_pasien['status']) {
            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Data pasien berhasil diubah';
            $data['url'] = 'pasien/' . $edited_pasien['pasien']['id'];
        } else {
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = $edited_pasien['pasien'];
            $data['url'] = 0;
        }

        DB::connection('patients')->commit();


        return json_encode($data);
    }



    public function APIPendaftaranPasien(Request $request)
    {
        ini_set('max_memory_limit', '4096M');
        // dd($request->all());
        //if(\Auth::user()->id == 3)         dd($request->all());
        DB::connection('rawatjalan')->beginTransaction();
        DB::connection('igd')->beginTransaction();
        DB::connection('rekammedis')->beginTransaction();
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        DB::connection('kasir')->beginTransaction();
        DB::connection('urikkes')->beginTransaction();
        DB::connection('unit_tindakan')->beginTransaction();
        DB::connection('keuangan')->beginTransaction();
        try {
            $layanan = $request->input('layanan');
            if (!is_object(Auth::user())) {
                Auth::loginUsingId(1);
                app('debugbar')->disable();
            }

            $data_transaksi['poliklinik_id'] = $request->poliklinik_id;
            $data_transaksi['nomor_sep'] = $request->no_sep;
            $data_transaksi['pasien_id'] = $request->input('pasien_id');
            $data_transaksi['bayar_id'] = $request->input('bayar_id');
            $data_transaksi['ruangan_id'] = $request->input('ruangan_id');
            $data_transaksi['kelas_id'] = $request->input('kelas');
            $data_transaksi['kasus_id'] = $request->input('kasus_id');
            $data_transaksi['asal_rujukan'] = $request->input('asal_rujukan');
            $data_transaksi['paket_urikkes'] = $request->input('paket_urikkes');
            $data_retribusi['layanan'] = $request->input('layanan');
            $data_retribusi['kelas_id'] = $request->input('kelas');
            $data_retribusi['pasien_id'] = $request->input('pasien_id');
            $data_retribusi['bayar_id'] = $request->input('bayar_id');
            $data_retribusi['retribusi'] = $request->input('retribusi');
            $data_transaksi['dokter_id'] = $request->dokter_id;
            $data_transaksi['tanggal_pemesanan'] = $request->tanggal_pemesanan;
            $data_transaksi['jenis_kunjungan'] = $request->jenis_kunjungan;
            $data_transaksi['nomor_referensi'] = $request->input('nomor_referensi');
            $transaksi_id = -1;

            $asal_rujukan_id = $request->asal_rujukan;
            #jika bukan number
            if (!is_numeric($asal_rujukan_id)) {
                // Cari apakah sudah ada rujukan dengan nama yang sama
                $find_asal_rujukan = AsalRujukan::find($asal_rujukan_id);
                if ($find_asal_rujukan == null) {
                    $asal_rujukan = AsalRujukan::create(['nama' => $asal_rujukan_id]);
                    $asal_rujukan_id = $asal_rujukan->id;
                } else {
                    $asal_rujukan_id = $find_asal_rujukan->id;
                }
            }
            $data_transaksi['asal_rujukan_id'] = $asal_rujukan_id;

            if ($layanan == 1) {
                $data_transaksi['mesin_antrian_konfirmasi'] = $request->input('mesin_antrian_konfirmasi');
                $data_transaksi['mesin_antrian_id'] = $request->input('mesin_antrian_id');
                $data_transaksi['is_bpjs'] = $request->input('is_bpjs');
                $data_transaksi['antrian_kelas'] = $request->input('antrian_kelas');
                $data_transaksi['dokter_jadwal_id'] = $request->dokter_jadwal_id;
                $data_transaksi['is_video'] = $request->input('is_video') ?? 0;
                $data_transaksi['durasi'] = $request->input('durasi') ?? null;
                $data_retribusi['kelas'] = "URJ";
                $data_retribusi['dokter'] = app('App\Http\Controllers\RawatJalan\Dokter\ReadController')->getId($request->dokter_id);
                $transaksi = $this->daftarRawatJalan($data_transaksi, $request->all());
                $transaksi_id = $transaksi->id;
                $data_retribusi['lokasi_id'] = $transaksi->poliklinik->lokasi->id;
                $data_retribusi['lokasi_nama'] = $transaksi->poliklinik->lokasi->nama;
                $data['url'] = 'rawatjalan/poliklinik/' . $transaksi->poliklinik_id;
                if (empty($transaksi->rm_transaksi)) {
                    $rm_transaksi = $this->permintaanRekamMedis($layanan, $transaksi);
                } else {
                    $rm_transaksi = app('App\Http\Controllers\RekamMedis\Transaksi\ReadController')->get($transaksi->rm_transaksi->id);
                }
                $transaksi = app('App\Http\Controllers\RawatJalan\Transaksi\EditController')->editTransaksiRM($transaksi->id, $rm_transaksi->id);
                if (config('medify.third-party.jkn_online.on')) {
                    $pasien_pembayaran = $transaksi->pasien_pembayaran;
                    $pasien            = $transaksi->pasien;
                    $perusahaan        = $pasien_pembayaran->perusahaan;
                    $poliklinik           = $transaksi->poliklinik;
                    $dokter               = $transaksi->dokter;
                    $dokter_jadwal     = $transaksi->dokter_jadwal;
                    $jam_buka             = explode(":",  $dokter_jadwal->jam_buka);
                    $jam_buka_text     = $jam_buka[0] . ":" . $jam_buka[1];
                    $jam_tutup         = explode(":",  $dokter_jadwal->jam_tutup);
                    $jam_tutup_text    = $jam_tutup[0] . ":" . $jam_tutup[1];
                    $jam_text             = $jam_buka_text . "-" . $jam_tutup_text;

                    $sisa_kuota_jkn = 0;
                    $kuota_jkn = 0;
                    $kuota_non_jkn = 0;
                    $sisa_kuota_non_jkn = 0;
                    $sisa_antrian = 0;
                    $data_read['tanggalperiksa'] = Carbon::parse($transaksi->ordered_at);
                    $data_read['jampraktek'] = $jam_text;
                    $transactions_jkn = app('App\Http\Controllers\ThirdParty\MobileBPJS\Antrean\ReadController')->getTransactionByJadwal($data_read, $dokter_jadwal->id, $dokter->id);
                    foreach ($transactions_jkn as $trans) {
                        if ($trans->status == 0) { // masih antri
                            $sisa_antrian++;
                        }
                        if (!is_null($trans->nomor_sep ?? null)) { // kuota jkn/bpjs keseluruhan
                            $kuota_jkn++;
                            if ($trans->status == 0) { // sisa kuota jkn/bpjs yang masih antri
                                $sisa_kuota_jkn++;
                            }
                        } else {
                            $kuota_non_jkn++;
                            if ($trans->status == 0) { // sisa kuota non jkn/bpjs yang masih antri
                                $sisa_kuota_non_jkn++;
                            }
                        }
                    }
                    $jenis_kunjungan = $data_transaksi['jenis_kunjungan'] ?? "";
                    $nomor_referensi = $data_transaksi['nomor_referensi'] ?? "";
                    if ($jenis_kunjungan == 3) {
                        //Cari surat kontrol
                        $bulan = date('m');
                        $tahun = date('Y');
                        $no_kartu = $pasien_pembayaran->no_asuransi ?? "";
                        $format_filter = 2;
                        $get_rencana_kontrol = app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\RencanaKontrol\ReadController::class)->getDataNoKartu($bulan, $tahun, $no_kartu, $format_filter);
                        $rencana_kontrol = json_decode($get_rencana_kontrol);
                        // dd($rencana_kontrol);
                        $nomor_referensi = $rencana_kontrol->response->list[0]->noSuratKontrol ?? $nomor_referensi;
                    }

                    if ($jenis_kunjungan == 2) {
                        // $nomor_kasus = str_pad($transaksi->kasus_id, 11, "0", STR_PAD_LEFT);
                        // $nomor_referensi = config('app.bpjs_ppk') . $nomor_kasus;

                        $kode_ppk = config('app.bpjs_ppk');
                        $kode_booking = (string) $transaksi->id;

                        // Menentukan panjang total yang diinginkan
                        $total_length = 19;

                        // Menghitung panjang kode
                        $length_kode_ppk = strlen($kode_ppk);

                        // Menghitung panjang yang tersisa untuk kode booking
                        $length_kode_booking = $total_length - $length_kode_ppk;

                        // Memformat kode booking agar memiliki panjang yang sesuai dengan menambahkan nol di depan
                        $kode_booking_padded = str_pad($kode_booking, $length_kode_booking, "0", STR_PAD_LEFT);

                        // Menggabungkan hasilnya
                        $nomor_referensi = $kode_ppk . $kode_booking_padded;
                    }

                    if ($jenis_kunjungan == 5) {
                        $jenis_kunjungan = 1;
                        $nomor_referensi = "";
                    }

                    $no_antrian        = (int) preg_replace("/[^0-9]/", "", $transaksi->nomor_antrian);


                    $response['kodebooking']         = (string) $transaksi->id;
                    $response['jenispasien']         = $perusahaan->type == 1 ? "JKN" : "NON JKN";
                    $response['nomorkartu']          = $pasien_pembayaran->no_asuransi ?? "";
                    $response['nik']                 = $pasien->no_identitas;
                    $response['nohp']                 = preg_replace('/\D/', '', $pasien->phone);
                    $response['kodepoli']             = $dokter->bpjs_poli ?? $poliklinik->bpjs_id;
                    $response['namapoli']             = $dokter->bpjs_poli_text ?? $poliklinik->name;
                    $response['pasienbaru']       = $pasien->is_baru == NULL ? 0 : $pasien->is_baru;
                    $response['norm']                 = $pasien->no_rm;
                    $response['tanggalperiksa']   = Carbon::createFromFormat('Y-m-d H:i:s', $transaksi->ordered_at)->format('Y-m-d');
                    $response['kodedokter']            = $dokter->bpjs_kode_dpjp;
                    $response['namadokter']            = $dokter->name;
                    $response['jampraktek']            = $jam_text;
                    $response['jeniskunjungan']     = (int) $jenis_kunjungan;
                    $response['nomorreferensi']     = $nomor_referensi;
                    $response['nomorantrean']        = $transaksi->nomor_antrian;
                    $response['angkaantrean']        = $no_antrian;
                    $response['estimasidilayani']   = strtotime($transaksi->ordered_at) * 1000;
                    $response['sisakuotajkn']       = $sisa_kuota_jkn;
                    $response['kuotajkn']           = $kuota_jkn;
                    $response['sisakuotanonjkn']    = $sisa_kuota_non_jkn;
                    $response['kuotanonjkn']        = $kuota_non_jkn;
                    $response['keterangan']         = "Peserta harap datang 30 menit lebih awal guna pencatatan administrasi.";
                    // dd($response);
                    $temp_params = new \Illuminate\Http\Request();

                    $temp_params->replace([
                        'kodebooking' => $response['kodebooking'],
                        'jenispasien' => $response['jenispasien'],
                        'nomorkartu' => $response['nomorkartu'],
                        'nik' => $response['nik'],
                        'nohp' => $response['nohp'],
                        'kodepoli' => $response['kodepoli'],
                        'namapoli' => $response['namapoli'],
                        'pasienbaru' => $response['pasienbaru'],
                        'norm' => $response['norm'],
                        'tanggalperiksa' => $response['tanggalperiksa'],
                        'kodedokter' => $response['kodedokter'],
                        'namadokter' => $response['namadokter'],
                        'jampraktek' => $response['jampraktek'],
                        'jeniskunjungan' => $response['jeniskunjungan'],
                        'nomorreferensi' => $response['nomorreferensi'],
                        'nomorantrean' => $response['nomorantrean'],
                        'angkaantrean' => $response['angkaantrean'],
                        'estimasidilayani' => $response['estimasidilayani'],
                        'sisakuotajkn' => $response['sisakuotajkn'],
                        'kuotajkn' => $response['kuotajkn'],
                        'sisakuotanonjkn' => $response['sisakuotanonjkn'],
                        'kuotanonjkn' => $response['kuotanonjkn'],
                        'keterangan' => $response['keterangan'],
                    ]);

                    $returned = app(\App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean\CreateController::class)->addAntrean($temp_params);
                    $returned = json_decode($returned);
                    $metadata = isset($returned->metadata) ? $returned->metadata : $returned->metaData;

                    $data_log['kodebooking'] = $transaksi->id;
                    $data_log['response'] = json_encode($returned);
                    $data_log['request'] = $temp_params->all();

                    app(\App\Http\Controllers\ThirdParty\LogJkn\CreateController::class)->create($data_log);

                    if (($metadata->code ?? null) != 200) {
                        $data_log['kodebooking'] = $transaksi->id;
                        $data_log['response'] = json_encode($returned);

                        app(\App\Http\Controllers\ThirdParty\LogErrorJkn\CreateController::class)->create($data_log);
                    } else {
                        if ($transaksi->is_online == 0) { // task id 1-3 untuk daftar offline, untuk daftar online ada di checkin dan konfirmasi antrian
                            $carbon_today = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                            $carbon_today = strtotime($carbon_today);
                            if ($pasien->is_baru == 1) {
                                $waktu = ($carbon_today - (rand(300, 600))) * 1000;
                                $data_1['kodebooking'] = $transaksi->id;
                                $data_1['taskid'] = 1;
                                $data_1['waktu'] = $waktu;

                                dispatch(new QueueArtisan('command:update-task-jkn-id', ['kodebooking' => $transaksi->id, 'taskid' => 1, 'waktu' => $waktu, 'jenisresep' => 'Tidak ada']));
                                //$data = [
                                //'kodebooking' => $transaksi->id,
                                //'taskid' => 1,
                                //'waktu' => $waktu
                                //];
                                //$returned = app(\App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean\PostController::class)->updateTaskId($data);
                                //$returned = json_decode($returned);
                                //$metadata = isset($returned->metadata) ? $returned->metadata : $returned->metaData;
                                //if ($metadata->code != "200") {
                                //$data_log['kodebooking'] = $transaksi->id;
                                //$data_log['response'] = json_encode($returned);

                                //app(\App\Http\Controllers\ThirdParty\LogErrorJkn\CreateController::class)->create($data_log);
                                //} else {
                                //$data_log['kodebooking'] = $transaksi->id;
                                //$data_log['task_id'] = 1;
                                //$data_log['waktu'] = $waktu;
                                //$data_log['response'] = json_encode($returned);
                                //$data_log['request'] = $data;

                                //app(\App\Http\Controllers\ThirdParty\LogJkn\CreateController::class)->create($data_log);
                                //}
                                $transaksi = Transaksi::find($transaksi->id);
                                $transaksi->task_id_jkn = 1;
                                $transaksi->save();

                                $waktu = ($carbon_today - (rand(60, 300))) * 1000;
                                $data_2['kodebooking'] = $transaksi->id;
                                $data_2['taskid'] = 2;
                                $data_2['waktu'] = $waktu;

                                dispatch(new QueueArtisan('command:update-task-jkn-id', ['kodebooking' => $transaksi->id, 'taskid' => 2, 'waktu' => $waktu]));
                                //$data = [
                                //'kodebooking' => $transaksi->id,
                                //'taskid' => 2,
                                //'waktu' => $waktu
                                //];
                                //$returned = app(\App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean\PostController::class)->updateTaskId($data);
                                //$returned = json_decode($returned);
                                //$metadata = isset($returned->metadata) ? $returned->metadata : $returned->metaData;
                                //if ($metadata->code != "200") {
                                //$data_log['kodebooking'] = $transaksi->id;
                                //$data_log['response'] = json_encode($returned);

                                //app(\App\Http\Controllers\ThirdParty\LogErrorJkn\CreateController::class)->create($data_log);
                                //} else {
                                //$data_log['kodebooking'] = $transaksi->id;
                                //$data_log['task_id'] = 2;
                                //$data_log['waktu'] = $waktu;
                                //$data_log['response'] = json_encode($returned);
                                //$data_log['request'] = $data;

                                //app(\App\Http\Controllers\ThirdParty\LogJkn\CreateController::class)->create($data_log);
                                //}
                                $transaksi = Transaksi::find($transaksi->id);
                                $transaksi->task_id_jkn = 2;
                                $transaksi->save();
                            }
                            $carbon_today = $carbon_today * 1000;
                            $data['kodebooking'] = $transaksi->id;
                            $data['taskid'] = 3;
                            $data['waktu'] = $carbon_today;
                            dispatch(new QueueArtisan('command:update-task-jkn-id', ['kodebooking' => $transaksi->id, 'taskid' => 3, 'waktu' => $carbon_today]));
                            //$data = [
                            //'kodebooking' => $transaksi->id,
                            //'taskid' => 3,
                            //'waktu' => $carbon_today
                            //];
                            //$returned = app(\App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean\PostController::class)->updateTaskId($data);
                            //$returned = json_decode($returned);
                            //$metadata = isset($returned->metadata) ? $returned->metadata : $returned->metaData;
                            //if ($metadata->code != "200") {
                            //$data_log['kodebooking'] = $transaksi->id;
                            //$data_log['response'] = json_encode($returned);

                            //app(\App\Http\Controllers\ThirdParty\LogErrorJkn\CreateController::class)->create($data_log);
                            //} else {
                            //$data_log['kodebooking'] = $transaksi->id;
                            //$data_log['task_id'] = 3;
                            //$data_log['waktu'] = $carbon_today;
                            //$data_log['response'] = json_encode($returned);
                            //$data_log['request'] = $data;

                            //app(\App\Http\Controllers\ThirdParty\LogJkn\CreateController::class)->create($data_log);
                            //}
                            $transaksi = Transaksi::find($transaksi->id);
                            $transaksi->task_id_jkn = 3;
                            $transaksi->save();
                        }
                    }
                }
            } elseif ($layanan == 2) {
                $data_retribusi['kelas'] = "IGD";
                $data_transaksi['sirs_pelayanan_khusus_id'] = $request->sirs_pelayanan_khusus_id;
                // dd($data_transaksi, $request->all());
                $transaksi = $this->daftarIGD($data_transaksi, $request->all());
                $transaksi_id = $transaksi->id;
                $data_retribusi['lokasi_id'] = $transaksi->ruangan->lokasi->id;
                $data_retribusi['lokasi_nama'] = $transaksi->ruangan->lokasi->nama;
                $data['url'] = 'igd';
                $rm_transaksi = $this->permintaanRekamMedis($layanan, $transaksi);
                $transaksi = app('App\Http\Controllers\IGD\Transaksi\EditController')->editTransaksiRM($transaksi->id, $rm_transaksi->id);
            } elseif ($layanan == 3) {
                $data_transaksi['total_harga'] = $request->total_harga;

                $transaksi = app('App\Http\Controllers\Urikkes\Transaksi\CreateController')->create($data_transaksi);
                $data_retribusi['lokasi_id'] = $transaksi->lokasi->id;
                $data_retribusi['lokasi_nama'] = $transaksi->lokasi->nama;
                $data['url'] = 'urikkes/transaksi';
                $rm_transaksi = $this->permintaanRekamMedis($layanan, $transaksi);
            }

            if (!empty($data_retribusi['retribusi'])) {
                $this->kirimRetribusi($data_retribusi, $transaksi);
            }

            if (!empty($transaksi->kasus_id)) {
                if ($layanan == 1) {
                    $log = app('App\Http\Controllers\Kasus\Log\CreateController')->create($transaksi->kasus_id, 'create', 'administrasi-rawatjalan-daftar', $transaksi->id);
                } elseif ($layanan == 2) {
                    $log = app('App\Http\Controllers\Kasus\Log\CreateController')->create($transaksi->kasus_id, 'create', 'administrasi-igd-daftar', $transaksi->id);
                } elseif ($layanan == 3) {
                    $log = app('App\Http\Controllers\Kasus\Log\CreateController')->create($transaksi->kasus_id, 'create', 'administrasi-urikkes-daftar', $transaksi->id);
                }
            }

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Pasien berhasil didaftarkan';
            $data['message'] = 'Pasien berhasil didaftarkan';
            $data['is_bpjs'] = $request->input('is_bpjs');
            $data['transaksi_id'] = $transaksi->id;



            DB::connection('rawatjalan')->commit();
            DB::connection('igd')->commit();
            DB::connection('rekammedis')->commit();
            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            DB::connection('kasir')->commit();
            DB::connection('urikkes')->commit();
            DB::connection('unit_tindakan')->commit();
            DB::connection('keuangan')->commit();
            return json_encode($data);
        } catch (\Exception $e) {

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('rawatjalan')->rollback();
            DB::connection('igd')->rollback();
            DB::connection('rekammedis')->rollback();
            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            DB::connection('kasir')->rollback();
            DB::connection('urikkes')->rollback();
            DB::connection('unit_tindakan')->rollback();
            DB::connection('keuangan')->rollback();
            $data['type'] = 'error';
            $data['title'] = 'Gagal Mendaftarkan Pasien';
            $data['text'] = 'Pasien gagal didaftarkan';
            $data['message'] = 'Pasien gagal didaftarkan';
            $data['url'] = 0;
            $data['is_bpjs'] = $request->input('is_bpjs');
            return json_encode($data);
        }
    }

    private function daftarRawatJalan($data_transaksi, $data)
    {
        // dd($data_transaksi, $data);
        $data_transaksi['poli_id'] = $data['poliklinik_id'];
        $data_transaksi['rujuk_id'] = $data['rujuk_id'];
        $data_transaksi['dokter_id'] = $data['dokter_id'];
        $data_transaksi['is_online'] = $data['is_online'] ?? 0;
        $data_transaksi['ordered_at'] = Carbon::now();
        $transaksi_poli = app('App\Http\Controllers\RawatJalan\Transaksi\CreateController')->create($data_transaksi);

        if (!empty($data_transaksi['rujuk_id']) > 0) {
            $transaksi_rujuk = app('App\Http\Controllers\RawatJalan\PermintaanRujuk\EditController')->updateStatus($data_transaksi['rujuk_id'], 1);

            //akan di cek apakah SEP nya diganti apa ngga
            //jika diganti dan memang blm ada SEP nya maka, SEPnya yang baru akan dibuat
            if ($data_transaksi['kasus_id'] > 0 && $data_transaksi['nomor_sep'] != 0)
                $cekSEP = app('App\Http\Controllers\Kasus\BPJS\PostController')->cekSEP($data_transaksi['nomor_sep'], $data_transaksi['kasus_id']);
        }
        if (!is_null($transaksi_poli->poliklinik->unit_tindakan))
            app('App\Http\Controllers\UnitTindakan\Transaksi\CreateController')->createByPoli($transaksi_poli, $transaksi_poli->poliklinik->unit_tindakan);

        return $transaksi_poli;
    }

    private function daftarIGD($data_transaksi)
    {
        $transaksi = app(\App\Http\Controllers\IGD\Transaksi\CreateController::class)->create($data_transaksi);

        $judul_kasus = 'IGD #' . $transaksi->id;
        $pasien = $transaksi->pasien;
        $lokasi = $transaksi->ruangan->lokasi->id;
        $kelas = $data_transaksi['kelas_id'];
        if ($transaksi->asal_rujukan > 0) $pasien->asal_rujukan = $transaksi->rujukan->nama;

        $set_kasus = (object)[
            'judul_kasus'               => $judul_kasus,
            'pasien'                    => $pasien,
            'location'                  => $lokasi,
            'transaksi_lokal_id'        => $transaksi->id,
            'kelas'                     => $kelas,
            'bayar_id'                  => $transaksi->pasien_pembayaran_id,
            'nomor_sep'                 => $transaksi->nomor_sep,
            'id_ibu'                    => null,
            'sirs_pelayanan_khusus_id' => $data_transaksi['sirs_pelayanan_khusus_id'],
        ];

        $set_kasus = (object)[
            'judul_kasus'               => $judul_kasus,
            'pasien'                    => $pasien,
            'location'                  => $lokasi,
            'transaksi_lokal_id'        => $transaksi->id,
            'kelas'                     => $kelas,
            'bayar_id'                  => $transaksi->pasien_pembayaran_id,
            'nomor_sep'                 => $transaksi->nomor_sep,
            'id_ibu'                    => null,
            'sirs_pelayanan_khusus_id' => $data_transaksi['sirs_pelayanan_khusus_id'],
            'asal_rujukan_id' => $transaksi->asal_rujukan ?? null,
        ];

        $kasus = app(\App\Http\Controllers\Kasus\Kasus\CreateController::class)->setCreateKasus($set_kasus);
        $kasus->tipe_igd = 1;
        $kasus->save();

        $transaksi = app('App\Http\Controllers\IGD\Transaksi\EditController')->updateKasus($transaksi->id, $kasus->id);
        #update pasien baru
        if (!empty($pasien->is_baru)) {
            if ($pasien->is_baru == 1) {
                $update_pasien = app('App\Http\Controllers\Pasien\Pasien\EditController')->updatePasienBaru($pasien->id);
                $transaksi->is_pasien_baru = 1;
                $transaksi->save();
            }
        }

        return $transaksi;
    }

    private function permintaanRekamMedis($layanan, $transaksi)
    {
        if ($layanan == 1) {
            $holder_group_id = $transaksi->poliklinik->group_id;
            $lokasi = $transaksi->poliklinik->lokasi->nama;
        } elseif ($layanan == 2) {
            $holder_group_id = $transaksi->ruangan->group_id;
            $lokasi = $transaksi->ruangan->lokasi->nama;
        } elseif ($layanan == 3) {
            $holder_group_id = $transaksi->group_id;
            $lokasi = $transaksi->lokasi->nama;
        }


        $data_rm = [];
        $data_rm['pasien_id'] = $transaksi->pasien_id;
        $data_rm['status'] = 0; //permintaan
        $data_rm['holder_type'] = 2; //group
        $data_rm['holder_user_id'] = null;
        $data_rm['holder_group_id'] = $holder_group_id;
        $data_rm['holder_keterangan'] = null;

        $data_rm['tujuan_id'] = 1; //Pelayanan pasien
        $data_rm['lokasi'] = $lokasi;
        $data_rm['jenis'] = 1;

        $data_rm['sender_confirmed_at'] = null;
        $data_rm['sender_confirmed_by'] = null;
        $data_rm['sender_keterangan'] = null;

        $rm_trans = app('App\Http\Controllers\RekamMedis\Transaksi\CreateController')->create($data_rm);
        return $rm_trans;
    }

    public function kirimRetribusi($data, $transaksi)
    {
        $pembayaran = PasienPembayaran::find($data['bayar_id']);
        $perusahaan = PembayaranPerusahaan::find($pembayaran->perusahaan_id);

        if (($perusahaan->tipe->kirim_kasus == 0 && $data['layanan'] == 1) || $data['layanan'] == 3) { // tunai rajal dan semua pembaayaran urikkes kirim kasir
            $lokasi_loket = Lokasi::where('slug', 'administrasi')->first();
            $pasien_id = $data['pasien_id'];
            $pasien = Pasien::find($pasien_id);

            $tarif_ids = explode(',', $data['retribusi']);
            $total_retribusi = 0;
            foreach ($tarif_ids as $id) {
                $tarif = Tarif::find($id);
                $total_retribusi += $tarif->harga;
                if ($tarif->master->slug == 'pemeriksaan-dokter') {
                    $data['created_by'] = $data['dokter']->user->id ?? Auth::user()->id;
                }
                $retribusi[] = $this->reshapeKasir($data, $tarif, $lokasi_loket);
            }

            if ($data['layanan'] == 1) {
                $nama_layanan = "Rawat Jalan";
                $kasir = Kasir::where('slug', 'LIKE', '%kasir-rawat-jalan%')->first();
                $kasir_id = $kasir->id;
            }
            if ($data['layanan'] == 2) {
                $nama_layanan = "IGD";
                $kasir = Kasir::where('slug', 'LIKE', '%kasir-igd%')->first();
                $kasir_id = $kasir->id;
            }
            if ($data['layanan'] == 3) {
                $nama_layanan = "Medical Checkup";
                $kasir = Kasir::where('slug', 'LIKE', '%kasir-medical-checkup%')->first();
                $kasir_id = $kasir->id;
            }

            $jumlah = $total_retribusi;
            $diskon = 0;
            $total = $total_retribusi;
            $pasien_id = $data['pasien_id'];
            $judul = 'Retribusi Pendaftaran ' . $nama_layanan . ' ' . $data['lokasi_nama'] . ' - ' . $pasien->name;
            $kasir_id = $kasir_id;
            $lokasi_id = $lokasi_loket->id;
            $created_at = Carbon::now();
            $updated_at = Carbon::now();
            $retribusi_details = $retribusi;
            $pasien_pembayaran_id = $data['bayar_id'];

            $lokasiNow = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getSingleLokasi($lokasi_id);
            $kategori_id = $lokasiNow->kategori_keuangan_id;

            $perusahaan_keuangan = $perusahaan->perusahaan_keuangan_id;
            $pihak_ketiga = $pasien->name;
            $perusahaan_id = $perusahaan_keuangan; ///tunai perusahaan keuangan

            if (!empty($retribusi)) {
                $retribusi_kasir = app('App\Http\Controllers\Keuangan\Piutang\CreateController')
                    ->create(
                        $kasir_id,
                        $judul,
                        $jumlah,
                        $diskon,
                        $total,
                        $pasien_id,
                        $pihak_ketiga,
                        $kategori_id,
                        $created_at,
                        $created_at,
                        $updated_at,
                        $retribusi_details,
                        $pasien_pembayaran_id,
                        $lokasi_id,
                        null,
                        $perusahaan_id,
                        'Administrasi Pendaftaran Pasien',
                        null,
                        null,
                        $data['created_by'] ?? $data['dokter']->user->id ?? null
                    );
            } else $retribusi_kasir = null;

            return $retribusi_kasir;
        } else {
            if (!empty($transaksi->kasus_id)) { //igd kirim kasus semua pembayaran
                $retribusi_kasus = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->addRetribusi($data['retribusi'], $transaksi->kasus_id);
            } else if ($data['layanan'] == 1) { // rajal kirim kasus selain tunai
                $retribusi_kasus = app('App\Http\Controllers\RawatJalan\Transaksi\EditController')->simpanRetribusi($data['retribusi'], $transaksi->id);
            }

            return $retribusi_kasus;
        }
    }

    public function kirimKasir($data)
    {
        $lokasi_loket = Lokasi::where('slug', 'administrasi')->first();
        $pasien_id = $data['pasien_id'];
        $pasien = Pasien::find($pasien_id);

        $tarif_ids = explode(',', $data['retribusi']);
        $total_retribusi = 0;
        foreach ($tarif_ids as $id) {
            $tarif = Tarif::find($id);
            $total_retribusi += $tarif->harga;
            if ($tarif->master->slug == 'pemeriksaan-dokter') {
                $data['created_by'] = $data['dokter']->user->id ?? Auth::user()->id;
            }
            $transaksi[] = $this->reshapeKasir($data, $tarif, $lokasi_loket);
        }

        if ($data['layanan'] == 1) {
            $nama_layanan = "Rawat Jalan";
            $kasir = Kasir::where('slug', 'LIKE', '%kasir-rawat-jalan%')->first();
            $kasir_id = $kasir->id;
        }
        if ($data['layanan'] == 2) {
            $nama_layanan = "IGD";
            $kasir = Kasir::where('slug', 'LIKE', '%kasir-igd%')->first();
            $kasir_id = $kasir->id;
        }
        if ($data['layanan'] == 3) {
            $nama_layanan = "Medical Checkup";
            $kasir = Kasir::where('slug', 'LIKE', '%kasir-medical-checkup%')->first();
            $kasir_id = $kasir->id;
        }

        $jumlah = $total_retribusi;
        $diskon = 0;
        $total = $total_retribusi;
        $pasien_id = $data['pasien_id'];
        $judul = 'Retribusi Pendaftaran ' . $nama_layanan . ' ' . $data['lokasi_nama'] . ' - ' . $pasien->name;
        $kasir_id = $kasir_id;
        $lokasi_id = $lokasi_loket->id;
        $created_at = Carbon::now();
        $updated_at = Carbon::now();
        $transaksi_details = $transaksi;
        $pasien_pembayaran_id = $data['bayar_id'];

        $lokasiNow = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getSingleLokasi($lokasi_id);
        $kategori_id = $lokasiNow->kategori_keuangan_id;

        $tipe = PembayaranPerusahaanType::where('slug', 'tunai')->first();
        $perusahaan = PembayaranPerusahaan::where('type', $tipe->id)->first();
        $perusahaan_keuangan = $perusahaan->perusahaan_keuangan_id;

        $pihak_ketiga = $pasien->name;
        $perusahaan_id = $perusahaan_keuangan; ///tunai perusahaan keuangan
        $akun_id = 1; //cash
        $kasus_id = null;
        $dokter_id = $data['dokter']->user->id ?? '';

        if (!empty($transaksi)) {
            $transaksi_kasir = app('App\Http\Controllers\Keuangan\Piutang\CreateController')
                ->create(
                    $kasir_id,
                    $judul,
                    $jumlah,
                    $diskon,
                    $total,
                    $pasien_id,
                    $pihak_ketiga,
                    $kategori_id,
                    $created_at,
                    $created_at,
                    $updated_at,
                    $transaksi_details,
                    $pasien_pembayaran_id,
                    $lokasi_id,
                    null,
                    $perusahaan_id,
                    'Administrasi Pendaftaran Pasien',
                    null,
                    null,
                    $dokter_id
                );
        } else $transaksi_kasir = null;

        return $transaksi_kasir;
    }

    private function reshapeKasir($data, $tarif, $lokasi_loket)
    {
        $newtrans = new \stdClass();
        $newtrans->tarif_id = $tarif->id;
        $newtrans->deskripsi = $tarif->master->deskripsi;
        $newtrans->kelas_id = $data['kelas_id'];
        $newtrans->tarif_tipe_id = $tarif->tipe_id;
        $newtrans->harga = $tarif->harga;
        $newtrans->diskon = 0;
        $newtrans->jumlah = 1;
        $newtrans->subtotal = $tarif->harga;
        $newtrans->keterangan = null;
        $newtrans->lokasi_id = $lokasi_loket->id;
        $newtrans->kategori_id = $lokasi_loket->kategori_keuangan_id;
        $newtrans->created_at = Carbon::now();
        $newtrans->updated_at = Carbon::now();
        $newtrans->created_by = $data['created_by'] ??  Auth::user()->id;

        return $newtrans;
    }

    public function copyPasien($pasien_id, $type = 1, $jenisKelamin = 1)
    {
        $pasien = Pasien::find($pasien_id);
        $wali = PasienWali::find($pasien->relatives_id);
        $pembayarans = PasienPembayaran::where('pasien_id', $pasien_id)->get();
        if ($type == 1) {
            $jumlah_bayi = Pasien::where('parent_id', $pasien_id)->count();
            $nama = $pasien->name . " BY NY";
            $gender = $jenisKelamin;
            $marriage = 1;
            $place_of_birth = "Surabaya";
            $date_of_birth = Carbon::now()->toDateString();
            $job = 1;
            $pendidikan = 8;
        }

        $pasien_arr = array(
            'jenis_kartu_identitas_id' => $pasien->jenis_kartu_identitas_id,
            'nomor_identitas' => $pasien->no_identitas,
            'name' => $nama,
            'gender' => $gender,
            'marriage' => $marriage,
            'place_of_birth' => $place_of_birth,
            'date_of_birth' => $date_of_birth,
            'address' => $pasien->address,
            'city' => $pasien->city,
            'parent_id' => $pasien_id,
            'district' => $pasien->district,
            'kelurahan' => $pasien->kelurahan,
            'phone' => $pasien->phone,
            'job' => 'BELUM / TIDAK BEKERJA',
            'agama' => $pasien->agama_id,
            'pendidikan' => $pendidikan,
            'is_anggota' => $pasien->is_anggota,
            'tni_nrp' => $pasien->tni_nrp,
            'tni_keanggotaan_id' => $pasien->tni_keanggotaan_id,
            'tni_pangkat_id' => $pasien->tni_pangkat_id,
            'tni_kotama_id' => $pasien->tni_kotama_id,
            'tni_satker_id' => $pasien->tni_satker_id,
            'tni_pangkat_singkat' => $pasien->tni_pangkat_singkat,
            'tni_jabatan' => $pasien->tni_jabatan,
            'tni_korps_id' => $pasien->tni_korps_id,
            'avatar' => $pasien->photo_ori,
            'avatar_thumb' => $pasien->photo_thumb,
            'suku' => $pasien->suku,
            'kategori_pasien' => 5,
            'address_domisili' => $pasien->address,
            'alergi' => null,
            'nama_ayah' => null,
            'nama_ibu' => $pasien->name,
            'nama_suami' => null,
            'nama_istri' => null
        );

        $kerabat = array(
            'ktp' => NULL,
            'name' => $wali->name,
            'gender' => $wali->gender,
            'birthplace' => NULL,
            'birthdate' => NULL,
            'address' => $wali->address,
            'city' => NULL,
            'district' => NULL,
            'kelurahan' => NULL,
            'phone' => $wali->phone,
            'is_anggota' => $wali->is_anggota,
            'tni_nama_kerabat' => $wali->tni_nama,
            'tni_nrp_kerabat' => $wali->tni_nrp,
            'tni_keanggotaan_kerabat' => $wali->tni_keanggotaan_id,
            'tni_pangkat_kerabat' => $wali->tni_pangkat_id,
            'tni_kotama_kerabat' => $wali->tni_kotama_id,
            'tni_satker_kerabat' => $wali->tni_satker_id,
            'tni_relative_kerabat' => $wali->tni_hubungan_type
        );

        $new_pasien = app('App\Http\Controllers\Pasien\Pasien\CreateController')->create($pasien_arr);
        $new_kerabat = app('App\Http\Controllers\Pasien\PasienWali\CreateController')->create($kerabat);
        $new_pasien['pasien']->relatives_id = $new_kerabat['kerabat']['id'];
        $new_pasien['pasien']->relatives_type = $pasien->relatives_type;
        $new_pasien['pasien']->save();
        foreach ($pembayarans as $pembayaran) {
            $this->createPasienPembayaran($new_pasien['pasien']->id, $pembayaran->no_asuransi, $pembayaran->perusahaan_id, $pembayaran->kelas_id, $pembayaran->utama);
        }

        return $new_pasien['pasien'];
    }

    public function daftarInap(Request $req, $id)
    {
        $pasien = Pasien::where('id', $id)->first();
        if ($req["permintaan-ranap"] != 0) {
            $kasus = app('App\Http\Controllers\RawatInap\Transaksi\ReadController')->getById($req["permintaan-ranap"])->kasus;
            $transaksi_id = $req['permintaan-ranap'];
        } else {
            $kasus = app('App\Http\Controllers\Kasus\Kasus\ReadController')->getById($req["pilih-kasus"]);
            $inap = app('App\Http\Controllers\Kasus\Administrasi\PostController')->rawatInapBuatPermintaan($kasus->nomor_kasus, 0, 0, 0, 'Tanpa Permintaan');
            $transaksi_id = $inap->id;
        }
        return redirect('rawatinap/transaksi/pendaftaran/ruangan?transaksi_id=' . $transaksi_id);
    }


    private function getEstimasiWaktuPemeriksaan($last_antrian_nomor, $last_antrian_waktu, $estimasi_per_px = 6)
    {

        $menit = $last_antrian_nomor * $estimasi_per_px;
        $now = Carbon::now();
        $today = Carbon::today()->addHours(8);
        $estimasi_awal = $today->copy()->addMinutes($menit);
        $estimasi_last_antrian = $last_antrian_waktu->copy()->addMinutes($estimasi_per_px);

        if ($estimasi_awal > $now) $return = $estimasi_awal;
        elseif ($estimasi_last_antrian < $now)
            $return = $now->addMinutes($estimasi_per_px);
        else
            $return = $estimasi_last_antrian;

        return $return;
    }

    public function APIPendaftaranPasienMobile(Request $request)
    {
        app('debugbar')->disable();
        // dd($request->all());
        $pembayaran = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->single($request->pembayaran_id);
        $pasien = Pasien::where('no_rm', $request->pasien_id)->first();
        $request->merge(['pasien_id' => $pasien->id]);
        $result = "";
        if ($pembayaran->perusahaan->tipe->slug == 'bpjs')
            $result = app('App\Http\Controllers\BPJS\AutoSEP\CreateController')->generate('rawatjalan', $pasien->id, $request->pembayaran_id, $request->poli_id);
        if ($pembayaran->perusahaan->tipe->slug == 'bpjs' && !empty($result->metaData)) {
            if ($result->metaData->code == 200 && !empty($result->response)) {
                if (!empty($result->response->sep)) {
                    $request->merge(['no_sep' => $result->response->sep->noSep]);
                    $res = $this->APIPendaftaranPasien($request);
                    $objRes = json_decode($res);

                    $transRajal = TransaksiRajal::find($objRes->transaksi_id);
                    $pemesanan = Carbon::createFromFormat("!Y-m-d", $request->tanggal_pemesanan);
                    $today = Carbon::today()->toDateString();
                    if ($pemesanan->copy()->toDateString() != $today)
                        $transRajal->is_sep_online_created = 0;

                    $transRajal->ordered_at = $pemesanan->toDateTimeString();
                    $transRajal->save();

                    $objRes->nomor_antrian = $transRajal->nomor_antrian ?? 0;
                    return json_encode($objRes);
                }
            }
        } elseif ($pembayaran->tipe->slug != 'bpjs') {
            $res = $this->APIPendaftaranPasien($request);
            $objRes = json_decode($res);
            $transRajal = TransaksiRajal::find($objRes->transaksi_id);
            $transRajal->ordered_at = Carbon::createFromFormat("!Y-m-d", $request->tanggal_pemesanan)->toDateTimeString();
            $transRajal->save();

            $objRes->nomor_antrian = $transRajal->nomor_antrian ?? 0;
            return json_encode($objRes);
        }
        return ($result);
    }


    public function dataSyncSIMLama($min)
    {

        $pasiens = Pasien::where('no_rm', $min)->get();
        $result = [];
        foreach ($pasiens as $pasien) {
            $status_pasien_medify = $pasien->pembayaranUtama->perusahaan->tipe->slug;

            // BPJS
            if ($status_pasien_medify == 'bpjs') {
                $status_pasien = 2;
                $status_kerjasama = '';
                $jns_umum = 0;
                $jns_bpjs = $pasien->pembayaranUtama->perusahaan->id;
                $no_bpjs = $pasien->pembayaranUtama->no_asuransi;
            } elseif ($status_pasien_medify == 'tunai') {
                $status_pasien = 1;
                $status_kerjasama = '';
                $jns_umum = 3;
                $jns_bpjs = 0;
                $no_bpjs = '';
            } else {
                $status_pasien = 1;
                $status_kerjasama = $pasien->pembayaranUtama->perusahaan->id;
                $jns_umum = 1;
                $jns_bpjs = 0;
                $no_bpjs = '';
            }

            $dob = explode('-', $pasien->date_of_birth);

            $data['dari'] = 1;
            $data['loket'] = '';
            $data['stat_pasien'] = $status_pasien;
            $data['kerjasama'] = $status_kerjasama;
            $data['jns_umum'] = $jns_umum;
            $data['jns_bpjs'] = $jns_bpjs;
            $data['kelas'] = $pasien->pembayaranUtama->kelas_id;
            $data['no_rm'] =  str_pad($pasien->no_rm, 10, "0", STR_PAD_LEFT);
            $data['no_bpjs'] = $no_bpjs;
            $data['nama'] = $pasien->name;
            $data['jkel'] = $pasien->gender == 1 ? 'L' : 'P';
            $data['jns_id'] = $pasien->jenis_kartu_identitas_id;
            $data['no_ktp'] = $pasien->no_identitas;
            $data['tmp_lahir'] = 0;
            $data['tgl_lahir1'] = $dob[2];
            $data['tgl_lahir2'] = $dob[1];
            $data['tgl_lahir3'] = $dob[0];
            $data['stat_nikah'] = $pasien->marriage;
            $data['agama'] = $pasien->agama_id;
            $data['pekerjaan'] = '';
            $data['pendidikan'] = $pasien->pendidikan_id;
            $data['provinsi'] = '';
            $data['kota'] = $pasien->city;
            $data['kecamatan'] = $pasien->district;
            $data['kelurahan'] = $pasien->kelurahan;
            $data['alamat'] = $pasien->address;
            $data['rt'] = '';
            $data['rw'] = '';
            $data['telp'] = $pasien->phone;
            $data['type'] = $pasien->tni_keanggotaan_id;
            $data['pangkat'] = $pasien->tni_pangkat_id;
            $data['nrp'] = $pasien->tni_nrp;
            $data['satker'] = $pasien->tni_satker_id;
            $data['kotama'] = $pasien->tni_kotama_id;
            $data['ka_keluarga'] = '';
            $data['ka_nama'] = '';
            $data['ka_nrp'] = '';
            $data['ka_type'] = '';
            $data['ka_pangkat'] = '';
            $data['kel_nama'] = $pasien->wali->name;
            $data['kel_type'] = '';
            $data['kel_pangkat'] = '';
            $data['kel_nrp'] = '';
            $data['kel_kotama'] = '';
            $data['kel_alamat'] = '';
            $data['kel_telp'] = '';
            $data['kel_satker'] = '';
            $data['kel_hubungan'] = '';
            $data['kel_tgl_lahir1'] = '';
            $data['kel_tgl_lahir2'] = '';
            $data['kel_tgl_lahir3'] = '';
            $data['ada_pj'] = '';
            $data['pj_nama'] = '';
            $data['pj_ktp'] = '';
            $data['pj_alamat'] = '';
            $data['pj_telp'] = '';
            $data['dokter_pribadi'] = '';
            $data['block_redir'] = 1;

            $string = '?';
            foreach ($data as $key => $value) {
                $string .= $key . '=' . $value . '&';
            }
            $string .= 'coba=1';
            $url = '192.168.200.250/rumkital/administrasi/new_pasien_api.php' . $string;

            $client = new Client();
            $res = $client->request(
                'GET',
                $url,
                []
            );
            $content = json_decode($res->getBody()->getContents());
            array_push($result, [
                "string" => $string,
                "result" => $content
            ]);
        }
        return $result;
    }

    public function asalRujukan(Request $request)
    {
        // dd($request->all());
        $data = [];
        DB::connection('patients')->beginTransaction();
        try {

            if (config('app.bpjs_enable') == true) {
                $faskes_medify = app('App\Http\Controllers\BPJS\API\Referensi\ReadController')->getFaskes($request->merge(['faskes' => $request->q]));
                $faskes_medify = json_decode($faskes_medify);
                $response_faskes = $faskes_medify->response;
                if (!is_null($response_faskes)) {
                    foreach ($response_faskes as $key => $list_faskes) {
                        foreach ($list_faskes as $key => $value) {
                            AsalRujukan::updateOrCreate(
                                ['kode' => $value->kode, 'nama' => $value->nama]
                            );
                        }
                    }
                    DB::connection('patients')->commit();
                }
            }

            $faskes = AsalRujukan::where('nama', 'like', '%' . $request->q . '%')
                ->select('id', 'nama')
                ->take('20')
                ->get()
                ->toArray();

            $status  = 'success';
            $title   = 'Berhasil';
            $message = 'Get Data Asal Rujukan';
            $data    = $faskes;
        } catch (\Throwable $th) {
            DB::connection('patients')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($th);
            $status  = 'error';
            $title   = 'Gagal !';
            $message = 'Terjadi Kesalahan Server';
        }

        $result = [
            'status'  => $status,
            'title'   => $title,
            'message' => $message,
            'data'    => $data
        ];
        return json_encode($result);
    }

    public function konfirmasiBatal($id)
    {
        try {

            DB::connection('rawatjalan')->beginTransaction();
            $transaksi = Transaksi::find($id);
            $transaksi->refund_status = 2;
            $transaksi->refund_status_by = Auth::user()->id;
            $transaksi->save();
            DB::connection('rawatjalan')->commit();
            return json_encode([
                'number' => 200,
                'status' => 'Berhasil!',
                'ket' => 'Konfirmasi Berhasil'
            ]);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('rawatjalan')->rollBack();
            return json_encode([
                'number' => 400,
                'status' => 'Gagal',
                'ket' => 'Konfirmasi gagal'
            ]);
        }
    }
}
