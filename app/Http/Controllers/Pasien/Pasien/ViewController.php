<?php

namespace App\Http\Controllers\Pasien\Pasien;

use App\Models\RawatJalan\Dokter;
use App\Models\RawatJalan\DokterJadwal;
use App\Models\Pasien\MesinAntrianPasien;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatJalan\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\TTD;
use Auth;
use MPDF;
use DNS1D;
use DNS2D;
use DOMPDF;
use App\Models\Pasien\Pasien;
use App\Models\Hospital\Profesi;
use App\Models\Hospital\Lokasi;
use App\Models\Hospital\Kelas;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\Kasus;
use App\Models\RawatJalan\AntrianLevel;
use Carbon\Carbon;
use DataTables;

class ViewController extends Controller
{
    public function index()
    {
        return view('pasien.index');
    }

    public function new()
    {
        $data = app('App\Http\Controllers\Pasien\Functions')->getAllForm();
        return view('pasien.baru', $data);
    }

    public function profile($id, Request $request)
    {
        $data = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($id, $request->dokter, $request->lokasi);
        $last_kasus = Kasus::where('pasien_id', $id)->orderby('id', 'desc')->first();
        $query = AlatBantu::with(["creator"]);
        if (!empty($last_kasus)) {
            $query->where("kasus_id", $last_kasus->id);
        } else {
            $query->whereRaw('JSON_EXTRACT(alat_bantu.val, "$.pasien_id") = "' . $id . '"');
        }
        $general_consent = $query->where("type", 'general-consent')->orderBy("id", "asc")->get();
        $general_consent_for_treatment = $query->where("type", 'general-consent-for-treatment')->orderBy("id", "asc")->get();
        // dd($general_consent_for_treatment);
        $this->checkToAbort($data['identitas']);
        $data['id'] = $id;
        $data['general_consent'] = $general_consent;
        $data['general_consent_for_treatment'] = $general_consent_for_treatment;
        return view('pasien.profile', $data);
    }

    public function edit($id)
    {
        $data = app('App\Http\Controllers\Pasien\Functions')->getAllForm();
        $data['pasien'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($id);
        $this->checkToAbort($data['pasien']);
        return view('pasien.edit', $data);
    }

    public function editKerabat($id, Request $request)
    {

        $data = app('App\Http\Controllers\Pasien\Functions')->getAllForm();
        $data['redirect_to'] = $request->get('redirect_to');
        $data['pasien'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($id);
        if (empty($data['pasien']['identitas']->relatives_id)) {
            $wali = app('App\Http\Controllers\Pasien\PasienWali\CreateController')->create($data['pasien']['identitas']->id);
            $data['wali'] = $wali;
        } else {
            $data['wali'] = app('App\Http\Controllers\Pasien\PasienWali\ReadController')->get($data['pasien']['identitas']->relatives_id);
        }


        return view('pasien.edit-kerabat', $data);
    }

    public function listPasien(Request $request)
    {
        $data = app('App\Http\Controllers\Pasien\Functions')->getAllForm();
        return view('pasien.list-pasien', $data);
    }

    public function laporan()
    {
        $data = [];
        $data['lokasi_igd'] = Lokasi::where('lokasi_departemen_id', 1)->get();
        $data['ttd'] = TTD::get();
        $data['profesi'] = Profesi::get();
        $data['date_range_start_month_default'] = Carbon::today()->subMonth();
        $data['date_range_end_month_default'] = Carbon::today();
        $data['date_range_start_day_default'] = Carbon::today()->subDay();
        $data['date_range_end_day_default'] = Carbon::today();
        $data['date_single_day_default'] = Carbon::today();
        $data['tahun'] = Carbon::now()->format('Y');
        $data['triwulan'] = Carbon::now()->format('m') / 3;
        return view('pasien.statistik.index', $data);
    }

    public function printLaporan()
    {
        $data = [];
        return view('pasien.statistic', $data);
    }

    public function baruBayar($id)
    {
        $data = app('App\Http\Controllers\Pasien\Functions')->getAllForm();
        $data['pasienid'] = $id;
        return view('pasien.pembayaran.baru', $data);
    }

    public function editPembayaran($id, $id_bayar)
    {
        $data = app('App\Http\Controllers\Pasien\Functions')->getAllForm();
        $data['pembayaran'] = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->getSingle($id_bayar);
        $this->checkToAbort($data['pembayaran']);
        return view('pasien.pembayaran.edit', $data);
    }

    public function baruDaftar($id, Request $request, $id_antrian = null)
    {
        // * handler autoselect rajal shift
        ini_set('memory_limit', '2046M');
        //        if(\Auth::user()->id == 3) dd('aa');

        $data = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($id);
        $poli = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getPoli();
        $poli =  json_decode($poli);
        $data['poli'] = $poli->data;
        $igd = app('App\Http\Controllers\IGD\Ruangan\ReadController')->getAll();
        $igd =  json_decode($igd);
        $data['igd'] = $igd->data;
        $data['dokter_poli'] = app('App\Http\Controllers\RawatJalan\Dokter\ReadController')->getAll();
        $data['dokter'] = app('App\Http\Controllers\KamarOperasi\Transaksi\ReadController')->listDokter();
        $data['metode'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->metode($id);
        $data['kelas_igd'] = Kelas::where('igd', 1)->get();
        $data['kelas_rj'] = Kelas::where('rawat_jalan', 1)->get();
        $data['kelas_medical_checkup'] = Kelas::where('medical_checkup', 1)->get();
        $data['tarif_admin'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getRetribusiPendaftaran($id);
        $data['pasien'] = Pasien::find($id);
        //        $data['rujukan'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->listRujukan();
        $data['sep'] = json_decode(app('App\Http\Controllers\BPJS\SEP\ReadController')->getByNomorPasien($id));
        $data['my_rujuk_poli'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->myRujukPoli($id);
        $data['sirs_pelayanan']        = app(\App\Http\Controllers\Admin\SirsKegiatanPelayananKhusus\ReadController::class)->getAll();

        $data['paket'] = app('App\Http\Controllers\Urikkes\Pengaturan\ReadController')->getPaketWithLayanan();

        $data['poli_level'] = AntrianLevel::all();
        if (!is_null($id_antrian)) {
            $mesin_antrian = app('App\Http\Controllers\Pasien\Antrian\ReadController')->getSingle($id_antrian);
            // * handler jika transaksi mesin sudah dikonfirmasi / dibatalkan
            if (!empty($mesin_antrian->konfirmasi_by) || !empty($mesin_antrian->cancel_by)) {
                return abort(404);
            }

            $jadwal_dokter = DokterJadwal::find($mesin_antrian->id_jadwal);
            $data['mesin_antrian'] = $mesin_antrian;
            $data['dokter_id'] = $jadwal_dokter->dokter_id ?? null;
        } else {
            $data['mesin_antrian'] = null;
            $data['dokter_id'] = null;
        }

        $request_readmisi = new Request(['pasien_id' => $id]);
        $data['readmisi'] = (new \App\Http\Controllers\RawatInap\Transaksi\ReadController())
            ->cekPotensiBPJSReadmisi($request_readmisi);

        return view('pasien.pendaftaran.baru', $data);
    }

    public function daftarInap($id)
    {
        $data = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($id);
        $poli = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getPoli();
        $poli =  json_decode($poli);
        $data['poli'] = $poli->data;
        $igd = app('App\Http\Controllers\IGD\Ruangan\ReadController')->getAll();
        $igd =  json_decode($igd);
        $data['igd'] = $igd->data;
        $data['dokter'] = app('App\Http\Controllers\KamarOperasi\Transaksi\ReadController')->listDokter();
        $data['metode'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->metode($id);
        $data['pasien'] = Pasien::find($id);
        $data['rujukan'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->listRujukan();
        $data['sep'] = json_decode(app('App\Http\Controllers\BPJS\SEP\ReadController')->getByNomorPasien($id));
        $data['my_rujuk_poli'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->myRujukPoli($id);
        $data['kasus'] = app('App\Http\Controllers\Kasus\Kasus\ReadController')->getByPasien($id);
        $data['permintaan'] = app('App\Http\Controllers\RawatInap\Transaksi\ReadController')->getDaftarInap($id);
        $data['kasus_id'] = app('App\Http\Controllers\RawatInap\Transaksi\ReadController')->getKasusIDDaftarInap($id);

        $data['paket'] = app('App\Http\Controllers\Urikkes\Pengaturan\ReadController')->getPaketWithLayanan();
        return view('pasien.pendaftaran.baru-inap', $data);
    }

    public function printprofile($id, $param_download = [])
    {

        $data = app('App\Http\Controllers\Pasien\Pasien\ReadController')->printprofile($id);
        $data['user'] = Auth::user();
        $pdf = DOMPDF::loadView('pasien.print-data', $data, [])->setPaper('a4', 'portrait');
        $pasien = $data;
        $filename = $pasien['identitas']->name . '-profil.pdf';
        if (($param_download['is_download'] ?? null) != null) {
            $filename = $param_download['filename'] ?? 'Print_Profil_' . $pasien['identitas']->id . '.pdf';
            if (file_exists($param_download['path'] . $filename))
                unlink($param_download['path'] . $filename);
            $pdf->save($param_download['path'] . $filename);
            return $filename;
        }
        return $pdf->stream($filename);

        // return view('pasien.print-data', $data);
    }

    public function ringkasanRanap($id)
    {
        $data = app('App\Http\Controllers\Pasien\Pasien\ReadController')->ringkasanRanap($id);
        $pdf = DOMPDF::loadView('pasien.profile.print-ringkasan-ranap', $data);
        return $pdf->stream('Ringkasan_Rawat_Inap.pdf');
    }

    public function ringkasanRajal($id)
    {
        $data = app('App\Http\Controllers\Pasien\Pasien\ReadController')->ringkasanRajal($id);
        $pdf = DOMPDF::loadView('pasien.profile.print-ringkasan-rajal', $data);
        return $pdf->stream('Ringkasan_Rawat_Inap.pdf');
    }

    public function prmrj($id)
    {
        $data = app('App\Http\Controllers\Pasien\Pasien\ReadController')->ringkasanRajal($id);
        $pdf = DOMPDF::loadView('pasien.profile.print-prmrj', $data);
        return $pdf->stream('Ringkasan_Rawat_Inap.pdf');
    }

    public function printgelang($id)
    {
        $pasien = app('App\Http\Controllers\Pasien\Pasien\ReadController')->getSingle($id);
        $data['pasien'] = $pasien;
        $pasien_id = $invID = str_pad($pasien->no_rm, 10, '0', STR_PAD_LEFT);
        $chunks = str_split($pasien_id, 2);
        $no_rm_format = implode(' - ', $chunks);
        $data['pasien']->no_rm_format = $no_rm_format;

        $data['barcode'] = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($pasien->no_rm, "C39", 1, 15) . '" alt="barcode"   />';


        $pdf = MPDF::loadView('pasien.profile.print-gelang', $data, [], [
            'mode' => 'utf-8',
            'format' => [60, 20]
        ]);
        $filename = $pasien->name . '-gelang.pdf';

        return $pdf->stream($filename);
    }

    public function printlabel($id)
    {
        $pasien = app('App\Http\Controllers\Pasien\Pasien\ReadController')->getSingle($id);
        $data['pasien'] = $pasien;
        $pasien_id = $invID = str_pad($pasien->no_rm, 10, '0', STR_PAD_LEFT);
        $chunks = str_split($pasien_id, 2);
        $no_rm_format = implode(' - ', $chunks);
        $data['pasien']->no_rm_format = $no_rm_format;

        $data['barcode'] = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($pasien->no_rm, "C39", 1.0, 40) . '" alt="barcode" style="width:100px;" />';


        $pdf = MPDF::loadView('pasien.profile.print-label', $data, [], [
            'mode' => 'utf-8',
            'format' => [108, 33]
        ]);
        $filename = $pasien->name . '-label.pdf';

        return $pdf->stream($filename);
    }

    public function printkartu($id)
    {
        $pasien = app('App\Http\Controllers\Pasien\Pasien\ReadController')->getSingle($id);
        $data['pasien'] = $pasien;
        $data['barcode'] = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($pasien->no_rm, "C128", 1, 20) . '" alt="barcode"   />';
        $pdf = MPDF::loadView('pasien.profile.print-kartu', $data, [], [
            'mode' => 'utf-8',
            'format' => [84.7, 52.9]
        ]);
        $filename = $pasien->name . '-kartu.pdf';

        return $pdf->stream($filename);
    }

    public function printKtp($id)
    {
        $pasien = app('App\Http\Controllers\Pasien\Pasien\ReadController')->getSingle($id);
        $data['pasien'] = $pasien;
        $pdf = MPDF::loadView('pasien.profile.print-ktp', $data, [], [
            'mode' => 'utf-8',
        ]);
        $filename = $pasien->name . ' - Kartu Identitas Pasien.pdf';
        return $pdf->stream($filename);
    }

    public function printgelangdewasa($id)
    {
        $pasien = app('App\Http\Controllers\Pasien\Pasien\ReadController')->getSingle($id);
        $data['pasien'] = $pasien;
        $data['qrcode'] = '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG($pasien->no_rm, "QRCODE", 3.2, 3.2) . '" alt="barcode"   />';
        $data['barcode'] = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($pasien->no_rm, "C128", 1, 30) . '" alt="barcode"   />';
        $customPaper = array(0, 0, 567, 80);
        // $pdf = DOMPDF::loadView('pasien.profile.print-gelang-dewasa',$data)->setPaper($customPaper);
        $pdf = MPDF::loadView('pasien.profile.print-gelang-dewasa', $data, [], [
            'mode' => 'utf-8',
            'format' => [115, 20]
        ]);
        $filename = '-gelang-dewasa.pdf';

        return $pdf->stream($filename);
    }

    public function printgelangbayi($id)
    {
        $pasien = app('App\Http\Controllers\Pasien\Pasien\ReadController')->getSingle($id);
        $data['pasien'] = $pasien;
        $data['barcode'] = DNS2D::getBarcodeHTML($pasien->no_rm, "QRCODE", 1.5, 1.5);
        $customPaper = array(0, 0, 567, 57);
        $pdf = DOMPDF::loadView('pasien.profile.print-gelang-bayi', $data)->setPaper($customPaper);
        $filename = '-gelang-bayi.pdf';

        return $pdf->stream($filename);
    }

    public function rujukIGD($id, $kasus)
    {
        $data = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($id);
        $kasus = app('App\Http\Controllers\Kasus\Kasus\ReadController')->get($kasus);
        $igd = app('App\Http\Controllers\IGD\Ruangan\ReadController')->getAll();
        $igd =  json_decode($igd);
        $data['igd'] = $igd->data;
        $data['kasus'] = $kasus;

        return view('pasien.rujuk.igd', $data);
    }

    public function rujukRJ($id, $kasus)
    {
        $data = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($id);
        $kasus = app('App\Http\Controllers\Kasus\Kasus\ReadController')->get($kasus);
        $poli = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getPoli();
        $poli =  json_decode($poli);
        $data['poli'] = $poli->data;
        $data['kasus'] = $kasus;
        $asal_poli  = $kasus->lokasi->lokasi;
        $data['asal_poli'] = $asal_poli;
        return view('pasien.rujuk.rawatjalan', $data);
    }

    public function statistik()
    {
        return view('pasien.statistik.statistik');
    }

    public function adminUpdateIndex()
    {

        return view('pasien.admin.update-index-elastic');
    }

    public function generalConsent($id)
    {
        $data = app('App\Http\Controllers\Pasien\Pasien\ReadController')->ringkasanRajal($id);
        $pdf = DOMPDF::loadView('pasien.profile.print-general-consent', $data);
        return $pdf->stream('persetujuan_umum_general_consent.pdf');
    }

    public function generalConsentForTreatment($id)
    {
        $data = app('App\Http\Controllers\Pasien\Pasien\ReadController')->ringkasanRajal($id);
        $pdf = DOMPDF::loadView('pasien.profile.print-general-consent-for-treatment', $data);
        return $pdf->stream('persetujuan_umum_general_consent_for_treatment.pdf');
    }

    public function tindakanKedokteran()
    {
        $pdf = DOMPDF::loadView('pasien.profile.print-tindakan-kedokteran');
        return $pdf->stream('persetujuan_umum_tindakan_kedokteran.pdf');
    }

    public function aktivitasPoliPsikologi()
    {
        $pdf = DOMPDF::loadView('pasien.profile.print-aktivitas-poli-psikologi');
        return $pdf->stream('aktivitas_poli_psikologi.pdf');
    }

    public function daftarOnline()
    {
        $poliklinik = Poliklinik::all();
        $dokter = Dokter::all();
        return view('pasien.daftar-online', ['poliklinik' => $poliklinik, 'dokter' => $dokter]);
    }

    public function updateDaftarOnline($id)
    {
        $transaksi = Transaksi::with('pasien', 'kasus.lokasi.lokasi.poliklinik', 'poliklinik', 'dokter', 'pasien_pembayaran.perusahaan', 'pasien_pembayaran.perusahaan.tipe')->find($id);

        $data['metode'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->metodePembayaran($transaksi);
        $data['transaksi'] = $transaksi;
        $data['sep'] = json_decode(app('App\Http\Controllers\BPJS\SEP\ReadController')->getByNomorPasien($transaksi->pasien->id));
        return view('pasien.update-daftar-online', $data);
    }

    public function getDaftarOnline(Request $request)
    {
        $data         = app('App\Http\Controllers\Pasien\Pasien\ReadController')->getDaftarOnline($request);

        return DataTables::of($data)
            ->addColumn('nomor_antrian', function ($data) {
                return ($data->nomor_antrian ?? '-');
            })
            ->addColumn('no_rm', function ($data) {
                return $data->pasien->no_rm ?? '-';
            })
            ->addColumn('nama_pasien', function ($data) {
                return $data->pasien->name ?? '-';
            })
            ->addColumn('jk', function ($data) {
                if ($data->pasien == null) {
                    return '-';
                } else {
                    if ($data->pasien->gender == 1) {
                        return 'L';
                    }
                    if ($data->pasien->gender == 2) {
                        return 'P';
                    }
                }
                return $data->pasien->name ?? '-';
            })
            ->addColumn('usia', function ($data) {
                return $data->pasien->age ?? '-';
            })
            ->addColumn('poliklinik', function ($data) {
                return $data->poliklinik->name ?? '-';
            })
            ->addColumn('dokter', function ($data) {
                return $data->dokter->name ?? '-';
            })
            ->addColumn('waktu_masuk', function ($data) {
                $date = date_format($data->waktu_masuk, "H:i");
                return $date ?? '-';
            })
            ->addColumn('status_pasien', function ($data) {
                $status = '';
                switch ($data->status) {
                    case 0:
                        $status = '<span class="badge badge-warning">Sudah terkonfirmasi</span>';
                        break;
                    case 1:
                        $status = '<span class="badge badge-primary">Dilayani</span>';
                        break;
                    case 2:
                        $status = '<span class="badge badge-secondary">Pulang</span>';
                        break;
                    case 3:
                        $status = '<span class="badge badge-success">Perlu dikonfirmasi</span>';
                        break;
                    case -1:
                        $status = '<span class="badge badge-danger">Batal</span>';
                        break;
                    default:
                        break;
                }
                return $status;
            })
            ->addColumn('aksi', function ($data) {
                $button = '';
                if ($data->status == 3) {
                    if ($data->pasien_pembayaran->perusahaan->tipe->slug == 'tunai' && !empty($data->piutang_online_tunai) && $data->piutang_online_tunai->total > $data->piutang_online_tunai->total_paid) {
                        $button = '<button type="button" class="btn btn-md btn-primary" onclick="swal({
                                        type: ' . "'warning'" . ',
                                        title: ' . "'Biaya registrasi belum terbayar'" . ',
                                        html: ' . "'Silahkan bayar terlebih dahulu dikasir dengan menginformasikan NO RM Pasien'" . ',
                                        timer: 10000,
                                    });"> Daftarkan </button>';
                    } else {
                        $button = '<a href="' . url("pasien/daftar-online/update") . '/' . $data->id . '" class="btn btn-md btn-primary">Daftarkan</a>';
                    }
                }
                return $button;
            })
            ->filterColumn('nomor_antrian', function ($data, $keyword) {
                $data->where('nomor_antrian', 'LIKE', "%$keyword%");
            })
            ->filterColumn('no_rm', function ($data, $keyword) {
                $data->whereHas('pasien', function ($query) use ($keyword) {
                    $query->from(config('app.db_name') . '_patients.pasien')->where('no_rm', 'LIKE', "%$keyword%");
                });
            })
            ->filterColumn('nama_pasien', function ($data, $keyword) {
                $data->whereHas('pasien', function ($query) use ($keyword) {
                    $query->from(config('app.db_name') . '_patients.pasien')->where('name', 'LIKE', "%$keyword%");
                });
            })
            ->filterColumn('poliklinik', function ($data, $keyword) {
                $data->whereHas('poliklinik', function ($query) use ($keyword) {
                    $query->from(config('app.db_name') . '_rawat_jalan.poliklinik')->where('name', 'LIKE', "%$keyword%");
                });
            })
            ->filterColumn('dokter', function ($data, $keyword) {
                $data->whereHas('dokter', function ($query) use ($keyword) {
                    $query->from(config('app.db_name') . '_rawat_jalan.dokter')->where('name', 'LIKE', "%$keyword%");
                });
            })
            ->filterColumn('status_pasien', function ($data, $keyword) {
                $search = strtolower($keyword);
                if ($search == 'dilayani') {
                    $data->where('status', 1);
                }
                if ($search == 'pulang') {
                    $data->where('status', 2);
                }
                if ($search == 'perlu dikonfirmasi') {
                    $data->where('status', 3);
                }
                if ($search == 'batal') {
                    $data->where('status', -1);
                }
                if ($search == 'sudah terkonfirmasi') {
                    $data->where('status', 0);
                }
            })

            ->escapeColumns([])
            ->make(true);
    }

    public function daftarOnlineBatal()
    {
        $poliklinik = Poliklinik::all();
        $dokter = Dokter::all();
        return view('pasien.daftar-online-batal', ['poliklinik' => $poliklinik, 'dokter' => $dokter]);
    }

    public function getDaftarOnlineBatal(Request $request)
    {
        $data         = app('App\Http\Controllers\Pasien\Pasien\ReadController')->getDaftarOnlineBatal($request);
        return DataTables::of($data)
            ->addColumn('no_rm', function ($data) {
                return $data->pasien->no_rm ?? '-';
            })
            ->addColumn('nama_pasien', function ($data) {
                return $data->pasien->name ?? '-';
            })
            ->addColumn('poliklinik', function ($data) {
                return $data->poliklinik->name ?? '-';
            })
            ->addColumn('dokter', function ($data) {
                return $data->dokter->name ?? '-';
            })
            ->addColumn('tipe_pembayaran', function ($data) {
                return $data->pasien_pembayaran->perusahaan->tipe->nama ?? '-';
            })
            ->addColumn('tanggal_pembatalan', function ($data) {
                $date = date("d F Y H:i", strtotime($data->cancel_at));
                return $date ?? '-';
            })
            ->addColumn('tanggal_pemesanan', function ($data) {
                $date = date("d F Y H:i", strtotime($data->ordered_at));
                return $date ?? '-';
            })
            ->addColumn('status_refund', function ($data) {
                $status = '';
                switch ($data->refund_status) {
                    case 1:
                        $status = '<span class="badge badge-warning">Menunggu</span>';
                        break;
                    case 2:
                        $status = '<span class="badge badge-success">Berhasil</span>';
                        break;
                    default:
                        break;
                }
                return $status;
            })
            ->addColumn('aksi', function ($data) {
                $button = '';
                if ($data->refund_status == 1 && $data->pasien_pembayaran->perusahaan->tipe->slug == 'tunai') {
                    $button = '
                            <button type="button" class="btn btn-sm btn-success js-tooltip-enabled btn-delete" onclick="konfirmasi(this)" data-toggle="tooltip" title="Konfirmasi Refund" data-original-title="Konfirmasi Refund" data-id="' . $data->id . '">
                                   <i class="fa fa-check"></i>
                            </button>
                    ';
                }
                return $button;
            })
            ->filterColumn('no_rm', function ($data, $keyword) {
                $data->whereHas('pasien', function ($query) use ($keyword) {
                    $query->from(config('app.db_name') . '_patients.pasien')->where('no_rm', 'LIKE', "%$keyword%");
                });
            })
            ->filterColumn('nama_pasien', function ($data, $keyword) {
                $data->whereHas('pasien', function ($query) use ($keyword) {
                    $query->from(config('app.db_name') . '_patients.pasien')->where('name', 'LIKE', "%$keyword%");
                });
            })
            ->filterColumn('poliklinik', function ($data, $keyword) {
                $data->whereHas('poliklinik', function ($query) use ($keyword) {
                    $query->from(config('app.db_name') . '_rawat_jalan.poliklinik')->where('name', 'LIKE', "%$keyword%");
                });
            })
            ->filterColumn('dokter', function ($data, $keyword) {
                $data->whereHas('dokter', function ($query) use ($keyword) {
                    $query->from(config('app.db_name') . '_rawat_jalan.dokter')->where('name', 'LIKE', "%$keyword%");
                });
            })
            ->filterColumn('status_refund', function ($data, $keyword) {
                $search = strtolower($keyword);
                if ($search == 'menunggu') {
                    $data->where('status', 1);
                }
                if ($search == 'berhasil') {
                    $data->where('status', 2);
                }
            })

            ->escapeColumns([])
            ->make(true);
    }

    public function pasienBaruOnline()
    {
        return view('pasien.pasien-baru-online');
    }

    public function getPasienBaruOnline(Request $request)
    {
        $data = app(\App\Http\Controllers\Pasien\Pasien\ReadController::class)->getPasienOnline($request);

        return DataTables::of($data)
            ->addColumn('nama_pasien', function ($data) {
                return $data->name ?? '-';
            })
            ->addColumn('no_identitas', function ($data) {
                return $data->no_identitas;
            })
            ->addColumn('aksi', function ($data) {
                if ($data->is_jkn == 1 && $data->is_konfirmasi == 1) {
                    $button = '<a href="javascript:void(0)" class="btn btn-sm btn-alt-success">Sudah Dikonfirmasi</a>';
                } else {
                    $button = '<a href="' . url("pasien/pasien-baru-online") . '/' . $data->id . '/edit" class="btn btn-md btn-primary">Konfirmasi</a>';
                }

                return $button;
            })
            ->filterColumn('nama_pasien', function ($data, $keyword) {
                return $data->where('name', 'LIKE', "%$keyword%");
            })
            ->filterColumn('no_identitas', function ($data, $keyword) {
                return $data->where('no_identitas', 'LIKE', "%$keyword%");
            })

            ->escapeColumns([])
            ->make(true);
    }

    public function pasienBaruOnlineEdit($id)
    {
        try {
            $data = app('App\Http\Controllers\Pasien\Functions')->getAllForm();
            $data['pasien'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($id);
            $this->checkToAbort($data['pasien']);
            return view('pasien.pasien-baru-online-edit', $data);
        } catch (\Exception $e) {
            $this->bugsnag($e);
        }
    }
}
