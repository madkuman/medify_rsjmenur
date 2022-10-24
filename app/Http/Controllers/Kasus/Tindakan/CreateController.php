<?php

namespace App\Http\Controllers\Kasus\Tindakan;

use App\Models\Kasus\CPPT;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Tindakan;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Bugsnag;

class CreateController extends Controller
{
    public function createNewTindakan(Request $request,$nomor_kasus) 
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        DB::connection('keuangan')->beginTransaction();
        try
        {   
            $kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
            $id_radiologi = $request->input('id_radiologi');

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
                    $tindakan->lokasi_id = $kasus->lokasi->lokasi_id;
                    $tindakan->price= $request->input('price.'.$i.'');
                    $tindakan->created_by = Auth::user()->id;
                    $tindakan->tarif_master_id = $request->input('tarif_master_id.'.$i.'');
                    $tindakan->radiologi_transaksi_id = $id_radiologi;
                    $tindakan->save();

                    $tagihan = 0;
    
                    $data['tarif_id'] = $request->input('tarif_id.'.$i.'');
                    $data['tarif_tipe_id'] = $request->input('tarif_tipe_id.'.$i.'');
                    $data['tarif_kelas_id'] = $request->input('tarif_kelas.'.$i.'');
                    $data['kasus_id'] = $kasus_id;
                    $data['desc'] = $request->input('desc_keperawatan.'.$i.'');
                    $data['unit_price'] = $request->input('price.'.$i.'');
                    $data['qty'] = 1;
                    $data['lokasi'] = $kasus->lokasi->lokasi->id;
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

                

                    $user_id = Auth::user()->id;
                    $tarif_master_id = $tindakan->tarif_master_id;

                    $log = app('App\Http\Controllers\Kasus\ViewTindakanUserTotal\CreateController')->create($user_id,$tarif_master_id);

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
                $tindakan->lokasi_id = $kasus->lokasi->lokasi_id;
                $tindakan->price= null;
                $tindakan->radiologi_transaksi_id = $id_radiologi;
                $tindakan->created_by = Auth::user()->id;
                $tindakan->save();                
                $log = app('App\Http\Controllers\Kasus\Log\CreateController')
                ->create($kasus->id,'create','tindakan',$tindakan->id);
            }
            $status = 1;
            $message = 'Tindakan baru berhasil dibuat!';
            $title = 'Berhasil!';
            if(!empty($tindakan->icd_9)){
                $tab = 'icd9';

                $user_id = Auth::user()->id;
                $icd_9 = $tindakan->icd_9;

                $log = app('App\Http\Controllers\Kasus\ViewICD9UserTotal\CreateController')->create($user_id,$icd_9);
            }
            else $tab = 'tindakan';

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            DB::connection('keuangan')->commit();
            if($id_radiologi != null)
                return back()
                ->with('active_nav','tindakan')
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);

            return redirect('/kasus/'.$nomor_kasus.'/datamedis/'.$tab)
            ->with('active_nav','tindakan')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
    }

    public function createTindakanManual(Request $request)
    {
        // dd($request);
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
            $kasus = Kasus::where('id', $request->kasus_id)->first();
            $jumlah = count($request->input('desc_keperawatan'));
            for($i=0;$i<$jumlah;$i++){

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
                $data['lokasi'] = $kasus->lokasi->lokasi->id;
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
            }

            $status = 1;
            $message = 'Tindakan berhasil ditambahkan';
            $title = 'Berhasil!';

            
            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();

        } catch (\Exception $e) {

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
        }
        return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
    }
}