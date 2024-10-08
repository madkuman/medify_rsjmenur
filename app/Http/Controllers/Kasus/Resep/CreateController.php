<?php

namespace App\Http\Controllers\Kasus\Resep;

use App\Jobs\QueueArtisan;
use App\Models\Kasus\CPPT;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Lokasi;
use App\Models\Kasus\Resep;
use App\Models\Kasus\ResepDetail;
use App\Models\Kasus\ResepRacikanDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Farmasi\TipeRacikan;
use App\User;
use Auth;
use DB;
use Bugsnag;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function createNewResep($nomorKasus, Request $request)
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        DB::connection('farmasi')->beginTransaction();
        try {
            if (!empty($request->kategori_resep)) {
                $kasus = $request->kasus;
                if ($request->kategori_resep == 'tpn') {
                    $resep = $this->createKategoriResepTpn(null, $request);
                } else if ($request->kategori_resep == 'dispensing_aseptik') {
                    $resep = $this->createKategoriResepDispensingAseptik(null, $request);
                } else {
                    $resep = $this->createKategoriResepDefault(null, $request);
                }
                if (empty($kasus->sep_id)) {
                    $noSEP = null;
                } else {
                    $noSEP = $kasus->sep_id;
                }

                $kirim_farmasi = $request->input('kirim-farmasi');
                if ($kirim_farmasi == "on") {
                    $is_video = 0;
                    if (isset($kasus->rawat_jalan_transaksi_first) && !empty($kasus->rawat_jalan_transaksi_first) && $kasus->tipe_igd == 0 && $kasus->tipe_mc == 0 && $kasus->tipe_ri == 0 && $kasus->rawat_jalan_transaksi_first->is_video == 1) {
                        $is_video = 1;
                    }
                    $request->merge(['kasus_id' => $kasus->id, 'resep_id' => $resep->id, 'pasien_id' => $kasus->pasien_id, 'sep_id' => $noSEP, 'no_redirect' => 1, 'is_video' => $is_video]);
                    $resep_farmasi = app(\App\Http\Controllers\Farmasi\Transaksi\CreateController::class)->createFromResepKasus(null, $request, $resep);

                    $resep->transaksi_id = $resep_farmasi->id;
                    $resep->save();
                }
                // dd($resep_farmasi);
                $log = app('App\Http\Controllers\Kasus\Log\CreateController')->create($kasus->id, 'create', 'resep', $resep->id);

                DB::connection('kasus')->commit();
                DB::connection('mysql')->commit();
                DB::connection('farmasi')->commit();
                return back()
                    ->with('active_nav', 'resep')
                    ->with('message', 'Resep berhasil dibuat!')
                    ->with('title', 'Berhasil!')
                    ->with('status', 1);
            }
            $kasus = Kasus::where('nomor_kasus', $nomorKasus)->first();
            $kasusId = $kasus->id;
            $pasienId = Kasus::where('nomor_kasus', $nomorKasus)->pluck('pasien_id')->first();

            $farmasi = $request->input('nama-apotek');
            $jenis_resep = $request->input('jenis_resep');
            $kirim_farmasi = $request->input('kirim-farmasi');
            $kategoriObat = $request->input('kategori-obat');
            $tipeObat = $request->input('tipe-obat');
            $jumlahObat = $request->input('jumlah-obat');
            $namaObat = $request->input('nama-obat');
            $racikan = $request->input('racikan');
            $aturanObat = $request->input('aturan-obat');
            $idObat = $request->input('id-obat');
            $racikan_detail_obat = $request->input('racikan-detail-obat');
            $racikan_detail_jumlah = $request->input('racikan-detail-jumlah');

            $resep = new Resep();
            $resep->kasus_id = $kasusId;
            $resep->jenis_resep = $jenis_resep;
            $resep->created_by = Auth::user()->id;
            $resep->save();

            $resepId = $resep->id;

            $size = sizeof($namaObat);

            for ($i = 0; $i < $size; $i++) {
                $resepDetail = new ResepDetail();
                $resepDetail->kasus_resep_id = $resepId;
                $resepDetail->obat_name = $namaObat[$i];
                $resepDetail->kategori = $kategoriObat[$i];
                $resepDetail->type = $tipeObat[$i];
                $resepDetail->racikan = $racikan[$i];
                $resepDetail->jumlah = $jumlahObat[$i];
                $resepDetail->aturan = $aturanObat[$i];
                if ($resepDetail->kategori != 'racikan') {
                    $resepDetail->obat_id = $idObat[$i];
                }
                $resepDetail->save();

                $this->kirimCatatanObatPx($resepDetail, $kasus->id);

                if ($resepDetail->kategori == 'racikan') {
                    $racikanDetailObat = json_decode($request->input('racikan-detail-obat')[$i]);
                    $racikanDetalJumlah = json_decode($request->input('racikan-detail-jumlah')[$i]);
                    $racikanDetalNama = json_decode($request->input('racikan-detail-nama')[$i]);

                    foreach ($racikanDetailObat as $index => $item_racikan_temp) {

                        $racikanDetail = new ResepRacikanDetail;
                        $racikanDetail->resep_detail_id = $resepDetail->id;
                        $racikanDetail->nama_obat = $racikanDetalNama[$index];
                        $racikanDetail->obat_id = $racikanDetailObat[$index];
                        $racikanDetail->jumlah = $racikanDetalJumlah[$index];
                        $racikanDetail->save();
                    }
                }
            }
            if (empty($kasus->sep_id)) {
                $noSEP = null;
            } else $noSEP = $kasus->sep_id;


            if ($kirim_farmasi == "on") {
                $is_video = 0;
                if (isset($kasus->rawat_jalan_transaksi_first) && !empty($kasus->rawat_jalan_transaksi_first) && $kasus->tipe_igd == 0 && $kasus->tipe_mc == 0 && $kasus->tipe_ri == 0 && $kasus->rawat_jalan_transaksi_first->is_video == 1) {
                    $is_video = 1;
                }
                $request->merge(['kasus_id' => $kasusId, 'resep_id' => $resepId, 'pasien_id' => $pasienId, 'sep_id' => $noSEP, 'no_redirect' => 1, 'is_video' => $is_video]);
                $resep_farmasi = app('App\Http\Controllers\Farmasi\Transaksi\CreateController')->doCreate($request);

                $resep->transaksi_id = $resep_farmasi->id;
                $resep->save();
            }

            if (config('medify.third-party.jkn_online.on')) {
                $kasus = app(\App\Http\Controllers\Kasus\Kasus\ReadController::class)->get($kasus->nomor_kasus);
                $transaksi = $kasus->rawat_jalan_transaksi_last_attr;
                $profesi = Auth::user()->profesi;
                if ($kasus->lokasi->lokasi->departemen->id == 2 && $transaksi && $transaksi->task_id_jkn < 5) {
                    $carbon_today = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                    $carbon_today = strtotime($carbon_today) * 1000;
                    $data['kodebooking'] = $transaksi->id;
                    $data['taskid'] = 5;
                    $data['waktu'] = $carbon_today;
                    $data['jenisresep'] = ucfirst($request->input('kategori')) ?? 'Tidak ada';
                    dd($data);
                    dispatch(new QueueArtisan('command:update-task-jkn-id', ['kodebooking' => $transaksi->id, 'taskid' => 5, 'waktu' => $carbon_today, 'jenisresep' => ucfirst($request->input('kategori')) ?? 'Tidak ada']));
                }
            }

            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
                ->create($kasusId, 'create', 'resep', $resep->id);

            $status = 1;
            $message = 'Resep berhasil dibuat!';
            $title = 'Berhasil!';



            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            DB::connection('farmasi')->commit();
            return back()
                ->with('active_nav', 'resep')
                ->with('message', $message)
                ->with('title', $title)
                ->with('status', $status);
        } catch (\Exception $e) {

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('farmasi')->rollback();
            DB::connection('mysql')->rollback();
        }
    }

    function createKategoriResepOld($request)
    {
        $kasus = Kasus::where('nomor_kasus', $nomorKasus)->first();
        $kasusId = $kasus->id;
        $pasienId = Kasus::where('nomor_kasus', $nomorKasus)->pluck('pasien_id')->first();

        $farmasi = $request->input('nama-apotek');
        $jenis_resep = $request->input('jenis_resep');
        $kirim_farmasi = $request->input('kirim-farmasi');
        $kategoriObat = $request->input('kategori-obat');
        $tipeObat = $request->input('tipe-obat');
        $jumlahObat = $request->input('jumlah-obat');
        $namaObat = $request->input('nama-obat');
        $racikan = $request->input('racikan');
        $aturanObat = $request->input('aturan-obat');
        $idObat = $request->input('id-obat');
        $racikan_detail_obat = $request->input('racikan-detail-obat');
        $racikan_detail_jumlah = $request->input('racikan-detail-jumlah');

        $resep = new Resep();
        $resep->kasus_id = $kasusId;
        $resep->jenis_resep = $jenis_resep;
        $resep->created_by = Auth::user()->id;
        $resep->save();

        $resepId = $resep->id;

        $size = sizeof($namaObat);

        for ($i = 0; $i < $size; $i++) {
            $resepDetail = new ResepDetail();
            $resepDetail->kasus_resep_id = $resepId;
            $resepDetail->obat_name = $namaObat[$i];
            $resepDetail->kategori = $kategoriObat[$i];
            $resepDetail->type = $tipeObat[$i];
            $resepDetail->racikan = $racikan[$i];
            $resepDetail->jumlah = $jumlahObat[$i];
            $resepDetail->aturan = $aturanObat[$i];
            if ($resepDetail->kategori != 'racikan') {
                $resepDetail->obat_id = $idObat[$i];
            }
            $resepDetail->save();

            $this->kirimCatatanObatPx($resepDetail, $kasus->id);

            if ($resepDetail->kategori == 'racikan') {
                $racikanDetailObat = json_decode($request->input('racikan-detail-obat')[$i]);
                $racikanDetalJumlah = json_decode($request->input('racikan-detail-jumlah')[$i]);
                $racikanDetalNama = json_decode($request->input('racikan-detail-nama')[$i]);

                foreach ($racikanDetailObat as $index => $item_racikan_temp) {

                    $racikanDetail = new ResepRacikanDetail;
                    $racikanDetail->resep_detail_id = $resepDetail->id;
                    $racikanDetail->nama_obat = $racikanDetalNama[$index];
                    $racikanDetail->obat_id = $racikanDetailObat[$index];
                    $racikanDetail->jumlah = $racikanDetalJumlah[$index];
                    $racikanDetail->save();
                }
            }
        }

        return $resep;
    }

    function createKategoriResepDefault($resep, $request)
    {
        $kasus = $request->kasus;

        if ($resep == null) {
            $resep = new Resep();
            $resep->created_by = auth()->id();
            $resep->cito = ($request->cito ?? null) == 'on' ? 1 : 0;
            $resep->farmasi_id = $request->input('nama-apotek');
            $resep->kasus_id = $kasus->id;
            $resep->kategori_resep = 'default';
        } else {
            ResepDetail::where('kasus_resep_id', $resep->id)->delete();
            ResepRacikanDetail::whereHas('kasus_resep_detail', function ($query) use ($resep) {
                $query->select(DB::raw(1))
                    ->where('kasus_resep_id', $resep->id);
            })->delete();
        }
        $resep->resep_iter = $request->resep_iter ?? null;
        $resep->jenis_resep = $request->jenis_resep;
        $resep->save();

        foreach ($request->kategori_resep_default['daftar_obat'] as $item) {
            $resep_detail = new ResepDetail();
            $resep_detail->kasus_resep_id = $resep->id;
            $resep_detail->kategori = $item['kategori'];
            $resep_detail->jumlah = $item['jumlah'];
            $resep_detail->aturan = $item['aturan_penggunaan'];
            if ($resep_detail->kategori == 'generik') {
                $item_farmasi = ItemsFarmasi::find($item['item_farmasi_id']);
                $resep_detail->obat_name = $item_farmasi->item_template->nama;
                $resep_detail->obat_id = $item_farmasi->item_template->id;
                $resep_detail->type = $item_farmasi->item_template->satuan;
            } else {
                $resep_detail->racikan = $item['nama_obat'];
                $resep_detail->type = '';
                $resep_detail->tipe_racikan_id = $item['tipe_racikan_id'];
            }
            $resep_detail->save();

            if ($resep_detail->kategori != 'generik') {
                foreach ($item['racikan'] as $item_racikan) {
                    $item_farmasi = ItemsFarmasi::find($item_racikan['item_farmasi_id']);
                    $racikanDetail = new ResepRacikanDetail;
                    $racikanDetail->resep_detail_id = $resep_detail->id;
                    $racikanDetail->nama_obat = $item_farmasi->item_template->nama;
                    $racikanDetail->obat_id = $item_farmasi->item_template->id;
                    $racikanDetail->dosis = $item_racikan['dosis'];
                    $racikanDetail->jumlah = $item_racikan['jumlah'];
                    $racikanDetail->save();
                }
            }
        }
        return $resep;
    }

    function createKategoriResepDispensingAseptik($resep, $request)
    {
        $kasus = $request->kasus;

        if ($resep == null) {
            $resep = new Resep();
            $resep->created_by = auth()->id();
            $resep->farmasi_id = $request->input('nama-apotek');
            $resep->cito = ($request->cito ?? null) == 'on' ? 1 : 0;
            $resep->kategori_resep = 'dispensing_aseptik';
            $resep->kasus_id = $kasus->id;
        } else {
            ResepDetail::where('kasus_resep_id', $resep->id)->delete();
            ResepRacikanDetail::whereHas('kasus_resep_detail', function ($query) use ($resep) {
                $query->select(DB::raw(1))
                    ->where('kasus_resep_id', $resep->id);
            })->delete();
        }
        $resep->resep_iter = $request->resep_iter ?? null;
        $resep->jenis_resep = $request->jenis_resep;
        $resep->save();

        foreach ($request->kategori_resep_dispensing_aseptik['daftar_obat'] as $item) {
            $resep_detail = new ResepDetail();
            $resep_detail->kasus_resep_id = $resep->id;
            $resep_detail->kategori = 'racikan';
            $resep_detail->jumlah = $item['jumlah'];
            $resep_detail->aturan = $item['aturan_penggunaan'];
            $resep_detail->racikan = $item['nama_obat'];
            $resep_detail->type = '';
            $resep_detail->dispensing_aseptik_aturan_penggunaan = $item['aturan_penggunaan'];
            $resep_detail->dispensing_aseptik_catatan = $item['catatan'];
            $resep_detail->save();

            $item_farmasi = ItemsFarmasi::find($item['obat']);
            $racikan_detail = new ResepRacikanDetail;
            $racikan_detail->resep_detail_id = $resep_detail->id;
            $racikan_detail->nama_obat = $item_farmasi->item_template->nama;
            $racikan_detail->obat_id = $item_farmasi->item_template->id;
            $racikan_detail->jumlah = $item['dosis'];
            $racikan_detail->dispensing_aseptik_dosis = $item['dosis'];
            $racikan_detail->dispensing_aseptik_dosis_yang_dibutuhkan = $item['dosis_yang_dibutuhkan'];
            $racikan_detail->dispensing_aseptik_jenis_racikan = 'obat_permintaan';
            $racikan_detail->save();

            $item_farmasi_pelarut = ItemsFarmasi::find($item['obat_pelarut']);
            $racikan_detail_pelarut = new ResepRacikanDetail;
            $racikan_detail_pelarut->resep_detail_id = $resep_detail->id;
            $racikan_detail_pelarut->nama_obat = $item_farmasi_pelarut->item_template->nama;
            $racikan_detail_pelarut->obat_id = $item_farmasi_pelarut->item_template->id;
            $racikan_detail_pelarut->jumlah = 1;
            $racikan_detail_pelarut->dispensing_aseptik_dosis = 1;
            $racikan_detail_pelarut->dispensing_aseptik_dosis_yang_dibutuhkan = 1;
            $racikan_detail_pelarut->dispensing_aseptik_jenis_racikan = 'obat_pelarut';
            $racikan_detail_pelarut->save();
        }
        return $resep;
    }

    function createKategoriResepTpn($resep, $request)
    {
        $header = $request->kategori_resep_tpn['header'];
        $kasus = $request->kasus;

        if ($resep == null) {
            $resep = new Resep();
            $resep->kategori_resep = 'tpn';
            $resep->kasus_id = $kasus->id;
            $resep->created_by = auth()->id();
            $resep->farmasi_id = $request->input('nama-apotek');
            $resep->cito = ($request->cito ?? null) == 'on' ? 1 : 0;
        } else {
            ResepDetail::where('kasus_resep_id', $resep->id)->delete();
            ResepRacikanDetail::whereHas('kasus_resep_detail', function ($query) use ($resep) {
                $query->select(DB::raw(1))
                    ->where('kasus_resep_id', $resep->id);
            })->delete();
        }
        $resep->resep_iter = $request->resep_iter ?? null;
        $resep->jenis_resep = $request->jenis_resep;
        $resep->save();

        $resep_detail = new ResepDetail();
        $resep_detail->kasus_resep_id = $resep->id;
        $resep_detail->racikan = $header['nama_obat'];
        $resep_detail->kategori = 'racikan';
        $resep_detail->jumlah = $header['jumlah_tpn'];
        $resep_detail->aturan = $header['aturan_penggunaan'];
        $resep_detail->type = $header['kemasan'];

        $resep_detail->tpn_alergi = $header['alergi'];
        $resep_detail->tpn_berat_badan = $header['berat_badan'];
        $resep_detail->tpn_diagnosis = $header['diagnosis'];
        $resep_detail->tpn_jumlah_tpn = $header['jumlah_tpn'];
        $resep_detail->tpn_kemasan = $header['kemasan'];
        $resep_detail->tpn_rute_pemberian = $header['rute_pemberian'];
        $resep_detail->tpn_aturan_penggunaan = $header['aturan_penggunaan'];
        $resep_detail->save();

        foreach ($request->kategori_resep_tpn['daftar_obat'] ?? [] as $item) {
            $item_farmasi = ItemsFarmasi::find($item['item_farmasi_id']);

            $racikanDetail = new ResepRacikanDetail;
            $racikanDetail->resep_detail_id = $resep_detail->id;
            $racikanDetail->nama_obat = $item_farmasi->item_template->nama;
            $racikanDetail->obat_id = $item_farmasi->item_template->id;
            $racikanDetail->jumlah = $item['jumlah'];
            $racikanDetail->tpn_catatan = $item['catatan'];
            $racikanDetail->save();
        }

        return $resep;
    }

    public function kirimCatatanObatPx($data, $kasus_id)
    {
        $obat = new \stdClass();
        if ($data->kategori == 'generik') {
            $obat->nama_obat = $data->obat_name;

            $item_template = app('App\Http\Controllers\Farmasi\ItemTemplate\ReadController')->single($data->obat_id);
            if (!empty($item_template) && $item_template->jenis != "Obat") {
                return 1; #abaikan obat generic non obat
            }
            $obat->obat_id = $data->obat_id;
        } else {
            $obat->obat_id = null;
            $obat->nama_obat = $data->racikan;
        }
        $obat->aturan_pemakaian = $data->aturan;
        $obat->rute = $data->type;
        $obat->keterangan = "";

        $check = app('App\Http\Controllers\Kasus\Farmasi\CatatanPengobatanPasien\ReadController')
            ->checkIfExist($kasus_id, $obat->nama_obat, ($data->kategori == 'generik' ? $obat->obat_id : 0), $data->aturan);

        if ($check) {
            app('App\Http\Controllers\Kasus\Farmasi\CatatanPengobatanPasien\CreateController')
                ->create($obat, $kasus_id);
        }
    }
}
