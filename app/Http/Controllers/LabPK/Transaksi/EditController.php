<?php

namespace App\Http\Controllers\LabPK\Transaksi;

use App\Models\Kasus\Penunjang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\Transaksi;
use App\Models\LabPK\TransaksiDetail;
use App\Models\FrontOffice\Patients;
use App\Models\LabPK\HasilTransfusi;
use App\Models\LabPK\PemeriksaanHasil;
use App\Models\LabPK\Pemeriksaan;
use App\Models\LabPK\Hasil;
use App\Models\LabPK\Dokumen;
use App\Models\LabPK\LaporanRekap;
use App\Models\Keuangan\Tarif;
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
    static protected $link = "labpk";
    static protected $lokasi_slug = "lab-pk";

    public function updateResult(Request $req, $transaction_slug)
    {
        $transaction = Transaksi::where('slug', $transaction_slug)->first();
        try {
            DB::connection('lab_pk')->beginTransaction();
            DB::connection('kasus')->beginTransaction();
            $date = explode(' ', $transaction->result_created_at)[0];
            $this->updatePicture($req, $transaction->id, $transaction->kasus_id);
            $transaction->result_created_by = $req['result_created_by'] ?? Auth::user()->id;
            $transaction->verified_by = $req['verified_by'] ?? Auth::user()->id;
            $transaction->gol_darah = $req['gol_darah'];
            $transaction->diagnosis = $req['diagnosis'];
            $transaction->infeksi_mdr = $req['infeksi_mdr'];
            $transaction->infeksi_karbapenemase = $req['infeksi_karbapenemase'];
            $transaction->infeksi_esbl = $req['infeksi_esbl'];
            $transaction->infeksi_aureus = $req['infeksi_aureus'];
            $transaction->save();
            $transaksi_detail_ids = TransaksiDetail::where('transaksi_id',$transaction->id)->pluck('id')->toArray();
            Hasil::whereIn('transaksi_detail_id',$transaksi_detail_ids)->delete();
            app('App\Http\Controllers\LabPK\Transaksi\CreateController')->saveDetailResult($req, $transaction);

            $this->generateFile($transaction);
            if($transaction->verified_at){
                Penunjang::where('type',self::$link)->where('penunjang_permintaan_id',$transaction->id)->delete();
                $this->sendFileHasil($transaction);
            }


            if(isset($req->tanggal))
                $this->updateTransfusi($req, $transaction->id);
            DB::connection('kasus')->commit();
            DB::connection('lab_pk')->commit();
            return redirect('labpk/transaksi/hasil/'.$transaction_slug)
                    ->with('status', 'success')
                    ->with('title', 'Berhasil')
                    ->with('message', 'Hasil berhasil diupdate');
        } catch (\Exception $e) {
            DB::connection('kasus')->rollback();
            DB::connection('lab_pk')->rollback();                
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return back()
                    ->with('status', 'error')
                    ->with('title', 'Gagal')
                    ->with('message', 'Hasil gagal diupdate');
        }
    }

    private function updatePicture($req, $transaction_id, $kasus_id)
    {
        $date = Carbon::now()->toDateString();
        $photos = Dokumen::where('hash', $req['saltForm'])->where('status', 0)->get();
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
                if(!is_null($kasus_id))
                    $penunjang = app('App\Http\Controllers\Kasus\Penunjang\CreateController')->createData('labpk/'.$item->path, $item->title, $item->caption, $kasus_id, 0, "labpk", $transaction_id);
                $i++;
            }
            if(app('App\Http\Controllers\LabPK\Transaksi\CreateController')->cleanPhotos($req['saltForm'], $transaction_id)){
                if($this->deletePhotos($req['deletedPhoto']))
                    return TRUE;
            }
            return FALSE;
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            if(config('app.debug'))
                
            return FALSE;
        }
    }

    private function deletePhotos($target)
    {
        $folder = public_path();
        try {
            if($target){
                foreach($target as $row){
                    $photo = Dokumen::find($row);
                    if(empty($photo)){
                        if(config('app.debug'))
                            dd("Foto hilang");            
                        return FALSE;
                    }
                    $target_folder = $folder.'/'.$photo->path;
                    if(file_exists($folder.'/'.$photo->path)) //DEVELOPMENT NEEDS
                        unlink($target_folder);
                    $photo->delete();
                }
            }
            return TRUE;
        } catch (\Exception $e) {
            if(config('app.debug'))
                
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return FALSE;
        }
    }

    public function editInspectionDate(Request $req, $slug){
        try {
            $transaction = Transaksi::where('slug', $slug)->first();
            $transaction->inspected_at = $req['tanggal_periksa'];
            $transaction->inspected_at_by = Auth::user()->id;
            $transaction->inspected_at_created_at = Carbon::now();
            if($transaction->save())
                return redirect('labpk/transaksi/permintaan/'.$slug);
        } catch (\Exception $e) {
            if(config('app.debug'))
                
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return redirect('labpk/transaksi/permintaan/'.$slug);
        }
    }

    public function editSEPNumber(Request $req, $slug){
        try {
            $transaction = Transaksi::where('slug', $slug)->first();
            $transaction->sep = $req['sep_number'];
            if($transaction->save())
                return redirect('labpk/transaksi/permintaan/'.$slug);
        } catch (\Exception $e) {
            if(config('app.debug'))
                
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return redirect('labpk/transaksi/permintaan/'.$slug);
        }
    }

    public function updatePenunjang(Request $req){
        try {
            $photo = Dokumen::find($req['id']);
            $photo->title = $req['live_title'];
            $photo->caption = $req['live_caption'];
            $photo->updated_by = Auth::user()->id;
            if($req['live_check'] == 'true'){
                $photo->verified_by = Auth::user()->id;
                $photo->verified_at = Carbon::now()->toDateTimeString();
            }
            $transaction = Transaksi::find($photo->transaksi_id);
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
                return redirect()->back();
            }
        } catch (\Exception $e) {
            if(config('app.debug'))
                
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return redirect()->back();
        }
    }

    public function verifikasi(Request $req, $slug){
        try {
            DB::connection('lab_pk')->beginTransaction();
            $transaksi = Transaksi::where('slug', $slug)->first();
            //$transaksi->verified_by = Auth::user()->id;
            $transaksi->verified_at = Carbon::now()->toDateTimeString();
            $transaksi->save();
            $this->generateFile($transaksi);
            $this->sendFileHasil($transaksi);
            DB::connection('lab_pk')->commit();

            return redirect()->back()->with('success', 'Transaksi berhasil diverifikasi');
        } catch (\Exception $e) {
            DB::connection('lab_pk')->rollback();               
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return redirect()->back();            
        }
    }

    public function generateFile($transaksi)
    {
        $now_date = Carbon::now()->toDateString();
        $now_timestamp = Carbon::now()->format('d-m-Y-H-i-s');
        $today = Carbon::now()->format('d-m-Y');
        $path = "uploads/labpk/result/".$now_date."/";
        $path_public = public_path($path);
        if(!file_exists($path_public)){
            mkdir($path_public, 0777, true);
        }

        $dokumen = Dokumen::whereNull('hash')->where('transaksi_id',$transaksi->id)->get();

        foreach ($dokumen as $item)
        {
            if(!is_null($item->penunjang_id)){
                $delete = app('App\Http\Controllers\Kasus\Penunjang\DeleteController')->delete($item->penunjang_id);
            }
            $item->delete();
        }

        $data['transaksi'] = $transaksi;
        $data['hasil'] = [];
        $data['result_parameter'] =[];
        $data['result_text']=[];
        $data['verifikator_nama'] = Auth::user()->name;
        $jumlah = 0;
        $pasien_name = str_replace('/','-',$transaksi->pasien->name);
        foreach($transaksi->detail as $detail)
        {
            $hasil = $detail;
            $result_parameter = Hasil::where('transaksi_detail_id',$detail->id)->whereIn('form_type',['parameter-number','parameter-text','parameter-number-greatherthan','parameter-number-lessthan'])->get();
            $result_text = Hasil::where('transaksi_detail_id',$detail->id)->whereNotIn('form_type',['parameter-number','parameter-text','parameter-number-greatherthan','parameter-number-lessthan'])->get();
            if($detail->tarif->kategori->slug != 'lab-pk-mikrobiologi'){
                $jumlah += count($result_text) + count($result_parameter) + 1;
                $data['hasil'][] = $hasil;
                $data['result_parameter'][]=$result_parameter;
                $data['result_text'][]=$result_text;
            }
            else{
                $data_mikrobiolgi['transaksi'] = $transaksi;
                $data_mikrobiolgi['verifikator_nama'] = Auth::user()->name;
                $data_mikrobiolgi['hasil'] = $hasil;
                $data_mikrobiolgi['result_parameter'] = $result_parameter;
                $data_mikrobiolgi['result_text'] = $result_text;
                $data_mikrobiolgi['jumlah'] = count($result_text) + count($result_parameter);
                $pdf = DOMPDF::loadView('labpk.laporan.print-hasil-mikrobiologi', $data_mikrobiolgi)->setPaper('A4', 'fullpage');
                $filename = $now_timestamp.'_'.$transaksi->pasien->no_rm.'_'.$detail->slug.'.pdf';
                $pdf->save($path_public.$filename);
                $file_path = $path.$filename;

                $data_file = app('App\Http\Controllers\Functions\FileUploader')->createThumbnail($now_date, $file_path, self::$link);

                $dokumen = new Dokumen;
                $dokumen->transaksi_id = $transaksi->id;
                $dokumen->title = $detail->tarif->deskripsi.'__'.$today;
                $dokumen->caption = '';
                $dokumen->path = $file_path;
                $dokumen->type = 'pdf';
                $dokumen->thumbnail_path = $data_file['path'];
                $dokumen->status = 1;
                $dokumen->created_by = $detail->created_by;
                $dokumen->verified_by = $transaksi->verified_by;
                $dokumen->verified_at = $transaksi->verified_at;
                $dokumen->save();

                $detail->dokumen_id = $dokumen->id;
                $detail->save();
            }
        }

        if($jumlah > 0){
            $data['jumlah'] = $jumlah;
            $pdf = DOMPDF::loadView('labpk.laporan.print-hasil', $data)->setPaper('A4', 'fullpage');
            $filename = $now_timestamp.'_'.$transaksi->pasien->no_rm.'_'.$pasien_name.'_laboratorium.pdf';
            $pdf->save($path_public.$filename);
            $file_path = $path.$filename;

            $data_file = app('App\Http\Controllers\Functions\FileUploader')->createThumbnail($now_date, $file_path, self::$link);

            $dokumen = new Dokumen;
            $dokumen->transaksi_id = $transaksi->id;
            $dokumen->title = $transaksi->pasien->no_rm.'_'.$pasien_name.'_laboratorium_'.$today;
            $dokumen->caption = '';
            $dokumen->path = $file_path;
            $dokumen->type = 'pdf';
            $dokumen->thumbnail_path = $data_file['path'];
            $dokumen->status = 1;
            $dokumen->created_by = $detail->created_by;
            $dokumen->verified_by = $transaksi->verified_by;
            $dokumen->verified_at = $transaksi->verified_at;
            $dokumen->save();
        }
    }

    private function transformResultJson($result)
    {
        $source = json_decode($result);
        $result = [];
        foreach($source as $row)
        {
            $temp = new \stdClass();
            $temp->group_test = '';
            $temp->test_name = $row->parameter;
            $temp->result = $row->value;
            $temp->unit = $row->satuan;
            $temp->nilai_normal = $row->referensi_min. '-' . $row->referensi_max;
            $temp->nilai_kritis = $row->kritis_min. '-' . $row->kritis_max;
            $temp->keterangan_result = $row->keterangan_result;
            $temp->metode = $row->metode;
            array_push($result, $temp);
        }

        $return[0] = $result;

        return $return;
    }

    private function sendFileHasil($transaksi){
        if(is_null($transaksi->kasus_id))
            return TRUE;
        //KIRIM HASIL UPLOAD KE KASUS
        foreach($transaksi->dokumen as $p)
        {
            if(!is_null($p->penunjang_id)){
                $delete = app('App\Http\Controllers\Kasus\Penunjang\DeleteController')->delete($p->penunjang_id);
            }
            $penunjang = app('App\Http\Controllers\Kasus\Penunjang\CreateController')->createData($p->path,
                    $p->title, '', $transaksi->kasus_id, $p->type, self::$link, $transaksi->id, $p->thumbnail_path);
            $p->penunjang_id = $penunjang->id;
            $p->save();
        }
    }

    private function updateTransfusi($req, $transaksi_id)
    {
        $creator = Auth::user()->id;
        if(isset($req->delete_transfusi))
        {
            foreach($req->delete_transfusi as $d)
            {
                $hasil = HasilTransfusi::find($d);
                $hasil->delete();
            }
        }

        foreach($req->tanggal as $i => $t)
        {
            if(isset($req->transfusi_id[$i]))
                $hasil = HasilTransfusi::find($req->transfusi_id[$i]);
            else
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

    public function mikrobiologiTerimaSpesimen(Request $request,$transaksi_slug)
    {
        $spesimen_terima_at = $request->spesimen_terima_tanggal.' '.$request->spesimen_terima_time;
        $spesimen_terima_at = Carbon::createFromFormat('d-m-Y H:i', $spesimen_terima_at);
        
        $transaction = Transaksi::where('slug', $transaksi_slug)->first();
        $transaction->spesimen_terima_at = $spesimen_terima_at;
        $transaction->spesimen_kualitas = $request->spesimen_kualitas;
        $transaction->spesimen_terima_by = Auth::user()->id;
        $transaction->spesimen_terima_keterangan = $request->spesimen_terima_keterangan;
        $transaction->spesimen_terima_submit_at = Carbon::now();
        $transaction->save();

        return back()
        ->with('status', '1')
        ->with('title', 'Berhasil')
        ->with('message', 'Spesimen berhasil diupdate');
    }
}