<?php

namespace App\Http\Controllers\LabPA\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPA\Transaction;
use App\Models\LabPA\TransactionDetail;
use App\Models\FrontOffice\Patients;
use App\Models\LabPA\Photo;
use App\Models\LabPA\Result;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use File;
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;
use Bugsnag;
use DOMPDF;

class EditController extends Controller
{
    static protected $lokasi_slug = "lab-pa";
    static protected $link = "labpa";

    function __construct()
    {
        $this->createController = app('App\Http\Controllers\LabPA\Transaction\CreateController'); 
    }

    public function updateResult(Request $req)
    {
        $transaction = Transaction::where('slug', $req['transaction_slug'])->first();
        $transaction->result = $req['summary'];
        $detail_data = [];
        try {            
            DB::connection('kasus')->beginTransaction();
            DB::connection('lab_pa')->beginTransaction();
            DB::connection('keuangan')->beginTransaction();

            $date = explode(' ', $transaction->result_created_at)[0];
            $transaction->info = $req['info'];
            $transaction->diagnosis = $req['diagnosis'];

            $this->updatePicture($req, $transaction->id, $transaction->kasus_id);
            $transaction->result_created_by = Auth::user()->id;
            $transaction->save();
            $data['tarif_tipe_id'] = $transaction->tarif_tipe_id;
            $data['tarif_kelas'] = $transaction->kelas->id;
            $data['tagihan_id'] = null;
            if(is_array(($req['batal_layanan'])))
                $this->createController->deleteLayanan($req);     //BATALKAN LAYANAN KALAU ADA

            $lokasi_id = \App\Models\Hospital\Lokasi::where('slug', self::$lokasi_slug)->first()->id;
            foreach((array)$req['layanan'] as $row){
                if(is_array(($req['batal_layanan'])) && in_array($row, $req['batal_layanan']))
                    continue;
                $detail = TransactionDetail::find($row);
                if($req['formDetail'][$row] != '0'){
                    $saveResult = app('App\Http\Controllers\LabPA\Transaction\CreateController')->generateResult($row, $req);

                    $detail->result = $saveResult;
                } else if(!is_null($detail->result)) {
                    $detail->result = null;
                }
                $detail->lokasi = $req['lokasi'][$row];
                $detail->kode_sediaan = $req['kode_sediaan'][$row];
                $detail->slide = $req['slide'][$row];
                $detail->qty = 1;

                if($detail->status == "ask")
                {
                    $data = $this->createController->saveTagihanData($transaction, $detail, $lokasi_id);
                    if($transaction->kirim_kasir)
                        array_push($detail_data, $data);
                    else if(!is_null($transaction->kasus_id)){
                        $saveToTagihan = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($data);
                        $detail->tagihan_detail_id = $saveToTagihan->id;
                    }
                }
                $detail->status = "done";
                $detail->save();
                    
                }
               //CHECK IF THERE'S ANY ADDITION DETAIL TO BE DONE
                foreach((array)$req['new_layanan'] as $key => $new_tarif_id){
                    if($new_tarif_id == 0){
                        continue;
                    }
                    $detail = $this->create_detail($new_tarif_id, $transaction->id);
                    if($req['formDetailBaru'][$key] != '0'){
                        $saveResult = app('App\Http\Controllers\LabPA\Transaction\CreateController')->generateResult('Baru'.$key, $req, 'baru');
                        $detail->result = $saveResult;
                    }
                    $detail->lokasi = $req['new_lokasi'][$key];
                    $detail->kode_sediaan = $req['new_kode_sediaan'][$key];
                    $detail->slide = $req['new_slide'][$key];
                    $detail->status = "ask";
                    $detail->save();
                }
                if($transaction->kirim_kasir && count($detail_data)){
                    app('App\Http\Controllers\LabPA\Transaction\PostController')->kirimKasir($transaction, $detail_data);
                }
                $transaction->is_checkout = 1;
                $transaction->save();

                DB::connection('kasus')->commit();
                DB::connection('lab_pa')->commit();
                DB::connection('keuangan')->commit();

                return redirect('labpa/transaksi/hasil/'.$req['transaction_slug'])
                    ->with('status', "success")
                    ->with('title', 'Berhasil')
                    ->with('success', 'Hasil berhasil diupdate');
            } catch (\Exception $e) {
                DB::connection('kasus')->rollback();
                DB::connection('lab_pa')->rollback();
                DB::connection('keuangan')->rollback();

                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
                return back()->with('status', "error")
                        ->with('title', 'Gagal')
                        ->with('success', 'Hasil gagal diupdate');
            }
        }

        private function updatePicture($req, $transaction_id, $kasus_id)
        {
            $date = Carbon::now()->toDateString();
            $photos = Photo::where('hash', $req['saltForm'])->where('status', 0)->get();
            try {
                $i = 0;
                foreach($photos as $item){
                    $item->status = 1;
                    $item->title = $req['judul'][$i];
                    $item->caption = $req['caption'][$i];
                    $item->created_by = Auth::user()->id;
                    $data_image = app('App\Http\Controllers\Functions\FileUploader')->createThumbnail($date, $item->path, self::$link);
                    $item->thumbnail_path = $data_image['path'];
                    $item->type = $data_image['type'];
                    $item->save();
                // if(!is_null($kasus_id)){
                //     $penunjang = app('App\Http\Controllers\Kasus\Penunjang\CreateController')->createData('labpa/'.$item->path, $item->title, $item->caption, $kasus_id, 0, "labpa", $transaction_id);
                // }
                    $i++;
                }
                if(app('App\Http\Controllers\LabPA\Transaction\CreateController')->cleanPhotos($req['saltForm'], $transaction_id)){
                    if($this->deletePhotos($req['deletedPhoto']))
                        return TRUE;
                }
                return FALSE;
            } catch (\Exception $e) {
                if(config('app.debug'))

                    app('App\Http\Controllers\Error\Handler')->bugsnag($e);
                return FALSE;
            }
        }

        private function deletePhotos($target)
        {
            $folder = public_path();
            try {
                if($target){
                    foreach($target as $row){
                        $photo = Photo::find($row);
                        if(empty($photo))
                            return FALSE;
                    if(file_exists($photo->path)) //DEVELOPMENT NEEDS
                    unlink($folder.'/'.$photo->path);
                    $photo->delete();
                }
            }
            return TRUE;
        } catch (\Exception $e) {
            if(config('app.debug'))

                return FALSE;
        }
    }

    public function editInspectionDate(Request $req, $slug){
        try {
            $transaction = Transaction::where('slug', $slug)->first();
            $transaction->inspected_at = $req['tanggal_periksa'];
            $transaction->inspected_at_by = Auth::user()->id;
            $transaction->inspected_at_created_at = Carbon::now();
            if($transaction->save())
                return redirect('labpa/transaksi/permintaan/'.$slug);
        } catch (\Exception $e) {
            if(config('app.debug'))

                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return redirect('labpa/transaksi/permintaan/'.$slug);
        }
    }

    public function editSEPNumber(Request $req, $slug){
        try {
            $transaction = Transaction::where('slug', $slug)->first();
            $transaction->sep = $req['sep_number'];
            if($transaction->save())
                return redirect('labpa/transaksi/permintaan/'.$slug);
        } catch (\Exception $e) {
            if(config('app.debug'))

                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return redirect('labpa/transaksi/permintaan/'.$slug);
        }
    }

    private function updateFormResult($transaction, $req){
        try {
            $result = Result::where('transaction_id', $transaction->id)->first();
            $result->makroskopis = $req['fnab_makroskopis'];
            $result->mikroskopis = $req['fnab_mikroskopis'];
            $result->kesimpulan = $req['fnab_kesimpulan'];
            $result->hispatologi_makroskopis = $req['hispatologi_makroskopis'];
            $result->hispatologi_mikroskopis = $req['hispatologi_mikroskopis'];
            $result->hispatologi_kesimpulan = $req['hispatologi_kesimpulan'];

            $result->sitologi_class = $req['papsmearClass'] ? json_encode($req['papsmearClass']) : null;
            $result->sitologi_infection = $req['papsmearInfection'] ? json_encode($req['papsmearInfection']) : null;
            $result->sitologi_specimen = $req['papsmearSpecimen'] ? json_encode($req['papsmearSpecimen']) : null;
            $result->sitologi_reactive = $req['papsmearReactive'] ? json_encode($req['papsmearReactive']) : null;
            $result->sitologi_general = $req['papsmearGeneral'] ? json_encode($req['papsmearGeneral']) : null;
            $result->save();
            return TRUE;
        } catch (\Exception $e) {
            if(config('app.debug'))

                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return FALSE;
        }
    }

    public function create_detail($service, $transaction_id)
    {
        try {
            $new_detail = new TransactionDetail();
            $new_detail->transaction_id = $transaction_id;
            $new_detail->tarif_id = $service;
            if($new_detail->save())
                return $new_detail;
            return FALSE;
        } catch (\Exception $e) {
            if(config('app.debug'))

                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return FALSE;
        }
    }

    public function updatePenunjang(Request $req){
        try {
            $photo = Photo::find($req['id']);
            $photo->title = $req['live_title'];
            $photo->caption = $req['live_caption'];
            $photo->updated_by = Auth::user()->id;
            if($req['live_check'] == 'true'){
                $photo->verified_by = Auth::user()->id;
                $photo->verified_at = Carbon::now()->toDateTimeString();
            }
            $transaction = Transaction::find($photo->transaction_id);
            if($photo->save()){
                if($req['live_check'] == 'true'){
                    if(is_null($photo->penunjang_id)){
                        $penunjang = app('App\Http\Controllers\Kasus\Penunjang\CreateController')->createData($photo->path, $photo->title, $photo->caption, $transaction->kasus_id, $photo->type, self::$link, $transaction->id, $photo->thumbnail_path);
                        $photo->penunjang_id = $penunjang->id;
                        $photo->save();
                    } else {
                        app('App\Http\Controllers\Kasus\Penunjang\EditController')->updateData($photo->title, $photo->caption, $photo->penunjang_id);
                    }
                } else {
                    if(!is_null($photo->penunjang_id)){
                        $delete = app('App\Http\Controllers\Kasus\Penunjang\DeleteController')->delete($photo->penunjang_id);
                    }                    
                }
                return back();
            }
        } catch (\Exception $e) {
            if(config('app.debug'))

                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return back();
        }
    }

    public function updateHasilBaca(Request $req, $slug){
        try {

            $transaction = Transaction::where('slug', $slug)->first();
            $transaction->result = $req['pemeriksaan'];
            $transaction->save();
            return back()->with('success', 'Hasil Baca berhasil diubah');            
        } catch (\Exception $e) {
            if(config('app.debug'))

                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return back();            
        }
    }

    public function verifikasi(Request $req, $slug){
        try {
            DB::connection('lab_pa')->beginTransaction();
            $transaksi = Transaction::where('slug', $slug)->first();
            $transaksi->verified_by = Auth::user()->id;
            $transaksi->verified_at = Carbon::now()->toDateTimeString();
            $transaksi->save();
            $this->sendFileHasil($transaksi);
            DB::connection('lab_pa')->commit();
            $data['status'] = "success";
            $data['title'] = "Berhasil!";
            $data['message'] = "Verifikasi Hasil LabPA Berhasil";
        } catch (\Exception $e) {
            if(config('app.debug'))
                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('lab_pa')->rollback();
            $data['status'] = "error";
            $data['title'] = "Gagal!";
            $data['message'] = "Verifikasi Hasil LabPA Gagal";
        }
        return json_encode($data);
    }

    private function sendFileHasil($transaksi){
        if(is_null($transaksi->kasus_id))
            return TRUE;
        //KIRIM HASIL BACA
        foreach($transaksi->detail_real as $d)
        {
            if(is_null($d->result))
                continue;
            $file_path = $this->generateFile($transaksi, $d);
            $now_date = Carbon::now()->toDateString();
            $data_file = app('App\Http\Controllers\Functions\FileUploader')->createThumbnail($now_date, $file_path, self::$link);
            $penunjang = app('App\Http\Controllers\Kasus\Penunjang\CreateController')->createData($file_path, 
                date('d/m/Y').' #'.$transaksi->id." ".$d->tarif->deskripsi, '', $transaksi->kasus_id, 'pdf', self::$link, $transaksi->id, $data_file['path']);
        }

        //KIRIM HASIL UPLOAD KE KASUS
        foreach($transaksi->photos as $p)
        {
            if(is_null($p->penunjang_id)){
                $penunjang = app('App\Http\Controllers\Kasus\Penunjang\CreateController')->createData($p->path, 
                    date('d/m/Y').' #'.$transaksi->id." ".$p->id, '', $transaksi->kasus_id, $p->type, self::$link, $transaksi->id, $p->thumbnail_path);
                $p->penunjang_id = $penunjang->id;
                $p->save();
            }
        }
    }

    private function generateFile($transaksi, $detail){
        $now_date = Carbon::now()->toDateString();
        $path = "uploads/labpa/result/".$now_date."/";
        $public_path = public_path($path);
        if(!file_exists($path))
            mkdir($path, 0777, true);

        \Blade::setEchoFormat('nl2br(e(%s))');

        $data['transaksi'] = $transaksi;
        $data['detail'] = $detail;
        if(!is_null($data['detail']->result)) $data['result'] = json_decode($data['detail']->result);
        if($data['result']->jenis_form == 'papsmear'){
            $pdf = DOMPDF::loadView('labpa.laporan.print-papsmear', $data);
        }
        else {
            $pdf = DOMPDF::loadView('labpa.laporan.print-detail', $data);
        }
        $filename = "LabPA_".$transaksi->id."_".$detail->id."_".date("d-m-Y").".pdf";
        $pdf->save($public_path.$filename);
        return $path.$filename;
    }

    public function startPemeriksaan($transaksi)
    {
        $transaksi->pemeriksaan_start = Carbon::now();
        $transaksi->save();
    }
}