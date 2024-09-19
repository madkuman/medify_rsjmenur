<?php

namespace App\Http\Controllers\ThirdParty\Whatsapp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function send(Request $request)
    {
        $token = "XExpVBnKQGzZ9A2UCErC";
        // $token = config('medify.third-party.whatsapp.token');
        $target = $request->input('target');
        $nama = $request->input('nama_pasien');
        // dd($token, $target, $nama);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $target,
                'message' => 'Halo Bpk/Ibu ' . $nama . ', kami menginfokan bahwa obat resep Anda sudah selesai diproses, selanjutnya Bpk/Ibu dapat mengambilnya di loket penyerahan. Salam kami dari Instalasi Farmasi RS Jiwa Menur Surabaya',
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token" //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        curl_close($curl);

        if (isset($error_msg)) {
            echo $error_msg;
        }

        // $response = json_decode($response, true);

        return $response;
    }
}
