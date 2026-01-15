<?php

namespace App\Http\Controllers\Radiology\Transaction;

use App\Models\Kasus\Penunjang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Radiology\Transaction;
use App\Models\Radiology\TransactionDetail;
use App\Models\Radiology\TemplateHasil;
use App\Models\FrontOffice\Patients;
use App\Models\Radiology\Photo;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Auth;
use File;
use App\Models\Hospital\Lokasi;
use Illuminate\Support\Facades\Storage;
use DB;
use Bugsnag;
use DOMPDF;

class EditController extends Controller
{
    static protected $lokasi_slug = "radiologi";
    static protected $link = "radiologi";

    function __construct()
    {
        $this->createController = app('App\Http\Controllers\Radiology\Transaction\CreateController'); 
    }

    public function updateResult(Request $req)
    {
        try {
            DB::connection('kasus')->beginTransaction();
            DB::connection('radiology')->beginTransaction();
            DB::connection('keuangan')->beginTransaction();
            $transaction = Transaction::where('slug', $req['transaction_slug'])->first();
            $transaction->result = $req['summary'];

            $transaction->info = $req['info'];
            if(empty($transaction->result_created_at)){
                $transaction->result_created_at = Carbon::now();
                $transaction->result_created_by = Auth::user()->id;
            }
            $this->updatePicture($req, $transaction->id, $transaction->kasus_id);

            $data['tarif_tipe_id'] = $transaction->tarif_tipe_id;
            $data['tarif_kelas'] = $transaction->kelas->id;
            if(is_array(($req['batal_layanan'])))
                $this->createController->deleteLayanan($req);     //BATALKAN LAYANAN KALAU ADA
                    
            $lokasi_id = Lokasi::where('slug', self::$lokasi_slug)->first()->id;
            $detail_data = [];
            $this->updateDetailResult($req, $transaction, $transaction->detail, $detail_data, $lokasi_id);  //SAVE DETAIL RESULT
            app('App\Http\Controllers\Radiology\Transaction\CreateController')->createNewDetailResult($req, $transaction);  //SAVE NEW DETAIL RESULT
            if($transaction->kirim_kasir && count($detail_data)){
                app('App\Http\Controllers\Radiology\Transaction\PostController')->kirimKasir($transaction, $detail_data);
            }
            $transaction->is_checkout = 1;
            $transaction->save();
            $this->updatePhotosPenunjang($transaction);
            app('App\Http\Controllers\Radiology\TransaksiBmhp\CreateController')->addData($req->bmhp,$transaction->id);
            DB::connection('kasus')->commit();
            DB::connection('radiology')->commit();
            DB::connection('keuangan')->commit();
            return redirect('radiologi/transaksi/hasil/'.$req['transaction_slug'])
                    ->with('status', "success")
                    ->with('title', 'Berhasil')
                    ->with('success', 'Hasil berhasil diupdate');
        } catch (\Exception $e) {
            DB::connection('kasus')->rollback();
            DB::connection('radiology')->rollback();
            DB::connection('keuangan')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return back()->with('status', "error")
                        ->with('title', 'Gagal')
                        ->with('success', 'Hasil gagal diupdate');
        }
    }

    private function updateDetailResult($req, $transaction, $transaction_detail, &$detail_data, $lokasi_id)
    {
        foreach($transaction_detail as $detail){
            $row = $detail->id;
            if(is_array(($req['batal_layanan'])) && in_array($row, $req['batal_layanan']))  //KALO LAYANAN DI DELETE, DISKIP
                continue;

            $detail->qty = (int)$req['jumlahPeriksa'][$row];
            $detail->film_dipakai = (int)$req['dipakai'][$row];
            $detail->film_ditolak = (int)$req['direject'][$row];
            $detail->ukuran_film = (int)$req['ukuran_film'][$row];
            $detail->foto_ulang = (int)$req['foto_ulang'][$row];
            $detail->alasan_foto_ulang = $req['alasan_ulang'][$row];
            $detail->alasan_film_direject = $req['alasan_film_direject'][$row] ?? '';                
            $detail->kontras_dipakai = (int)$req['kontras_dipakai'][$row];
            $detail->kontras_dikembalikan = (int)$req['kontras_dikembalikan'][$row];
            $detail->hasil_baca = $req['hasil_baca'][$row];
            $data = app('App\Http\Controllers\Radiology\Transaction\CreateController')->saveTagihanData($transaction, $detail, $lokasi_id);
            
            if($detail->status == "ask")
                {
                    $detail->qty = (int)$req['jumlahPeriksa'][$row];

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
                // }
                $i++;
            }
            if(app('App\Http\Controllers\Radiology\Transaction\CreateController')->cleanPhotos($req['saltForm'], $transaction_id)){
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
                    if(file_exists($folder.'/'.$photo->path)) //DEVELOPMENT NEEDS
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
                return redirect('radiologi/transaksi/permintaan/'.$slug);
        } catch (\Exception $e) {
            if(config('app.debug'))

                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return redirect('radiologi/transaksi/permintaan/'.$slug);
        }
    }

    public function editSEPNumber(Request $req, $slug){
        try {
            $transaction = Transaction::where('slug', $slug)->first();
            $transaction->sep = $req['sep_number'];
            if($transaction->save())
                return redirect('radiologi/transaksi/permintaan/'.$slug);
        } catch (\Exception $e) {
            if(config('app.debug'))

                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return redirect('radiologi/transaksi/permintaan/'.$slug);
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
                        $photo->penunjang_id = null;
                        $photo->save();
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

    public function verifikasi(Request $req, $slug){
        try {
            DB::connection('radiology')->beginTransaction();
            $transaksi = Transaction::where('slug', $slug)->first();
            $transaksi->verified_by = Auth::user()->id;
            $transaksi->verified_at = Carbon::now()->toDateTimeString();
            $transaksi->save();
            $this->updatePhotosPenunjang($transaksi);
            DB::connection('radiology')->commit();
            $status = "success";
            $title = "Berhasil!";
            $message = "Verifikasi Hasil Radiologi Berhasil";
        } catch (\Exception $e) {
            if(config('app.debug'))
                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('radiology')->rollback();
            $status = "error";
            $title = "Gagal!";
            $message = "Verifikasi Hasil Radiologi Gagal";
        }
        return back()
                ->with('status', $status)
                ->with('title', $title)
                ->with('message', $message);
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

    private function sendFileHasil($transaksi){
        if(is_null($transaksi->kasus_id))
            return TRUE;
        //KIRIM HASIL BACA
        foreach($transaksi->detail_real as $d)
        {
            $file_path = $this->generateFile($transaksi, $d);
            $now_date = Carbon::now()->toDateString();
            $data_file = app('App\Http\Controllers\Functions\FileUploader')->createThumbnail($now_date, $file_path, self::$link);   
            $penunjang = app('App\Http\Controllers\Kasus\Penunjang\CreateController')->createData($file_path, 
                date('d/m/Y').' #'.$transaksi->id." ".$d->tarif->deskripsi, '', $transaksi->kasus_id, 'pdf', self::$link, $transaksi->id, $data_file['path']);
        }
        //KIRIM HASIL UPLOAD KE KASUS
        if(is_null($transaksi->kasus_id))
            return TRUE;
        foreach($transaksi->photos as $p)
        {
                $penunjang = app('App\Http\Controllers\Kasus\Penunjang\CreateController')->createData($p->path, 
                    date('d/m/Y').' #'.$transaksi->id." ".$p->id, '', $transaksi->kasus_id, $p->type, self::$link, $transaksi->id, $p->thumbnail_path);
                $p->penunjang_id = $penunjang->id;
                $p->save();
        }
    }

    private function generateFile($transaksi, $detail){
        $now_date = Carbon::now()->toDateString();
        $path = "uploads/radiologi/result/".$now_date."/";
        $public_path = public_path($path);
        if(!file_exists($path))
            mkdir($path, 0777, true);

        $data['transaksi'] = $transaksi;
        $data['detail'] = $detail;
        $pdf = DOMPDF::loadView('radiolog.laporan.print-detail', $data)->setPaper('a4', 'fullpage');
        $filename = "Radiologi_".$transaksi->id."_".$detail->id."_".date("d-m-Y").".pdf";
        $pdf->save($public_path.$filename);
        return $path.$filename;
    }

    public function startPemeriksaan($transaksi)
    {
        if(empty($transaksi->pemeriksaan_start_at)){
            $transaksi->pemeriksaan_start_at = Carbon::now();
            $transaksi->pemeriksaan_start_by = Auth::user()->id;
            $transaksi->save();
        }
    }

    public function updatePhotosPenunjang($transaksi)
    {
        $photo_penunjang_lama = Penunjang::where('penunjang_permintaan_id',$transaksi->id)->where('type',self::$link)->get();
        foreach ($photo_penunjang_lama as $item){
            $item->delete();
        }
        $this->sendFileHasil($transaksi);
    }
}