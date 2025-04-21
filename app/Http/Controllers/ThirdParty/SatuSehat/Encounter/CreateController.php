<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Encounter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdPartySatuSehat\Encounter;
use App\Models\ThirdPartySatuSehat\LogEncounterCondition;
use Ramsey\Uuid\Uuid;

class CreateController extends Controller
{
    public function getParamArrived(Request $request)
    {
        $currentStatus = [
            'status' => 'arrived',
            'period' => [
                'start' => $request->waktu_start
            ]
        ];
        if (!empty($request->waktu_end)) {
            $currentStatus['period']['end'] = $request->waktu_end ?? "";
        }

        # resource params
        $resource_param = $this->defaultResourceParams($request);
        $resource_param["status"] = $request->status ?? "arrived";
        $resource_param["statusHistory"] = [];
        $resource_param["statusHistory"][] = $currentStatus;

        $resource_param["period"] = [
            "start" => $request->waktu_start
        ];
        if (!empty($request->waktu_end)) {
            $resource_param["period"]["end"] = $request->waktu_end ?? "";
        }
        return $resource_param;
    }

    public function getParamUpdateStatus(Request $request)
    {
        $getHistory = LogEncounterCondition::where('encounter_id', $request->encounter_id)
            ->where('id', '!=', $request->log_id)
            ->orderBy('id', 'desc')
            ->first();

        $getHistoryResponse = json_decode($getHistory->response, true);
        $getStatusHistory = $getHistoryResponse['statusHistory'] ?? [];

        foreach ($getStatusHistory as $key => $item) {
            if (empty($item['period']['end'])) {
                $getStatusHistory[$key]['period']['end'] = $request->waktu_start;
            }
        }

        $currentStatus = [
            'status' => $request->status,
            'period' => [
                'start' => $request->waktu_start
            ]
        ];
        if (!empty($request->waktu_end)) {
            $currentStatus['period']['end'] = $request->waktu_end ?? "";
        }
        $getStatusHistory[] = $currentStatus;

        # resource params
        $resource_param = $this->defaultResourceParams($request);
        $resource_param["id"] = $getHistoryResponse['id'] ?? '';
        $resource_param["status"] = $request->status;
        $resource_param["statusHistory"] = $getStatusHistory;

        $resource_param["period"] = [
            "start" => $request->waktu_start
        ];
        if (!empty($request->waktu_end)) {
            $resource_param["period"]["end"] = $request->waktu_end ?? "";
        }

        if ($request->status == 'discharge' && !empty($request->discharge_disposition)) {
            $resource_param["hospitalization"] = [
                "dischargeDisposition" => $request->discharge_disposition
            ];
        }

        return $resource_param;
    }

    private function defaultResourceParams($request)
    {
        $get_org = app(\App\Http\Controllers\ThirdParty\SatuSehat\Organization\PostController::class)->getById($request);
        $get_org = json_decode($get_org, true);

        $default = [
            "resourceType" => "Encounter",
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/encounter/10000004",
                    "value" => "P20240001"
                ]
            ],
            "class" => $request->encounter_class ?? [],
            "subject" => [
                "reference" => "Patient/" . $request->ss_patient->ihs_number,
                "display" => $request->ss_patient->name
            ],
            "participant" => [
                [
                    "type" => [
                        [
                            "coding" => [
                                [
                                    "system" => "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                    "code" => "ATND",
                                    "display" => "attender"
                                ]
                            ]
                        ]
                    ],
                    "individual" => [
                        "reference" => "Practitioner/" . $request->ss_practitioner->his_number,
                        "display" => $request->ss_practitioner->name
                    ]
                ]
            ],
            "location" => [
                [
                    "location" => [
                        "reference" => "Location/" . $request->ss_location->satusehat_id,
                        "display" => $request->ss_location->name
                    ]
                ]
            ],
            "serviceProvider" => [
                "reference" => "Organization/" . ($get_org['id'] ?? "")
            ]
        ];

        return $default;
    }

    public function save($log_data, $response_data)
    {
        $ss_kasus = Encounter::where('kasus_id', $log_data->kasus_id)->where('satusehat_id', $response_data->id)->first();
        if (empty($ss_kasus)) {
            $ss_kasus = new Encounter();
            $ss_kasus->kasus_id = $log_data->kasus_id;
            $ss_kasus->hospital_lokasi_id = $log_data->hospital_lokasi_id;
            $ss_kasus->satusehat_id = $response_data->id ?? null;
            $ss_kasus->save();

            return $ss_kasus;
        }
        return $ss_kasus;
    }

    public function saveByKasus($log_data)
    {
        $encounter = Encounter::where('kasus_id', $log_data->kasus_id)->first();
        if (empty($encounter)) {
            $encounter = new Encounter();
            $encounter->save();
        }

        if (empty($encounter->uuid)) {
            $uuid = Uuid::uuid4()->getUrn();
            $encounter_uuid = Encounter::where('uuid', $uuid)->count('id');
            while ($encounter_uuid > 0) {
                $uuid = Uuid::uuid4()->getUrn();
                $encounter_uuid = Encounter::where('uuid', $uuid)->count('id');
            }

            $encounter->uuid = $uuid;
        }

        $encounter->kasus_id = $log_data->kasus_id;
        $encounter->hospital_lokasi_id = $log_data->hospital_lokasi_id ?? $encounter->hospital_lokasi_id;
        $encounter->satusehat_id = $log_data->satusehat_id ?? $encounter->satusehat_id;
        $encounter->request_param = $log_data->request_param ?? $encounter->request_param;
        $encounter->status = $log_data->status ?? $encounter->status;
        $encounter->save();

        return $encounter;
    }
}
