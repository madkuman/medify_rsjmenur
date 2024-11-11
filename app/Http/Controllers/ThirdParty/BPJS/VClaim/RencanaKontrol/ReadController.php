<?php

namespace App\Http\Controllers\ThirdParty\BPJS\VClaim\RencanaKontrol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ReadController extends Controller
{
    public function rencanaKontrolBySep($no_sep)
    {
        $header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();
        try {
            $timestamp = $header_array['X-timestamp'];
            $client = new Client(['headers' => $header_array]);
            $res = $client->request('GET', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl() . '/RencanaKontrol/nosep/' . $no_sep);

            $resp =  $res->getBody()->getContents();

            if (config('app.bpjs_decrypt', false)) {
                $resp_decoded = json_decode($resp);
                $resp_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $resp_decoded->response));
                return (json_encode($resp_decoded));
            } else {
                return $resp;
            }
        } catch (\Exception $e) {
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (GuzzleException $e) {
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        }
    }

    public function rencanaKontrolByNoSk($no_sk)
    {
        $header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();
        try {
            $client = new Client(['headers' => $header_array]);
            $res = $client->request('GET', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl() . '/RencanaKontrol/noSuratKontrol/' . $no_sk);
            $response = $res->getBody()->getContents();
            if (config('app.bpjs_decrypt', false)) {
                $timestamp = $header_array['X-timestamp'];
                $redecode = json_decode($response);
                $redecode->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $redecode->response));
                return (json_encode($redecode));
            }
            return $response;
        } catch (\Exception $e) {
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (GuzzleException $e) {
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        }
    }

    public function getDataNoSK($tgl_awal, $tgl_akhir, $format_filter)
    {
        $header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();
        try {
            $client = new Client(['headers' => $header_array]);
            $res = $client->request('GET', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl() . '/RencanaKontrol/ListRencanaKontrol/tglAwal/' . $tgl_awal . '/tglAkhir/' . $tgl_akhir . '/filter/' . $format_filter);
            $response = $res->getBody()->getContents();
            if (config('app.bpjs_decrypt', false)) {
                $timestamp = $header_array['X-timestamp'];
                $redecode = json_decode($response);
                $redecode->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $redecode->response));
                return (json_encode($redecode));
            }
            return $response;
        } catch (\Exception $e) {
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (GuzzleException $e) {
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        }
    }

    public function getPoliRencanaKontrol($jenis_kontrol, $nomor, $tgl)
    {
        $header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();
        try {
            $timestamp = $header_array['X-timestamp'];

            $client = new Client(['headers' => $header_array]);
            $res = $client->request('GET', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl() . '/RencanaKontrol/ListSpesialistik/JnsKontrol/' . $jenis_kontrol . '/nomor/' . $nomor . '/TglRencanaKontrol/' . $tgl);

            $resp =  $res->getBody()->getContents();

            if (config('app.bpjs_decrypt', false)) {
                $resp_decoded = json_decode($resp);
                $resp_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $resp_decoded->response));
                return (json_encode($resp_decoded));
            } else {
                return $resp;
            }
        } catch (\Exception $e) {

            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (GuzzleException $e) {
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        }
    }

    public function getDokterRencanaKontrol($jenis_kontrol, $kode_poli, $tgl)
    {
        $header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();
        try {
            $timestamp = $header_array['X-timestamp'];
            $client = new Client(['headers' => $header_array]);
            $res = $client->request('GET', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl() . '/RencanaKontrol/JadwalPraktekDokter/JnsKontrol/' . $jenis_kontrol . '/KdPoli/' . $kode_poli . '/TglRencanaKontrol/' . $tgl);

            $dokter = ($res->getBody()->getContents());

            if (config('app.bpjs_decrypt', false)) {
                $dokter_decoded = json_decode($dokter);
                $dokter_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $dokter_decoded->response));
                return (json_encode($dokter_decoded));
            } else {
                return $dokter;
            }

            return $res->getBody()->getContents();
        } catch (\Exception $e) {

            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (GuzzleException $e) {
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        }
    }

    public function getDataNoKartu($bulan, $tahun, $noKartu, $format_filter)
    {
        $header_array = app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getHeader();

        try {
            $client = new Client(['headers' => $header_array]);
            $res = $client->request('GET', app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->getUrl() . '/RencanaKontrol/ListRencanaKontrol/Bulan/' . $bulan . '/Tahun/' . $tahun . '/Nokartu/' . $noKartu . '/filter/' . $format_filter);
            $response = $res->getBody()->getContents();
            if (config('app.bpjs_decrypt', false)) {
                $timestamp = $header_array['X-timestamp'];
                $redecode = json_decode($response);
                $redecode->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $redecode->response));
                // dd($redecode);
                return (json_encode($redecode));
            }
            return $response;
        } catch (\Exception $e) {
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        } catch (GuzzleException $e) {
            return json_encode([
                "metaData" => [
                    "code" => "500",
                    "message" => "Tidak dapat menghubungkan dengan server BPJS, coba lagi. Apabila tetap muncul pesan ini, sementara gunakan aplikasi VClaim. Apabila VClaim tidak dapat dibuka, hubungi petugas BPJS yang ada."
                ],
                "response" => []
            ]);
        }
    }
}
