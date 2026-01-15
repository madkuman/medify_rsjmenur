<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\BundleRequest;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Models\Kasus\Kasus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Pasien\Pasien;
use GuzzleHttp\RequestOptions;
use App\Models\Hospital\Lokasi;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\VitalSign;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Transaksi;
use App\Models\RawatJalan\Poliklinik;
use App\Models\ThirdPartySatuSehat\Patient;
use App\Models\ThirdPartySatuSehat\Location;
use App\Models\ThirdPartySatuSehat\Encounter;
use App\Models\ThirdPartySatuSehat\Practitioner;

class BundlePostController extends Controller
{
    protected $request;

    public function __construct()
    {
        $this->request = (new \App\Http\Controllers\ThirdParty\SatuSehat\RequestController());
    }

    public function generateUuid()
    {
        $uuid = Uuid::uuid4()->toString();
        return response()->json([
            'uuid' => $uuid
        ]);
    }

    public function bundle()
    {
        //Get ID Organization
        $organization_id = config('medify.third-party.satusehat.organization_id');
        // Get the current date without the time part for comparison
        // $currentDate = Carbon::now()->toDateString();
        $currentDate = "2023-08-02";
        // Retrieve transaksi with related kasus where the created_at date matches the current date
        $transaksi = Transaksi::whereDate('medify_rsjmenur_rawat_jalan.transaksi.waktu_pemeriksaan', $currentDate)
            // ->leftJoin('medify_rsjmenur_third_party.log_bundle', 'medify_rsjmenur_rawat_jalan.transaksi.kasus_id', '=', 'medify_rsjmenur_third_party.log_bundle.kasus_id')
            // ->whereNull('medify_rsjmenur_third_party_satusehat.encounter.kasus_id')
            ->where('status', 1)
            ->limit(10)
            ->get();
        // dd($transaksi);

        // Check if there are any transactions
        if ($transaksi->isEmpty()) {
            return response()->json(['message' => 'No transactions found for the specified date.'], 404);
        }
        // Initialize an array to hold the results
        $results = [];

        foreach ($transaksi as $tx) {
            try {
                //Cari Pasien
                $pasien = Pasien::find($tx->pasien_id);
                if (empty($pasien)) {
                    return response()->json([
                        'message' => 'Pasien tidak ditemukan'
                    ]);
                }
                // dd($pasien);
                $ss_patient = Patient::where('pasien_id', $pasien->id)->first();
                if (empty($ss_patient)) {
                    $request_search_pasien = new Request([
                        'nik' => $pasien->no_identitas,
                        'pasien' => $pasien
                    ]);
                    // dd($pasien->id);
                    $ss_patient = (new \App\Http\Controllers\ThirdParty\SatuSehat\Patient\PostController())->getByNIK($request_search_pasien);
                }
                // dd($ss_patient);
                //Cari Kasus
                $kasus = Kasus::find($tx->kasus_id);
                if (empty($kasus)) {
                    return response()->json([
                        'message' => 'Kasus tidak ditemukan'
                    ]);
                }
                //Generate UUID untuk Encounter ID sementara
                $uuidEncounterResponse = $this->generateUuid();
                $uuid_encounter = json_decode($uuidEncounterResponse->getContent(), true)['uuid'];
                //Cari DPJP
                $ss_practitioner = Practitioner::where('dokter_id', $tx->dokter_id)->first() ?? null;

                //Cari Diagnosis
                $uuid_diagnosis = $this->generateUuid();
                $uuid_diagnosis = json_decode($uuid_diagnosis->getContent(), true)['uuid'];

                //Cari Diagnosis Primer
                $uuid_diagnosis_primer = $this->generateUuid();
                $uuid_diagnosis_primer = json_decode($uuid_diagnosis_primer->getContent(), true)['uuid'];
                $diagnosis_primer = Diagnosis::with('icd10')
                    ->where('kasus_id', $kasus->id)
                    ->where('type', 'utama')
                    ->first();

                //Cari Diagnosis Sekunder
                $uuid_diagnosis_sekunder = $this->generateUuid();
                $uuid_diagnosis_sekunder = json_decode($uuid_diagnosis_sekunder->getContent(), true)['uuid'];
                $diagnosis_sekunder = Diagnosis::with('icd10')
                    ->where('kasus_id', $kasus->id)
                    ->where('type', 'sekunder')
                    ->first();

                //Cari Location
                $poliklinik = Poliklinik::find($tx->poliklinik_id);
                $ss_location = Location::where('hospital_lokasi_id', $poliklinik->lokasi_id)->first() ?? null;

                //Get Pemeriksaan Nadi
                $vital_sign = VitalSign::where('kasus_id', $kasus->id)->first();
                if (!empty($vital_sign) && !empty($vital_sign->nadi)) {
                    $nadi = $vital_sign->nadi;
                } else {
                    $nadi = "hasil pemeriksaan nadi tidak tersedia";
                }
                // dd($uuid_diagnosis_sekunder);
                //Buat param bundle
                $param = [
                    "resourceType" => "Bundle",
                    "type" => "transaction",
                    "entry" => [
                        [
                            "fullUrl" => "urn:uuid:{$uuid_encounter}",
                            "resource" => [
                                "resourceType" => "Encounter",
                                "identifier" => [
                                    [
                                        "system" => "http://sys-ids.kemkes.go.id/encounter/{$organization_id}",
                                        "value" => $organization_id
                                    ]
                                ],
                                "status" => "finished",
                                "statusHistory" => [
                                    [
                                        "status" => "arrived",
                                        "period" => [
                                            "start" => Carbon::parse($tx->waktu_masuk, 'Asia/Jakarta')->subMinutes(30)->toIso8601String(),
                                            "end" => Carbon::parse($tx->waktu_pemeriksaan, 'Asia/Jakarta')->toIso8601String(),
                                        ]
                                    ],
                                    [
                                        "status" => "in-progress",
                                        "period" => [
                                            "start" => Carbon::parse($tx->waktu_pemeriksaan, 'Asia/Jakarta')->toIso8601String(),
                                            "end" => Carbon::parse($tx->waktu_pemeriksaan, 'Asia/Jakarta')->addMinutes(19)->toIso8601String(),
                                        ]
                                    ],
                                    [
                                        "status" => "finished",
                                        "period" => [
                                            "start" => Carbon::parse($tx->waktu_masuk, 'Asia/Jakarta')->addMinutes(60)->toIso8601String(),
                                            "end" => Carbon::parse($tx->waktu_masuk, 'Asia/Jakarta')->addMinutes(120)->toIso8601String()
                                        ]
                                    ]
                                ],
                                "class" => [
                                    "system" => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                                    "code" => "AMB",
                                    "display" => "ambulatory"
                                ],
                                "subject" => [
                                    "reference" => "Patient/{$ss_patient->ihs_number}",
                                    "display" => $ss_patient->name
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
                                            "reference" => "Practitioner/{$ss_practitioner->his_number}",
                                            "display" => $ss_practitioner->name,
                                        ]
                                    ]
                                ],
                                "period" => [
                                    "start" => Carbon::parse($tx->waktu_masuk, 'Asia/Jakarta')->subMinutes(30)->toIso8601String(),
                                    "end" => Carbon::parse($tx->waktu_masuk, 'Asia/Jakarta')->addMinutes(120)->toIso8601String(),
                                ],
                                "hospitalization" => [
                                    "dischargeDisposition" => [
                                        "coding" => [
                                            [
                                                "system" => "http://terminology.hl7.org/CodeSystem/discharge-disposition",
                                                "code" => "oth",
                                                "display" => "other-hcf"
                                            ]
                                        ],
                                        "text" => "-"
                                    ]
                                ],
                                "location" => [
                                    [
                                        "extension" => [
                                            [
                                                "extension" => [
                                                    [
                                                        "url" => "value",
                                                        "valueCodeableConcept" => [
                                                            "coding" => [
                                                                [
                                                                    "system" => "http://terminology.kemkes.go.id/CodeSystem/locationServiceClass-Outpatient",
                                                                    "code" => "reguler",
                                                                    "display" => "Kelas Reguler"
                                                                ]
                                                            ]
                                                        ]
                                                    ],
                                                    [
                                                        "url" => "upgradeClassIndicator",
                                                        "valueCodeableConcept" => [
                                                            "coding" => [
                                                                [
                                                                    "system" => "http://terminology.kemkes.go.id/CodeSystem/locationUpgradeClass",
                                                                    "code" => "kelas-tetap",
                                                                    "display" => "Kelas Tetap Perawatan"
                                                                ]
                                                            ]
                                                        ]
                                                    ]
                                                ],
                                                "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/ServiceClass"
                                            ]
                                        ],
                                        "location" => [
                                            "reference" => "Location/{$ss_location->satusehat_id}",
                                            "display" => $ss_location->name
                                        ],
                                        "period" => [
                                            "start" => Carbon::parse($tx->waktu_pemeriksaan, 'Asia/Jakarta')->toIso8601String(),
                                            "end" => "2023-08-31T02:00:00+00:00"
                                        ]
                                    ]
                                ],
                                "serviceProvider" => [
                                    "reference" => "Organization/{$organization_id}"
                                ]
                            ],
                            "request" => [
                                "method" => "POST",
                                "url" => "Encounter",
                            ],
                        ],
                        [
                            "fullUrl" => "urn:uuid:{$uuid_diagnosis_primer}",
                            "resource" => [
                                "resourceType" => "Condition",
                                "clinicalStatus" => [
                                    "coding" => [
                                        [
                                            "system" => "http://terminology.hl7.org/CodeSystem/condition-clinical",
                                            "code" => "active",
                                            "display" => "Active"
                                        ],
                                    ],
                                ],
                                "category" => [
                                    [
                                        "coding" => [
                                            [
                                                "system" => "http://terminology.hl7.org/CodeSystem/condition-category",
                                                "code" => "problem-list-item",
                                                "display" => "Problem List Item"
                                            ]
                                        ]
                                    ]
                                ],
                                "code" => [
                                    "coding" => [
                                        [
                                            "system" => "http://loinc.org",
                                            "code" => $diagnosis_primer->icd10->code_icd,
                                            "display" => $diagnosis_primer->icd10->long_desc,
                                        ],
                                    ],
                                ],
                                "subject" => [
                                    "reference" => "Patient/{$ss_patient->ihs_number}",
                                    "display" => $ss_patient->name
                                ],
                                "encounter" => [
                                    "reference" => "urn:uuid:{$uuid_encounter}"
                                ],
                                "onsetDateTime" => "2023-02-02T00:00:00+00:00",
                                "recordedDate" => "2023-08-31T01:00:00+00:00",
                                "recorder" => [
                                    "reference" => "Practitioner/{$ss_practitioner->his_number}",
                                    "display" => $ss_practitioner->name
                                ],
                                "note" => [
                                    [
                                        "text" => "-"
                                    ]
                                ]
                            ],
                            "request" => [
                                "method" => "POST",
                                "url" => "Condition",
                            ],
                        ],
                        [
                            "fullUrl" => "urn:uuid:{{Observation_Nadi}}",
                            "resource" => [
                                "resourceType" => "Observation",
                                "status" => "final",
                                "category" => [
                                    [
                                        "coding" => [
                                            [
                                                "system" => "http://terminology.hl7.org/CodeSystem/observation-category",
                                                "code" => "vital-signs",
                                                "display" => "Vital Signs"
                                            ]
                                        ]
                                    ]
                                ],
                                "code" => [
                                    "coding" => [
                                        [
                                            "system" => "http://loinc.org",
                                            "code" => "8867-4",
                                            "display" => "Heart rate"
                                        ]
                                    ]
                                ],
                                "subject" => [
                                    "reference" => "Patient/{{Patient_ID}}",
                                    "display" => "{{Patient_Name}}"
                                ],
                                "encounter" => [
                                    "reference" => "urn:uuid:{{Encounter_id}}"
                                ],
                                "effectiveDateTime" => "2023-08-31T01:10:00+00:00",
                                "issued" => "2023-08-31T01:10:00+00:00",
                                "performer" => [
                                    [
                                        "reference" => "Practitioner/{{Practitioner_ID}}",
                                        "display" => "{{Practitioner_Name}}"
                                    ]
                                ],
                                "valueQuantity" => [
                                    "value" => 80,
                                    "unit" => "{beats}/min",
                                    "system" => "http://unitsofmeasure.org",
                                    "code" => "{beats}/min"
                                ]
                            ],
                            "request" => [
                                "method" => "POST",
                                "url" => "Observation"
                            ]
                        ],
                        // [
                        //     "fullUrl" => "urn:uuid:{$uuid_diagnosis_sekunder}",
                        //     "resource" => [
                        //         "resourceType" => "Condition",
                        //         "clinicalStatus" => [
                        //             "coding" => [
                        //                 [
                        //                     "system" => "http://terminology.hl7.org/CodeSystem/condition-clinical",
                        //                     "code" => "active",
                        //                     "display" => "Active"
                        //                 ],
                        //             ],
                        //         ],
                        //         "category" => [
                        //             [
                        //                 "coding" => [
                        //                     [
                        //                         "system" => "http://terminology.hl7.org/CodeSystem/condition-category",
                        //                         "code" => "problem-list-item",
                        //                         "display" => "Problem List Item"
                        //                     ]
                        //                 ]
                        //             ]
                        //         ],
                        //         "code" => [
                        //             "coding" => [
                        //                 [
                        //                     "system" => "http://loinc.org",
                        //                     "code" => $diagnosis_sekunder->icd10->code_icd,
                        //                     "display" => $diagnosis_sekunder->icd10->long_desc,
                        //                 ],
                        //             ],
                        //         ],
                        //         "subject" => [
                        //             "reference" => "Patient/{$ss_patient->ihs_number}",
                        //             "display" => $ss_patient->name
                        //         ],
                        //         "encounter" => [
                        //             "reference" => "urn:uuid:{$uuid_encounter}"
                        //         ],
                        //         "onsetDateTime" => "2023-02-02T00:00:00+00:00",
                        //         "recordedDate" => "2023-08-31T01:00:00+00:00",
                        //         "recorder" => [
                        //             "reference" => "Practitioner/{$ss_practitioner->his_number}",
                        //             "display" => $ss_practitioner->name
                        //         ],
                        //         "note" => [
                        //             [
                        //                 "text" => "Batuk Berdarah sejak 3bl yll"
                        //             ]
                        //         ]
                        //     ],
                        //     "request" => [
                        //         "method" => "POST",
                        //         "url" => "Condition",
                        //     ],
                        // ],
                        // [
                        //     "fullUrl" => "urn:uuid:{{Observation_Kesadaran}}",
                        //     "resource" => [
                        //         "resourceType" => "Observation",
                        //         "status" => "final",
                        //         "category" => [
                        //             [
                        //                 "coding" => [
                        //                     [
                        //                         "system" => "http://terminology.hl7.org/CodeSystem/observation-category",
                        //                         "code" => "vital-signs",
                        //                         "display" => "Vital Signs"
                        //                     ]
                        //                 ]
                        //             ]
                        //         ],
                        //         "code" => [
                        //             "coding" => [
                        //                 [
                        //                     "system" => "http=>//loinc.org",
                        //                     "code" => "67775-7",
                        //                     "display" => "Level of responsiveness"
                        //                 ]
                        //             ]
                        //         ],
                        //         "subject" => [
                        //             "reference" => "Patient/{{Patient_ID}}",
                        //             "display" => "{{Patient_Name}}"
                        //         ],
                        //         "encounter" => [
                        //             "reference" => "urn:uuid:{{Encounter_id}}"
                        //         ],
                        //         "effectiveDateTime" => "2023-08-31T01:10:00+00:00",
                        //         "issued" => "2023-08-31T01:10:00+00:00",
                        //         "performer" => [
                        //             [
                        //                 "reference" => "Practitioner/{{Practitioner_ID}}",
                        //                 "display" => "{{Practitioner_Name}}"
                        //             ]
                        //         ],
                        //         "valueCodeableConcept" => [
                        //             "coding" => [
                        //                 [
                        //                     "system" => "http://snomed.info/sct",
                        //                     "code" => "248234008",
                        //                     "display" => "Mentally alert"
                        //                 ]
                        //             ]
                        //         ]
                        //     ],
                        //     "request" => [
                        //         "method" => "POST",
                        //         "url" => "Observation"
                        //     ]
                        // ],
                    ],
                ];

                if ($diagnosis_primer) {
                    $param['entry'][0]['resource']['diagnosis'][] = [
                        "condition" => [
                            "reference" => "urn:uuid:{$uuid_diagnosis_primer}",
                            "display" => $diagnosis_primer->icd10->long_desc,
                        ],
                        "use" => [
                            "coding" => [
                                [
                                    "system" => "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                                    "code" => $diagnosis_primer->icd10->code_icd,
                                    "display" => $diagnosis_primer->icd10->long_desc,
                                ]
                            ]
                        ],
                        "rank" => 1,
                    ];
                } else {
                    $param['entry'][0]['resource']['diagnosis'][] = [
                        "condition" => [
                            "reference" => "urn:uuid:{$uuid_diagnosis_primer}",
                            "display" => "Personal history of drug use disorder"
                        ],
                        "use" => [
                            "coding" => [
                                [
                                    "system" => "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                                    "code" => "Z86.42",
                                    "display" => "Personal history of drug use disorder"
                                ]
                            ]
                        ],
                        "rank" => 1,
                    ];
                }

                if ($diagnosis_sekunder) {
                    $param['entry'][0]['resource']['diagnosis'][] = [
                        "condition" => [
                            "reference" => "urn:uuid:{$uuid_diagnosis_sekunder}",
                            "display" => $diagnosis_sekunder->icd10->long_desc,
                        ],
                        "use" => [
                            "coding" => [
                                [
                                    "system" => "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                                    "code" => $diagnosis_sekunder->icd10->code_icd,
                                    "display" => $diagnosis_sekunder->icd10->long_desc,
                                ]
                            ]
                        ],
                        "rank" => 2,
                    ];
                } else {
                    $param['entry'][0]['resource']['diagnosis'][] = [
                        "condition" => [
                            "reference" => "urn:uuid:{$uuid_diagnosis_sekunder}",
                            "display" => "Personal history of drug use disorder"
                        ],
                        "use" => [
                            "coding" => [
                                [
                                    "system" => "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                                    "code" => "Z86.42",
                                    "display" => "Personal history of drug use disorder"
                                ]
                            ]
                        ],
                        "rank" => 2,
                    ];
                };
                dd($param);
                // $url = $this->request->getBaseUrl();
                $url = "https://centerview-api.dinkes.jatimprov.go.id/fhir-r4/v1";
                $send = $this->request->send('POST', $url, \GuzzleHttp\RequestOptions::JSON, $param);
                $response = json_decode($send);

                if ($response->code == 200) {
                    $entryResult = $response->entry ?? [];
                    foreach ($entryResult as $key => $result) {
                        $currentModel = $entryModels[$key] ?? null;
                        if (!empty($currentModel)) {
                            $currentModel->satusehat_id = $result->response->resourceID ?? null;
                            $currentModel->save();
                        }
                    }
                } else {
                    // $log_data->status = -1;
                    // $create_log = (new \App\Http\Controllers\ThirdParty\SatuSehat\Log\CreateController)->encounterCondition($log_data, $param);
                }

                return $response;
            } catch (\Exception $e) {
                return $e;
            }
        }
    }
}
