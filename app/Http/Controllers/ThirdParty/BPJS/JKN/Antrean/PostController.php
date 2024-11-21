<?php

namespace App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean;

use App\Jobs\ThirdParty\BPJS\JKN\UpdateWaktuAntrean;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PostController extends Controller
{
    protected $request;
    public function __construct()
    {
        $this->request = app('App\Http\Controllers\ThirdParty\BPJS\JKN\RequestController');
    }

    public function updateWaktuAntrean(Request $params)
    {
        $arg = (object)[
            'url' => $this->request->getUrl() . '/antrean/updatewaktu',
            'header' => $this->request->getHeader(),
            'params' => $params,
        ];

        return app('App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean\EditController')
            ->updateWaktuAntrean($arg->url, $arg->header, $arg->params);

        //        UpdateWaktuAntrean::dispatch($arg)->delay(now()->addMinutes(5));
    }

    public function batal(Request $params)
    {
        try {
            $client = new Client(['headers' => $this->request->getHeader()]);
            $res = $client->request('POST', $this->request->getUrl() . '/antrean/batal', [
                'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                \GuzzleHttp\RequestOptions::JSON => $params->all(),
            ]);
            return $res->getBody()->getContents();
        } catch (\Exception $e) {
            return $this->failedResponse();
        } catch (GuzzleException $e) {
            return $this->failedResponse();
        }
    }

    private function failedResponse()
    {
        return json_encode([
            "metaData" => [
                "code" => "500",
                "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
            ],
            "response" => [],
        ]);
    }

    public function updateTaskId($data)
    {
        $request = new \Illuminate\Http\Request();

        $request->replace([
            'kodebooking' => $data['kodebooking'],
            'taskid' => $data['taskid'],
            'waktu' => $data['waktu'],
        ]);

        $returned = $this->updateWaktuAntrean($request);

        return $returned;
    }
}
