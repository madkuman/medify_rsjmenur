<?php

namespace App\Http\Controllers\BPJS\API\RencanaKontrol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function create(Request $request)
    {
        $data = [
            'tgl_rk' => $request->tgl_rencana_kontrol,
            'pasien_id' => $request->pasien_id,
            'kasus_id' => $request->kasus_id,
            'no_sep' => $request->no_sep,
            'kode_poli' => $request->kode_poli ?? $request->poli_kontrol,
            'nama_poli' => $request->nama_poli,
            'jenis_kontrol' => $request->jenis_kontrol,
            'kode_dokter' => $request->kode_dokter,
            'user' => $request->user,
            'user_id' => $request->user_id,
        ];
        $code_response = 200;

        if (config('app.bpjs_enable', false)) {
            // jika pilihan melalui input sep
            // cek sep di bpjs. sama tidak dengan yang diinput 
            // if (isset($request->input_type) && $request->input_type == 2) {
            //     $bpjs_sep = app('App\Http\Controllers\BPJS\API\RencanaKontrol\ReadController')->rencanaKontrolBySep($request->no_sep);
            //     $bpjs_sep = json_decode($bpjs_sep);
            //     if ($bpjs_sep->metaData->code != 200) {
            //         $res['result'] = $bpjs_sep;

            //         return response()->json($res, $bpjs_sep->metaData->code);
            //     }
            // } 

            $response =  app('App\Http\Controllers\BPJS\API\RencanaKontrol\CreateController')->create($data);
            $resp = json_decode($response);
            if ($resp->metaData->code == 200) {
                app(\App\Http\Controllers\BPJS\RencanaKontrol\CreateController::class)->create($data, $resp->response);

                $res['result'] = $resp;
                return response()->json($res, $resp->metaData->code);
            }


            $res['result'] = $resp;
            $status_code = $resp->metaData->code;
        } else {
            $resp = [
                'metaData' => [
                    'message' =>  'Rencana kontrol (Tidak terkoneksi BPJS)',
                    'code' => 404
                ]
            ];
            $res['result'] = $resp;
        }
        if ($status_code > 200 && $status_code <= 300) {
            $code_response = 201;
        }
        // dd($res);
        return response()->json($res, $code_response);
    }

    public function update(Request $request)
    {
        $data = [
            'no_sk' => $request->no_sk,
            'no_sep' => $request->no_sep,
            'tgl_rk' => $request->tgl_rencana_kontrol,
            'no_sep' => $request->no_sep,
            'kode_poli' => $request->poli_kontrol,
            'nama_poli' => $request->nama_poli,
            'kode_dokter' => $request->kode_dokter,
            'jenis_kontrol' => $request->jenis_kontrol,
            'user' => $request->user,
        ];
        if (config('app.bpjs_enable', false)) {

            $response =  app('App\Http\Controllers\BPJS\API\RencanaKontrol\EditController')->edit($data);

            $resp = json_decode($response);
            if ($resp->metaData->code == 200) {
                app('App\Http\Controllers\BPJS\RencanaKontrol\EditController')->edit($data, $resp->response);

                $res['result'] = $resp;
                return response()->json($res, $resp->metaData->code);
            }

            $res['result'] = $resp;
        } else {
            $resp = [
                'metaData' => [
                    'message' =>  'Rencana kontrol (Tidak terkoneksi BPJS)',
                    'code' => 404
                ]
            ];
            $res['result'] = $resp;
        }

        return response()->json($res, $resp->metaData->code);
    }

    public function delete(Request $request)
    {
        $no_sk = $request->no_sk;
        $user = $request->user;

        $data = [
            'no_sk' => $no_sk,
            'user' => $user,
            'user_id' => $request->user_id,
        ];

        if (config('app.bpjs_enable', false)) {
            $response = app('App\Http\Controllers\BPJS\API\RencanaKontrol\DeleteController')->delete($data);
            $resp = json_decode($response);

            if ($resp->metaData->code == 200) {
                app('App\Http\Controllers\BPJS\RencanaKontrol\DeleteController')->delete($data);
            }
        } else {
            $response = response()->json([
                'metaData' => [
                    'message' =>  'Rencana kontrol (Tidak terkoneksi BPJS)',
                    'code' => 404
                ]
            ]);
        }

        return $response;
    }

    public function getSkdpSirp(Request $request)
    {
        try {
            #jenis 1 = rawat inap, 2 rawat jalan
            $rencana_kontrol = app(\App\Http\Controllers\BPJS\API\RencanaKontrol\ReadController::class)->geetDataRencanaKontrol($request);
            $response = [
                'rencana_kontrol' => $rencana_kontrol
            ];
            return $this->resSuccessJsonWeb('Berhasil', 0, $response);
        } catch (\Throwable $th) {
            return $this->bugsnagJson($th);
        }
    }
}
