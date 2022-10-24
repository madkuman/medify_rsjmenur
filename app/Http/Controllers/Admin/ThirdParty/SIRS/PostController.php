<?php

namespace App\Http\Controllers\Admin\ThirdParty\SIRS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function savePekerjaan(Request $request)
    {
		DB::connection('patients')->beginTransaction();
        try {
            $pekerjaan = \App\Models\Pasien\JenisPekerjaan::find($request->id);
            $pekerjaan->sirs_pekerjaan_id = $request->sirs_pekerjaan_id;
            $pekerjaan->save();

            DB::connection('patients')->commit();
            $response = [
                'status' => 1,
                'message' => 'Berhasil Simpan Data Pekerjaan'
            ];
        } catch (\Exception $e) {
            DB::connection('patients')->rollback();
            app(\App\Http\Controllers\Error\Handler::class)->bugsnag($e);
            $response = [
                'status' => -1,
                'message' => 'Terjadi Kesalahan server',
                'data' => $e->getTrace(),
            ];
        }
        return back()->with($response);
    }

    public function saveStatusKeluar(Request $request)
    {
        DB::connection('mysql')->beginTransaction();
        try {
            $statuskeluar = \App\Models\Hospital\MasterCaraPulang::find($request->id);
            $statuskeluar->sirs_status_keluar_id = $request->sirs_status_keluar_id;
            $statuskeluar->save();

            DB::connection('mysql')->commit();
            $response = [
                'status' => 1,
                'message' => 'Berhasil Simpan Data Status Keluar'
            ];
        } catch (\Exception $e) {
            DB::connection('mysql')->rollback();
            app(\App\Http\Controllers\Error\Handler::class)->bugsnag($e);
            $response = [
                'status' => -1,
                'message' => 'Terjadi Kesalahan server',
                'data' => $e->getTrace(),
            ];
        }
        return back()->with($response);
    }

    public function runSyncMasterData(Request $request)
    {
        $api = app(\App\Http\Controllers\ThirdParty\SIRS\API\ReadController::class)->getAPIBySlug($request->slug);
        $this->checkToAbort($api);

        $data_name = str_replace('-', ' ', $api->slug);
        $data_name = ucfirst($data_name);
        DB::connection($api->connection)->beginTransaction();
        try {
            $sirs_data = app(\App\Http\Controllers\ThirdParty\SIRS\API\ReadController::class)->getAPIData($request->slug, 1, 10000);
            $kolom_comparing = json_decode($api->kolom_comparing, true);
            if (in_array($api->tabel, ['alamat_kecamatan', 'alamat_kota'])) {
                \Schema::connection($api->connection)->table($api->tabel, function (\Illuminate\Database\Schema\Blueprint $table) use ($api, &$kolom_comparing) {
                    if (!\Schema::hasColumns($api->tabel, $kolom_comparing)) {
                        $kolom_comparing['nama'] = 'name';
                    }
                });
            }

            $data_insert = [];
            if ($sirs_data->isNotEmpty()) {
                if (!empty($api->kolom_values)) {
                    $check_exist_row = \DB::connection($api->connection)->table($api->tabel)->count();
                    $data_update = [];
                    $kolom_update = json_decode($api->kolom_values, true);
                    foreach ($kolom_update as $sirs_key => $kolom_key) {
                        $reset_exist = \DB::connection($api->connection)->table($api->tabel)->whereNotNull($kolom_key)->update([$kolom_key => null]);
                    }
                    foreach ($sirs_data as $item) {
                        foreach ($kolom_update as $sirs_key => $kolom_key) {
                            $data_update[$kolom_key] = $item[$sirs_key] ?? null;
                        }

                        if ($check_exist_row == 0) {
                            $data_update = array_filter($data_update);
                            if (!empty($data_update)) {
                                $data_insert[] = $data_update;
                            }
                        } else {
                            $row = \DB::connection($api->connection)->table($api->tabel);
                            foreach ($kolom_comparing as $sirs_key => $tabel_key) {
                                $row = $row->whereRaw('LOWER(`'.$tabel_key.'`) = ? ', [$item[$sirs_key]]);
                            }
                            $result_row = $row->update($data_update);
                        }
                    }
                } else {
                    $check_exist_row = \DB::connection($api->connection)->table($api->tabel)->count();
                    $reset_exist = \DB::connection($api->connection)->table($api->tabel)->whereNotNull('sirs_id')->update(['sirs_id' => null]);
                    foreach ($sirs_data as $item) {
                        $data_update = $item;
                        $data_update['sirs_id'] = $item['id'] ?? null;
                        unset($data_update['id']);

                        if ($check_exist_row == 0) {
                            $data_update = array_filter($data_update);
                            if (!empty($data_update)) {
                                $data_insert[] = $data_update;
                            }
                        } else {
                            $row = \DB::connection($api->connection)->table($api->tabel);
                            foreach ($kolom_comparing as $sirs_key => $tabel_key) {
                                $row = $row->whereRaw('LOWER(`'.$tabel_key.'`) = ? ', [$item[$sirs_key]]);
                            }
                            $result_row = $row->update($data_update);
                        }
                    }
                }
            }

            if (!empty($data_insert)) {
                $insert_row = \DB::connection($api->connection)->table($api->tabel)->insert($data_insert);
            }

            DB::connection($api->connection)->commit();
            return response()->json([
                'status' => 1,
                'title' => 'Berhasil',
                'message' => 'Berhasil Simpan '.$data_name
            ]);
        } catch (\Exception $e) {
            DB::connection($api->connection)->rollback();
            app(\App\Http\Controllers\Error\Handler::class)->bugsnag($e);
            return response()->json([
                'status' => -1,
                'title' => 'Gagal',
                'message' => "Sinkronisasi data gagal disimpan",
            ]);
        }
    }
}
