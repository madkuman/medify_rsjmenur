<?php


namespace App\Http\Controllers\ThirdParty\BPJS\JKN\Dashboard;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class ReadController extends Controller
{
    protected $request;
    public function __construct()
    {
        $this->request = app('App\Http\Controllers\ThirdParty\BPJS\JKN\RequestController');
    }

    public function getHarian($tanggal, $waktu)
    {
        $header_array = $this->request->getHeader();
        try {
            $client = new Client(['headers' => $header_array]);
            $res = $client->request('GET', $this->request->getUrl().'/dashboard/waktutunggu/tanggal/'.$tanggal.'/waktu/'.$waktu,
            [
                'headers' => ['Content-Type' => 'application/json'], 
                'Accept' => 'application/json',
                \GuzzleHttp\RequestOptions::JSON => [],
            ]);

            $content = $res->getBody()->getContents();

            return $content;

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return $this->failedResponse();
        } catch (GuzzleException $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return $this->failedResponse();
        }
    }

    public function bulanan($bulan, $tahun, $waktu)
    {
        try
        {
            $client = new Client(['headers' => $this->request->getHeader()]);
            $res = $client->request('GET', $this->request->getUrl()."/dashboard/waktutunggu/bulan/$bulan/tahun/$tahun/waktu/$waktu");
            return $res->getBody()->getContents();
        } catch (\Exception $e) {
            return $this->failedResponse();
        } catch (GuzzleException $e){
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
}