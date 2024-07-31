<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\BundleRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdPartySatuSehat\Encounter;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use stdClass;

class PostController extends Controller
{
    protected $request;

    public function __construct()
    {
        $this->request = (new \App\Http\Controllers\ThirdParty\SatuSehat\RequestController());
    }

    /**
     * param
     *      $request->kasus_id
     *      $request->entry_id : by id of type (optional)
     *      $request->entry_type : by slug of type
     */
    public function generate(Request $request)
    {
        $log_data = new stdClass;
        
        try {
            # SET ENTRY DATA BY CATEGORY
            $entryData = [];
            $kasusId = $request->kasus_id ?? 0;
            $entryId = $request->entry_id;
            $entryType = $request->entry_type;
            $entryModels = [];
            $kasus = (new \App\Http\Controllers\Kasus\Kasus\ReadController)->getFind($kasusId, ['diagnosis']);
    
            # BUNDLE 1 : Encounter & Condition
            # Reff : https://medify.postman.co/workspace/Medify~0e5b03b6-9a7e-4f09-8f1e-83f122f0adf7/request/6068267-6017f7ed-beb4-48fd-bb12-9f8b5795fa65?ctx=documentation
            if ($entryType == 'encounter-condition') {
                # ENCOUNTER
                $log_data->encounter_id = $entryId;
                $log_data->kasus_id = $kasusId;

                # HARUS SUDAH CREATE ENCOUNTER
                $encounter = (new \App\Http\Controllers\ThirdParty\SatuSehat\Encounter\ReadController)->getById($entryId);
                $entryDataBundle = $encounter->bundle_entry;
                
                # HANDLE FAILED BRIDGE
                if ($entryDataBundle instanceof JsonResponse) {
                    $log_data->status = -1;
                    $create_log = (new \App\Http\Controllers\ThirdParty\SatuSehat\Log\CreateController)->encounterCondition($log_data);
                    return $entryDataBundle;
                };
                
                $entryModels[] = $encounter;
                $entryData[] = $entryDataBundle;
                if ($kasus->diagnosis->isNotEmpty()) {
                    foreach ($kasus->diagnosis as $diagnosis) {
                        # HARUS SUDAH CREATE CONDITION, DI BUNDLE SUDAH AUTO CREATE KETIKA SET PARAM DIAGNOSIS ENCOUNTER
                        if (!empty($diagnosis->satusehat_condition)) {
                            if (empty($diagnosis->icd10)) continue;

                            $condition = $diagnosis->satusehat_condition;
                            $entryDataBundle = $condition->bundle_entry;

                            if (empty($entryDataBundle)) continue;
                            if ($entryDataBundle instanceof JsonResponse) {
                                $log_error = (new \App\Http\Controllers\ThirdParty\SatuSehat\Log\CreateController)->error('/Condition', null, json_decode($entryDataBundle->getContent()));
                                return $entryDataBundle;
                            };
                            
                            $entryModels[] = $condition;
                            $entryData[] = $condition->bundle_entry;
                        }
                    }
                }
            }

            $param = [];
            $param['resourceType'] = "Bundle";
            $param['type'] = "transaction";
            $param['entry'] = $entryData;
            // dd($entryData);
            $url = $this->request->getBaseUrl();
            $send = $this->request->send('POST', $url, \GuzzleHttp\RequestOptions::JSON, $param);
            $send = json_decode($send);
            // dd($send, $param);
            foreach ($entryModels as $model) {
                $model->request_param = json_encode($param);
                $model->status = $send->code == 200 ? 1 : -1;
                $model->save();
            }

            if ($send->code == 200) {
                $entryResult = $send->response->entry ?? [];
                foreach ($entryResult as $key => $result) {
                    $currentModel = $entryModels[$key] ?? null;
                    if (!empty($currentModel)) {
                        $currentModel->satusehat_id = $result->response->resourceID ?? null;
                        $currentModel->save();
                    }
                }
            } else {
                $log_data->status = -1;
                $create_log = (new \App\Http\Controllers\ThirdParty\SatuSehat\Log\CreateController)->encounterCondition($log_data, $param);
            }

            return $send;
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
