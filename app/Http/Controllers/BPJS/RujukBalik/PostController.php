<?php

namespace App\Http\Controllers\BPJS\RujukBalik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function create(Request $request)
    {
        try {
            DB::connection('thirdp')->beginTransaction();

            $message = "";
            $sep = app(\App\Http\Controllers\BPJS\SEP\ReadController::class)->singleByNoSEP($request->no_sep);
            if (!isset($sep)) $message = "Nomor SEP tidak ditemukan";
            elseif ($sep->kasus->count() == 0) $message = "SEP yang dipilih belum memiliki Kasus";
            elseif (!isset($sep->kasus->first()->dpjp)) $message = "SEP yang dipilih belum miliki DPJP";
            elseif (!isset($sep->kasus->first()->dpjp->user->dokter)) $message = "DPJP belum disambungkan dengan Dokter";
            elseif (!isset($sep->kasus->first()->dpjp->user->dokter->bpjs_kode_dpjp) || 
                    $sep->kasus->first()->dpjp->user->dokter->bpjs_kode_dpjp == '') $message = "DPJP belum memiliki kode BPJS";
            if ($message != "") {
                DB::connection('thirdp')->rollback();
                return response()->json([
                    'metaData' => [
                        'code' => 201,
                        'message' => $message,
                    ],
                ]);
            }
            $dokter_dpjp = $sep->kasus->first()->dpjp->user->dokter;
            $param = [
                'pasien_id' => $sep->kasus->first()->pasien->id,
                "no_sep" => $sep->no_sep,
                "no_kartu" => $sep->no_bpjs,
                'no_surat_rujuk_balik' => '',
                "alamat_peserta" => $sep->kasus->first()->pasien->alamat_detail ?? '',
                'nama_peserta' => $sep->kasus->first()->pasien->name,
                "email_peserta" => "", #TODO : email opo iki anjir
                "kode_program_prb" => $request->kode_program_prb,
                "program_prb" => $request->program_prb,
                "kode_dpjp" => $dokter_dpjp->bpjs_kode_dpjp,
                "dpjp" => $dokter_dpjp->name,
                "keterangan" => $request->keterangan,
                "saran" => $request->keterangan,
                "user" => auth()->id() ?? '-',
                "obat" => $request->obat,
                'plain_response' => null,
            ];

            $rujuk_balik = app(\App\Http\Controllers\BPJS\RujukBalik\CreateController::class)->create($param);

            if (config('app.bpjs_enable', false)) {
                $obat = [];
                foreach ($rujuk_balik->detail as $item) {
                    $item = (object) $item;
                    $obat[] = [
                        'kdObat' => $item->kode_obat ?? '',
                        'signa1' => $item->signa1,
                        'signa2' => $item->signa2,
                        'jmlObat' => $item->jumlah,
                    ];
                }
                $param_api['request']['t_prb'] = [
                    "noSep" => $rujuk_balik->no_sep,
                    "noKartu" => $rujuk_balik->no_kartu,
                    "alamat" => $rujuk_balik->alamat_peserta,
                    "email" => "test-email@gmail.com",
                    "programPRB" => $rujuk_balik->kode_program_prb,
                    "kodeDPJP" => $rujuk_balik->kode_dpjp,
                    "keterangan" => $rujuk_balik->keterangan,
                    "saran" => $rujuk_balik->keterangan,
                    "user" => auth()->id() ?? '-',
                    "obat" => $obat,
                ];
                $content = app(\App\Http\Controllers\BPJS\API\RujukBalik\CreateController::class)->create($param_api);
                $content_data = json_decode($content);
                if ($content_data->metaData->code == 200) {
                    $rujuk_balik->status_vclaim = 1;
                    $rujuk_balik->save();

                    app(\App\Http\Controllers\BPJS\RujukBalik\EditController::class)->updateFromVclaim($rujuk_balik->id, $content_data->response);
                    DB::connection('thirdp')->commit();
                } else {
                    DB::connection('thirdp')->rollback();
                }
                
                return $content;
            }

            return response()->json([
                'metaData' => [
                    'code' => 200,
                    'message' => "Berhasil",
                ],
            ]);
        } catch (\Exception $e) {
            app(\App\Http\Controllers\Error\Handler::class)->bugsnag($e);

            return response()->json([
                'metaData' => [
                    'code' => 500,
                    'message' => "Terjadi Kesalahan Server",
                ],
            ]);
        }
    }

    public function kirimVclaim(Request $request)
    {
        if (!config('app.bpjs_enable', false)) {
            return response()->json([
                'metaData' => [
                    'code' => 201,
                    'message' => 'Fitur BPJS tidak aktif',
                ],
            ]);
        }
        #validasi
        $rujuk_balik = app(\App\Http\Controllers\BPJS\RujukBalik\ReadController::class)->single($request->id, 'detail');

        if ($rujuk_balik->status_vclaim != 0) {
            return response()->json([
                'metaData' => [
                    'code' => 201,
                    'message' => $rujuk_balik->status_vclaim == 1 ? 'Status Vclaim sudah selesai' : 'Terdapat proses sama yang sedang berjalan / Jika lebih dari 10 menit silahkan hubungi admin',
                ],
            ]);
        }
        $rujuk_balik->status_vclaim = -1; #status pending
        $rujuk_balik->save();

        $obat = [];
        foreach ($rujuk_balik->detail as $item) {
            $item = (object) $item;
            $obat[] = [
                'kdObat' => $item->kode_obat ?? '',
                'signa1' => $item->signa1,
                'signa2' => $item->signa2,
                'jmlObat' => $item->jumlah,
            ];
        }

        $param['request'] = [
            "noSep" => $rujuk_balik->no_sep,
            "noKartu" => $rujuk_balik->no_kartu,
            "alamat" => $rujuk_balik->alamat_peserta,
            "email" => $rujuk_balik->email_peserta,
            "programPRB" => $rujuk_balik->kode_program_prb,
            "kodeDPJP" => $rujuk_balik->kode_dpjp,
            "keterangan" => $rujuk_balik->keterangan,
            "saran" => $rujuk_balik->keterangan,
            "user" => auth()->id() ?? '-',
            "obat" => $obat,
        ];
        $content = app(\App\Http\Controllers\BPJS\API\RujukBalik\CreateController::class)->create($param);

        $content_data = json_decode($content);
        if ($content_data->metaData->code == 200) {
            $rujuk_balik->status_vclaim = 1;

            app(\App\Http\Controllers\BPJS\RujukBalik\EditController::class)->updateFromVclaim($rujuk_balik->id, $content_data->response);
        } else {
            $rujuk_balik->status_vclaim = 0;
        }
        $rujuk_balik->save();

        return $content;
    }

    public function delete(Request $request)
    {
        if (config('app.bpjs_enable', false)) {
            /**
             * $request->id bisa berupa integer / string (srb-1010210)
             * jika integer ambil no_surat dari db
             * jika string berarti request->id tersebut sudah no_surat
             */
            if (strpos('srb-', $request->id) !== false) {
                $rujuk_balik = app(\App\Http\Controllers\BPJS\RujukBalik\ReadController::class)->single($request->id, 'detail');
                $noSrb = $rujuk_balik->no_surat_rujuk_balik;
            } else {
                $noSrb = substr($request->id, 4, strlen($request->id));
            }

            $param['request']['t_prb'] = [
                "noSrb" => $noSrb,
                "user" => auth()->id() ?? '-',
            ];
            $content = app(\App\Http\Controllers\BPJS\API\RujukBalik\DeleteController::class)->delete($param);
            $content_data = json_decode($content);
            if ($content_data->metaData->code == 200 && isset($rujuk_balik)) {
                app(\App\Http\Controllers\BPJS\RujukBalik\DeleteController::class)->delete($rujuk_balik->id);
            }
            return $content;
        } else {
            app(\App\Http\Controllers\BPJS\RujukBalik\DeleteController::class)->delete($request->id);
            return response()->json([
                'metaData' => [
                    'code' => 200,
                    'message' => 'success',
                ],
            ]);
        }
    }

    public function edit(Request $request)
    {
        if (config('app.bpjs_enable', false)) {
            DB::connection('thirdp')->beginTransaction();

            $rujuk_balik = app(\App\Http\Controllers\BPJS\RujukBalik\EditController::class)->edit($request->id, $request->toArray());
            $rujuk_balik->load('detail');
            $obat = [];
            foreach ($rujuk_balik->detail as $item) {
                $item = (object) $item;
                $obat[] = [
                    'kdObat' => $item->kode_obat ?? '',
                    'signa1' => $item->signa1,
                    'signa2' => $item->signa2,
                    'jmlObat' => $item->jumlah,
                ];
            }
            $param['request']['t_prb'] = [
                "noSrb" => $rujuk_balik->no_surat_rujuk_balik,
                "noSep" => $rujuk_balik->no_sep,
                'alamat' => $rujuk_balik->alamat_peserta,
                'email' => $rujuk_balik->email_peserta,
                'kodeDPJP' => $rujuk_balik->kode_dpjp,
                'keterangan' => $rujuk_balik->keterangan,
                'saran' => $rujuk_balik->saran,
                'obat' => $obat,
                'user' => auth()->user()->id
            ];
            $content = app(\App\Http\Controllers\BPJS\API\RujukBalik\EditController::class)->edit($param);

            $content_data = json_decode($content);
            if ($content_data->metaData->code != 200) {
                DB::connection('thirdp')->rollback();
            } else {
                $rujuk_balik->status_vclaim = 1;
                $rujuk_balik->save();
            }

            DB::connection('thirdp')->commit();
            return $content;
        } else {
            $rujuk_balik = app(\App\Http\Controllers\BPJS\RujukBalik\EditController::class)->edit($request->id, $request);
            return response()->json([
                'metaData' => [
                    'code' => 200,
                    'message' => 'success',
                ],
            ]);
        }
    }
}
