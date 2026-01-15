<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Encounter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use stdClass;

class PostController extends Controller
{
    // DEPRECATED SOON
    protected $request;
    protected $log;
    protected $helper;

    public function __construct()
    {
        $this->log = (new \App\Http\Controllers\ThirdParty\SatuSehat\Log\CreateController());
        $this->request = (new \App\Http\Controllers\ThirdParty\SatuSehat\RequestController());
        $this->helper = (new \App\Http\Controllers\ThirdParty\SatuSehat\HelperController());
    }

    private function prepareData(Request $request, $with_check_ss_data = true)
    {
        $log_id = $request->log_id; // satusehat.log_encounter_condition.id
        $pasien = $request->pasien; // model collecion pasien.pasien
        $kasus = $request->kasus; // model collecion kasus.kasus
        $user_dokter_dpjp = $request->user_dokter_dpjp; // model collecion hospital.users
        $lokasi = $request->lokasi; // model collecion hospital.lokasi
        $waktu_start = $request->waktu_start; // format Y-m-d H:i:s
        $waktu_end = $request->waktu_end; // format Y-m-d H:i:s

        # log param
        $log_data = new stdClass;
        $log_data->log_id = $log_id;
        $log_data->kasus_id = $kasus->id;
        $log_data->hospital_lokasi_id = $lokasi->id;
        $log_data->response = null;
        $log_data->status = -1;

        if (empty($user_dokter_dpjp))
            $log_data->response = ['error' => 'Data User Dokter tidak ditemukan'];

        $user_dokter_dpjp = $user_dokter_dpjp->load(['employee', 'dokter']);

        $ss_patient = $pasien->satusehat_patient ?? null;
        $ss_practitioner = (!empty($user_dokter_dpjp->dokter) ? ($user_dokter_dpjp->dokter->satusehat_practitioner ?? null) : null);
        $ss_location = $lokasi->satusehat_location ?? null;
        $waktu_start = Carbon::parse($waktu_start)->setTimezone('Asia/Jakarta')->toIso8601String();
        $waktu_end = !empty($waktu_end) ? Carbon::parse($waktu_end)->setTimezone('Asia/Jakarta')->toIso8601String() : null;

        if ($with_check_ss_data) {
            # auto sync lokasi
            if (empty($ss_location)) {
                $request_set_lokasi = new Request([
                    'id' => $lokasi->id
                ]);
                $ss_location = (new \App\Http\Controllers\ThirdParty\SatuSehat\Location\PostController())->create($request_set_lokasi);
            }

            # auto sync dokter
            if (empty($ss_practitioner) && !empty($user_dokter_dpjp->employee) && !empty($user_dokter_dpjp->dokter)) {
                $nik_user = ($user_dokter_dpjp->employee->identity_card ?? '');
                if (config('medify.third-party.satusehat.sumber_nik_user', 'kepegawaian') == 'user') {
                    $nik_user = ($user_dokter_dpjp->nik ?? '');
                }
                $request_search_dokter = new Request([
                    'nik' => $nik_user,
                    'dokter' => $user_dokter_dpjp->dokter,
                    'pegawai' => $user_dokter_dpjp->employee
                ]);
                $ss_practitioner = (new \App\Http\Controllers\ThirdParty\SatuSehat\Practitioner\PostController())->getByNIK($request_search_dokter);
            }

            # auto sync patient
            if (empty($ss_patient)) {
                $request_search_pasien = new Request([
                    'nik' => $pasien->no_identitas,
                    'pasien' => $pasien
                ]);
                $ss_patient = (new \App\Http\Controllers\ThirdParty\SatuSehat\Patient\PostController())->getByNIK($request_search_pasien);
            }
        }

        # catch log error satusehat data bridge
        if (empty($ss_patient))
            $log_data->response = ['error' => 'Data Pasien dengan NIK tidak ditemukan'];
        else if (empty($ss_practitioner))
            $log_data->response = ['error' => 'Data Dokter dengan NIK tidak ditemukan'];
        else if (empty($ss_location))
            $log_data->response = ['error' => 'Data Location tidak ditemukan'];

        return [
            'log_data'          => $log_data,
            'ss_patient'        => $ss_patient,
            'ss_practitioner'   => $ss_practitioner,
            'ss_location'       => $ss_location,
            'waktu_start'       => $waktu_start,
            'waktu_end'         => $waktu_end,
        ];
    }

    public function pelayananArrived(Request $request)
    {
        $kasus = $request->kasus; // model collecion kasus.kasus
        $tipe_pelayanan = $request->tipe_pelayanan; // enum RJ, IGD, RI

        $prepareData = $this->prepareData($request);
        $log_data = $prepareData['log_data'];

        # catch log error
        if (!empty($log_data->response)) {
            $log_data->status = -1;
            $this->log->encounterCondition($log_data);
            return $log_data;
        }

        $request_param = new Request([
            'ss_patient' => $prepareData['ss_patient'],
            'ss_practitioner' => $prepareData['ss_practitioner'],
            'ss_location' => $prepareData['ss_location'],
            'waktu_start' => $prepareData['waktu_start'],
            'status' => "arrived",
            'encounter_class' => $this->helper->getEncounterClass($tipe_pelayanan)
        ]);
        $get_params = app(\App\Http\Controllers\ThirdParty\SatuSehat\Encounter\CreateController::class)->getParamArrived($request_param);
        $params = new Request($get_params);

        try {
            $url = $this->request->getBaseUrl() . '/Encounter';
            $send = $this->request->send('POST', $url, \GuzzleHttp\RequestOptions::JSON, $params->all());
            $send = json_decode($send);

            if ($send->code == 200) {
                # save encounter data
                $encounter = app(\App\Http\Controllers\ThirdParty\SatuSehat\Encounter\CreateController::class)->save($log_data, $send->response);
                $log_data->status = 1;
                $log_data->encounter_id = $encounter->id;
            }

            $log_data->response = $send->response;
            $this->log->encounterCondition($log_data, $params->all());

            return $log_data;
        } catch (\Exception $e) {
            $log_data->response = ['error' => $e->getMessage()];
            $this->log->encounterCondition($log_data, $params->all());

            return $log_data;
        }
    }

    public function pelayananInProgress(Request $request)
    {
        $encounter_id = $request->encounter_id;
        $encounter_satusehat_id = $request->encounter_satusehat_id;
        $kasus = $request->kasus; // model collecion kasus.kasus
        $tipe_pelayanan = $request->tipe_pelayanan; // enum RJ, IGD, RI

        $prepareData = $this->prepareData($request, false);
        $log_data = $prepareData['log_data'];

        # catch log error
        if (!empty($log_data->response)) {
            $this->log->encounterCondition($log_data);
            return $log_data;
        }

        $request_param = new Request([
            'log_id' => $log_data->log_id,
            'encounter_id' => $encounter_id,
            'ss_patient' => $prepareData['ss_patient'],
            'ss_practitioner' => $prepareData['ss_practitioner'],
            'ss_location' => $prepareData['ss_location'],
            'waktu_start' => $prepareData['waktu_start'],
            'status' => "in-progress",
            'encounter_class' => $this->helper->getEncounterClass($tipe_pelayanan)
        ]);
        $get_params = app(\App\Http\Controllers\ThirdParty\SatuSehat\Encounter\CreateController::class)->getParamUpdateStatus($request_param);
        $params = new Request($get_params);

        try {
            $url = $this->request->getBaseUrl() . '/Encounter/' . $encounter_satusehat_id;
            $send = $this->request->send('PUT', $url, \GuzzleHttp\RequestOptions::JSON, $params->all());
            $send = json_decode($send);

            if ($send->code == 200) {
                # save encounter data
                app(\App\Http\Controllers\ThirdParty\SatuSehat\Encounter\CreateController::class)->save($log_data, $send->response);
                $log_data->status = 1;
            }

            $log_data->response = $send->response;
            $this->log->encounterCondition($log_data, $params->all());

            return $log_data;
        } catch (\Exception $e) {
            $log_data->response = ['error' => $e->getMessage()];
            $this->log->encounterCondition($log_data, $params->all());

            return $log_data;
        }
    }

    public function pelayananDischarge(Request $request)
    {
        $encounter_id = $request->encounter_id;
        $encounter_satusehat_id = $request->encounter_satusehat_id;
        $kasus = $request->kasus; // model collecion kasus.kasus
        $tipe_pelayanan = $request->tipe_pelayanan; // enum RJ, IGD, RI
        $cara_pulang_slug = $request->cara_pulang_slug; // cara_pulang_slug teks

        $prepareData = $this->prepareData($request, false);
        $log_data = $prepareData['log_data'];
        $discharge_disposition = $this->helper->getEncounterDischargeDisposition($cara_pulang_slug);

        if (empty($kasus->alasan_krs) || empty($discharge_disposition))
            $log_data->response = ['error' => "Alasan KRS $cara_pulang_slug belum di set"];

        # catch log error
        if (!empty($log_data->response)) {
            $this->log->encounterCondition($log_data);
            return $log_data;
        }

        $request_param = new Request([
            'log_id' => $log_data->log_id,
            'encounter_id' => $encounter_id,
            'ss_patient' => $prepareData['ss_patient'],
            'ss_practitioner' => $prepareData['ss_practitioner'],
            'ss_location' => $prepareData['ss_location'],
            'waktu_start' => $prepareData['waktu_start'],
            'waktu_end' => $prepareData['waktu_end'],
            'status' => "discharge",
            'encounter_class' => $this->helper->getEncounterClass($tipe_pelayanan),
            'discharge_disposition' => $discharge_disposition
        ]);
        $get_params = app(\App\Http\Controllers\ThirdParty\SatuSehat\Encounter\CreateController::class)->getParamUpdateStatus($request_param);
        $params = new Request($get_params);

        try {
            $url = $this->request->getBaseUrl() . '/Encounter/' . $encounter_satusehat_id;
            $send = $this->request->send('PUT', $url, \GuzzleHttp\RequestOptions::JSON, $params->all());
            $send = json_decode($send);

            if ($send->code == 200) {
                # save encounter data
                app(\App\Http\Controllers\ThirdParty\SatuSehat\Encounter\CreateController::class)->save($log_data, $send->response);
                $log_data->status = 1;
            }

            $log_data->response = $send->response;
            $this->log->encounterCondition($log_data, $params->all());

            return $log_data;
        } catch (\Exception $e) {
            $log_data->response = ['error' => $e->getMessage()];
            $this->log->encounterCondition($log_data, $params->all());

            return $log_data;
        }
    }

    public function pelayananFinished(Request $request)
    {
        $encounter_id = $request->encounter_id;
        $encounter_satusehat_id = $request->encounter_satusehat_id;
        $kasus = $request->kasus; // model collecion kasus.kasus
        $tipe_pelayanan = $request->tipe_pelayanan; // enum RJ, IGD, RI
        $cara_pulang_slug = $request->cara_pulang_slug; // cara_pulang_slug teks

        $prepareData = $this->prepareData($request, false);
        $log_data = $prepareData['log_data'];

        # catch log error
        if (!empty($log_data->response)) {
            $this->log->encounterCondition($log_data);
            return $log_data;
        }

        $request_param = new Request([
            'log_id' => $log_data->log_id,
            'encounter_id' => $encounter_id,
            'ss_patient' => $prepareData['ss_patient'],
            'ss_practitioner' => $prepareData['ss_practitioner'],
            'ss_location' => $prepareData['ss_location'],
            'waktu_start' => $prepareData['waktu_start'],
            'waktu_end' => $prepareData['waktu_end'],
            'status' => "finished",
            'encounter_class' => $this->helper->getEncounterClass($tipe_pelayanan),
        ]);
        $get_params = (new \App\Http\Controllers\ThirdParty\SatuSehat\Encounter\CreateController())->getParamUpdateStatus($request_param);
        $params = new Request($get_params);

        try {
            $url = $this->request->getBaseUrl() . '/Encounter/' . $encounter_satusehat_id;
            $send = $this->request->send('PUT', $url, \GuzzleHttp\RequestOptions::JSON, $params->all());
            $send = json_decode($send);

            if ($send->code == 200) {
                # save encounter data
                app(\App\Http\Controllers\ThirdParty\SatuSehat\Encounter\CreateController::class)->save($log_data, $send->response);
                $log_data->status = 1;
            }

            $log_data->response = $send->response;
            $this->log->encounterCondition($log_data, $params->all());

            return $log_data;
        } catch (\Exception $e) {
            $log_data->response = ['error' => $e->getMessage()];
            $this->log->encounterCondition($log_data, $params->all());

            return $log_data;
        }
    }
}
