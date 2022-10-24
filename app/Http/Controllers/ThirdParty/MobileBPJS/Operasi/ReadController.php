<?php

namespace App\Http\Controllers\ThirdParty\MobileBPJS\Operasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Validator;
use DB;

class ReadController extends Controller
{
    public function getJadwalOperasi(Request $request)
    {

        try {

            app('debugbar')->disable();
            $token = $request->header('x-token');
            $cek_token = app('App\Http\Controllers\ThirdParty\MobileBPJS\ReadController')->cekToken($token);
            /** cek token */
            if (empty($cek_token)) {
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->errorAuth();
            }
            /** end cek token */

            /** validator */
            $rules            =  [
                'tanggalawal'  => 'required|date_format:Y-m-d',
                'tanggalakhir' => 'required|date_format:Y-m-d|after_or_equal:' . $request->tanggalawal,
            ];
            $alert            =  [
                'required'       => ':attribute harus diisi',
                'date_format'    => ':attribute format harus :date_format',
                'after_or_equal' => ':attribute harus lebih dari ' . $request->tanggalawal,
            ];

            $validator = Validator::make($request->all(), $rules, $alert);
            if (!$validator->passes()) {
                $message = $validator->errors()->all();
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->error($message);
            }
            /** end validator */

            $tanggal_min = Carbon::parse($request->tanggalawal)->startOfDay();
            $tanggal_max = Carbon::parse($request->tanggalakhir)->endOfDay();
            // $jadwals = app('App\Http\Controllers\KamarOperasi\Transaksi\ReadController')->getListJadwalOperasiByDate($tanggal_min, $tanggal_max);
            $jadwals = app('App\Http\Controllers\KamarOperasi\Transaksi\ReadController')->getListJadwalOperasiBPJSByDate($tanggal_min, $tanggal_max);

            $response = [];
            foreach ($jadwals as $key => $jadwal) {
                // dd($jadwal->kasus->TransaksiIGD);
                // dd($jadwal);
                /** jika ruangan masih kosong continue */
                if (empty($jadwal->ruangan->name)) {
                    continue;
                }
                /** end ruangan masih kosong continue */

                $kode_poli = $jadwal->kasus->TransaksiRawatJalanLast->poliklinik->bpjs_id ?? "";
                $nama_poli = $jadwal->kasus->TransaksiRawatJalanLast->poliklinik->name ?? "";

                if (count($jadwal->kasus->TransaksiIGD) > 0) {
                    $kode_poli = 'IGD';
                    $nama_poli = 'INSTALASI GAWAT DARURAT';
                }

                $response[$key] = [
                    "kodebooking"    => $jadwal->id ?? "",
                    "tanggaloperasi" => Carbon::parse($jadwal->jadwal_operasi)->toDateString(),
                    "jenistindakan"  => (!empty($jadwal->icd9) ? $jadwal->icd9->long_desc : ''),
                    "kodepoli"       => $kode_poli,
                    "namapoli"       => $nama_poli,
                    "terlaksana"     => $jadwal->status == 1 ? 1 : 0,
                    "nopeserta"      => $jadwal->kasus->sep->no_bpjs ?? "",
                    "lastupdate"     => $jadwal->updated_at->timestamp
                ];
            }

            $log['jenis_request'] = 'post';
            $log['url']           = 'operasi/get-jadwal-harian';
            $log['param']         = json_encode($request->input());
            $log['response']      = json_encode($response);
            $log['created_by']    = $cek_token->created_by;
            app('App\Http\Controllers\ThirdParty\MobileBPJS\CreateController')->createLog($log);
            DB::connection('thirdp')->commit();

            return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                ->success(['list' => $response]);
        } catch (\Exception $e) {

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                ->error();
        }
    }

    public function getListKodeBooking(Request $request)
    {
        DB::connection('thirdp')->beginTransaction();
        try {
            app('debugbar')->disable();
            $token = $request->header('x-token');
            $cek_token = app('App\Http\Controllers\ThirdParty\MobileBPJS\ReadController')->cekToken($token);
            /** cek token */
            if (empty($cek_token)) {
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->errorAuth();
            }
            /** end cek token */

            /** validator */
            $rules            =  [
                'nopeserta' => 'required',
            ];
            $alert            =  [
                'required'       => ':attribute harus diisi',
            ];

            $validator = Validator::make($request->all(), $rules, $alert);
            if (!$validator->passes()) {
                $message = $validator->errors()->all();
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->error($message);
            }
            /** end validator */
            $pasien_bpjs = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->getNoAsuransi($request->nopeserta);

            if (empty($pasien_bpjs)) {
                $message = 'Pasien Tidak ditemukan';
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->error($message);
            }

            $list_booking_operasi = $pasien_bpjs->pasien->getListBookingOperasi
                ->where('status', 0);

            $response = [];
            if (!empty($list_booking_operasi)) {
                foreach ($list_booking_operasi as $key => $value) {
                    $lokasi = $value->kasus->lokasi_first->lokasi;
                    $kode = '-';
                    /**jika lokasinya adalah IGD */
                    if ($lokasi->lokasi_departemen_id === 1) {
                        $lokasi = $lokasi->nama ?? 'IGD';
                        $kode   = 'IGD';
                    } else {
                        $lokasi = $lokasi->poliklinik->name ?? '-';
                        $kode = $value->kasus->lokasi_first->lokasi->poliklinik->bpjs_id ?? "-";
                    }

                    $response[] = [
                        'kodebooking'    => $value->kode_booking ?? "-",
                        'tanggaloperasi' => !empty($value->jadwal_operasi) ? Carbon::parse($value->jadwal_operasi)->format('Y-m-d') : "",
                        'jenistindakan'  => $value->icd9->long_desc ?? '-',
                        'kodepoli'       => $kode,
                        'namapoli'       => $lokasi,
                        'terlaksana'     => $value->status,
                    ];
                }
            }

            $log['jenis_request'] = 'post';
            $log['url']              = 'operasi/get-jadwal-harian';
            $log['param']         = json_encode($request->input());
            $log['response']      = json_encode($response);
            $log['created_by']    = $cek_token->created_by;
            app('App\Http\Controllers\ThirdParty\MobileBPJS\CreateController')->createLog($log);
            DB::connection('thirdp')->commit();

            return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                ->success($response);
        } catch (\Exception $e) {
            DB::connection('thirdp')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                ->error();
        }
    }

    public function getJadwalOperasiRs(Request $request)
    {

        try {

            app('debugbar')->disable();
            $headers['username'] = $request->header('x-username');
			$headers['token'] = $request->header('x-token');
			$user_token = app('App\Http\Controllers\ThirdParty\MobileBPJS\ReadController')->cekUserToken($headers);
            
            /** cek token */
            if (empty($user_token)) {
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->errorAuth();
            }
            /** end cek token */

            /** validator */
            $rules            =  [
                'tanggalawal'  => 'required|date_format:Y-m-d',
                'tanggalakhir' => 'required|date_format:Y-m-d|after_or_equal:' . $request->tanggalawal,
            ];
            $alert            =  [
                'required'       => ':attribute harus diisi',
                'date_format'    => ':attribute format harus :date_format',
                'after_or_equal' => ':attribute harus lebih dari ' . $request->tanggalawal,
            ];

            $validator = Validator::make($request->all(), $rules, $alert);
            if (!$validator->passes()) {
                $message = $validator->errors()->all();
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->error($message);
            }
            /** end validator */

            $tanggal_min = Carbon::parse($request->tanggalawal)->startOfDay();
            $tanggal_max = Carbon::parse($request->tanggalakhir)->endOfDay();
            //$jadwals = app('App\Http\Controllers\KamarOperasi\Transaksi\ReadController')->getListJadwalOperasiBPJSByDate($tanggal_min, $tanggal_max);
            $jadwals = [];
            $response = [];
            foreach ($jadwals as $key => $jadwal) {

                /** jika ruangan masih kosong continue */
                if (empty($jadwal->ruangan->name)) {
                    continue;
                }
                /** end ruangan masih kosong continue */

                $kode_poli = $jadwal->kasus->TransaksiRawatJalanLast->poliklinik->bpjs_id ?? "";
                $nama_poli = $jadwal->kasus->TransaksiRawatJalanLast->poliklinik->name ?? "";

                if (count($jadwal->kasus->TransaksiIGD) > 0) {
                    $kode_poli = 'IGD';
                    $nama_poli = 'INSTALASI GAWAT DARURAT';
                }

                $response[$key] = [
                    "kodebooking"    => $jadwal->id ?? "",
                    "tanggaloperasi" => Carbon::parse($jadwal->jadwal_operasi)->toDateString(),
                    "jenistindakan"  => (!empty($jadwal->icd9) ? $jadwal->icd9->long_desc : ''),
                    "kodepoli"       => $kode_poli,
                    "namapoli"       => $nama_poli,
                    "terlaksana"     => $jadwal->status == 1 ? 1 : 0,
                    "nopeserta"      => $jadwal->kasus->sep->no_bpjs ?? "",
                    "lastupdate"     => $jadwal->updated_at->timestamp
                ];
            }

            $log['jenis_request'] = 'post';
            $log['url']           = 'operasi/get-jadwal-rs';
            $log['param']         = json_encode($request->input());
            $log['response']      = json_encode($response);
            $log['created_by']    = $user_token->created_by;
            app('App\Http\Controllers\ThirdParty\MobileBPJS\CreateController')->createLog($log);
            DB::connection('thirdp')->commit();

            return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                ->success(['list' => $response]);
        } catch (\Exception $e) {

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                ->error();
        }
    }

    public function getJadwalOperasiPasien(Request $request)
    {
        DB::connection('thirdp')->beginTransaction();
        try {
            app('debugbar')->disable();
            $headers['token'] = $request->header('x-token');
            $headers['username'] = $request->header('x-username');
            $user_token = app('App\Http\Controllers\ThirdParty\MobileBPJS\ReadController')->cekUserToken($headers);
            /** cek token */
            if (empty($user_token)) {
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->errorAuth();
            }
            /** end cek token */

            /** validator */
            $rules            =  [
                'nopeserta' => 'required',
            ];
            $alert            =  [
                'required'       => ':attribute harus diisi',
            ];

            $validator = Validator::make($request->all(), $rules, $alert);
            if (!$validator->passes()) {
                $message = $validator->errors()->all();
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->error($message);
            }
            /** end validator */
            $pasien_bpjs = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->getNoAsuransi($request->nopeserta);

            if (empty($pasien_bpjs)) {
                $message = 'Pasien Tidak ditemukan';
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->error($message);
            }

            //$list_booking_operasi = $pasien_bpjs->pasien->getListBookingOperasi;
                // ->where('status', 0);
            $list_booking_operasi = [];
            $response['list'] = [];
            if (!empty($list_booking_operasi)) {
                foreach ($list_booking_operasi as $key => $value) {
                    $lokasi = $value->kasus->lokasi_first->lokasi;
                    $kode = '-';
                    /**jika lokasinya adalah IGD */
                    if ($lokasi->lokasi_departemen_id === 1) {
                        $lokasi = $lokasi->nama ?? 'IGD';
                        $kode   = 'IGD';
                    } else {
                        $lokasi = $lokasi->poliklinik->name ?? '-';
                        $kode = $value->kasus->lokasi_first->lokasi->poliklinik->bpjs_id ?? "-";
                    }

                    $response['list'][] = [
                        'kodebooking'    => $value->id ?? "-",
                        'tanggaloperasi' => !empty($value->jadwal_operasi) ? Carbon::parse($value->jadwal_operasi)->format('Y-m-d') : "",
                        'jenistindakan'  => $value->icd9->long_desc ?? '-',
                        'kodepoli'       => $kode,
                        'namapoli'       => $lokasi,
                        'terlaksana'     => $value->status,
                    ];
                }
            }

            $log['jenis_request'] = 'post';
            $log['url']           = 'operasi/get-jadwal-pasien';
            $log['param']         = json_encode($request->input());
            $log['response']      = json_encode($response);
            $log['created_by']    = $user_token->created_by;
            app('App\Http\Controllers\ThirdParty\MobileBPJS\CreateController')->createLog($log);
            DB::connection('thirdp')->commit();

            return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                ->success($response);
        } catch (\Exception $e) {
            DB::connection('thirdp')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                ->error();
        }
    }
}
