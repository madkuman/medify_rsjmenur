<?php

namespace App\Http\Controllers\LabPK\Transaksi;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\LabPK\Layanan;
use App\Models\LabPK\Dokumen;
use App\Models\LabPK\Transaksi;
use App\Models\Hospital\Lokasi;
use App\Models\LabPK\TransaksiDetail;
use App\Models\LabPK\PemeriksaanHasil;
use App\Models\LabPK\Pemeriksaan;
use App\Models\Pasien\Pasien;
use App\Models\Keuangan\Tarif;
use App\Models\Kasus\Penunjang;
use DB;
use Bugsnag;
use DateTime;
use Auth;
use Carbon\Carbon;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{
    static protected $lokasi_slug = "lab-pk";
    static protected $slug = 'lab-pk';
    static protected $slug_kasir = 'kasir-lab-pk';

    public function periksa(Request $request, $slug, $transaksi_detail_slug)
    {
        try {
            DB::connection('kasus')->beginTransaction();
            DB::connection('lab_pk')->beginTransaction();
            $layanan_id = $request->input('layanan_id');
            $tarif = Tarif::find($layanan_id);
            $pemeriksaan = new Pemeriksaan;
            $pemeriksaan->transaksi_detail_id =  $transaksi_detail_slug;
            $pemeriksaan->save();

            $result = [];
            foreach($tarif->form_labpk as $form)
            {

                $hasil = new PemeriksaanHasil;
                $hasil->pemeriksaan_id = $pemeriksaan->id;
                $hasil->form_id = $form->id;
                $hasil->value = $request->input($form->id);
                $hasil->keterangan = NULL;
                $hasil->created_by = 0;
                $hasil->save();
                $temp['label'] = $form->label;
                $temp['type'] = $form->type;
                $temp['flag'] = $form->flag;
                $temp['satuan'] = $form->satuan;
                $temp['referensi'] = $form->referensi;
                $temp['value'] = $request[$form->id];
                array_push($result, $temp);
            }
            $result = json_encode($result);
            $detail = TransaksiDetail::where('slug', $transaksi_detail_slug)->first();
            $transaction = Transaksi::where('slug', $slug)->first();

            $lokasi = Lokasi::where('slug', self::$lokasi_slug)->first();//id lokasi loket
            $data['tarif_tipe_id'] = $transaction->tarif_tipe_id;
            $data['tarif_kelas'] = $transaction->kelas->id;
            //FINDING CURRENT DETAIL TO BE UPDATED AS DONE
            $data['kasus_id'] = $transaction->kasus_id;
            $data['desc'] = $detail->transactionDetail_service['deskripsi'];
            $data['lokasi'] = $lokasi->id;
            $data['unit_price'] = $detail->classPrice();
            $data['qty'] = 1;
            $data['daftar_harga_id'] = null;
            $data['tarif_id'] = $detail->tarif_id;
            $data['sep_id'] = $transaction->sep;
            
            if(!is_null($transaction->kasus_id)){
                $detailTagihan = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($data);
                $detail->tagihan_detail_id = $detailTagihan->id;
            }

            $detail->done = 1;
            $detail->qty = 1;
            $detail->status = "done";
            $detail->result = $result;
            $detail->save();

            $transaction->status = 1;
            $transaction->result_created_at = Carbon::now();
            $transaction->save();
            $status = 1;
            $message = 'Pemeriksaan berhasil dibuat.';
            $title = 'Berhasil!';
            DB::connection('kasus')->commit();
            DB::connection('lab_pk')->commit();
            return redirect('labpk/transaksi/hasil/'.$slug)
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);            
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kasus')->rollback();
            DB::connection('lab_pk')->rollback();
            if(config('app.debug'))
                
            return back();
        }

    }

    public function simpanHasil($transaksi_id)
    {
        $transaksi = Transaksi::find($transaksi_id);
        $transaksi->status = 1;
        $transaksi->save();

        $this->sendtoMedify($transaksi_id,$transaksi->kasus_id);
        $this->insertTagihan($transaksi_id);

        $status = 1;
        $message = 'Pemeriksaan berhasil disimpan.';
        $title = 'Berhasil!';

        return redirect('labpk/transaksi/hasil/'.$transaksi_id)
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }

    private function insertTagihan($transaksi_id)
    {
        $transaksi = Transaksi::find($transaksi_id);
        foreach($transaksi->detail as $detail)
        {
            $tagihan = app('App\Http\Controllers\Kasus\Tagihan\CreateController')->create($transaksi->kasus_id);

            $data = array();
            $data['desc'] = $detail->layanan->name;
            $data['qty'] = 1;
            $data['daftar_harga_id'] = 0;
            $data['unit_price'] = $detail->layanan->harga;
            $data['nominal'] = $detail->layanan->harga;

            $tagihan_detail = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->createTagihanDetail($tagihan->id,'Lab PK',$data);
        }
        
    }


    private function sendtoMedify($transaksi_id,$kasus_id)
    {

        $url = 'http://localhost/medifyhospital/public/labpk/transaksi/hasil/'.$transaksi_id;
        $title = 'Pemeriksaan LabPK #'.$transaksi_id;
        $file_primary = 'Anda akan pindah ke website lain? Apakah anda yakin?';
        $file_thumb = 'penunjang/link.png';
        $type = 'link';
        $file_type = 4;
        $link_flag = 1;
        $created_by = 2;

        $penunjang = new Penunjang;
        $penunjang->kasus_id = $kasus_id;
        $penunjang->judul = $title;
        $penunjang->file = $url;
        $penunjang->file_primary = $file_primary;
        $penunjang->file_thumb = $file_thumb;
        $penunjang->type = $type;
        $penunjang->file_type = $file_type;
        $penunjang->link_flag = $link_flag;
        $penunjang->created_by = $created_by;
        $penunjang->save();

    }

    private function savePicture($file, $transactionSlug, $key, $judul, $caption)
    {
        try {
            //PREPARE FOLDER
            $now_date = Carbon::now()->toDateString();
            $public_folder = public_path('uploads/labpk/'.$now_date."/");
            $folder = 'labpk/temp';
            if(!file_exists($public_folder))
                mkdir($public_folder, 0777);

            $image = $file;
            $extension = strtolower($file->getClientOriginalExtension());
            $filename = app('App\Http\Controllers\LabPK\Transaksi\CreateController')->createFilename($transactionSlug, $public_folder, $extension);
            $transaction = Transaksi::where('slug', $transactionSlug)->first();

             //store local storage
            $upload_success = $image->storeAs($folder, $filename.".".$extension);
            // If the upload is successful, return the name of directory/filename of the upload.
            if ($upload_success) {            
                //move to public path (dest,source)
                $new_path = $file->move($public_folder, $upload_success);
                $photo = new Dokumen();
                $photo->transaksi_id = $transaction->id;
                $photo->type = $extension;
                $photo->hash = $key;
                $photo->title = $judul;
                $photo->caption = $caption;
                $photo->status = 0;
                $photo->path = $now_date."/".$filename.".".$extension;
                $photo->save();
                return TRUE;
            }
            else {
                return FALSE;
            }            
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kasus')->rollback();
            DB::connection('lab_pk')->rollback();
            if(config('app.debug'))
                
            throw new Exception($e);   
        }
    }

    private function confirmPicture($key, $transaction_id, $kasus_id)
    {
        $photos = Dokumen::where('hash', $key)->where('status', 0)->where('transaksi_id',$transaction_id)->get();
        $now_date = Carbon::now()->toDateString();
        $new_folder = public_path('uploads/labpk/'.$now_date."/");
        try {
            $i = 0;
            foreach($photos as $item){
                $item->status = 1;
                $item->save();
                if(!is_null($kasus_id))
                $penunjang = app('App\Http\Controllers\Kasus\Penunjang\CreateController')->createData('labpk/'.$item->path, $item->title, $item->caption, $kasus_id, 0, "labpk", $transaction_id);
                $i++;
            }
            if($this->cleanPhotos($key, $transaction_id))
                return TRUE;
            return FALSE;
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            if(config('app.debug'))
                
            throw new Exception($e);
        }
    }

    public function cleanPhotos($hash, $transaction_id)
    {
        $folder = public_path('uploads/labpk/');
        try {
            $photos = Dokumen::where('hash', '!=', $hash)->where('status', 0)->where('transaksi_id',$transaction_id)->get();       
            foreach($photos as $item) {
                if(file_exists($folder.$item->path)) //DEVELOPMENT NEEDS
                    unlink($folder.$item->path);
                $item->delete();
            }
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            if(config('app.debug'))
                
            return FALSE;
        }
        return TRUE;
    }

    public function kirimKasir($transaction, $detail_data)
    {

        $lokasi = Lokasi::where('slug', self::$lokasi_slug)->first();//id lokasi loket

        $nama_layanan = $transaction->kelas->nama;
        $kasir = app('App\Http\Controllers\Kasir\Manajemen\ReadController')->getBySlug(self::$slug_kasir);
        $kasir_id = $kasir->id;

        $transaksi_details = [];
        $jumlah = 0;
        foreach($detail_data as $d){
            $detail_res = $this->reshapeKasir((object)$d, $lokasi);
            $jumlah += $d['unit_price'];
            array_push($transaksi_details, $detail_res);
        }
        $transaksi_details = (object)$transaksi_details;
        // if($data['kelas'] == "URJ") {
        //     $nama_layanan = "Rawat Jalan";
        //     $kasir_id = 2;
        // }
        // if($data['kelas'] == "IGD") {
        //     $nama_layanan = "IGD";
        //     $kasir_id = 1;
        // }

        $diskon = 0;
        $total = $jumlah;
        $pasien_id = $transaction->pasien_id;
        $pasien = Pasien::find($pasien_id);
        $judul = 'Lab Patologi Klinik '.$nama_layanan.' - '.$pasien->name;
        $kasir_id = $kasir_id;
        $asal_layanan = $transaction->asal->nama ?? 'Tanpa Kasus';
        $lokasi_id = $lokasi->id;
        $created_at = Carbon::now();
        $updated_at = Carbon::now();
        $pasien_pembayaran_id = $transaction->pasien_pembayaran_id;

        $lokasiNow = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getSingleLokasi($lokasi_id);
        $kategori_id = $lokasiNow->kategori_keuangan_id;
        $pihak_ketiga = "TUNAI";
        $perusahaan_id = 2; ///tunai perusahaan keuangan
        $akun_id = 1; //cash
        $kasus_id = null;

        $transaksi_kasir = app('App\Http\Controllers\Keuangan\Piutang\CreateController')
            ->create($kasir_id,$judul,$jumlah,$diskon,$total,$pasien_id,$pihak_ketiga,$kategori_id,
                $created_at,$created_at,$updated_at,
                $transaksi_details,$pasien_pembayaran_id,$lokasi_id,
                null,$perusahaan_id,'Administrasi Pendaftaran Pasien',null);


        return $transaksi_kasir;
    }

    private function reshapeKasir($data,$lokasi_loket)
    {
        $tarif = Tarif::find($data->tarif_id);
        $newtrans = new \stdClass();
        $newtrans->tarif_id = $data->tarif->id ?? '0';
        $newtrans->deskripsi = $data->desc;
        $newtrans->tarif_tipe_id = $data->tarif_tipe_id;
        $newtrans->kelas_id = $data->tarif_kelas;
        $newtrans->harga = $data->unit_price;
        $newtrans->diskon = 0;
        $newtrans->jumlah = 1;
        $newtrans->subtotal = $data->unit_price;
        $newtrans->keterangan = null;
        $newtrans->lokasi_id = $lokasi_loket->id;
        $newtrans->kategori_id = $lokasi_loket->kategori_keuangan_id;
        $newtrans->created_at = Carbon::now();
        $newtrans->updated_at = Carbon::now();
        $newtrans->created_by = Auth::user()->id;
        return $newtrans;
    }

    public function kirimTagihan($slug)
    {
        try {
            DB::connection('kasus')->beginTransaction();
            DB::connection('lab_pk')->beginTransaction();
            DB::connection('keuangan')->beginTransaction();

            $transaksi = Transaksi::where('slug', $slug)->first();
            $detail_data = [];
            foreach($transaksi->detail as $d){
                $temp = app('App\Http\Controllers\LabPK\Transaksi\CreateController')->saveTagihanData($transaksi, $d);
                if($transaksi->kirim_kasir)
                    array_push($detail_data, $temp);
                else {
                    $saveToTagihan = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($temp);
                    $d->tagihan_detail_id = $saveToTagihan->id;
                    $d->save();
                }
            }
            if($transaksi->kirim_kasir)
                $this->kirimKasir($transaksi, $detail_data);
            $transaksi->is_checkout = 1;
            $transaksi->save();
            DB::connection('keuangan')->commit();
            DB::connection('kasus')->commit();
            DB::connection('lab_pk')->commit();

            $status = 'success';
            $message = 'Berhasil Mengirim Tagihan';
        } catch (\Exception $e) {
            DB::connection('keuangan')->rollback();
            DB::connection('kasus')->rollback();
            DB::connection('lab_pk')->rollback();                
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $status = 'error';
            $message = 'Gagal Mengirim Tagihan';
        }
       return redirect('labpk/transaksi/permintaan/'.$slug)->with($status, $message); 
    }

    public function tambahPemeriksaan($slug,Request $request)
    {
        $transaksi = Transaksi::where('slug', $slug)->first();
        $services = $request->tambah_pemeriksaan;
        try {
            DB::connection('kasus')->beginTransaction();
            DB::connection('lab_pk')->beginTransaction();
            DB::connection('keuangan')->beginTransaction();

            $detail_data = [];
            $service_baru = [];
            foreach ($services as $service){
                $detail = app('App\Http\Controllers\LabPK\Transaksi\CreateController')->create_detail($service,$transaksi->id);
                $detail_transaksi=app('App\Http\Controllers\LabPK\Transaksi\CreateController')->saveTagihanData($transaksi, $detail,$transaksi->lokasi_id);
                if ($transaksi->kirim_kasir == 1) {
                    array_push($detail_data,$detail_transaksi);
                    array_push($service_baru,$detail);
                } else {
                    $detail_transaksi=app('App\Http\Controllers\LabPK\Transaksi\CreateController')->saveTagihanData($transaksi, $detail,$transaksi->lokasi_id);
                    $saveToTagihan = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($detail_transaksi);
                    $detail->tagihan_detail_id = $saveToTagihan->id;
                    $detail->save();
                }
            }
            if(!empty($detail_data)){
                $piutang = $this->kirimKasir($transaksi, $detail_data);
                foreach ($service_baru as $detail){
                    $detail->piutang_id = $piutang->id;
                    $detail->save();
                }
            }

            DB::connection('keuangan')->commit();
            DB::connection('kasus')->commit();
            DB::connection('lab_pk')->commit();
            $status =1;
            $title = 'success';
            $message = 'Berhasil Tambah Pemeriksaan';
        }catch (\Exception $e) {
            DB::connection('keuangan')->rollback();
            DB::connection('kasus')->rollback();
            DB::connection('lab_pk')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $status = -1;
            $title = 'error';
            $message = 'Gagal Tambah Pemeriksaan';
        }
        return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
    }
}