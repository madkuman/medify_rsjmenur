<?php

namespace App\Http\Controllers\LabPK\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\Transaksi;
use App\Models\LabPK\TransaksiDetail;
use App\Models\LabPK\TransaksiSpesimen;
use App\Models\LabPK\Dokumen;
use App\Models\LabPK\Hasil;
use App\Models\LabPK\HasilTransfusi;
use App\Models\LabPK\Result;
use App\Models\LabPK\ErrorLIS;
use App\Models\LabPK\LaporanRekap;
use App\Models\Kasus\Kasus;
use App\Models\Hospital\Lokasi;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifMaster;
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
    static protected $link = "labpk";
    static protected $lokasi_slug = "lab-pk";


    /*TAMBAH TRANSAKSI*/
    public function create(Request $req)
    {
        $create = $this->APICreate($req);
        if(isset($create['status']) && $create['status'] == FALSE)
            return back()->with('status', 'error')
        ->with('title', 'Gagal')
        ->with('message', 'Gagal membuat permintaan');
        return redirect('labpk');
    }

    /*TAMBAH TRANSAKSI*/
    public function APICreate($req,$status=0)
    {
        try {
            DB::connection('lab_pk')->beginTransaction();
            $new_transaction = new Transaksi();
            $new_transaction->pasien_id = $req['pasien'];
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
                $new_transaction->class = $req['kelas_pasien'];
                $new_transaction->slug = $this->createSlug('tanpa_kasus', $req->input('pasien'));                
                $new_transaction->nama_dokter = $req['nama_dokter'];
                $new_transaction->nama_rs = $req['nama_rs'];
                $new_transaction->dokter_perujuk = $req['dokter_perujuk'];
            }
            $new_transaction->pasien_pembayaran_id = $req['pasien_pembayaran_id'];
            $new_transaction->keterangan = $req['keterangan'];
            $new_transaction->keterangan_permintaan = $req['keterangan_permintaan'];
            $new_transaction->kirim_kasir = (int)$req['kirim_kasir'];
            if(!is_null($req['tanggal_periksa'])){
                $new_transaction->inspected_at = $req['tanggal_periksa'];
                $new_transaction->inspected_at_by = Auth::user()->id;
                $new_transaction->inspected_at_created_at = Carbon::now();
            } else {
                $new_transaction->inspected_at = Carbon::now();
            }
            
            $new_transaction->created_by = !empty($req->dokter) ? $req->dokter : Auth::user()->id;
            $new_transaction->save();
            $service_count = count($req['layanan']);
            for($i = 0; $i < $service_count; $i++)
            {

                $service_id = $req['layanan'][$i];
                if(!$this->create_detail($service_id, $new_transaction->id))
                {
                    DB::connection('lab_pk')->rollback();
                    return FALSE;
                }
            }
            if(isset($req['spesimen_mikrobiologi'])){
                $spesimen_count = count($req['spesimen_mikrobiologi']);
                for($i = 0; $i < $spesimen_count; $i++)
                {

                    $spesimen_id = $req['spesimen_mikrobiologi'][$i];
                    $keterangan = $req['spesimen_mikrobiologi_keterangan'][$spesimen_id] ?? '';
                    if(!$this->createSpesimen($spesimen_id, $new_transaction->id,$keterangan))
                    {
                        DB::connection('lab_pk')->rollback();
                        return FALSE;
                    }
                }
            }

            if(config('app.lis_enable')){
                $LISResult = app('App\Http\Controllers\LabPK\LIS\PostController')->order($new_transaction);
                if($LISResult['result']->RC != "0000"){
                    DB::connection('lab_pk')->rollback();
                    $errorLIS = new ErrorLIS;
                    $errorLIS->kasus_id = $req['kasus_id'] ?? 0;
                    $errorLIS->pasien_id = $req['pasien_id'];
                    $errorLIS->payload = $LISResult['payload'];
                    $errorLIS->created_by = !empty($req['dokter']) ? $req['dokter'] : Auth::user()->id;
                    $errorLIS->save();
                    return ['status' => FALSE,
                    'origin' => "LIS"];
                }
                $new_transaction->no_lab = $LISResult['result']->ORDER_NO;
                $new_transaction->barcode = json_encode($LISResult['result']->BARCODE);
                $new_transaction->save();
            }

            $lokasi_labpk = \App\Models\Hospital\Lokasi::where('slug', 'lab-pk')->first();

            if ($new_transaction->kirim_kasir == 1) {
                $detail = [];
                foreach ($new_transaction->detail as $item){
                    $detail_transaksi=$this->saveTagihanData($new_transaction, $item, $lokasi_labpk->id ?? "");
                    array_push($detail,$detail_transaksi);
                }
                $piutang = app('App\Http\Controllers\LabPK\Transaksi\PostController')->kirimKasir($new_transaction, $detail);
                $new_transaction->piutang_id = $piutang->id;
                $new_transaction->is_checkout = 1;
                $new_transaction->save();
            } elseif($status != 1) {
                foreach ($new_transaction->detail as $item) {
                    $detail_transaksi=$this->saveTagihanData($new_transaction, $item, $lokasi_labpk->id ?? "");
                    $saveToTagihan = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($detail_transaksi);
                    $item->tagihan_detail_id = $saveToTagihan->id;
                    $item->save();
                }
            }

            DB::connection('lab_pk')->commit();
            return $new_transaction;
        } catch (\Exception $e) {
            if(isset($LISResult))
                app('App\Http\Controllers\Error\Handler')->bugsnag($e, TRUE, $LISdata);
            else
                app('App\Http\Controllers\Error\Handler')->bugsnag($e);                
            DB::connection('lab_pk')->rollback();

            return FALSE;
        }
    }

    public function create_detail($service, $transaction_id)
    {
        try {
            $new_detail = new TransaksiDetail();
            $new_detail->transaksi_id = $transaction_id;
            $new_detail->tarif_id = $service;
            $encryptedTime = Crypt::encryptString(str_replace(' ', '', Carbon::now()->toDateTimeString()));
            $encryptedId = Crypt::encryptString($transaction_id);
            $new_detail->slug = substr($encryptedId, 0, 5).substr($encryptedTime, 0, 15);
            
            if($new_detail->save())
                return $new_detail;
            return FALSE;
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return FALSE;
        }
    }

    public function createSpesimen($spesimen_id, $transaction_id,$keterangan)
    {
        try {
            $new_detail = new TransaksiSpesimen;
            $new_detail->transaksi_id = $transaction_id;
            $new_detail->spesimen_id = $spesimen_id;
            $new_detail->keterangan = $keterangan;
            if($new_detail->save())
                return TRUE;
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
                $delete_detail = TransactionDetail::where('transaksi_id', $new_transaction->id)->delete();
                return redirect('labpk/dummyreq')->with('status', 'Gagal Membuat Transaksi Baru');
            }
        }

        return $new_transaction->id;
    }


    private function sendToKasus($file_url,$title,$caption,$kasus_id,$file_type,$permintaan_id)
    {
        $item = app('App\Http\Controllers\Kasus\Penunjang\CreateController')
        ->createData($file_url,$title,$caption,$kasus_id,$file_type,'labpk',$permintaan_id);
    }

    public function createResult(Request $req)
    {
        $transaction = Transaksi::where('slug', $req['transaction_slug'])->first();
        try {
            DB::connection('kasus')->beginTransaction();
            DB::connection('keuangan')->beginTransaction();
            DB::connection('lab_pk')->beginTransaction();

            $transaction->catatan = $req['catatan'];
            $transaction->jam_diperiksa = $req['jam_diperiksa'];
            $transaction->jam_selesai = $req['jam_selesai'];
            $transaction->spesimen_terima_keterangan = $req['spesimen_terima_keterangan'];
            $transaction->status = 1;
            $transaction->diagnosis = $req['diagnosis'];
            $transaction->result_created_at = Carbon::now();
            $transaction->gol_darah = $req['gol_darah'];
            $transaction->infeksi_mdr = $req['infeksi_mdr'];
            $transaction->infeksi_karbapenemase = $req['infeksi_karbapenemase'];
            $transaction->infeksi_esbl = $req['infeksi_esbl'];
            $transaction->infeksi_aureus = $req['infeksi_aureus'];
            $this->savePicture($req, $transaction->id, $transaction->kasus_id);
            //CHECK BUAT BIKIN TRANSFUSI
            if(isset($req->tanggal))
                $this->saveTransfusi($req, $transaction->id);
            $transaction->result_created_by = $req['result_created_by'] ?? Auth::user()->id;
            $transaction->verified_by = $req['verified_by'];
            $data['tarif_kelas'] = $transaction->kelas->id;
            $transaction->save();
            $detail_data = $this->saveDetailResult($req, $transaction);
            app('App\Http\Controllers\LabPK\Transaksi\EditController')->generateFile($transaction);
            DB::connection('keuangan')->commit();
            DB::connection('kasus')->commit();
            DB::connection('lab_pk')->commit();
            return redirect('labpk/transaksi/hasil/'.$req['transaction_slug'])
            ->with('status', 1)
            ->with('title', 'Berhasil')
            ->with('success', 'Hasil berhasil diunggah');


        } catch (\Exception $e) {
            DB::connection('keuangan')->rollback();
            DB::connection('kasus')->rollback();
            DB::connection('lab_pk')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return back()
            ->with('status', -1)
            ->with('title', 'Gagal')
            ->with('success', 'Hasil gagal diunggah');

        }
    }

    public function saveDetailResult($req, $transaction)
    {
        try {
            $data['tarif_tipe_id'] = $transaction->tarif_tipe_id;
            $data['tarif_kelas'] = $transaction->kelas->id;
            $counter = 0;
            $detail_data = [];
            $pasien_pembayaran_perusahaan = $transaction->pembayaran->perusahaan_id;
            $lokasi_departemen = $transaction->asal->lokasi_departemen_id ?? 0;
            
            $lokasi_id = \App\Models\Hospital\Lokasi::where('slug', self::$lokasi_slug)->first()->id;
            foreach((array)$req['layanan'] as $row){

                $transaksi_detail = TransaksiDetail::find($row);
                $tarif = TarifMaster::find($req['layanan_id'][$row]);
                
                $keterangan_result = 'normal';

                $form_created = $transaksi_detail->transaksi->created_at;
                $pasien_tgl_lahir = $transaksi_detail->transaksi->pasien->date_of_birth;
                $pasien_tgl_lahir = Carbon::parse($pasien_tgl_lahir);
                $px_usia = $form_created->diffInYears($pasien_tgl_lahir);
                $px_gender = $transaksi_detail->transaksi->pasien->gender;

                $result = [];

                foreach($tarif->labpk_form_tarif as $form_tarif){
                    $form_type = $form_tarif->form->type ?? null;
                    if ($form_type == null) continue;
                    $form = $form_tarif->form;
                    $keterangan_result_temp = 'normal';
                    if($form_type == 'parameter-number' || $form_type == 'parameter-text' || $form_tarif->form->type == 'parameter-number-greatherthan' || $form_tarif->form->type == 'parameter-number-lessthan')
                    {
                        foreach($form_tarif->form->detail as $form_detail){

                            if(($form_detail->jk_pria && $px_gender == 1) || ($form_detail->jk_wanita && $px_gender != 1))
                            {
                                if($form_detail->usia_min <= $px_usia && $form_detail->usia_max >= $px_usia)
                                {


                                    $hasil =  new Hasil;
                                    $hasil->transaksi_detail_id = $transaksi_detail->id;
                                    $hasil->form_detail_id = $form_detail->id;
                                    $hasil->form_type = $form->type;
                                    $hasil->parameter = $form->parameter;
                                    $hasil->satuan = $form->satuan;
                                    $hasil->value = $req['form_'.$transaksi_detail->slug.'_'.str_replace(' ', '_', $form_detail->id)];


                                    $keterangan_result_temp = 'normal';
                                    
                                    if($form_tarif->form->type == 'parameter-number')
                                    {
                                        $hasil->referensi_max = $form_detail->referensi_max;
                                        $hasil->referensi_min = $form_detail->referensi_min;
                                        $hasil->kritis_min = $form_detail->kritis_min;
                                        $hasil->kritis_max = $form_detail->kritis_max;


                                        if(!empty($form_detail->kritis_max) && $hasil->value > $form_detail->kritis_max) 
                                            $keterangan_result_temp = 'kritis';
                                        elseif(!empty($form_detail->kritis_min) && $hasil->value < $form_detail->kritis_min)
                                            $keterangan_result_temp = 'kritis';
                                        elseif(!empty($form_detail->referensi_min) && $hasil->value < $form_detail->referensi_min)
                                            $keterangan_result_temp = 'bahaya';
                                        elseif(!empty($form_detail->referensi_max) && $hasil->value > $form_detail->referensi_max)
                                            $keterangan_result_temp = 'bahaya';

                                    }
                                    elseif ($form_tarif->form->type == 'parameter-number-greatherthan')
                                    {
                                        $hasil->referensi_min = $form_detail->referensi_min;
                                        $hasil->kritis_min = $form_detail->kritis_min;
                                        if(!empty($form_detail->kritis_min) && $hasil->value <= $form_detail->kritis_min){
                                            $keterangan_result_temp = 'kritis';
                                        }
                                    }
                                    elseif ($form_tarif->form->type == 'parameter-number-lessthan')
                                    {
                                        $hasil->referensi_max = $form_detail->referensi_max;
                                        $hasil->kritis_max = $form_detail->kritis_max;
                                        if(!empty($form_detail->kritis_max) && $hasil->value > $form_detail->kritis_max){
                                            $keterangan_result_temp = 'kritis';
                                        }
                                    }
                                    elseif($form_tarif->form->type == 'parameter-text')
                                    {
                                        $hasil->referensi_lainnya = $form_detail->referensi_lainnya;

                                        if(!empty($form_detail->referensi_lainnya) && slug($hasil->value) != slug($form_detail->referensi_lainnya)) 
                                            $keterangan_result_temp = 'bahaya';
                                    }
                                    
                                    $hasil->metode = $form->metode;

                                    
                                    $hasil->keterangan_result = $keterangan_result_temp;
                                    $hasil->created_by = Auth::user()->id;
                                    $hasil->save();
                                }
                            }
                        }
                    }
                    else
                    {
                        $hasil =  new Hasil;
                        $hasil->transaksi_detail_id = $transaksi_detail->id;
                        $hasil->form_id = $form->id;
                        $hasil->form_type = $form->type;
                        $hasil->parameter = $form->parameter;
                        $hasil->value = $req['form_text_'.$transaksi_detail->slug.'_'.str_replace(' ', '_', $form->id)];
                        $keterangan_result_temp = 'normal';
                        $hasil->keterangan_result = $keterangan_result_temp;
                        $hasil->created_by = Auth::user()->id;
                        $hasil->save();
                    }

                    if($keterangan_result_temp == 'kritis'){
                        $keterangan_result = 'kritis';
                    } 
                    elseif($keterangan_result_temp == 'bahaya' && $keterangan_result != 'kritis'){
                        $keterangan_result = 'bahaya';
                    }
                    elseif($keterangan_result != 'kritis' && $keterangan_result != 'bahaya'){
                        $keterangan_result = 'normal';
                    }
                }

                if($transaksi_detail->status == "ask")
                {
                    $rekap = new LaporanRekap;
                    $rekap->transaksi_id = $transaction->id;
                    $rekap->tarif_id = $transaksi_detail->tarif_id;
                    $rekap->pasien_pembayaran_perusahaan = $pasien_pembayaran_perusahaan;
                    $rekap->lokasi_departemen = $lokasi_departemen;
                    $rekap->result_created_at = $transaction->result_created_at;
                    $rekap->save();
                }
                $transaksi_detail->keterangan_result = $keterangan_result;
                $transaksi_detail->qty = 1;
                $transaksi_detail->done = 1;
                $transaksi_detail->status = "done";
                $transaksi_detail->save();
                $counter++;
            }
            return $detail_data;
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    public function createFilename($name,$public_folder,$ext)
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
        $public_folder = public_path('uploads/labpk/'.$now_date."/");
        $picturePath = 'uploads/labpk/'.$now_date.'/';
        $folder = 'labpk/temp';
        if(!file_exists($public_folder))
            mkdir($public_folder, 0777, true);

        $image = $request->file('file');
        $extension = strtolower($image->getClientOriginalExtension());
        $proposedName = substr($request['target'], 0, 13).time().'0'.$request['fileNumber'];
        
        $filename = $this->createFilename($proposedName, $public_folder, $extension);
        $transaction = Transaksi::where('slug', $request['target'])->first();

         //store local storage
        $upload_success = $image->storeAs($folder, $filename.".".$extension);
        // If the upload is successful, return the name of directory/filename of the upload.
        if ($upload_success) {            
            //move to public path (dest,source)
            $new_path = $request->file->move($public_folder, $upload_success);
            $photo = new Dokumen();
            $photo->transaksi_id = $transaction->id;
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
        $photos = Dokumen::where('hash', $req['saltForm'])->where('status', 0)->where('transaksi_id',$transaction_id)->get();
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
            $photos = Dokumen::where('hash', '!=', $hash)->where('status', 0)->where('transaksi_id',$transaction_id)->get();       
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
            $photo = Dokumen::find($target);
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
        $data['kasus_id'] = $transaction->kasus_id;
        $data['desc'] = $detail->tarif->deskripsi;
        $data['lokasi'] = $lokasi_id;
        $data['tarif_tipe_id'] = $transaction->tarif_tipe_id;
        $data['tarif_kelas_id'] = $transaction->kelas->id;
        $data['tarif_kelas'] = $transaction->kelas->id;
        $data['unit_price'] = $detail->harga;
        $data['qty'] = 1;
        $data['daftar_harga_id'] = null;
        $data['tarif_id'] = $detail->tarif_id;
        $data['tarif'] = $detail->tarif_harga;

        $data['sep_id'] = $transaction->sep;
        return $data;
    }

    private function saveTransfusi($req, $transaksi_id)
    {
        $creator = Auth::user()->id;
        
        foreach($req->tanggal as $i => $t)
        {
            $hasil = new HasilTransfusi;
            $hasil->transaksi_id = $transaksi_id;
            $hasil->tanggal = date('Y-m-d', strtotime($t));
            $hasil->jam = $req->jam[$i];
            $hasil->no_kantong = $req->no_kantong[$i];
            $hasil->no_slang = $req->no_slang[$i];
            $hasil->jenis_darah = $req->jenis_darah[$i];
            $hasil->gol_darah = $req->golongan_darah[$i];
            $hasil->rhesus = $req->rhesus[$i];
            $hasil->hasil_cross = $req->hasil_cross[$i];
            $hasil->pemberi = $req->pemberi[$i];
            $hasil->penerima = $req->penerima[$i];
            $hasil->created_by = $creator;
            $hasil->save();
        }
    }
}