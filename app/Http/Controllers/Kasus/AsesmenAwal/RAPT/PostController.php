<?php

namespace App\Http\Controllers\Kasus\AsesmenAwal\RAPT;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\CPPT;
use App\Models\Kasus\Kasus;
use App\User;
use MPDF; 
use Auth;
use DB;
use Bugsnag;
use Carbon\Carbon;

class PostController extends Controller
{
	public function saveRapt($nomorKasus, Request $request) 
    {
        DB::connection('kasus')->beginTransaction();
        try
        {
            // dd($request->all());
        	$kasus = Kasus::where('nomor_kasus', $nomorKasus)->first();

            $cppt = CPPT::find($request->id);
            if(!isset($cppt)){
                $cppt = new CPPT;
                $cppt->created_by = Auth::user()->id;
                if($kasus->lokasi->lokasi->departemen->id == 3 && Auth::user()->profesi == 1)
                {
                    $ruangan = Ruangan::where('lokasi_id',$kasus->lokasi->lokasi->id)->first();
                   
                    $user = User::find(Auth::user()->id);
                    if(!empty($user->subspecialty))
                    {
                        $visite = app('App\Http\Controllers\Kasus\CPPT\CreateController')->getVisite($ruangan->id,3);
                    }
                    else if(!empty($user->specialty))
                    {
                        $visite = app('App\Http\Controllers\Kasus\CPPT\CreateController')->getVisite($ruangan->id,2);
                    }
                    else
                    {
                        $visite = app('App\Http\Controllers\Kasus\CPPT\CreateController')->getVisite($ruangan->id,1);
                    }
                    if(empty($visite))
                    {
                        DB::connection('kasus')->rollback();
                        $status = -1;
                        $message = 'RAPT gagal dibuat! Harga Visite Belum dimasukkan';
                        $title = 'Gagal!';

                        return redirect('/kasus/'.$nomorKasus.'/asesmenawal')
                        ->with('message', $message)
                        ->with('active_nav','cppt')
                        ->with('title',$title)
                        ->with('status', $status);
                    }
                    else $unit_price = $visite->tarif->harga;
                    
                    $data['tarif_id'] = $visite->tarif_id;
                    $data['tarif_tipe_id'] = 1;
                    $data['tarif_kelas'] = $kasus->kelas->id;
                    $data['kasus_id'] = $kasus->id;
                    $data['desc'] = $visite->tarif->master->deskripsi.' - '.Auth::user()->name;
                    $data['unit_price'] = $unit_price;
                    $data['qty'] = 1;
                    $data['lokasi'] = $kasus->lokasi->lokasi->id;
                    $data['daftar_harga_id'] = 0;
                    $data['sep_id'] = $kasus->sep_id;
                    $data['departemen_id'] = 3;
                    $createDetail = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($data);
                    $cppt->tagihan_detail_id = $createDetail->id;
                    $cppt->save();
                }
            }else{
                $cppt->updated_by = Auth::user()->id;
            }
           
            $cppt->jenis = 'rapt';
            $cppt->kasus_id = $kasus->id;
            $cppt->subjective = $request->subjective;
            $cppt->objective = $request->objective;
            $cppt->assessment = $request->assessment;
            $cppt->plan = $request->plan;
            $cppt->ppa = $request->ppa;
            $cppt->save();

            $status = 1;
            $message = 'RAPT baru berhasil dibuat!';
            $title = 'Berhasil!';


            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
            ->create($kasus->id,'create','AsesmenAwal',$cppt->id,$kasus->id);

            DB::connection('kasus')->commit();
            return redirect('/kasus/'.$nomorKasus.'/datamedis/asesmenawal')
            ->with('message', $message)
            ->with('active_nav','AsesmenAwal')
            ->with('title',$title)
            ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kasus')->rollback();

            $status = -1;
            $message = 'RAPT gagal dibuat!';
            $title = 'Gagal!';

            return redirect('/kasus/'.$nomorKasus.'/datamedis/asesmenawal')
            ->with('message', $message)
            ->with('active_nav','AsesmenAwal')
            ->with('title',$title)
            ->with('status', $status);
        }
    }

    public function deleteRapt(Request $request, $nomor_kasus)
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        //dd($request);
        try
        {
            $cppt = CPPT::find($request->id);
            if(isset($cppt)){
                $kasusId = $cppt->kasus_id;
                $tagihan_detail_id = $cppt->tagihan_detail_id;
                $nomorKasus = Kasus::where('id',$kasusId)->first();
                if(!empty($cppt->tagihanDetail))
                {
                    if(empty($cppt->tagihanDetail->tagihan->checkout))
                    {   
                        $deleteTagihan = app('App\Http\Controllers\Kasus\TagihanDetail\DeleteController')->deleteFromCppt($nomorKasus->nomor_kasus,$tagihan_detail_id);
                    }
                    else
                    {   
                        $status = 0;
                        $message = 'CPPT telah dicheckout di tagihan!';
                        $title = 'Gagal!';
                        return redirect('/kasus/'.$nomor_kasus.'/datamedis/asesmenawal')
                        ->with('active_nav','cppt')
                        ->with('message', $message)
                        ->with('title',$title)
                        ->with('status', $status);
                    }
                }
                $log = app('App\Http\Controllers\Kasus\Log\CreateController')
                ->create($kasusId,'delete','cppt',$cppt->id);
                $cppt->delete();
            }
            
            $status = 1;
            $message = 'CPPT berhasil dihapus!';
            $title = 'Berhasil!';

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return redirect('/kasus/'.$nomorKasus->nomor_kasus.'/datamedis/asesmenawal')
            ->with('active_nav','cppt')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
            
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
        }
    }
}
