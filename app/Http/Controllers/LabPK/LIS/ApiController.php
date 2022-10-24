<?php

namespace App\Http\Controllers\LabPK\LIS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\Transaksi;
use App\Models\Keuangan\TarifMaster;
use App\Models\LabPK\Hasil;
use App\Models\LabPK\LaporanRekap;
use Carbon\Carbon;
use File;
use Auth;
use DB;
use Bugsnag;
use DOMPDF;

class ApiController extends Controller
{
    static protected $link = "labpk";
    static protected $lokasi_slug = "lab-pk";
    protected static $lis_url;
    static protected $lis_user;

    public function __construct(){
        self::$lis_url = config('app.lis_url');
        self::$lis_user = config('app.lis_user');
        $this->createController = app('App\Http\Controllers\LabPK\Transaction\CreateController');
    }

    public function insertHasilByJson(Request $req)
    {
        if(is_null($req['no_ref'])){
            $in = $req->getContent();
            $in = trim(preg_replace('/\s+/', '', $in));
            $res = (array)json_decode($in);
            $no_ref = $res['no_ref'];
            $hasil_in = $res['has il'] ?? $res['hasil'];
        } else {
            $no_ref = $req['no_ref'];
            $hasil_in = $req['hasil'];
        }

        $transaction = Transaksi::find($no_ref);
        if(is_null($transaction))
            return response(json_encode(['code' => 400,
                'message' => "Error",
                'response' => "No. Ref not found"]), 400);
        try {
            DB::connection('kasus')->beginTransaction();
            DB::connection('keuangan')->beginTransaction();
            DB::connection('lab_pk')->beginTransaction();
            Auth::loginUsingId(self::$lis_user);

            $transaction->status = 1;
            $transaction->result_created_at = Carbon::now();
            $transaction->result_created_by = Auth::user()->id;
            $transaction->verified_by = Auth::user()->id;
            $transaction->verified_at = Carbon::now();
            $transaction->save();

            $detail_data = $this->tambahTagihan($transaction);
            if(!$transaction->is_checkout && $transaction->kirim_kasir){
                app('App\Http\Controllers\LabPK\Transaksi\PostController')->kirimKasir($transaction, $detail_data);
                $transaction->is_checkout = 1;
                $transaction->save();
            }
            $hasil = new Hasil();
            $hasil->transaksi_id = $transaction->id;
            $hasil->lis_result = json_encode($hasil_in);
            $hasil->created_by = Auth::user()->id;
            $hasil->save();
            $file_path = $this->generateFile($transaction, $hasil);
            $now_date = Carbon::now()->toDateString();
            $data_file = app('App\Http\Controllers\Functions\FileUploader')->createThumbnail($now_date, $file_path, self::$link);
   
            $penunjang = app('App\Http\Controllers\Kasus\Penunjang\CreateController')->createData($file_path, date('d/m/Y').' '.$transaction->no_lab, '', $transaction->kasus_id, 'pdf', self::$link, $transaction->id, $data_file['path']);
            if(!is_null($transaction->kasus_id) && $transaction->class == config('const.urikkes'))
                $this->updateUrikkes($hasil_in, $transaction->kasus_id);
            // $this->appendLog($req);
            
            DB::connection('keuangan')->commit();
            DB::connection('kasus')->commit();
            DB::connection('lab_pk')->commit();
            return response(json_encode(['code' => 200,
                'message' => "OK",
                'response' => "success"]), 200);

            DB::connection('keuangan')->rollback();
            DB::connection('kasus')->rollback();
            DB::connection('lab_pk')->rollback();
            return response(json_encode(['code' => 500,
                'message' => "OK",
                'response' => "success"]), 500);        
        }
        catch (\Exception $e) {
            DB::connection('keuangan')->rollback();
            DB::connection('kasus')->rollback();
            DB::connection('lab_pk')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return response(json_encode(['code' => 500,
                'message' => "Error",
                'response' => "error"]), 500);        
        }
    }

    public function tambahTagihan($transaction)
    {
        try {
            $data['tarif_tipe_id'] = $transaction->tarif_tipe_id;
            $data['tarif_kelas'] = $transaction->kelas->id;
            $counter = 0;
            $detail_data = [];
            $pasien_pembayaran_perusahaan = $transaction->pembayaran->perusahaan_id;
            $lokasi_departemen = $transaction->asal->lokasi_departemen_id;
            $lokasi_id = \App\Models\Hospital\Lokasi::where('slug', self::$lokasi_slug)->first()->id;
            foreach($transaction->detail as $detail){
                $tarif = TarifMaster::find($detail->tarif_id);

                if($detail->status == "ask")
                {
                    $data = $this->createController->saveTagihanData($transaction, $detail, $lokasi_id);

                    if(!$transaction->is_checkout){
                        if($transaction->kirim_kasir)
                            array_push($detail_data, $data);
                        else if(!is_null($transaction->kasus_id)){
                            $saveToTagihan = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($data);
                            $detail->tagihan_detail_id = $saveToTagihan->id;
                        }
                    }
                    $rekap = new LaporanRekap;
                    $rekap->transaksi_id = $transaction->id;
                    $rekap->tarif_id = $detail->tarif_id;
                    $rekap->pasien_pembayaran_perusahaan = $pasien_pembayaran_perusahaan;
                    $rekap->lokasi_departemen = $lokasi_departemen;
                    $rekap->result_created_at = $transaction->result_created_at;
                    $rekap->save();
                }
                $detail->qty = 1;
                $detail->done = 1;
                $detail->status = "done";
                $detail->save();
                $counter++;
            }
            return $detail_data;
        } catch (\Exception $e) {
            if(config('app.debug'))

                throw new \Exception($e, 1);
        }
    }

    private function generateFile($transaksi, $hasil){
        $now_date = Carbon::now()->toDateString();
        $path = public_path("uploads/labpk/result/".$now_date."/");
        if(!file_exists($path))
            mkdir($path, 0777, true);

        $data['transaksi'] = $transaksi;
        $data['hasil'] = $hasil;
        if(!$data['transaksi'] || !$data['hasil'])
            abort(404);
        $data['result'] = $this->transformResultJson($data['hasil']->lis_result);

        $data['jumlah'] = count(json_decode($data['hasil']->lis_result));

        $pdf = DOMPDF::loadView('labpk.laporan.print-hasil', $data, [], [
            'format' => 'A4',
            'display_mode' => 'fullpage'
        ]);
        $filename = $path.date("M Y").'_'.$transaksi->no_lab.'.pdf';
        $pdf->save($filename);
        return "uploads/labpk/result/".$now_date."/".date("M Y").'_'.$transaksi->no_lab.'.pdf';
    }

    private function transformResultJson($source)
    {
        $source = json_decode($source);
        // dd($source);
        $first = array_splice($source, 0, 17);
        $result = [$first];
        if(count($source)){
            $remaining = array_chunk($source, 34);
            return array_merge($result, $remaining);
        } else {
            return $result;
        }
    }

    private function appendLog(Request $request)
    {
        $filename = 'labpk_lis_logger_' . date('d-m-y') . '.log';

        if(!file_exists(storage_path('logs' . DIRECTORY_SEPARATOR . $filename)))   //Cek udh ada file belom                         
            file_put_contents(storage_path('logs' . DIRECTORY_SEPARATOR . $filename), "Time;IP Address;URL;Method;Content;".PHP_EOL , FILE_APPEND | LOCK_EX);

        $dataToLog  = gmdate("F j, Y, g:i a") . ";";
        $dataToLog .= $request->ip() . ";";
        $dataToLog .= $request->fullUrl() . ";";
        $dataToLog .= $request->method() . ";";
        $dataToLog .= $request->no_ref.' - '.$request->hasil;
        file_put_contents(storage_path('logs' . DIRECTORY_SEPARATOR . $filename), $dataToLog.PHP_EOL , FILE_APPEND | LOCK_EX);
    }

    private function updateUrikkes($hasil_in, $kasus_id)
    {
        foreach ($hasil_in as $key => $val) {
            $tarif = TarifMaster::where('lis_id', $val['ext_code0'])->first();
            if(is_null($tarif)) continue;
            else{
                $target = $tarif->hasil_urikkes;
                $targets = explode(';', $target);
                foreach ($targets as $t) {
                    $row = explode('|', $t);
                    if(count($row) > 1)
                        DB::connection('kasus')->table($row[0])
                                                ->updateOrInsert(['kasus_id' => $kasus_id],
                                                    [$row[1] => $val['result']],
                                                    ['created_by' => self::$lis_user]);
                }
            }
        }
    }
}