<?php

namespace App\Http\Controllers\ThirdParty\MobileBPJS\Farmasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatJalan\PoliklinikBpjs;
use App\Models\RawatJalan\Transaksi;
use DateTime;
use Validator;
use DB;
use Carbon\Carbon;
use PhpParser\Node\Stmt\TryCatch;

class PostController extends Controller
{
    protected $headers = [
        'username',
        'token'
    ];

    public function __construct(Request $request)
    {
        $this->headers['token'] = $request->header('x-token');
        $this->headers['username'] = $request->header('x-username');
    }

    public function getAntrean(Request $request)
    {
        DB::connection('farmasi')->beginTransaction();

        try {
            app('debugbar')->disable();
            $user_token = app('App\Http\Controllers\ThirdParty\MobileBPJS\ReadController')->cekUserToken($this->headers);
            /** cek token */
            if (empty($user_token)) {
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->errorAuth();
            }
            /** end cek token */

            /** validator */
            $rules            =  [
                'kodebooking'     => 'required'
            ];
            $alert            =  [
                'required'       => ':kodebooking tidak boleh kosong'
            ];

            $validator = Validator::make($request->all(), $rules, $alert);

            if (!$validator->passes()) {
                $message = $validator->errors()->all();
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->error(null, 201, $message);
            }
            /** end validator */
        } catch (\Exception $e) {

            DB::connection('farmasi')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                ->error();
        }
    }
}
