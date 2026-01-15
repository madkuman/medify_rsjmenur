<?php

namespace App\Http\Controllers\RawatJalan\Transaksi;

use App\Jobs\QueueArtisan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Transaksi;
use App\Models\RawatJalan\Poliklinik;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\Lokasi;
use App\Models\Kasus\Kasus;
use App\Models\RawatJalan\PermintaanRujuk;
use App\Models\Hospital\TransaksiMasuk as GlobalTransaksiMasuk;
use App\Models\Hospital\TransaksiMasukDetail as GlobalTransaksiMasukDetail;
use Carbon\Carbon;
use App\Models\Kasus\TagihanDetail;
use Auth;
use DB;
use DNS1D;
use Bugsnag;
use Illuminate\Support\Facades\Artisan;

class PostController extends Controller
{
    public function createPasien($pasien_id, $kasus_id = 0, Request $request)
    {
        $rujuk = $request->get('rujuk');
        if (empty($rujuk)) $rujuk = 0;
        $poli = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getPoli();
        $poli =  json_decode($poli);
        $data['poli'] = $poli->data;
        $data['routeFlag'] = 1;
        $data['pasien_id'] = $pasien_id;
        $data['kasus_id'] = $kasus_id;
        $data['rujuk'] = $rujuk;
        return view('rawatjalan.antrian.create-poliklinik', $data);
    }

    public function cancel(Request $request)
    {
        DB::connection('rawatjalan')->beginTransaction();
        DB::connection('rekammedis')->beginTransaction();
        try {
            $transaksi = Transaksi::find($request->id);
            if (in_array($transaksi->status, [1, 2]) && isset($request->kodebooking)) {
                $return['status'] = -1;
                $return['message'] = 'Pasien Sudah Dilayani. Antrean Tidak Dapat Dibatalkan';
                return $return;
            }
            $transaksi->status = -1;
            $transaksi->cancel_keterangan = $request->keterangan;
            $transaksi->cancel_at = Carbon::now();
            $transaksi->cancel_by = Auth::user()->id ?? 1;
            $transaksi->save();

            $data = app('App\Http\Controllers\RekamMedis\Transaksi\EditController')->tolakPengiriman($transaksi->rm_transaksi_id, $request->keterangan);

            if (config('medify.third-party.jkn_online.on')) {
                $data['kodebooking'] = $transaksi->id;
                $data['keterangan'] = $request->keterangan;

                $request_data = new \Illuminate\Http\Request();

                $request_data->replace([
                    'kodebooking' => $data['kodebooking'],
                    'keterangan' => $data['keterangan']
                ]);

                $returned = app(\App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean\PostController::class)->batal($request_data);
                $returned = json_decode($returned);
                $metadata = isset($returned->metadata) ? $returned->metadata : $returned->metaData;
                if (($metadata->code ?? null) != "200") {
                    $data_log['kodebooking'] = $transaksi->id;
                    $data_log['response'] = json_encode($returned);

                    app(\App\Http\Controllers\ThirdParty\LogErrorJkn\CreateController::class)->create($data_log);
                } else {
                    if (config('medify.third-party.jkn_online.on')) {
                        $carbon_today = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                        $carbon_today = strtotime($carbon_today) * 1000;
                        $data['kodebooking'] = $transaksi->id;
                        $data['taskid'] = 99;
                        $data['waktu'] = $carbon_today;
                        // dispatch(new QueueArtisan('command:update-task-jkn-id', ['kodebooking' => $transaksi->id, 'taskid' => 99, 'waktu' => $carbon_today]));
                        $data = [
                            'kodebooking' => $transaksi->id,
                            'taskid' => 99,
                            'waktu' => $carbon_today
                        ];
                        $returned = app(\App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean\PostController::class)->updateTaskId($data);
                        $returned = json_decode($returned);
                        $metadata = isset($returned->metadata) ? $returned->metadata : $returned->metaData;
                        if ($metadata->code != "200") {
                            $data_log['kodebooking'] = $transaksi->id;
                            $data_log['response'] = json_encode($returned);

                            app(\App\Http\Controllers\ThirdParty\LogErrorJkn\CreateController::class)->create($data_log);
                        } else {
                            $data_log['kodebooking'] = $transaksi->id;
                            $data_log['task_id'] = 99;
                            $data_log['waktu'] = $carbon_today;
                            $data_log['response'] = json_encode($returned);
                            $data_log['request'] = $data;

                            app(\App\Http\Controllers\ThirdParty\LogJkn\CreateController::class)->create($data_log);
                        }
                        $transaksi = Transaksi::find($transaksi->id);
                        $transaksi->task_id_jkn = 99;
                        $transaksi->save();
                    }
                }
                $transaksi->task_id_jkn = 99;
                $transaksi->save();
            }

            $status = 1;
            $message = 'Transaksi berhasil di cancel!';
            $title = 'Berhasil!';

            DB::connection('rawatjalan')->commit();
            DB::connection('rekammedis')->commit();
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('rawatjalan')->rollback();
            DB::connection('rekammedis')->rollback();

            $status = -1;
            $message = 'Transaksi gagal di cancel';
            $title = 'Gagal!';
        }

        // kalau cancle dari bpjs
        if (isset($request->kodebooking)) {
            $return['status'] = $status;
            $return['message'] = $message;
            return $return;
        }

        return back()
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
    }

    public function konfirmasiAntrian(Request $request)
    {
        $pasien = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getSinglePasien($request->input('pasien_id'));
        $poli = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getSinglePoli($request->input('poliklinik_id'));

        $kasus_id = $request->input('kasus_id');
        $rujuk = $request->input('rujuk');
        $data['kasus_id'] = $kasus_id;

        $poli =  json_decode($poli);
        $data['poli'] = $poli->data;
        $data['pasien'] = $pasien;
        $data['routeFlag'] = 1;
        $data['rujuk'] = $rujuk;
        return view('rawatjalan.antrian.create-konfirmasi', $data);
    }


    public function APIsubmitAntrian(Request $request)
    {
        DB::connection('rawatjalan')->beginTransaction();
        DB::connection('rekammedis')->beginTransaction();
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        DB::connection('kasir')->beginTransaction();
        try {
            $pasien_id = $request->input('pasien_id');
            $poli_id = $request->input('poliklinik_id');
            $kasus_id = $request->input('kasus_id');
            $nomor_sep = $request->input('nomor_sep');
            $is_karcis = $request->input('is_karcis');
            $is_kartu = $request->input('is_kartu');
            $is_kartu_poli = $request->input('is_kartu_poli');
            $is_file_tni = $request->input('is_file');
            $total_retribusi = $request->input('total_retribusi');
            $asal_rujukan = $request->input('asal_rujukan');
            $bayar_id = $request->input('bayar_id');
            $rujuk_id = $request->input('rujuk_id');
            $rujuk = $request->input('rujuk');

            $last_antrian = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getLastAntrian($poli_id);

            $transaksi_masuk_detail = app('App\Http\Controllers\Hospital\Transaksi\CreateController')->create(2, 1, $pasien_id);

            $transaksi = new Transaksi;
            $transaksi->poliklinik_id = $poli_id;
            $transaksi->pasien_id = $pasien_id;
            $transaksi->nomor_antrian = $last_antrian + 1;
            $transaksi->ordered_at = $this->getEstimasiWaktuPemeriksaan($last_antrian + 1);
            if ($kasus_id > 0) {
                $transaksi->kasus_id = $kasus_id;
            }
            if ($rujuk_id > 0) {
                $transaksi->rujuk = 1;
                $transaksi->permintaan_rujuk_id = 1;
            }
            $transaksi->status = 0;
            $transaksi->transaksi_masuk_detail_id = $transaksi_masuk_detail->id;
            $transaksi->nomor_sep = $nomor_sep;
            $transaksi->is_karcis_pengunjung = $is_karcis;
            $transaksi->is_kartu_baru = $is_kartu;
            $transaksi->is_karcis_poli = $is_kartu_poli;
            $transaksi->is_file_tni = $is_file_tni;
            $transaksi->asal_rujukan = $asal_rujukan;
            $transaksi->total_retribusi = $total_retribusi;
            $transaksi->pasien_pembayaran_id = $bayar_id;
            $transaksi->waktu_masuk = Carbon::now();
            $transaksi->save();

            $lokasi = $transaksi->poliklinik->name;

            //mengarahkan transaksi masuk detail pada global menjadi transaksi id pada lokal
            $transaksi_masuk_detail = app('App\Http\Controllers\Hospital\Transaksi\EditController')->edit($transaksi_masuk_detail->id, $transaksi->id);

            //permintaan rekam medis
            $request->merge(['pasien' => $transaksi->pasien_id, 'tujuan' => "Pelayanan", 'lokasi' => $lokasi, 'keterangan' => "Permintaan dari Rawat Jalan"]);

            $poli = Poliklinik::find($poli_id);

            $data_rm = [];
            $data_rm['pasien_id'] = $request->pasien_id;
            $data_rm['status'] = 0;
            $data_rm['holder_type'] = 2;
            $data_rm['holder_user_id'] = null;
            $data_rm['holder_group_id'] = $poli->group_id;
            $data_rm['holder_keterangan'] = null;

            $data_rm['tujuan_id'] = 1; //Pelayanan pasien
            $data_rm['lokasi'] = $poli->name;
            $data_rm['jenis'] = 1;

            $data_rm['sender_confirmed_at'] = null;
            $data_rm['sender_confirmed_by'] = null;
            $data_rm['sender_keterangan'] = null;

            $rm_trans = app('App\Http\Controllers\RekamMedis\Transaksi\CreateController')->create($data_rm);

            if ($rujuk_id > 0) {
                $permintan_rujukan = PermintaanRujuk::find($rujuk_id);
                $permintan_rujukan->status = 1;
                $permintan_rujukan->save();

                //akan di cek apakah SEP nya diganti apa ngga
                //jika diganti dan memang blm ada SEP nya maka, SEPnya yang baru akan dibuat
                if ($kasus_id > 0) {
                    if ($nomor_sep != '0') {
                        $cekSEP = app('App\Http\Controllers\Kasus\BPJS\PostController')->cekSEP($nomor_sep, $kasus_id);
                    }
                }
            }

            if ($total_retribusi != 0) {
                $kasir = $this->kirimKasir($request);
            }

            $status = 1;
            $message = 'Pasien berhasil didaftarkan ke dalam antrian.';
            $title = 'Berhasil!';

            if (!empty($transaksi->kasus_id)) {
                $log = app('App\Http\Controllers\Kasus\Log\CreateController')
                    ->create($transaksi->kasus_id, 'create', 'administrasi-rawatjalan-daftar', $transaksi->id);
            }

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Pasien berhasil didaftarkan';
            $data['url'] = 'rawatjalan/poliklinik/' . $poli_id;

            DB::connection('rawatjalan')->commit();
            DB::connection('rekammedis')->commit();
            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            DB::connection('kasir')->commit();
            return json_encode($data);
        } catch (\Exception $e) {

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('rawatjalan')->rollback();
            DB::connection('rekammedis')->rollback();
            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            DB::connection('kasir')->rollback();

            $data['type'] = 'error';
            $data['title'] = 'Gagal Mendaftarkan Pasien';
            $data['text'] = 'Pasien gagal didaftarkan';
            $data['url'] = 0;
        }
    }

    public function layaniPasien(Request $request)
    {
        DB::connection('rawatjalan')->beginTransaction();
        DB::connection('kasus')->beginTransaction();
        try {
            $perawat_url = Auth::user()->profesi == 2 ? '/datamedis/asesmenawal' : '';
            $transaksi_id = $request->input('transaksi_id');

            $asal_rujukan_id = null;

            $transaksi = Transaksi::with('rujukan')->where('id', $transaksi_id)->first();
            $judul_kasus = 'Rawat Jalan #' . $transaksi_id;
            $pasien = Pasien::find($transaksi->pasien_id);
            $kelas = $transaksi->kelas_id; //ID KELAS URJ
            $lokasi = $transaksi->poliklinik->lokasi_id;

            if ($transaksi->asal_rujukan != 0) {
                $pasien->asal_rujukan = $transaksi->rujukan->nama ?? '-';
                $asal_rujukan_id = $transaksi->asal_rujukan ?? '';
            } else $pasien->asal_rujukan = "-";

            if (Auth::user()->profesi ==  1) {
                $status_tipe = 1;
            } else {
                $status_tipe = 0;
            }

            if (empty($transaksi->kasus_id)) {
                $kasus = app('App\Http\Controllers\Kasus\Kasus\CreateController')
                    ->createKasus($judul_kasus, $pasien, $lokasi, $transaksi->id, $kelas, $transaksi->pasien_pembayaran_id, $transaksi->nomor_sep, null, $asal_rujukan_id);

                $kasus->tipe_rj = 1;
                $kasus->save();

                $transaksi->status = $status_tipe;
                $transaksi->kasus_id = $kasus->id;
                if ($status_tipe == 1) {
                    $transaksi->waktu_pemeriksaan = Carbon::now();
                }
                $transaksi->save();

                // add retribusi if retribusi_list is not null
                if (!empty($transaksi->retribusi_list)) {
                    $retribusi_kasus = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->addRetribusi($transaksi->retribusi_list, $transaksi->kasus_id, $transaksi->is_online);

                    if (!empty($retribusi_kasus)) {
                        $transaksi->retribusi_list = NULL;
                        $transaksi->save();
                    }
                }
            } else {
                if (!empty($transaksi->permintaan_rujuk_id) && $transaksi->status == 0) {
                    $this->changeKasusLokasi($transaksi->kasus_id, $lokasi);
                    if ($transaksi->kasus->pembayaran->perusahaan->tipe->slug == 'bpjs')
                        $activesep = app('App\Http\Controllers\Kasus\Kasus\EditController')->changeActiveSEPtoLatestSEP($transaksi->kasus_id);

                    $transaksi->status = $status_tipe;
                    if ($status_tipe == 1) {
                        $transaksi->waktu_pemeriksaan = Carbon::now();
                    }
                    $transaksi->save();
                } elseif ($transaksi->status == 0) {
                    $transaksi->status = 1;
                    if ($status_tipe == 1) {
                        $transaksi->waktu_pemeriksaan = Carbon::now();
                    }
                    $transaksi->save();
                }
            }

            $this->checkIfKolaborator($transaksi->kasus_id);

            if (!empty($pasien->is_baru)) {
                if ($pasien->is_baru == 1) {
                    $update_pasien = app('App\Http\Controllers\Pasien\Pasien\EditController')->updatePasienBaru($pasien->id);
                    $transaksi->is_pasien_baru = 1;
                    $transaksi->save();
                    $update_kasus = app('App\Http\Controllers\Kasus\Kasus\EditController')->updateKasusBaru($transaksi->kasus_id);
                }
            }

            if (config('medify.third-party.jkn_online.on') && $transaksi->task_id_jkn < 4) {
                $carbon_today = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                $carbon_today = strtotime($carbon_today) * 1000;
                //$data['kodebooking'] = $transaksi->id;
                //$data['taskid'] = 4;
                //$data['waktu'] = $carbon_today;
                //dispatch(new QueueArtisan('command:update-task-jkn-id', ['kodebooking' => $transaksi->id, 'taskid' => 4, 'waktu' => $carbon_today]));
                $data = [
                    'kodebooking' => $transaksi->id,
                    'taskid' => 4,
                    'waktu' => $carbon_today
                ];
                $returned = app(\App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean\PostController::class)->updateTaskId($data);
                $returned = json_decode($returned);
                $metadata = isset($returned->metadata) ? $returned->metadata : $returned->metaData;
                if ($metadata->code != "200") {
                    $data_log['kodebooking'] = $transaksi->id;
                    $data_log['response'] = json_encode($returned);

                    app(\App\Http\Controllers\ThirdParty\LogErrorJkn\CreateController::class)->create($data_log);
                } else {
                    $data_log['kodebooking'] = $transaksi->id;
                    $data_log['task_id'] = 4;
                    $data_log['waktu'] = $carbon_today;
                    $data_log['response'] = json_encode($returned);
                    $data_log['request'] = $data;

                    app(\App\Http\Controllers\ThirdParty\LogJkn\CreateController::class)->create($data_log);
                }
                $transaksi = Transaksi::find($transaksi->id);
                $transaksi->task_id_jkn = 4;
                $transaksi->save();
            }

            DB::connection('kasus')->commit();
            DB::connection('rawatjalan')->commit();
            return redirect('kasus/' . $transaksi->kasus->nomor_kasus . $perawat_url);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('rawatjalan')->rollback();
            DB::connection('kasus')->rollback();
        }
    }

    private function checkIfKolaborator($kasus_id)
    {
        /*CHECK APAKAH SI USER KOLABORATOR, JIKA TIDAK MAKA DI CREATE, JIKA IYA MAKA DI UPDATE*/
        $user_id = Auth::user()->id;
        $status = app('App\Http\Controllers\Kasus\Kolaborator\ReadController')->checkIfExist($kasus_id, $user_id);
        if (!empty($status->id))
            $status = app('App\Http\Controllers\Kasus\Kolaborator\EditController')->updateStatus($status->id, 1);
        else
            $status = app('App\Http\Controllers\Kasus\Kolaborator\CreateController')->createWithStatus($kasus_id, $user_id, 1, 0);
    }

    private function changeKasusLokasi($kasus_id, $lokasi)
    {
        $id_user = Auth::user()->id;
        # TODO byepass pindah ruangan gizi
        // app('App\Http\Controllers\Gizi\Pemesanan\PostController')->pindahRuangan($kasus_id,$lokasi);
        $data = new Lokasi;
        $data->kasus_id = $kasus_id;
        $data->lokasi_id = $lokasi;
        $data->created_by = $id_user;
        $data->save();

        return 1;
    }




    public function rujukPoli(Request $request)
    {
        $pasien_id = $request->input('pasien_id');
        $ruangan_id = $request->input('ruangan_id');
        $kasus_id = $request->input('kasus_id');
        $transaksi_masuk_id = $request->input('transaksi_masuk_id');

        $last_antrian = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getLastAntrian($ruangan_id);
        #buat dulu transaksi masuk
        #yang me return transaksi_masuk_detail
        $transaksi_detail = app('App\Http\Controllers\Hospital\Transaksi\CreateController')->createDetail($transaksi_masuk_id, 2, 1);

        #buat transaksi pada IGD
        $transaksi = new Transaksi;
        $transaksi->poliklinik_id = $ruangan_id;
        $transaksi->pasien_id = $pasien_id;
        $transaksi->nomor_antrian = $last_antrian + 1;
        $transaksi->kasus_id = $kasus_id;
        $transaksi->ordered_at = $this->getEstimasiWaktuPemeriksaan($last_antrian + 1);
        $transaksi->transaksi_masuk_detail_id = $transaksi_detail->id;
        $transaksi->status = 1;
        $transaksi->created_by = Auth::user()->id;
        $transaksi->save();
        #mengupdate transaksi_detail yang tadi dibuat, karena dia tadi belum nyimpen local id
        $transaksi_detail = app('App\Http\Controllers\Hospital\Transaksi\EditController')->edit($transaksi_detail->id, $transaksi->id);
        $kasus = Kasus::find($kasus_id);
        #kalo dia gabuat kasus baru maka perlu di arahkan supaya jadi aktif lagi
        $changePoli = $this->updatePoli($kasus->transaksi_masuk_detail_id, $transaksi->id);
        $newTransaksiMasukDetail = app('App\Http\Controllers\Kasus\Kasus\EditController')->changeActiveTransaksiMasukDetail($transaksi->kasus_id, $transaksi->transaksi_masuk_detail_id);

        $log = app('App\Http\Controllers\Kasus\Log\CreateController')
            ->create($kasus->id, 'create', 'administrasi-rawatjalan-pindah', $transaksi->id);

        $data['type'] = 'success';
        $data['title'] = 'Berhasil';
        $data['text'] = 'Pasien Rawat Jalan berhasil dirujuk';

        return json_encode($data);
    }

    private function updatePoli($old_id, $new_poli_id)
    {
        $old_transaksi = GlobalTransaksiMasukDetail::find($old_id);
        $old_poli = Transaksi::find($old_transaksi->transaksi_lokal_id);

        $new_poli = Transaksi::find($new_poli_id);
        $new_poli->is_karcis_pengunjung = $old_poli->is_karcis_pengunjung;
        $new_poli->is_kartu_baru = $old_poli->is_kartu_baru;
        $new_poli->is_karcis_poli = $old_poli->is_karcis_poli;
        $new_poli->is_file_tni = $old_poli->is_file_tni;
        $new_poli->total_retribusi = $old_poli->total_retribusi;
        $new_poli->asal_rujukan = $old_poli->asal_rujukan;
        $new_poli->nomor_sep = $old_poli->nomor_sep;
        $new_poli->pasien_pembayaran_id = $old_poli->pasien_pembayaran_id;
        $new_poli->save();

        return $new_poli;
    }

    public function kirimKasir(Request $request)
    {
        $pasien_id = $request->input('pasien_id');
        $pasien = Pasien::find($pasien_id);

        $is_karcis = $request->input('is_karcis');
        if ($is_karcis) {
            $newtrans = new TagihanDetail;
            $newtrans->layanan_id = 1282;
            $newtrans->layanan_string = "Karcis Pengunjung Baru";
            $newtrans->tipe = 1;
            $newtrans->kelas = "URJ";
            $newtrans->departemen_id = 20;
            $newtrans->harga = 15000;
            $newtrans->diskon = 0;
            $newtrans->jumlah = 1;
            $newtrans->subtotal = 15000;
            $newtrans->created_at = Carbon::now();
            $newtrans->updated_at = Carbon::now();
            $newtrans->created_by = Auth::user()->id;
            $transaksi[] = $newtrans;
        }

        $is_kartu = $request->input('is_kartu');
        if ($is_kartu) {
            $newtrans = new TagihanDetail;
            $newtrans->layanan_id = 1283;
            $newtrans->layanan_string = "Kartu Baru";
            $newtrans->tipe = 1;
            $newtrans->kelas = "URJ";
            $newtrans->departemen_id = 20;
            $newtrans->harga = 20000;
            $newtrans->diskon = 0;
            $newtrans->jumlah = 1;
            $newtrans->subtotal = 20000;
            $newtrans->created_at = Carbon::now();
            $newtrans->updated_at = Carbon::now();
            $newtrans->created_by = Auth::user()->id;
            $transaksi[] = $newtrans;
        }

        $is_kartu_poli = $request->input('is_kartu_poli');
        if ($is_kartu_poli) {
            $newtrans = new TagihanDetail;
            $newtrans->layanan_id = 1284;
            $newtrans->layanan_string = "Karcis Poli";
            $newtrans->tipe = 1;
            $newtrans->kelas = "URJ";
            $newtrans->departemen_id = 20;
            $newtrans->harga = 20000;
            $newtrans->diskon = 0;
            $newtrans->jumlah = 1;
            $newtrans->subtotal = 20000;
            $newtrans->created_at = Carbon::now();
            $newtrans->updated_at = Carbon::now();
            $newtrans->created_by = Auth::user()->id;
            $transaksi[] = $newtrans;
        }

        $is_file_tni = $request->input('is_file');
        if ($is_file_tni) {
            $newtrans = new TagihanDetail;
            $newtrans->layanan_id = 1286;
            $newtrans->layanan_string = "File TNI/BPJS";
            $newtrans->tipe = 1;
            $newtrans->kelas = "URJ";
            $newtrans->departemen_id = 20;
            $newtrans->harga = 0;
            $newtrans->diskon = 0;
            $newtrans->jumlah = 1;
            $newtrans->subtotal = 0;
            $newtrans->created_at = Carbon::now();
            $newtrans->updated_at = Carbon::now();
            $newtrans->created_by = Auth::user()->id;
            $transaksi[] = $newtrans;
        }

        $request->merge([
            'id' => null,
            'kasir_id' => 7,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'alljumlah' => $request->total_retribusi,
            'alldiskon' => 0,
            'alltotal' => $request->total_retribusi,
            'asal_layanan' => "URJ",
            'pasien_id' => $pasien_id,
            'transaksi' => json_encode($transaksi),
            'judul' => 'Retribusi Pendaftaran Rawat Jalan - ' . $pasien->name
        ]);

        if (!empty($transaksi)) {
            $transaksi_kasir = app('App\Http\Controllers\Kasir\Transaksi\PostController')->apiSubmit($request);
        } else $transaksi_kasir = null;

        return $transaksi_kasir;
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
            ->with('active_nav', 'cppt')
            ->with('title', $title)
            ->with('status', $status);
        return back();
    }

    public function kembalikanFile($transaksi_id)
    {
        $transaksi = Transaksi::find($transaksi_id);

        $data['pasien_id'] = $transaksi->pasien_id;
        $data['status'] = 1;
        $data['holder_keterangan'] = '';
        $data['holder_type'] = 2;
        $data['holder_user_id'] = null;
        $rm_group = app('App\Http\Controllers\Group\Group\ReadController')->getRMGroupSlug('rekam-medis');
        $data['holder_group_id'] = $rm_group->id;

        $data['lokasi'] = 'Poli ' . $transaksi->poliklinik->name;
        $data['tujuan_id'] = 1;
        $data['jenis'] = 2;

        $data['sender_confirmed_at'] = Carbon::now();
        $data['sender_confirmed_by'] = Auth::user()->id;
        $data['sender_keterangan'] = '';

        $rm_transaksi = app('App\Http\Controllers\RekamMedis\Transaksi\CreateController')->create($data);
        $transaksi = app('App\Http\Controllers\RawatJalan\Transaksi\EditController')->editTransaksiPengembalianRM($transaksi->id, $rm_transaksi->id);

        $status = 1;
        $message = 'Berhasil membuat pengembalian file';
        $title = 'Berhasil!';

        return back()
            ->with('message', $message)
            ->with('active_nav', 'cppt')
            ->with('title', $title)
            ->with('status', $status);
        return back();
    }

    public function sepEdit(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);

        if (isset($request->sep)) {
            $sep = json_decode($request->sep);
            $nomor_sep = $sep->no_sep;
        } else {
            $nomor_sep = $request->custom_sep;
            $sep['no_bpjs'] = $transaksi->pasien_pembayaran->no_asuransi;
            $sep['tgl_sep'] = Carbon::now()->format('Y-m-d');
            $sep['jenis_pelayanan'] = 2;
            $sep['no_rm'] = $transaksi->pasien->no_rm;
            $sep['pasien_id'] = $transaksi->pasien->id;
            $sep['created_by'] = Auth::user()->id;
        }

        $transaksi->nomor_sep = $nomor_sep;
        $transaksi->save();

        app('App\Http\Controllers\BPJS\SEP\CreateController')->create($sep, $nomor_sep);

        return redirect('rawatjalan/transaksi/pendaftaran/' . $id)
            ->with('message', 'Sukses mengubah nomor SEP')
            ->with('title', 'Sukses')
            ->with('status', 1);
    }

    public function generateAutoSEP($transaksi_id)
    {
        $no_sep_rujukan = null;
        $is_rujukan = false;
        $transaksi = Transaksi::with(['permintaan_rujuk.kasus.sep'])->find($transaksi_id);
        if (!is_null($transaksi->permintaan_rujuk_id)) {
            $is_rujukan = true;
            $no_sep_rujukan = $transaksi->permintaan_rujuk->kasus->sep->no_sep ?? null;
        }

        if ($is_rujukan) {
            $return_data['status'] = 3;
            $return_data['result']['response']['sep']['noSep'] = $no_sep_rujukan;
            $auto_sep = json_encode($return_data);

            $transaksi->nomor_sep = $no_sep_rujukan;
            $transaksi->save();
        } else {
            $transaksi->auto_sep_online_retry_at = Carbon::now();
            $transaksi->save();

            $pasien_id = $transaksi->pasien_id;
            $pembayaran_id = $transaksi->pasien_pembayaran_id;
            $poli_id = $transaksi->poliklinik_id;
            $dokter_id = $transaksi->dokter_id;

            $auto_sep = app('App\Http\Controllers\BPJS\AutoSEP\CreateController')->generate('rawatjalan', $pasien_id, $pembayaran_id, $poli_id, $dokter_id);
            $result_sep = json_decode($auto_sep);
            if ($result_sep->status == 200) {
                $transaksi->nomor_sep = $result_sep->result->response->sep->noSep ?? null;
                $transaksi->save();
            }
        }

        return $auto_sep;
    }

    public function generateAntrianPasien(Request $request)
    {
        $antrian = $request->antrian_data ?? [];
        if (!empty($antrian)) {
            try {
                // ? create transaksi rawat jalan
                $pasien_id = $antrian['pasien']['id'];
                $pembayaran_id = $antrian['pembayaran_id'];
                $poli_id = $antrian['poli_tujuan'];
                $dokter_id = $antrian['dokter_id'];
                $jadwal_id = $antrian['jadwal_id'];
                $nomor_sep = $antrian['nomor_sep'] ?? null;
                $rujuk_id = $antrian['rujuk_id'] ?? null;
                if (empty($nomor_sep) && !empty($rujuk_id)) {
                    $rujukan = \App\Models\RawatJalan\PermintaanRujuk::with('kasus.sep')->find($rujuk_id);
                    if (!empty($rujukan)) {
                        $nomor_sep = $rujukan->kasus->sep->no_sep ?? null;
                    }
                }
                $pasien = app('App\Http\Controllers\Pasien\Pasien\ReadController')->getSingle($pasien_id);

                $request_data = new \Illuminate\Http\Request();
                $request_data->replace([
                    'is_online' => 0,
                    'is_video' => 0,
                    'pasien_id' => $pasien_id,
                    'pasien_data' => $pasien,
                    'bayar_id' => $pembayaran_id,
                    'is_bpjs' => 1,
                    'dokter_id' => $dokter_id,
                    'dokter_jadwal_id' => $jadwal_id,
                    'layanan' => 1,
                    'poliklinik_id' => $poli_id,
                    'rujuk_id' => $rujuk_id
                ]);
                $data = app('App\Http\Controllers\Pasien\Pasien\PostController')->APIPendaftaranPasien($request_data);
                $data = json_decode($data);
                $transaksi = Transaksi::find($data->transaksi_id);
                $transaksi->nomor_sep = $nomor_sep;
                $transaksi->rujuk = !empty($rujuk_id) ? 1 : 0;
                $transaksi->auto_sep_online_retry_at = Carbon::now();
                $transaksi->save();

                $return_data['status'] = 1;
                $return_data['message'] = 'Pendaftaran Pasien Berhasil';
                $return_data['ordered_at'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($transaksi->ordered_at, '%d %B %Y, %H:%M');
                $return_data['barcode'] = '<img class="big_barcode" src="data:image/png;base64,' . DNS1D::getBarcodePNG($transaksi->pasien->no_rm, "C128", 3, 30) . '" alt="barcode"  style="width:900px;" />';
                $return_data['transaksi'] = $transaksi;
                $return_data['check_in'] = Carbon::now()->format('d-m-Y H:i:s');

                return json_encode($return_data);
            } catch (\Exception $e) {
                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
                return json_encode(['status' => -1, 'message' => 'Pendaftaran Pasien Gagal']);
            }
        }
        return json_encode(['status' => -1, 'message' => 'Pendaftaran Pasien Gagal']);
    }

    public function updateSelesaiPelayanan(Request $request)
    {
        try {
            $id = $request->input('id');
            $transaksi = Transaksi::find($id);
            $transaksi->selesai_pelayanan_at = now();
            $transaksi->selesai_pelayanan_by = Auth::user()->id ?? 1;
            $transaksi->save();
            if ($transaksi && $transaksi->task_id_jkn < 5) {
                $carbon_today = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                $carbon_today = strtotime($carbon_today) * 1000;
                $data['kodebooking'] = $transaksi->id;
                $data['taskid'] = 5;
                $data['waktu'] = $carbon_today;
                dispatch(new QueueArtisan('command:update-task-jkn-id', ['kodebooking' => $transaksi->id, 'taskid' => 5, 'waktu' => $carbon_today]));
                $transaksi = Transaksi::find($transaksi->id);
                $transaksi->task_id_jkn = 5;
                $transaksi->save();
            }

            return response()->json(['status' => 'success', 'message' => 'Pelayanan selesai.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Gagal selesaikan pelayanan.']);
        }
    }
}
