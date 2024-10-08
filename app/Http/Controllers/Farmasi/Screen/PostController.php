<?php

namespace App\Http\Controllers\Farmasi\Screen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Pasien\PembayaranPerusahaanType;
use App\Models\RawatJalan\Transaksi;

class PostController extends Controller
{
    public function save(Request $request, $farmasi)
    {
        DB::connection('farmasi')->beginTransaction();
        try {
            $farm = session('farmasi');
            $id = $request->id;

            if ($id) {
                app('App\Http\Controllers\Farmasi\Screen\EditController')->edit($request);

                $message = "Berhasil mengubah screen antrian";
            } else {
                app('App\Http\Controllers\Farmasi\Screen\CreateController')->create($request);

                $message = "Berhasil menambah screen antrian baru";
            }

            DB::connection('farmasi')->commit();

            $status = 1;
            $title = 'Berhasil!';

            return redirect('farmasi/' . $farm->slug . '/screen-tv')
                ->with('status', $status)
                ->with('message', $message)
                ->with('title', $title);
        } catch (\Exception $e) {
            DB::connection('farmasi')->rollback();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = -1;
            $message = "Gagal menyimpan screen antrian";
            $title = 'Gagal!';

            return redirect('farmasi/' . $farm->slug . '/screen-tv')
                ->with('status', -1)
                ->with('message', $message)
                ->with('title', $title);
        }
    }

    public function delete(Request $request, $farmasi)
    {
        DB::connection('farmasi')->beginTransaction();
        try {
            $farm = session('farmasi');

            app('App\Http\Controllers\Farmasi\Screen\DeleteController')->delete($request);

            DB::connection('farmasi')->commit();

            $status = 1;
            $message = "Berhasil menghapus screen antrian";
            $title = 'Berhasil!';

            return redirect('farmasi/' . $farm->slug . '/screen-tv')
                ->with('status', $status)
                ->with('message', $message)
                ->with('title', $title);
        } catch (\Exception $e) {
            DB::connection('farmasi')->rollback();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = -1;
            $message = "Gagal menghapus screen antrian";
            $title = 'Gagal!';

            return redirect('farmasi/' . $farm->slug . '/screen-tv')
                ->with('status', -1)
                ->with('message', $message)
                ->with('title', $title);
        }
    }

    public function checkIn(Request $request)
    {
        $awal = Carbon::today()->startOfDay();
        $akhir = $awal->copy()->endOfDay();
        $tanggal = (bool)strtotime($request->tanggal_lahir);

        if ($tanggal) {
            $tgl_lahir = Carbon::parse($request->tanggal_lahir)->format('Y-m-d');
            $pasien = app('App\Http\Controllers\Pasien\Pasien\ReadController')->getByRmTanggalLahir($request->no_rm, $tgl_lahir);

            if (empty($pasien)) {
                $data['status'] = 0;
                $data['msg'] = 'Data pasien tidak ditemukan';
            } else {
                $transaksi_farmasi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getByPasienDate($pasien->id, $awal, $akhir);

                $data['transaksi'] = $transaksi_farmasi;
                $data['pasien'] = $pasien;
                $data['no_rm_format'] = $pasien->no_rm_formatted;
                $data['jk'] = $pasien->jenis_kelamin;
                $data['status'] = 1;
            }
        } else {
            $data['status'] = 0;
            $data['msg'] = 'Format tanggal salah';
        }

        return json_encode($data);
    }

    public function confirm(Request $request)
    {
        $waktu_tunggu = 0;

        $transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getById($request->transaksi_id);

        if ($transaksi) {
            $is_racikan = $transaksi->final_detail->resep_detail->where('tipe', 1)->first();
            $today = Carbon::now();

            if ($is_racikan) {
                $estimasi = app('App\Http\Controllers\Farmasi\WaktuEstimasiJenisResep\ReadController')->getWaktuRacikan();

                $waktu_tunggu = date('d-m-Y H:i:s', strtotime("+ " . $estimasi->waktu_estimasi . " minutes"));
                $jenis_resep = 1;
            } else {
                $estimasi = app('App\Http\Controllers\Farmasi\WaktuEstimasiJenisResep\ReadController')->getWaktuNonRacikan();

                $waktu_tunggu = date('d-m-Y H:i:s', strtotime("+ " . $estimasi->waktu_estimasi . " minutes"));
                $jenis_resep = 2;
            }

            $estimasi_selesai = date('Y-m-d H:i:s', strtotime($waktu_tunggu));

            if ($transaksi->pembayaran_detail) $tipe_perusahaan = $transaksi->pembayaran_detail->perusahaan->tipe;
            else $tipe_perusahaan = PembayaranPerusahaanType::where('slug', 'tunai')->first();

            $jenis_antrian = app('App\Http\Controllers\Farmasi\JenisAntrian\ReadController')->getByFilter($tipe_perusahaan->id, $jenis_resep, ($transaksi->lokasi->lokasi_departemen_id ?? 0));
            if ($jenis_antrian) {
                $kode = $jenis_antrian->kode;
                $transaksi_today = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getByDateNow($kode);

                $nomor = $transaksi_today->count() + 1;
                $nomor = 1000 + $nomor;
                $nomor = substr($nomor, 1);

                $nomor_antrian = $kode . $nomor;

                $transaksi->nomor_antrian = $nomor_antrian;
                $transaksi->jenis_resep_antrian = $jenis_resep;
                $transaksi->jenis_antrian_id = $jenis_antrian->id;
                $transaksi->jenis_antrian_kode = $jenis_antrian->kode;
                $transaksi->waktu_check_in = $today;
                $transaksi->waktu_estimasi_selesai = $estimasi_selesai;
                $transaksi->save();

                //Tambah antrean farmasi BPJS
                $transaksi_rawat_jalan = Transaksi::where('kasus_id', $transaksi->kasus_id)->first();
                if ($transaksi_rawat_jalan) {
                    $temp_params = new \Illuminate\Http\Request();
                    if ($jenis_resep == 1) {
                        $jenis_resep_text = "racikan";
                    } else {
                        $jenis_resep_text = "non racikan";
                    }
                    $temp_params->replace([
                        'kodebooking' => (string) $transaksi_rawat_jalan->id ?? '',
                        'jenisresep' => $jenis_resep_text,
                        'nomorantrean' => $transaksi->nomor_antrian,
                        'keterangan' => 'Bila resep selesai diproses kami akan mengirimkan pemberitahuan melalui pesan whatsapp di nomor yang terdaftar.',
                    ]);
                    // dd($jenis_resep);

                    $returned = app(\App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean\CreateController::class)->addAntreanFarmasi($temp_params);
                    $returned = json_decode($returned);
                }
                //End tambah antrean farmasi BPJS

                $result['status'] = 1;
                $result['nomor_resep'] = $transaksi->final_detail->nomor_resep;
                $result['estimasi_waktu'] = $waktu_tunggu;
            } else {
                $result['status'] = 0;
                $result['message'] = 'Data kode antrean tidak ditemukan, silahkan hubungi admin';
            }
        } else {
            $result['status'] = 0;
            $result['message'] = 'Data transaksi tidak ditemukan';
        }

        return json_encode($result);
    }

    public function print(Request $request)
    {
        $transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getById($request->id);

        if ($transaksi) {
            $tipe_perusahaan = $transaksi->pembayaran_detail->perusahaan->tipe;

            if (!empty($transaksi->lokasi_text)) {
                $lokasi = $transaksi->lokasi_text;
            } else {
                $lokasi = $transaksi->lokasi->nama;
            }

            $data['transaksi'] = $transaksi;
            $data['nomor_resep'] = $transaksi->final_detail->nomor_resep;
            $data['waktu_check_in'] = date('d-m-Y H:i:s', strtotime($transaksi->waktu_check_in));
            $data['waktu_estimasi_selesai'] = date('d-m-Y H:i:s', strtotime($transaksi->waktu_estimasi_selesai));
            $data['lokasi'] = $lokasi;
            $data['debitur'] = $tipe_perusahaan->nama;
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
            $data['message'] = 'Data transaksi tidak ditemukan';
        }

        return json_encode($data);
    }

    public function loadDataRealtime(Request $request, $farm_id, $screen_id)
    {
        $data['new_data'] = (new \App\Http\Controllers\Farmasi\Transaksi\ReadController())->getDataRealtime($request, $farm_id, $screen_id);
        $data['shown_data'] = (new \App\Http\Controllers\Farmasi\Transaksi\ReadController())->getDataRealtimeShown($request, $farm_id, $screen_id);
        $data['shown_data_box'] = (new \App\Http\Controllers\Farmasi\Transaksi\ReadController())->getDataRealtimeBoxShown($request, $farm_id, $screen_id);
        return json_encode($data);
    }

    public function call(Request $request, $farm_id)
    {
        $status = -1;
        $message = 'Gagal memanggil antrian';
        $title = 'Gagal!';

        $farm = session('farmasi');
        DB::connection('farmasi')->beginTransaction();
        try {
            $result = (new \App\Http\Controllers\Farmasi\Transaksi\EditController())->saveAntrian($request);
            if ($result->status) {
                DB::connection('farmasi')->commit();

                $status = 1;
                $message = 'Berhasil memanggil antrian, silahkan tunggu';
                $title = 'Berhasil!';
            } else {
                DB::connection('farmasi')->rollback();
                $message .= ", $result->message";
            }
        } catch (\Exception $e) {
            DB::connection('farmasi')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

        return redirect('farmasi/' . $farm->slug . '/transaksi')
            ->with('status', $status)
            ->with('message', $message)
            ->with('title', $title);
    }

    public function screenUpdateNomorAntrian($farmasi)
    {
        $current_antrian = (new \App\Http\Controllers\Farmasi\Transaksi\EditController())->panggilAntrian($farmasi);
        if (!empty($current_antrian)) {
            $implode_nomor_antrian = explode('-', ($current_antrian->no_antrian ?? $current_antrian->nomor_antrian ?? ''));

            $return['status'] = 1;
            $return['loket_id'] = $current_antrian->loket_id;
            $return['loket_nama'] = $current_antrian->loket_antrian->nama;
            $return['nomor_antrian'] = $current_antrian->no_antrian ?? $current_antrian->nomor_antrian;
            $return['kode'] = $implode_nomor_antrian[0];
            $return['tipe'] = $implode_nomor_antrian[1];
            $return['transaksi_id'] = $current_antrian->id;
            return json_encode($return);
        }
        $return['status'] = 0;
        return json_encode($return);
    }
}
