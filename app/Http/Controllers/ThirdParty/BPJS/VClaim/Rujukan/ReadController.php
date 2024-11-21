<?php

namespace App\Http\Controllers\ThirdParty\BPJS\VClaim\Rujukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ThirdParty\BPJS\RequestController;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ReadController extends Controller
{
    public function __construct()
    {
        $this->requestController = new RequestController();
    }

    public function searchByNomorKartuRS($multi, $nomor_kartu)
    {
        $header_array = $this->requestController->getHeader();

        if ($multi)
            $url = $this->requestController->getUrl() . '/Rujukan/RS/List/Peserta/' . $nomor_kartu;
        else
            $url = $this->requestController->getUrl() . '/Rujukan/RS/Peserta/' . $nomor_kartu;

        try {
            $timestamp = $header_array['X-timestamp'];
            $client = new Client(['headers' => $header_array]);
            $res = $client->request('GET', $url);
            $rujukan = $res->getBody()->getContents();

            if (config('app.bpjs_decrypt', false)) {
                $rujukan_decoded = json_decode($rujukan);
                $rujukan_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $rujukan_decoded->response));
                return (json_encode($rujukan_decoded));
            } else {
                return $rujukan;
            }
        } catch (\Exception $e) {
            return json_encode([
                "error" => $e,
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (GuzzleException $e) {
            return json_encode([
                "error" => $e,
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        }
    }

    public function searchByNomorKartuPKM($multi, $nomor_kartu)
    {
        $header_array = $this->requestController->getHeader();

        if ($multi)
            $url = $this->requestController->getUrl() . '/Rujukan/List/Peserta/' . $nomor_kartu;
        else
            $url = $this->requestController->getUrl() . '/Rujukan/Peserta/' . $nomor_kartu;
        try {
            $timestamp = $header_array['X-timestamp'];
            $client = new Client(['headers' => $header_array]);
            $res = $client->request('GET', $url);
            $rujukan = $res->getBody()->getContents();

            if (config('app.bpjs_decrypt', false)) {
                $rujukan_decoded = json_decode($rujukan);
                $rujukan_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $rujukan_decoded->response));
                return (json_encode($rujukan_decoded));
            } else {
                return $rujukan;
            }
        } catch (\Exception $e) {
            return json_encode([
                "error" => $e,
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (GuzzleException $e) {
            return json_encode([
                "error" => $e,
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        }
    }

    public function searchByNomorKartuAll($multi, $nomor_kartu)
    {
        $rujukRS = json_decode($this->searchByNomorKartuRS($multi, $nomor_kartu));
        $rujukPKM = json_decode($this->searchByNomorKartuPKM($multi, $nomor_kartu));
        $rujuk_res = [];
        $status = 200;
        // dd($rujukRS, $rujukPKM);

        if ($rujukRS->metaData->code == 200) {
            if ($multi) {
                // foreach ($rujukRS->response->rujukan as $rujuk) {
                foreach (($rujukRS->response->rujukan ?? []) as $rujuk) {
                    $rujuk->tipe_perujuk = 2;
                    array_push($rujuk_res, $rujuk);
                }
            } else {
                $rujukRS->response->rujukan->tipe_perujuk = 2;
                array_push($rujuk_res, $rujukRS->response->rujukan);
            }
        } else if ($rujukRS->metaData->code != 201) {
            $status = $rujukPKM->metaData->code;
        }
        if ($rujukPKM->metaData->code == 200) {
            if ($multi) {
                foreach (($rujukPKM->response->rujukan ?? []) as $rujuk) {
                    $rujuk->tipe_perujuk = 1;
                    array_push($rujuk_res, $rujuk);
                }
            } else {
                $rujukPKM->response->rujukan->tipe_perujuk = 1;
                array_push($rujuk_res, $rujukPKM->response->rujukan);
            }
            $status = 200;
        } else if ($rujukPKM->metaData->code != 201) {
            if ($status != 200) {
                return json_encode([
                    "metaData" => [
                        "code" => "500",
                        "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                    ],
                    "response" => [
                        "rujukan" => []
                    ]
                ]);
            }
        }

        $res = [];
        if (empty($rujuk_res)) {
            $res["metaData"] = [
                "code" => "200",
                "message" => "Rujukan tidak ditemukan."
            ];
            $res['response']['rujukan'] = [];
        } else {
            $res["metaData"] = [
                "code" => "200",
                "message" => "Rujukan ditemukan."
            ];
            $res['response']['rujukan'] = $rujuk_res;
        }

        return json_encode($res);
    }

    //search puskesmas
    public function searchPKM($param)
    {
        $header_array = $this->requestController->getHeader();
        try {
            $url = $this->requestController->getUrl() . '/Rujukan/' . $param;
            $timestamp = $header_array['X-timestamp'];

            $client = new Client(['headers' => $header_array]);
            $res = $client->request('GET', $url);
            $rujukan = $res->getBody()->getContents();

            if (config('app.bpjs_decrypt', false)) {
                $rujukan_decoded = json_decode($rujukan);
                $rujukan_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $rujukan_decoded->response));
                return (json_encode($rujukan_decoded));
            } else {
                return $rujukan;
            }
        } catch (\Exception $e) {

            return json_encode([
                "error" => $e,
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (GuzzleException $e) {
            return json_encode([
                "error" => $e,
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        }
    }

    //search rujukan rs
    public function searchRS($param)
    {
        $header_array = $this->requestController->getHeader();
        $url = $this->requestController->getUrl() . '/Rujukan/RS/' . $param;
        try {
            $timestamp = $header_array['X-timestamp'];
            $client = new Client(['headers' => $header_array]);
            $res = $client->request('GET', $url);
            $rujukan = $res->getBody()->getContents();

            if (config('app.bpjs_decrypt', false)) {
                $rujukan_decoded = json_decode($rujukan);
                $rujukan_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $rujukan_decoded->response));
                return (json_encode($rujukan_decoded));
            } else {
                return $rujukan;
            }
        } catch (\Exception $e) {

            return json_encode([
                "error" => $e,
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (GuzzleException $e) {
            return json_encode([
                "error" => $e,
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        }
    }

    public function searchAll($param)
    {
        $rujukRS = json_decode($this->searchRS($param));
        $rujukPKM = json_decode($this->searchPKM($param));
        // dd($rujukRS, $rujukPKM);
        if ($rujukRS->response != null && !empty($rujukRS->response->rujukan ?? null)) {
            $rujukRS->response->rujukan->tipe_perujuk = 2;
            return json_encode($rujukRS->response->rujukan);
        }
        if ($rujukPKM->response != null) {
            $rujukPKM->response->rujukan->tipe_perujuk = 1;
            return json_encode($rujukPKM->response->rujukan);
        }
        return null;
    }

    public function GetListSpesialistikRujukan($ppk, $tanggal)
    {
        $header_array = $this->requestController->getHeader();
        $url = $this->requestController->getUrl() . "/Rujukan/ListSpesialistik/PPKRujukan/$ppk/TglRujukan/$tanggal";
        try {
            $timestamp = $header_array['X-timestamp'];
            $client = new Client(['headers' => $header_array]);
            $res = $client->request('GET', $url);
            $rujukan = $res->getBody()->getContents();

            if (config('app.bpjs_decrypt', false)) {
                $rujukan_decoded = json_decode($rujukan);
                $rujukan_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $rujukan_decoded->response));
                return (json_encode($rujukan_decoded));
            } else {
                return $rujukan;
            }
        } catch (\Exception $e) {

            return json_encode([
                "error" => $e,
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (GuzzleException $e) {
            return json_encode([
                "error" => $e,
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        }
    }
}
