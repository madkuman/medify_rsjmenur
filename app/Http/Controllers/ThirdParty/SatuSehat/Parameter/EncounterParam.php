<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Parameter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class EncounterParam extends Controller
{
    public $encounter = ['resourceType' => 'Encounter'];

    private function returnError($message)
    {
        return JsonResponse::create(['code' => 500, 'message' => $message], 500);
    }

    public function setStatusHistory($kasus)
    {
        if (array_key_exists('statusHistory', $this->encounter)) {
            unset($this->encounter['statusHistory']);
        }

        $statusHistoryArrived = [];
        $statusHistoryInProgress = [];
        $statusHistoryFinished = [];

        if ($kasus->tipe_rj == 1 && $kasus->tipe_ri == 0) { # CASE RAWATJALAN
            $rawatjalan_transaksi = $kasus->rawat_jalan_transaksi_last;
            $arrived_at = (new \App\Http\Controllers\RawatJalan\Transaksi\ReadController)->getPendaftaranJKNAt($rawatjalan_transaksi);

            $this->encounter['status'] = 'arrived';
            $this->encounter['period']['start'] = Carbon::parse($arrived_at)->toIso8601String();

            $statusHistoryArrived['status'] = 'arrived';
            $statusHistoryArrived['period']['start'] = Carbon::parse($arrived_at)->toIso8601String();

            if (!empty($rawatjalan_transaksi->waktu_pemeriksaan)) {
                $this->encounter['status'] = 'in-progress';
                $statusHistoryArrived['period']['end'] = Carbon::parse($rawatjalan_transaksi->waktu_pemeriksaan)->toIso8601String();

                $statusHistoryInProgress['status'] = 'in-progress';
                $statusHistoryInProgress['period']['start'] = Carbon::parse($rawatjalan_transaksi->waktu_pemeriksaan)->toIso8601String();
            }
        } else if ($kasus->tipe_ri == 1) { # CASE RAWATINAP
            $rawatinap_transaksi = $kasus->rawat_inap_transaksi_first;
            $arrived_at = $kasus->mrs_at;

            $this->encounter['status'] = 'arrived';
            $this->encounter['period']['start'] = Carbon::parse($arrived_at)->toIso8601String();

            $statusHistoryArrived['status'] = 'arrived';
            $statusHistoryArrived['period']['start'] = Carbon::parse($arrived_at)->toIso8601String();

            if (!empty($rawatinap_transaksi->kedatangan_at)) {
                $this->encounter['status'] = 'in-progress';

                $statusHistoryArrived['period']['end'] = Carbon::parse($rawatinap_transaksi->kedatangan_at)->toIso8601String();

                $statusHistoryInProgress['status'] = 'in-progress';
                $statusHistoryInProgress['period']['start'] = Carbon::parse($rawatinap_transaksi->kedatangan_at)->toIso8601String();
            }
        } else if ($kasus->tipe_igd == 1 && $kasus->tipe_rj == 0 && $kasus->tipe_ri == 0) { # CASE IGD
            $arrived_at = $kasus->created_at;
            $in_progress_at = $kasus->created_at;

            $this->encounter['status'] = 'in-progress';
            $this->encounter['period']['start'] = Carbon::parse($arrived_at)->toIso8601String();

            $statusHistoryArrived['status'] = 'arrived';
            $statusHistoryArrived['period']['start'] = Carbon::parse($arrived_at)->toIso8601String();
            $statusHistoryArrived['period']['end'] = Carbon::parse($in_progress_at)->toIso8601String();

            $statusHistoryInProgress['status'] = 'in-progress';
            $statusHistoryInProgress['period']['start'] = Carbon::parse($in_progress_at)->toIso8601String();
        }

        if (!empty($kasus->krs_at)) {
            $this->encounter['status'] = 'finished';
            $this->encounter['period']['end'] = Carbon::parse($kasus->krs_at)->toIso8601String();

            $statusHistoryInProgress['period']['end'] = Carbon::parse($kasus->krs_at)->toIso8601String();

            $statusHistoryFinished['status'] = 'finished';
            $statusHistoryFinished['period']['start'] = Carbon::parse($kasus->krs_at)->toIso8601String();
            $statusHistoryFinished['period']['end'] = Carbon::parse($kasus->krs_at)->toIso8601String();
        }

        // Add all statusHistory
        $this->encounter['statusHistory'][] = $statusHistoryArrived;
        if (!empty($statusHistoryInProgress)) {
            $this->encounter['statusHistory'][] = $statusHistoryInProgress;
        }
        if (!empty($statusHistoryFinished)) {
            $this->encounter['statusHistory'][] = $statusHistoryFinished;
        }
    }

    public function setClass($kasus)
    {
        $encounter_class = [];
        $encounter_class_hl7 = (new \App\Http\Controllers\ThirdParty\SatuSehat\HL7\ReadController)->getActCode();

        if ($kasus->tipe_rj == 1 && $kasus->tipe_ri == 0) { # CASE RAWATJALAN
            $encounter_class = $encounter_class_hl7->where('code', 'SS')->first();
        } else if ($kasus->tipe_ri == 1) { # CASE RAWATINAP
            $encounter_class = $encounter_class_hl7->where('code', 'IMP')->first();
        } else if ($kasus->tipe_igd == 1 && $kasus->tipe_rj == 0 && $kasus->tipe_ri == 0) { # CASE IGD
            $encounter_class = $encounter_class_hl7->where('code', 'AMB')->first();
        }

        $this->encounter['class'] = $encounter_class;
    }

    public function setSubject($pasien)
    {
        $ss_patient = (new \App\Http\Controllers\ThirdParty\SatuSehat\Patient\ReadController)->getPatient($pasien);
        if (empty($ss_patient)) return $this->returnError('Pasien tidak ditemukan');

        $this->encounter['subject']['reference'] = 'Patient/' . ($ss_patient->ihs_number ?? 0);
        $this->encounter['subject']['display'] = ($ss_patient->name ?? $pasien->name);
    }

    public function setParticipant($user_dpjp)
    {
        $dokter = $user_dpjp->dokter;
        $ss_practitioner = (new \App\Http\Controllers\ThirdParty\SatuSehat\Practitioner\ReadController)->getPractitioner($user_dpjp);
        if (empty($ss_practitioner)) return $this->returnError('Dokter tidak ditemukan');

        $participant = [];
        $participant_hl7 = (new \App\Http\Controllers\ThirdParty\SatuSehat\HL7\ReadController)->getParticipationType();

        $participantId = ($ss_practitioner->his_number ?? 0);
        $participantName = ($ss_practitioner->name ?? $dokter->name ?? $user_dpjp->name);

        $participant['individual']['reference'] = 'Practitioner/' . $participantId;
        $participant['individual']['display'] = $participantName;
        $participant['type'][]['coding'] = [
            $participant_hl7->where('code', 'ATND')->first()
        ];

        $this->encounter['participant'][] = $participant;
    }

    public function setLocation($kasus)
    {
        if (array_key_exists('location', $this->encounter)) {
            unset($this->encounter['location']);
        }

        foreach ($kasus->lokasiAll as $item) {
            $ss_location = $item->lokasi->satusehat_location ?? null;

            # auto sync location
            if (empty($ss_location)) {
                $request_set_lokasi = new Request([
                    'id' => $item->lokasi->id
                ]);
                $ss_location = (new \App\Http\Controllers\ThirdParty\SatuSehat\Location\PostController())->create($request_set_lokasi);
            }
            if (empty($ss_location)) continue;

            $locationId = ($ss_location->satusehat_id ?? 0);
            $locationName = ($ss_location->description ?? $item->lokasi->name);

            $location['location']['reference'] = 'Location/' . $locationId;
            $location['location']['display'] = $locationName;

            $this->encounter['location'][] = $location;
        }
    }

    public function setDiagnosis($kasus)
    {
        $diagnosis = $kasus->diagnosis;
        $diagnosis_hl7 = (new \App\Http\Controllers\ThirdParty\SatuSehat\HL7\ReadController)->getDiagnosisRole();

        $diagnosis_object = [];
        foreach ($diagnosis as $index => $item) {
            if (empty($item->icd10)) continue;

            $condition = $item->satusehat_condition;

            # SATUSEHAT CREATE CONDITION
            if (empty($condition) || empty($condition->uuid)) {
                $condition_data = new Request([
                    'kasus_id' => $item->kasus_id,
                    'diagnosis_id' => $item->id
                ]);
                $condition = (new \App\Http\Controllers\ThirdParty\SatuSehat\Condition\CreateController)->saveByDiagnosis($condition_data);
            }

            switch ($item->type) {
                case 'komplikasi':
                    $dx_code = 'CM';
                    break;
                default:
                    $dx_code = 'DD';
                    break;
            }

            $diagnosisName = ($item->icd10->long_desc ?? '');
            $diagnosisCoding = $diagnosis_hl7->where('code', $dx_code)->first();

            $diagnosisTemp = [];
            $diagnosisTemp['condition']['reference'] = $condition->uuid;
            $diagnosisTemp['condition']['display'] = $diagnosisName;
            $diagnosisTemp['use']['coding'] = [
                $diagnosisCoding
            ];

            // Determine ranking
            if (!array_key_exists('diagnosis', $this->encounter)) {
                $rank = 1;
            } else {
                $rank = count($this->encounter['diagnosis']) + 1;
            }
            $diagnosisTemp['rank'] = $rank;

            $this->encounter['diagnosis'][] = $diagnosisTemp;
        }

        return $diagnosis_object;
    }

    public function setServiceProvider()
    {
        $get_org = (new \App\Http\Controllers\ThirdParty\SatuSehat\Organization\ReadController)->getOrganization();
        $get_org = json_decode($get_org, true);

        $orgId = ($get_org['id'] ?? "");
        $this->encounter['serviceProvider']['reference'] = 'Organization/' . $orgId;
    }

    public function setIdentifier($kasus)
    {
        $kasus_id = $kasus->id;
        $get_org = (new \App\Http\Controllers\ThirdParty\SatuSehat\Organization\ReadController)->getOrganization();
        $get_org = json_decode($get_org, true);

        $identifier = 'http://sys-ids.kemkes.go.id/encounter/' . ($get_org['id'] ?? "");

        $this->encounter['identifier'][] = [
            'system' => $identifier,
            'value' => (string) $kasus_id
        ];
    }

    public function toArray()
    {
        if (!array_key_exists('status', $this->encounter)) {
            return $this->returnError('status required');
        }

        if (!array_key_exists('class', $this->encounter)) {
            return $this->returnError('class required');
        }

        if (!array_key_exists('subject', $this->encounter)) {
            return $this->returnError('subject required');
        }

        if (!array_key_exists('participant', $this->encounter)) {
            return $this->returnError('participant required');
        }

        if (!array_key_exists('location', $this->encounter)) {
            return $this->returnError('location required');
        }

        if (!array_key_exists('serviceProvider', $this->encounter)) {
            $this->setServiceProvider();
        }

        return $this->encounter;
    }

    public function post()
    {
        $url = (new \App\Http\Controllers\ThirdParty\SatuSehat\RequestController)->getBaseUrl() . '/Encounter';
        $send = (new \App\Http\Controllers\ThirdParty\SatuSehat\RequestController)->send('POST', $url, \GuzzleHttp\RequestOptions::JSON, $this->encounter);
        $send = json_decode($send);
        return $send;
    }

    public function put()
    {
        $url = (new \App\Http\Controllers\ThirdParty\SatuSehat\RequestController)->getBaseUrl() . '/Encounter';
        $send = (new \App\Http\Controllers\ThirdParty\SatuSehat\RequestController)->send('PUT', $url, \GuzzleHttp\RequestOptions::JSON, $this->encounter);
        $send = json_decode($send);
        return $send;
    }
}
