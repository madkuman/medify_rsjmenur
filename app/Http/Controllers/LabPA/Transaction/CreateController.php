<?php

namespace App\Http\Controllers\LabPA\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPA\Transaction;
use App\Models\LabPA\TransactionDetail;
use App\Models\LabPA\Rejection;
use App\Models\LabPA\Photo;
use App\Models\LabPA\Result;
use App\Models\Kasus\Kasus;
use App\Models\Hospital\Lokasi;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use File;
use Auth;
use DateTime;
use Image;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use DB;
use Bugsnag;

class CreateController extends Controller
{
    static protected $lokasi_slug = "lab-pa";
    static protected $link = "labpa";

    public function create(Request $req)
    {
        if(!$this->APICreate($req))
            return back();
        return redirect('labpa');
    }

    public function APICreate($req,$status=0)
    {
        try {
            DB::connection('lab_pa')->beginTransaction();
            $new_transaction = new Transaction();
            $new_transaction->patient_id = $req['pasien'];
            $new_transaction->tarif_tipe_id = $req['tipe_layanan'];
            $new_transaction->no_bpjs = $req['no_bpjs'];
            if(!$req->tanpa_kasus)
            {
                $kasus = Kasus::find($req['kasus_id']);
                $lokasi = $kasus->lokasi->lokasi_id;
                $new_transaction->class = is_null($req['kelas_pasien']) ? $kasus->kelas_id : $req['kelas_pasien'];
                $new_transaction->kasus_id = $req['kasus_id'];
                $new_transaction->lokasi_id = $lokasi;
                $new_transaction->slug = $this->createSlug($req->input('asal_ruang'), $req->input('pasien'));
            }
            else
            {
                $new_transaction->no_sep = $req['no_sep'];
                $new_transaction->class = config('const.iii_ac');
                $new_transaction->slug = $this->createSlug('tanpa_kasus', $req->input('pasien'));                
                $new_transaction->nama_dokter = $req['nama_dokter'];
                $new_transaction->nama_rs = $req['nama_rs'];
            }

            $new_transaction->pasien_pembayaran_id = $req['pasien_pembayaran_id'];
            $new_transaction->keterangan = $req['keterangan'];
            $new_transaction->keterangan_permintaan = $req['keterangan_permintaan'];
            $new_transaction->kirim_kasir = (int)$req['kirim_kasir'];
            if(!is_null($req['tanggal_periksa'])){
                $new_transaction->inspected_at = $req['tanggal_periksa'];
                $new_transaction->inspected_at_by = Auth::user()->id;
                $new_transaction->inspected_at_created_at = Carbon::now();
            }

            $new_transaction->created_by = !empty($req->dokter) ? $req->dokter : Auth::user()->id;
            $new_transaction->save();
            $service_count = count($req['layanan']);
            for($i = 0; $i < $service_count; $i++)
            {

                $service_id = $req['layanan'][$i];
                if(!$this->create_detail($service_id, $new_transaction->id))
                {
                    DB::connection('lab_pa')->rollback();
                    return FALSE;
                }
            }

            if ($new_transaction->kirim_kasir == 1) {
                $detail = [];
                foreach ($new_transaction->detail as $item){
                    $detail_transaksi=$this->saveTagihanData($new_transaction, $item,$req->input('asal_ruang') ?? '');
                    array_push($detail,$detail_transaksi);
                }
                $piutang=app('App\Http\Controllers\LabPA\Transaction\PostController')->kirimKasir($new_transaction, $detail);
                $new_transaction->piutang_id = $piutang->id;
                $new_transaction->is_checkout = 1;
                $new_transaction->save();
            }
            elseif($status != 1) {
                foreach ($new_transaction->detail as $item) {
                    $detail_transaksi = $this->saveTagihanData($new_transaction, $item, $kasus->lokasi->lokasi_id);
                    $saveToTagihan = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($detail_transaksi);
                    $item->tagihan_detail_id = $saveToTagihan->id;
                    $item->save();
                }
            }

            DB::connection('lab_pa')->commit();
            return $new_transaction;
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('lab_pa')->rollback();
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
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return FALSE;
        }
    }

    public function createSlug($room, $id)
    {
        $room_name = Lokasi::find($room);
        if(!is_null($room_name))
            $room_name = $room_name->nama;
        else
            $room_name = $room;
        $current_time = str_replace(' ', '', Carbon::now()->toDateTimeString());
        $encrypted_room = Crypt::encryptString($id.$room_name);
        $slug = substr($encrypted_room, 1, 13).$current_time;
        return $slug;
    }   

    public function inspectCancel(Request $req, $slug)
    {
        try {
            $transaction = Transaction::where('slug', $slug)->first();
            $rejection = new Rejection();
            if($req->input('reason') == 'other')
                $rejection->reason = $req->input('other_reason');
            else
                $rejection->reason = $req->input('reason');
            $rejection->user_id = 1;        //DUMMY USER
            $rejection->transaction_id = $transaction->id;     //DUMMY TRANSACTION
            $rejection->save();
            Transaction::find($transaction->id)->unsearchable();
            if(Transaction::find($transaction->id)->delete())
                return redirect('labpa/transaksi')->with('success', 'Transaksi berhasil Dibatalkan');
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return redirect('labpa/transaksi/periksa/'.$slug)->with('error', 'Gagal Membatalkan Transaksi');
        }
    }

    private function checkService($service_id, $transaction_id)
    {
        try {
            $myservice = TransactionDetail::where('service_id', $service_id)->where('transaction_id', $transaction_id)->first();
            if($myservice)
            {
                $myservice->status = 'done';
            }
            else
            {
                $myservice = new TransactionDetail();
                $myservice->service_id = $service_id;
                $myservice->transaction_id = $transaction_id;
                $myservice->status = 'new';
            }
            $myservice->save();

            $this->insertTagihanKasus($myservice);

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return FALSE;
        }
        return TRUE;
    }

    private function insertTagihanKasus($service)
    {
        $tagihan = app('App\Http\Controllers\Kasus\Tagihan\CreateController')->create($service->transaction->kasus_id);


        $data = array();
        $data['desc'] = $service->transactionDetail_service->name;
        $data['qty'] = 1;
        $data['unit_price'] = $service->transactionDetail_service->fee;
        $data['nominal'] = $service->transactionDetail_service->fee;
        $data['daftar_harga_id'] = 0;
        
        $tagihan_detail = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->createTagihanDetail($tagihan->id,'LabPA',$data);
    }

    public function createPermintaan($services,$lokasi,$pasien_id,$kasus_id)
    {
        $new_transaction = new Transaction();
        $new_transaction->patient_id = $pasien_id;
        $new_transaction->room_source = $lokasi;
        $new_transaction->kasus_id = $kasus_id;
        $new_transaction->slug = $this->createSlug($lokasi, $pasien_id);
        $new_transaction->save();


        foreach($services as $service)
        {
            if(!$this->create_detail($service, $new_transaction->id))
            {
                $new_transaction->delete();
                $delete_detail = TransactionDetail::where('transaction_id', $new_transaction->id)->delete();
                return redirect('labpa/dummyreq')->with('status', 'Gagal Membuat Transaksi Baru');
            }
        }

        return $new_transaction->id;
    }

    private function sendtoMedify($file_url,$caption,$kasus_id)
    {
        $client = new Client(); //GuzzleHttp\Client


        $result = $client->post('http://localhost/medify/public/api/penunjang/hospital/create', [
            'form_params' => [
                'file_url' => $file_url,
                'judul' => $caption,
                'kasus_id' => $kasus_id
            ]
        ]);

    }


    private function sendToKasus($file_url,$title,$caption,$kasus_id,$file_type,$permintaan_id)
    {
        $item = app('App\Http\Controllers\Kasus\Penunjang\CreateController')
        ->createData($file_url,$title,$caption,$kasus_id,$file_type,'labpa',$permintaan_id);
    }

    public function createResult(Request $req)
    {
        $transaction = Transaction::where('slug', $req['transaction_slug'])->first();
        $transaction->result = $req['summary'];
        $detail_data = [];
        try {
            DB::connection('keuangan')->beginTransaction();
            DB::connection('kasus')->beginTransaction();
            DB::connection('lab_pa')->beginTransaction();
            $transaction->status = 1;
            $transaction->result_created_at = Carbon::now();
            $transaction->info = $req['info'];
            $transaction->diagnosis = $req['diagnosis'];
            $this->savePicture($req, $transaction->id, $transaction->kasus_id);
            $transaction->result_created_by = Auth::user()->id;
            $transaction->save();
            $data['tarif_tipe_id'] = $transaction->tarif_tipe_id;
            $data['tarif_kelas'] = $transaction->kelas->id;
            if(is_array(($req['batal_layanan'])))
                $this->deleteLayanan($req);     //BATALKAN LAYANAN KALAU ADA
            //FINDING CURRENT DETAIL TO BE UPDATED AS DONE

            $lokasi_id = \App\Models\Hospital\Lokasi::where('slug', self::$lokasi_slug)->first()->id;
            foreach((array)$req['layanan'] as $row){
                if(is_array(($req['batal_layanan'])) && in_array($row, $req['batal_layanan']))
                    continue;
                
                $detail = TransactionDetail::find($row);
                if($req['formDetail'][$row] != '0'){
                    $saveResult = $this->generateResult($row, $req);
                    $detail->result = $saveResult;
                }
                $detail->lokasi = $req['lokasi'][$row];
                $detail->kode_sediaan = $req['kode_sediaan'][$row];
                $detail->slide = $req['slide'][$row];
                $detail->qty = 1;
                $detail->status = "done";
                $detail->save();
            }
            //CHECK IF THERE'S ANY ADDITION DETAIL TO BE
            foreach((array)$req['new_layanan'] as $key => $new_tarif_id){
                if($new_tarif_id == 0){
                    continue;
                }
                $detail = $this->create_detail($new_tarif_id, $transaction->id);
                if($req['formDetailBaru'][$key] != '0'){
                    $saveResult = $this->generateResult('Baru'.$key, $req, 'baru');
                    $detail->result = $saveResult;
                }
                $detail->lokasi = $req['new_lokasi'][$key];
                $detail->kode_sediaan = $req['new_kode_sediaan'][$key];
                $detail->slide = $req['new_slide'][$key];
                $detail->status = "ask";
                $detail->qty = 1;

                $detail->save();
            }
            if($transaction->kirim_kasir && count($detail_data)){
                app('App\Http\Controllers\LabPA\Transaction\PostController')->kirimKasir($transaction, $detail_data);
            }
            $transaction->is_checkout = 1;
            $transaction->save();
            DB::connection('keuangan')->commit();
            DB::connection('kasus')->commit();
            DB::connection('lab_pa')->commit();
            return redirect('labpa/transaksi/hasil/'.$req['transaction_slug'])
            ->with('status', "success")
            ->with('title', 'Berhasil')
            ->with('success', 'Hasil berhasil diunggah');
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('keuangan')->rollback();
            DB::connection('kasus')->rollback();
            DB::connection('lab_pa')->rollback();
            return back()
            ->with('status', "error")
            ->with('title', 'Gagal')
            ->with('success', 'Hasil gagal diunggah');
        }
    }

    public function deleteLayanan($req)
    {
        foreach ($req['batal_layanan'] as $key => $val) {
            TransactionDetail::find($val)->delete();
        }
        return true;
    }

    public function generateResult($detailId, $req, $tipe='lama'){
        try {
            if($tipe == 'lama')
                $tipe = $req['formDetail'][$detailId];
            else{
                $tipe = $req['formDetailBaru'][substr($detailId, 4)];
            }
            if($tipe == 'papsmear'){
                $result['jenis_form'] = 'papsmear';
                $result['sitologi_class'] = isset($req['papsmearClass'][$detailId]) ? $req['papsmearClass'][$detailId] : null;
                $result['sitologi_infection'] = isset($req['papsmearInfection'][$detailId]) ? $req['papsmearInfection'][$detailId] : null;
                $result['sitologi_specimen'] = isset($req['papsmearSpecimen'][$detailId]) ? $req['papsmearSpecimen'][$detailId] : null;
                $result['sitologi_reactive'] = isset($req['papsmearReactive'][$detailId]) ? $req['papsmearReactive'][$detailId] : null;
                $result['sitologi_general'] = isset($req['papsmearGeneral'][$detailId]) ? $req['papsmearGeneral'][$detailId] : null;
                $result['kesimpulan'] = $req['kesimpulan'][$detailId] ?? null;
            } else{
                $result['jenis_form'] = $tipe;
                $result['makroskopis'] = $req['makroskopis'][$detailId] ?? null;
                $result['mikroskopis'] = $req['mikroskopis'][$detailId] ?? null;
                $result['kesimpulan'] = $req['kesimpulan'][$detailId] ?? null;
            }
            $result = json_encode($result);
            return $result;
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return FALSE;
        }
    }

    private function createFilename($name,$public_folder,$ext)
    {
        //slug filename
        $filename = $name;
        $filename = preg_replace('~[^\pL\d]+~u', '-', $filename);
        $filename = iconv('utf-8', 'us-ascii//TRANSLIT', $filename);// transliterate
        $filename = preg_replace('~[^-\w]+~', '', $filename); // remove unwanted characters
        $filename = trim($filename, '-'); // trim
        $filename = preg_replace('~-+~', '-', $filename); // remove duplicate -
        $filename = strtolower($filename); // lowercase
        $filename_check = $filename;
        $i = 2;

        //if file exist change name;
        while(file_exists( $public_folder .'/'. $filename_check .'.'. $ext)) {
            $filename_check = $filename;
            $filename_check.= $i;
            $i++;
        }

        $filename = $filename_check;

        return $filename;
    }
    
    public function uploadPicture(Request $request)
    {
        //PREPARE FOLDER
        $now_date = Carbon::now()->toDateString();
        $public_folder = public_path('uploads/labpa/'.$now_date."/");
        $picturePath = 'uploads/labpa/'.$now_date.'/';
        $folder = 'labpa/temp';
        if(!file_exists($public_folder))
            mkdir($public_folder, 0777, true);

        $image = $request->file('file');
        $extension = strtolower($image->getClientOriginalExtension());
        $proposedName = substr($request['target'], 0, 13).time().'0'.$request['fileNumber'];
        
        $filename = $this->createFilename($proposedName, $public_folder, $extension);
        $transaction = Transaction::where('slug', $request['target'])->first();

         //store local storage
        $upload_success = $image->storeAs($folder, $filename.".".$extension);
        // If the upload is successful, return the name of directory/filename of the upload.
        if ($upload_success) {            
            //move to public path (dest,source)
            $new_path = $request->file->move($public_folder, $upload_success);
            $photo = new Photo();
            $photo->transaction_id = $transaction->id;
            $photo->type = $extension;
            $photo->hash = $request['saltPict'];
            $photo->status = 0;
            $photo->path = $picturePath.$filename.".".$extension;
            $photo->save();
            return response()->json($photo->id, 200);
        }
        // Else, return error 400
        else {
            return response()->json('error', 400);
        }
    }

    private function savePicture($req, $transaction_id, $kasus_id)
    {
        $photos = Photo::where('hash', $req['saltForm'])->where('status', 0)->where('transaction_id',$transaction_id)->get();
        $now_date = Carbon::now()->toDateString();
        try {
            $i = 0;
            foreach($photos as $item){
                $item->status = 1;
                $item->title = $req['judul'][$i];
                $item->caption = $req['caption'][$i];
                $item->created_by = Auth::user()->id;
                $data_image = app('App\Http\Controllers\Functions\FileUploader')->createThumbnail($now_date, $item->path, self::$link);
                $item->thumbnail_path = $data_image['path'];
                $item->type = $data_image['type'];                
                $item->save();
                // if(!is_null($kasus_id)){
                //     $penunjang = app('App\Http\Controllers\Kasus\Penunjang\CreateController')->createData($item->path, $item->title, $item->caption, $kasus_id, 0, "labpa", $transaction_id);
                // }
                $i++;
            }
            if($this->cleanPhotos($req['saltForm'], $transaction_id))
                return TRUE;
            return FALSE;
        } catch (\Exception $e) {
            if(config('app.debug'))

                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return FALSE;
        }
    }

    public function cleanPhotos($hash, $transaction_id)
    {
        $folder = public_path();
        try {
            $photos = Photo::where('hash', '!=', $hash)->where('status', 0)->where('transaction_id',$transaction_id)->get();       
            foreach($photos as $item) {
                if(file_exists($item->path)) //DEVELOPMENT NEEDS
                unlink($folder.'/'.$item->path);
                $item->delete();
            }
        } catch (\Exception $e) {
            if(config('app.debug'))

                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return FALSE;
        }
        return TRUE;
    }
    
    public function deletePicture(Request $req){
        $target = $req['id'];
        $folder = public_path();
        try {
            $photo = Photo::find($target);
            unlink($folder.'/'.$photo->path);
            $photo->delete();
            return response()->json('success', 200);
        } catch (\Exception $e) {
            if(config('app.debug'))

                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return response()->json('failed', 500);
        }

    }

    public function saveTagihanData($transaction, $detail, $lokasi_id){
        $data['transaction_detail_id'] = $detail->id;
        $data['kasus_id'] = $transaction->kasus_id;
        $data['desc'] = $detail->tarif->deskripsi;
        $data['lokasi'] = $lokasi_id;
        $data['tarif_tipe_id'] = $transaction->tarif_tipe_id;
        $data['tarif_kelas_id'] = $transaction->kelas->id;
        $data['tarif_kelas'] = $transaction->kelas->id;
        $data['unit_price'] = $detail->harga;
        $data['qty'] = $detail->qty ?? 1;
        $data['daftar_harga_id'] = null;
        $data['tarif_id'] = $detail->tarif_id;
        $data['tarif'] = $detail->tarif_harga;

        $data['sep_id'] = $transaction->sep;
        return $data;
    }
}