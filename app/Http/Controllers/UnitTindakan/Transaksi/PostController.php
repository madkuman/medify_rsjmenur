<?php

namespace App\Http\Controllers\UnitTindakan\Transaksi;

use App\Models\Kasus\CPPT;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Tindakan;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifDetail;
use App\Models\UnitTindakan\UnitTindakan;
use App\Models\UnitTindakan\Transaksi;
use App\Models\Pasien\Pasien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Bugsnag;

class PostController extends Controller
{
    public function createNewTindakan(Request $request, $slug) 
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        DB::connection('keuangan')->beginTransaction();
        DB::connection('unit_tindakan')->beginTransaction();
        try
        {   
            $kasus = Kasus::find($request->kasus_id);
            $unit_tindakan = UnitTindakan::where('slug', $slug)->first();
            $transaksi = Transaksi::find($request->transaksi_id);

            if($request->input('kategori-tindakan') == 'keperawatan')
            {
                $jumlah = count($request->input('desc_keperawatan'));
                for($i=0;$i<$jumlah;$i++)
                {
                    $kasus_id = $kasus->id;
                    $tindakan = new Tindakan();
                    $tindakan->kasus_id = $kasus->id;
                    $tindakan->icd_9= $request->input('icd_9');
                    $tindakan->desc= $request->input('desc_keperawatan.'.$i.'');
                    $tindakan->price= $request->input('price.'.$i.'');
                    $tindakan->created_by = Auth::user()->id;
                    $tindakan->tarif_master_id = $request->input('tarif_master_id.'.$i.'');
                    $tindakan->save();

                    $tagihan = 0;
    
                    $data['tarif_id'] = $request->input('tarif_id.'.$i.'');
                    $data['tarif_tipe_id'] = $request->input('tarif_tipe_id.'.$i.'');
                    $data['tarif_kelas_id'] = $request->input('tarif_kelas.'.$i.'');
                    $data['kasus_id'] = $kasus_id;
                    $data['desc'] = $request->input('desc_keperawatan.'.$i.'');
                    $data['unit_price'] = $request->input('price.'.$i.'');
                    $data['qty'] = 1;
                    $data['lokasi'] = $unit_tindakan->lokasi_id;
                    $data['daftar_harga_id'] = 0;
                    $data['sep_id'] = $kasus->sep_id;
                    $data['kategori_id'] = $kasus->lokasi->lokasi->kategori_keuangan_id;
                    //$data['departemen_id'] = $request->input('departemen_id.'.$i.'');
                    //dd($data);
                    $createDetail = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($data);
                    $tindakan->tagihan_detail_id= $createDetail->id;
                    $tindakan->save();
                    $log = app('App\Http\Controllers\Kasus\Log\CreateController')
                    ->create($kasus->id,'create','tindakan',$tindakan->id);
                    /*$tarif_pop = TarifDetail::where('id',$data['tarif_id'])->first();
                    $add_count = Tarif::where('id',$tarif_pop->tarif_id)->first();
                    if(empty($add_count->count))
                    {
                        $add_count->count = 1;   
                    }
                    else if(!empty($add_count->count)) //tambah count
                    {
                        $add_count->count++;
                    }
                    $add_count->save();*/
                    //dd($tarif_pop,$add_count->count);
                }
            }
            else
            {   
                $desc = $request->input('desc_icd');
                $kasus_id = $kasus->id;
                $tindakan = new Tindakan();
                $tindakan->kasus_id = $kasus->id;
                $tindakan->icd_9= $request->input('icd_9');
                $tindakan->desc= $desc;
                $tindakan->price= null;
                $tindakan->created_by = Auth::user()->id;
                $tindakan->save();                
                $log = app('App\Http\Controllers\Kasus\Log\CreateController')
                ->create($kasus->id,'create','tindakan',$tindakan->id);
            }
            $transaksi->save();
            $status = 1;
            $message = 'Tindakan baru berhasil dibuat!';
            $title = 'Berhasil!';

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            DB::connection('keuangan')->commit();
            DB::connection('unit_tindakan')->commit();

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            DB::connection('keuangan')->rollback();
            DB::connection('unit_tindakan')->rollback();
            $status = -1;
            $message = 'Gagal menambahkan Tindakan';
            $title = 'Gagal!';           
        }
        return redirect('/unit-tindakan/'.$slug.'/dashboard')
        ->with('active_nav','tindakan')
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }

    public function layani(Request $request, $slug, $tindakan_transaksi_id) 
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        DB::connection('unit_tindakan')->beginTransaction();
        DB::connection('rawatjalan')->beginTransaction();
        try
        {
            $tindakan_transaksi = Transaksi::find($tindakan_transaksi_id);
            if(is_null($tindakan_transaksi)){
                $status = -1;
                $message = 'Gagal melayani Transaksi';
                $title = 'Gagal!';
                return redirect('/unit-tindakan/'.$slug.'/dashboard')
                ->with('active_nav','tindakan')
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
            }
            $transaksi_id = $tindakan_transaksi->transaksi_rawat_jalan_id;
            $transaksi = \App\Models\RawatJalan\Transaksi::find($transaksi_id);
            $judul_kasus = 'Rawat Jalan #'.$transaksi_id;
            $pasien = Pasien::find($transaksi->pasien_id);
            $kelas = 1; //ID KELAS URJ
            $lokasi = $transaksi->poliklinik->lokasi_id;

            if ($transaksi->asal_rujukan!=0) {
                $pasien->asal_rujukan = $transaksi->rujukan->nama;
            }
            else $pasien->asal_rujukan = "-";

            if(empty($transaksi->kasus_id))
            {
                $kasus = app('App\Http\Controllers\Kasus\Kasus\CreateController')
                ->createKasus($judul_kasus,$pasien,$lokasi,$transaksi->id,$kelas,$transaksi->pasien_pembayaran_id,$transaksi->nomor_sep);
                $transaksi->kasus_id=$kasus->id;
                $transaksi->status = 1;
                $transaksi->save();

            }
            else
            {
                if(!empty($transaksi->permintaan_rujuk_id) && $transaksi->status == 0)
                {
                    $this->changeKasusLokasi($transaksi->kasus_id,$lokasi);
                    if($transaksi->kasus->pembayaran->perusahaan->tipe->id == 1)
                        $activesep = app('App\Http\Controllers\Kasus\Kasus\EditController')->changeActiveSEPtoLatestSEP($transaksi->kasus_id);

                    $transaksi->save();
                }
            }

            $this->checkIfKolaborator($transaksi->kasus_id);

            if (!empty($pasien->is_baru)) {
                if ($pasien->is_baru==1) {
                    $update_pasien = app('App\Http\Controllers\Pasien\Pasien\EditController')->updatePasienBaru($pasien->id);
                    $transaksi->is_pasien_baru = 1;
                    $transaksi->save();


                    $update_kasus = app('App\Http\Controllers\Kasus\Kasus\EditController')->updateKasusBaru($transaksi->kasus_id);
                }
            }

            $tindakan_transaksi->kasus_id = $transaksi->kasus_id;
            $tindakan_transaksi->save();

            $this->insertKasus($transaksi_id, $transaksi->kasus_id);
            $transaksi->save();
            $status = 1;
            $message = 'Transaksi berhasil dilayani!';
            $title = 'Berhasil!';

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            DB::connection('rawatjalan')->commit();
            DB::connection('unit_tindakan')->commit();

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            DB::connection('rawatjalan')->rollback();
            DB::connection('unit_tindakan')->rollback();
            $status = -1;
            $message = 'Gagal melayani Transaksi';
            $title = 'Gagal!';
        }
        return redirect('/unit-tindakan/'.$slug.'/dashboard')
        ->with('active_nav','tindakan')
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }

    public function selesai(Request $request, $slug, $transaksi_id) 
    {
        DB::connection('unit_tindakan')->beginTransaction();
        try
        {
            $transaksi = Transaksi::find($transaksi_id);
            $transaksi->flag = 1;
            $transaksi->save();

            $status = 1;
            $message = 'Transaksi berhasil diselesaikan!';
            $title = 'Berhasil!';

            DB::connection('unit_tindakan')->commit();

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('unit_tindakan')->rollback();
            $status = -1;
            $message = 'Transaksi gagal diselesaikan';
            $title = 'Gagal!';
        }
        return redirect('/unit-tindakan/'.$slug.'/dashboard')
        ->with('active_nav','tindakan')
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }

    private function checkIfKolaborator($kasus_id)
    {
        /*CHECK APAKAH SI USER KOLABORATOR, JIKA TIDAK MAKA DI CREATE, JIKA IYA MAKA DI UPDATE*/

        $user_id = Auth::user()->id;
        $status = app('App\Http\Controllers\Kasus\Kolaborator\ReadController')->checkIfExist($kasus_id,$user_id);
        if(!empty($status->id))
            $status = app('App\Http\Controllers\Kasus\Kolaborator\EditController')->updateStatus($status->id,1);
        else
            $status = app('App\Http\Controllers\Kasus\Kolaborator\CreateController')->createWithStatus($kasus_id,$user_id,1,0);
    }

    private function insertKasus($transaksi_id, $kasus_id)
    {
        $transaksi = Transaksi::where('transaksi_rawat_jalan_id', $transaksi_id)->whereNull('kasus_id')->get();
        foreach ($transaksi as $t) {
            $t->kasus_id = $kasus_id;
            $t->save();
        }
        return TRUE;
    }
}