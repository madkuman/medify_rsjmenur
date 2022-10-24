<?php

namespace App\Console\Commands\ThirdParty\SIRSV3;

use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use Illuminate\Console\Command;

class LaporanCovid19Update extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'third-party-sirs-v3:laporan-covid-19-update {--kasus_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update semua pasien belum KRS yang di asesmen covid.';
    static protected $kewarganegaraan_default_id, $asal_ppln, $asal_default, $status_covid_mapping, $job_mapping, $lokasi_mapping, $gejala_default;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!config('medify.third-party.sirs_v3.on')) {
            echo 'Fitur SIRS v3 tidak tersedia';
            return;
        }

        \Auth::loginUsingId(1);
        app(\App\Http\Controllers\ThirdParty\SIRS\API\RequestController::class)->authv3();

        $kasus_id = $this->option('kasus_id');

        $second_auth = [];
        $use_second_auth = false;
        if (config('medify.third-party.sirs_v3.on_second_acc') && empty($kasus_id)) {
            $second_auth['id'] = config('medify.third-party.sirs_v3.second_acc_id');
            $second_auth['password'] = config('medify.third-party.sirs_v3.second_acc_password');
            $second_auth['lokasi'] = config('medify.third-party.sirs_v3.second_acc_lokasi');

            if (!empty($second_auth['id']) && !empty($second_auth['password']) && !empty($second_auth['lokasi'])) {
                $use_second_auth = true;
            } else {
                echo "Pengaturan Fitur Dual Akun SIRS v3 tidak lengkap\n\n";
            }
        }

        $kewarganegaraan_default = \App\Models\Pasien\JenisKewarganegaraan::where('nama', 'like', '%Indonesia%')->first();
        $status_covid_mapping = \App\Models\SIRS\MasterStatuspasien::pluck('sirs_id', 'nama')->toArray();
        self::$kewarganegaraan_default_id = $kewarganegaraan_default->sirs_kewarganegaraan_id ?? null;
        self::$asal_ppln = \App\Models\SIRS\MasterAsalpasien::where('nama', 'like', '%PPLN%')->first();
        self::$asal_default = \App\Models\SIRS\MasterAsalpasien::where('nama', 'like', '%Non PPLN%')->first();
        self::$status_covid_mapping = array_change_key_case($status_covid_mapping, CASE_LOWER);
        self::$job_mapping = \App\Models\Pasien\JenisPekerjaan::pluck('sirs_pekerjaan_id', 'nama');
        self::$lokasi_mapping = \App\Models\Hospital\LokasiDepartemen::pluck('sirs_jenis_pasien_id', 'id');
        self::$gejala_default = \App\Models\SIRS\MasterKelompokgejala::first();

        $today = Carbon::now();
        $time_limit = $today->copy()->subDays(5);
        
        try {
            $kasus = Kasus::with([
                    'covid_status',
                    'pasien.alamat_kecamatan',
                    'pasien.alamat_kota.provinsi',
                    'lokasi.lokasi',
                    'sirs_v3_laporan_covid:id,kasus_id,sirs_laporan_id'
                ])
                ->whereHas('covid_status');
            
            if (empty($kasus_id)) {
                $kasus = $kasus->when($use_second_auth, function ($q) use ($second_auth) {
                    $q->whereHas('lokasi', function ($q) use ($second_auth) {
                        $q->whereNotIn('lokasi_id', $second_auth['lokasi']);
                    });
                })
                ->where(function ($q) use ($time_limit) {
                    $q->where('krs_at', '>', $time_limit)->orWhereNull('krs_at');
                })
                ->get();
            } else {
                $kasus = $kasus->where('id', $kasus_id)->get();
            }

            echo "Start Sending Kasus \n";
            foreach ($kasus as $item) {
                $save_laporan = $item->sirs_v3_laporan_covid;
                if (empty($item->sirs_v3_laporan_covid)) {
                    $laporan_api_slug = 'laporan-covid-19-add';
                    $laporan_data = $this->generateData($item);
                
                    if (!empty($laporan_data)) {
                        $result = app(\App\Http\Controllers\ThirdParty\SIRS\API\RequestController::class)->requestAPI($laporan_api_slug, $laporan_data);
                        if ($result['code'] == 201) {
                            $save_laporan = app(\App\Http\Controllers\ThirdParty\SIRS\API\PostController::class)->createLaporanCovid($item, $result);
                            $save_log = app(\App\Http\Controllers\ThirdParty\SIRS\API\PostController::class)->addLogLaporanCovid('add', $item->id, $save_laporan, $result);
                        } else {
                            $save_laporan = app(\App\Http\Controllers\ThirdParty\SIRS\API\PostController::class)->addLogLaporanCovid('add', $item->id, null, $result);
                        }
                        echo "Sending Kasus " . $item->id . " : " . $result['code'] . "\n";
                    }
                }

                // ? update KRS ke SIRS
                if (!empty($save_laporan) && !empty($item->krs_at) && empty($save_laporan->sirs_krs_updated_at)) {
                    $laporan_api_slug_update = 'laporan-covid-19-status-keluar-update';
                    $laporan_data_update = $this->generateDataUpdate($item);

                    if (!empty($laporan_data_update)) {
                        $result_update = app(\App\Http\Controllers\ThirdParty\SIRS\API\RequestController::class)->requestAPI($laporan_api_slug_update, $laporan_data_update);
                        if ($result_update['code'] == 201) {
                            $save_laporan->sirs_krs_updated_at = Carbon::now();
                            $save_laporan->save();
                        }
                        $save_log_update = app(\App\Http\Controllers\ThirdParty\SIRS\API\PostController::class)->addLogLaporanCovid('update', $item->id, $save_laporan->id, $result_update);
                        echo "Updating Kasus " . $item->id . " : " . $result_update['code'] . "\n";
                    }
                }
            }

            // ? running second auth 
            if (!empty($second_auth) && $use_second_auth) {
                echo "Start Sending Kasus di Second Account \n";

                $auth_id = $second_auth['id'];
                $auth_pass = $second_auth['password'];
                app(\App\Http\Controllers\ThirdParty\SIRS\API\RequestController::class)->authv3($auth_id, $auth_pass);

                $kasus_second = Kasus::with([
                        'covid_status',
                        'pasien.alamat_kecamatan',
                        'pasien.alamat_kota.provinsi',
                        'lokasi.lokasi',
                        'sirs_v3_laporan_covid:id,kasus_id,sirs_laporan_id'
                    ])
                    ->whereHas('covid_status');

                if (empty($kasus_id)) {
                    $kasus_second = $kasus_second
                        ->whereHas('lokasi', function ($q) use ($second_auth) {
                            $q->whereIn('lokasi_id', $second_auth['lokasi']);
                        })
                        ->where(function ($q) use ($time_limit) {
                            $q->where('krs_at', '>', $time_limit)->orWhereNull('krs_at');
                        })
                        ->get();
                } else {
                    $kasus_second = $kasus_second->where('id', $kasus_id)->get();
                }

                foreach ($kasus_second as $item) {
                    $save_laporan = $item->sirs_v3_laporan_covid;
                    if (empty($item->sirs_v3_laporan_covid)) {
                        $laporan_api_slug = 'laporan-covid-19-add';
                        $laporan_data = $this->generateData($item);

                        if (!empty($laporan_data)) {
                            $result = app(\App\Http\Controllers\ThirdParty\SIRS\API\RequestController::class)->requestAPI($laporan_api_slug, $laporan_data);
                            if ($result['code'] == 201) {
                                $save_laporan = app(\App\Http\Controllers\ThirdParty\SIRS\API\PostController::class)->createLaporanCovid($item, $result);
                                $save_log = app(\App\Http\Controllers\ThirdParty\SIRS\API\PostController::class)->addLogLaporanCovid('add', $item->id, $save_laporan, $result);
                            } else {
                                $save_laporan = app(\App\Http\Controllers\ThirdParty\SIRS\API\PostController::class)->addLogLaporanCovid('add', $item->id, null, $result);
                            }
                        }
                        echo "Sending Kasus " . $item->id . " : " . $result['code'] . "\n";
                    }

                    // ? update KRS ke SIRS
                    if (!empty($save_laporan) && !empty($item->krs_at) && empty($save_laporan->sirs_krs_updated_at)) {
                        $laporan_api_slug_update = 'laporan-covid-19-status-keluar-update';
                        $laporan_data_update = $this->generateDataUpdate($item);

                        if (!empty($laporan_data_update)) {
                            $result_update = app(\App\Http\Controllers\ThirdParty\SIRS\API\RequestController::class)->requestAPI($laporan_api_slug_update, $laporan_data_update);
                            if ($result_update['code'] == 201) {
                                $save_laporan->sirs_krs_updated_at = Carbon::now();
                                $save_laporan->save();
                            }
                            $save_log_update = app(\App\Http\Controllers\ThirdParty\SIRS\API\PostController::class)->addLogLaporanCovid('update', $item->id, $save_laporan->id, $result_update);
                        }
                        echo "Updating Kasus " . $item->id . " : " . $result['code'] . "\n";
                    }
                }
            }
            echo "Done send data to SIRS \n";
        } catch (\Exception $e) {
            app(\App\Http\Controllers\Error\Handler::class)->bugsnag($e);
            dd($e);
        }
    }

    public function generateData($item)
    {
        $pasien = $item->pasien;
        if (empty($pasien)) return [];

        $asesmen = !empty($item->pengawasan_covid) ? json_decode($item->pengawasan_covid->val, true) : [];
        $covid_status = strtolower(!empty($item->covid_status) ? $item->covid_status->status : null);

        $laporan_data = [];

        if (!empty($item->krs_at)) $krs_at = Carbon::parse($item->krs_at);
        else $krs_at = null;

        if (!empty($pasien->kewarganegaraan_id)) $laporan_data['kewarganegaraanId'] = $pasien->kewarganegaraan->sirs_kewarganegaraan_id ?? self::$kewarganegaraan_default_id;
        else $laporan_data['kewarganegaraanId'] = self::$kewarganegaraan_default_id;

        if (($pasien->jenis_identitas->slug ?? '') == 'ktp') $laporan_data['nik'] = $pasien->no_identitas;
        else $laporan_data['nik'] = null;

        if (($pasien->jenis_identitas->slug ?? '') == 'passport') $laporan_data['noPassport'] = $pasien->no_identitas;
        else $laporan_data['noPassport'] = null;

        if (!empty($asesmen['negara'])) $laporan_data['asalPasienId'] = self::$asal_ppln->sirs_id;
        else $laporan_data['asalPasienId'] = self::$asal_default->sirs_id ?? 0;

        if (!empty($pasien->no_rm)) $laporan_data['noRM'] = (string) $pasien->no_rm;
        else $laporan_data['noRM'] = null;

        if (!empty($pasien->name)) $laporan_data['namaLengkapPasien'] = $pasien->name;
        else $laporan_data['namaLengkapPasien'] = '';

        if (!empty($pasien->date_of_birth)) $laporan_data['tanggalLahir'] = $pasien->date_of_birth;
        else $laporan_data['tanggalLahir'] = null;

        if (!empty($pasien->email)) $laporan_data['email'] = $pasien->email;
        else $laporan_data['email'] = null;

        if (!empty($pasien->phone)) $laporan_data['noTelp'] = $pasien->phone;
        else $laporan_data['noTelp'] = null;

        if (!empty($pasien->gender)) $laporan_data['jenisKelaminId'] = $pasien->jenis_kelamin_lp;
        else $laporan_data['jenisKelaminId'] = null;

        if (!empty($pasien->alamat_kecamatan)) $laporan_data['domisiliKecamatanId'] = $pasien->alamat_kecamatan->sirs_kecamatan_id ?? 0;
        else $laporan_data['domisiliKecamatanId'] = 0;

        if (!empty($pasien->alamat_kota ?? null)) $laporan_data['domisiliKabKotaId'] = $pasien->alamat_kota->sirs_kabkota_id ?? 0;
        else $laporan_data['domisiliKabKotaId'] = 0;

        if (!empty($pasien->alamat_kota)) $laporan_data['domisiliProvinsiId'] = $pasien->alamat_kota->provinsi->sirs_provinsi_id ?? 0;
        else $laporan_data['domisiliProvinsiId'] = 0;

        if (!empty($pasien->job)) $laporan_data['pekerjaanId'] = self::$job_mapping[$pasien->job] ?? 0;
        else $laporan_data['pekerjaanId'] = 0;

        if (!empty($item->mrs_at)) $laporan_data['tanggalMasuk'] = Carbon::parse($item->mrs_at)->format('Y-m-d');
        else $laporan_data['tanggalMasuk'] = Carbon::parse($item->created_at)->format('Y-m-d');

        if (!empty($item->lokasi->lokasi->lokasi_departemen_id ?? null)) $laporan_data['jenisPasienId'] = self::$lokasi_mapping[$item->lokasi->lokasi->lokasi_departemen_id] ?? 0;
        else $laporan_data['jenisPasienId'] = 0;

        if (!empty($covid_status)) $laporan_data['statusPasienId'] = self::$status_covid_mapping[$covid_status] ?? 0;
        else $laporan_data['statusPasienId'] = 0;

        if (!empty($item->lokasi->lokasi->ruangan ?? null)) $laporan_data['statusRawatId'] = $item->lokasi->lokasi->ruangan->sirs_covid_19_tt_id ?? 0;
        else $laporan_data['statusRawatId'] = 0;

        $laporan_data['namaInisialPasien'] = $this->getInitial($pasien->name);
        $laporan_data['statusCoInsidenId'] = 0; // ? default 0 dulu
        $laporan_data['alatOksigenId'] = null; // ? default 0 dulu
        $laporan_data['penyintasId'] = 0; // ? default 0 dulu
        $laporan_data['tanggalOnsetGejala'] = $laporan_data['tanggalMasuk']; // ? default null dulu
        $laporan_data['kelompokGejalaId'] = self::$gejala_default->sirs_id ?? null; // ? default null dulu
        $laporan_data['gejala'] = [
            'demamId' => '0',
            'batukId' => '0',
            'pilekId' => '0',
            'sakitTenggorokanId' => '0',
            'sesakNapasId' => '0',
            'lemasId' => '0',
            'nyeriOtotId' => '0',
            'mualMuntahId' => '0',
            'diareId' => '0',
            'anosmiaId' => '0',
            'napasCepatId' => '0',
            'frekNapas30KaliPerMenitId' => '0',
            'distresPernapasanBeratId' => '0',
            'lainnyaId' => '0'
        ];

        return $laporan_data;
    }

    public function generateDataUpdate($item)
    {
        $pasien = $item->pasien;
        if (empty($pasien)) return [];

        $asesmen = !empty($item->pengawasan_covid) ? json_decode($item->pengawasan_covid->val, true) : [];
        $covid_status = strtolower(!empty($item->covid_status) ? $item->covid_status->status : null);
        if ($covid_status == 'konfirmasi') {
            $kasusKematianId = \App\Models\SIRS\MasterKasuskematian::where('deskripsi', 'like', '%Konfirmasi%')->first()->sirs_id ?? 0;
        } else if ($covid_status == 'probable') {
            $kasusKematianId = \App\Models\SIRS\MasterKasuskematian::where('deskripsi', 'like', '%Probable%')->first()->sirs_id ?? 0;
        } else {
            $kasusKematianId = \App\Models\SIRS\MasterKasuskematian::where('deskripsi', 'like', '%Negatif%')->first()->sirs_id ?? 0;
        }
        
        $laporan_data = [];
        $laporan_data['laporanCovid19Versi3Id'] = $item->sirs_v3_laporan_covid->sirs_laporan_id;
        $laporan_data['tanggalKeluar'] = Carbon::parse($item->krs_at)->format('Y-m-d');
        $laporan_data['statusKeluarId'] = $item->alasan_krs->sirs_status_keluar_id ?? 0;
        $laporan_data['kasusKematianId'] = $kasusKematianId;
        $laporan_data['penyebabKematianLangsungId'] = 'null';

        return $laporan_data;
    }

    public function getInitial($name)
    {
        $words = explode(" ", $name);
        $acronym = "SIM-";
        foreach ($words as $w) {
            $acronym .= $w[0];
        }

        return $acronym;
    }
}
