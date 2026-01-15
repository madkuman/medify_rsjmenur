<?php

namespace App\Http\Controllers\ThirdParty\SatuSehat\Practitioner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\User;
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
        $pegawai = $request->pegawai;
        $dokter = $request->dokter;
        
        if (empty($nik)) return null;
        
        if (empty($pegawai) && config('medify.third-party.satusehat.sumber_nik_user') == 'kepegawaian') {
            $pegawai = Pegawai::with('user:id,employee_id,dokter_id', 'user.dokter')->where('identity_card', $nik)->first();
            if (empty($pegawai->user->dokter ?? null)) return null;
        }
        
        if (empty($dokter) && config('medify.third-party.satusehat.sumber_nik_user') == 'kepegawaian') {
            $dokter = $pegawai->user->dokter;
        }
        else if (empty($dokter) && config('medify.third-party.satusehat.sumber_nik_user') == 'user') {
            $user = User::where('nik', $nik)->first();
            $dokter = $user->dokter;
        }

        $params = new Request([
            'identifier' => "https://fhir.kemkes.go.id/id/nik|".$nik,
        ]);

        try {
            $url = $this->request->getBaseUrl() . '/Practitioner';
            $send = $this->request->send('GET', $url, \GuzzleHttp\RequestOptions::QUERY, $params->all());
            $send = json_decode($send);

            if ($send->code == 200) {
                $response = $send->response;
                $resource_data = $response->entry[0]->resource;
                $dokter_data = app(\App\Http\Controllers\ThirdParty\SatuSehat\Practitioner\CreateController::class)->save($dokter, $resource_data);
                return $dokter_data;
            }

            return null;
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return null;
        }
    }
}
