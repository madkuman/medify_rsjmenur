<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PostController extends Controller
{
    protected $request;

    public function __construct()
    {
        $this->request = (new \App\Http\Controllers\ThirdParty\SatuSehat\RequestController());
    }

    public function getByNIK(Request $request)
    {
        $nik = $request->nik;
        $pasien = $request->pasien;
        
        if (empty($pasien)) {
            $pasien = app(\App\Http\Controllers\Pasien\Pasien\ReadController::class)->getSingleByNik($nik);
            if (empty($pasien)) return null;
        }

        $params = new Request([
            'identifier'=> "https://fhir.kemkes.go.id/id/nik|" . $nik,
            // 'name'      => "'".$pasien->name."'",
            // 'birthdate' => $pasien->date_of_birth,
            // 'gender'    => $pasien->gender == 1 ? 'male' : 'female',
        ]);
        
        try {
            $url = $this->request->getBaseUrl() . '/Patient';
            $send = $this->request->send('GET', $url, \GuzzleHttp\RequestOptions::QUERY, $params->all());
            $send = json_decode($send);

            if ($send->code == 200) {
                $response = $send->response;
                if (empty($response->entry)) return null;

                $resource_data = $response->entry[0]->resource ?? [];
                $patient_data = app(\App\Http\Controllers\ThirdParty\SatuSehat\Patient\CreateController::class)->save($pasien, $resource_data);
                return $patient_data;
            }
            
            return null;
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return null;
        }
    }
}
