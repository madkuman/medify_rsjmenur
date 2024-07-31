<?php

namespace App\Http\Controllers\Kasus\Kasus;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\BPJSSEP;
use DB;
use Bugsnag;

class PostController extends Controller
{
    static protected $success = "200";
    static protected $error_diagnose = "X-0-20-X";
    static protected $error_empty_result = "X-0-99-X";
    static protected $error_ambulatory = "X-0-19-X";

    public function autoUpdatePlafon($kasus)
    {
        //KLAIM BARU
        //$verifikasi_coder = VerifikasiKoder::with('icd10', 'icd10_bpjs', 'icd9', 'icd9_bpjs')->where('kasus_id', $kasus->id)->get();
        if ($kasus->claim_sent) {
            $res = app('App\Http\Controllers\INACBG\PostController')->reedit($kasus);
        }
        $res = app('App\Http\Controllers\INACBG\PostController')->newClaim($kasus);

        if (($res->metadata->code ?? null) != self::$success && ($res->metadata->code ?? null) != "400") {
            return FALSE;
        }


        //ISI DATA KLAIM DENGAN TINDAKAN & DIAGNOSIS

        $res = app('App\Http\Controllers\INACBG\PostController')->setClaimData($kasus);
        $payload = $res['payload'];
        $res = $res['res'];
        //GROUPER STAGE 1
        $res = app('App\Http\Controllers\INACBG\PostController')->firstGrouper($kasus);
        if ($res->metadata->code != self::$success && $res->metadata->code != "400") {
            return FALSE;
        }

        $is_error = $this->checkError($res);
        if ($is_error['status']) //ERROR CODE YG DI RESPONSE CBG
        {
            $hasil = app('App\Http\Controllers\INACBG\CreateController')->create($res, $kasus->id, $payload, 0);
            return FALSE;
        }
        //BUAT INACBG BARU
        $hasil = app('App\Http\Controllers\INACBG\CreateController')->create($res, $kasus->id, $payload);
        // if(isset($res->special_cmg_option))
        // {
        //     DB::connection('kasus')->commit();
        //     return json_encode(['status' => 201,
        //         'message' => "Silahkan pilih Spesial CMG",
        //         'cmg' => $res->special_cmg_option]);
        // }
        $pembayaran_kelas = $kasus->pembayaran->kelas_id;

        foreach ($res->tarif_alt as $t) {
            if ($t->kelas == "kelas_" . $pembayaran_kelas) {
                if (!is_null($kasus->active_sep))
                    $this->updateBpjs($kasus->active_sep->id, $t->tarif_inacbg);
            }
        }
    }

    public function updatePlafon(Request $req, $nomor_kasus, $verifikasi_coder = null)
    {
        try {
            DB::connection('kasus')->beginTransaction();
            $kasus = Kasus::where('nomor_kasus', $nomor_kasus)->with(
                'tindakan_icd9.icd9_bpjs',
                'diagnosis.icd10_bpjs',
                'daftar_tagihan.detail.tarif.tarif_detail.tarif_kategori_inacbg'
            )->first();
            // if ($verifikasi_coder == null)
            //     $verifikasi_coder = VerifikasiKoder::with('icd10', 'icd10_bpjs', 'icd9', 'icd9_bpjs')->where('kasus_id', $kasus->id)->get();
            $this->checkToAbort($kasus);
            //KLAIM BARU
            $res_new_claim = app('App\Http\Controllers\INACBG\PostController')->newClaim($kasus);
            // dd('newClaim', $res_new_claim);
            #butuh 400 karena awalnya emang dupliasi SEP
            if(isset($res_new_claim->metadata->code) && $res_new_claim->metadata->code != self::$success && $res_new_claim->metadata->code != "400"){
                return json_encode([
                    'status' => 500,
                    'message' => "Gagal menghubungkan ke INACBG"
                ]);
            }


            //ISI DATA KLAIM DENGAN TINDAKAN & DIAGNOSIS
            $res = app('App\Http\Controllers\INACBG\PostController')->setClaimData($kasus, $verifikasi_coder);
            $payload = $res['payload'];
            $res = $res['res'];

            //GROUPER STAGE 1
            $res = app('App\Http\Controllers\INACBG\PostController')->firstGrouper($kasus);
            if ($res && $res->metadata->code != self::$success && $res->metadata->code != "400") {
                return json_encode([
                    'status' => 500,
                    'message' => "Gagal menghubungkan ke INACBG"
                ]);
            }

            $is_error = $this->checkError($res);
            if ($is_error['status']) //ERROR CODE YG DI RESPONSE CBG
            {
                return json_encode([
                    'status' => 500,
                    'message' => $is_error['msg']
                ]);
            }
            //BUAT INACBG BARU
            $hasil = app('App\Http\Controllers\INACBG\CreateController')->create($res, $kasus->id, $payload);
            if (isset($res->special_cmg_option)) {
                DB::connection('kasus')->commit();
                return json_encode([
                    'status' => 201,
                    'message' => "Silahkan pilih Spesial CMG",
                    'cmg' => $res->special_cmg_option
                ]);
            }
            $pembayaran_kelas = $kasus->pasien->pembayaranUtama->kelas_id;

            foreach ($res->tarif_alt as $t) {
                if ($t->kelas == "kelas_" . $pembayaran_kelas) {
                    if (!is_null($kasus->active_sep))
                        $this->updateBpjs($kasus->active_sep->id, $t->tarif_inacbg);
                }
            }


            if ($kasus->claim_sent) {
                $res = app('App\Http\Controllers\INACBG\PostController')->finalisasiClaim($kasus);
            }
            $kasus->claim_sent = 1;
            $kasus->save();
            DB::connection('kasus')->commit();
            return json_encode([
                'status' => 200,
                'message' => "Berhasil mengupdate Plafon"
            ]);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kasus')->rollback();
            return json_encode([
                'status' => 500,
                'message' => "Maaf, Terdapat kesalahan server"
            ]);
        }
    }


    public function updatePlafonSecond(Request $req, $nomor_kasus)
    {
        try {
        DB::connection('kasus')->beginTransaction();
        $kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
        $this->checkToAbort($kasus);
        //GROUPER STAGE 2
        $res = app('App\Http\Controllers\INACBG\PostController')->secondGrouper($req, $kasus);
        $payload = $res['payload'];
        $res = $res['res'];
        if($res->metadata->code != self::$success && $res->metadata->code != "400")
        {
            return json_encode(['status' => 500,
                'message' => "Gagal menghubungkan ke INACBG"]);
        }
    
        $is_error = $this->checkError($res);
        if($is_error['status']) //ERROR CODE YG DI RESPONSE CBG
        {
            return json_encode(['status' => 500,
                'message' => $is_error['msg']]);
        }
        //BUAT INACBG BARU
        $hasil = app('App\Http\Controllers\INACBG\CreateController')->create($res, $kasus->id, $payload);
        $pembayaran_kelas = $kasus->pasien->pembayaranUtama->kelas_id;

        foreach($res->tarif_alt as $t){
            if($t->kelas == "kelas_".$pembayaran_kelas){
                $total = $t->tarif_inacbg;
                if(isset($t->tarif_sp))
                    $total += $t->tarif_sp;
                if(isset($t->tarif_sr))
                    $total += $t->tarif_sr;
                if(!is_null($kasus->active_sep))
                    $kasus->active_sep->total_plafon = $total;
                $this->updateBpjs($kasus->active_sep->id, $total);
                // $kasus->plafon_inacbg = $total;
            }
        }
        $kasus->save();
        DB::connection('kasus')->commit();
        return json_encode(['status' => 200,
                'message' => "Berhasil mengupdate Plafon"]);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kasus')->rollback();
            return json_encode(['status' => 500,
                'message' => "Maaf, Terdapat kesalahan server"]);
        }
    }

    private function checkError($res)
    {
        if (!isset($res->response->cbg->code))
            return [
                'status' => TRUE,
                'msg' => "Kesalahan pada server INACBG"
            ];
        switch ($res->response->cbg->code) {
            case self::$error_diagnose:
                return [ 'status' => TRUE,
                    'msg' => "Diagnosis/Tindakan ICD9 tidak sesuai dengan kaidah koding"];
            case self::$error_empty_result:
                return [ 'status' => TRUE,
                    'msg' => "Hasil tidak ditemukan/kosong"];
            case self::$error_ambulatory:
                return [ 'status' => TRUE,
                    'msg' => $res->response->cbg->description];
            default:
                return [ 'status' => FALSE,
                    'msg' => ""];
        }
    }

    private function updateBpjs($id, $plafon)
    {
        $bpjs = BPJSSEP::find($id);
        $bpjs->total_plafon = $plafon;
        $bpjs->save();
    }

}