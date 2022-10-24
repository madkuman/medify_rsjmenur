<?php

namespace App\Http\Controllers\Kasus\CPPT;

use App\Jobs\QueueArtisan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\CPPT;
use App\Models\Kasus\Kasus;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\RuanganVisite;
use App\User;
use MPDF; 
use Auth;
use DB;
use Bugsnag;
use Carbon\Carbon;

class PostController extends Controller
{
	public function createNewCPPT(Request $request, $nomor_kasus, $jenis = null) 
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('rawatjalan')->beginTransaction();
        try
        {	
        	$cppt = app('App\Http\Controllers\Kasus\CPPT\CreateController')
			->createNewCPPT($request, $nomor_kasus, $jenis);

        	if(is_string($cppt))
            {
                DB::connection('kasus')->rollback();

                $status = -1;
                $message = $cppt;
                $title = 'Gagal!';

                return redirect('/kasus/'.$nomor_kasus.'/datamedis/cppt')
                    ->with('message', $message)
                    ->with('active_nav','cppt')
                    ->with('title',$title)
                    ->with('status', $status);
            }

			if (config('medify.third-party.jkn_online.on')) {
				$kasus = app(\App\Http\Controllers\Kasus\Kasus\ReadController::class)->get($nomor_kasus);
				$transaksi = $kasus->rawat_jalan_transaksi_last_attr;
				$profesi = Auth::user()->profesi;
				if ($kasus->lokasi->lokasi->departemen->id == 2 && $profesi == 1 && $transaksi && $transaksi->task_id_jkn < 5) {
                    $carbon_today = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                    $carbon_today = strtotime($carbon_today) * 1000;
                    $data['kodebooking'] = $transaksi->id;
                    $data['taskid'] = 5;
                    $data['waktu'] = $carbon_today;
                    dispatch(new QueueArtisan('command:update-task-jkn-id', ['kodebooking' => $transaksi->id, 'taskid' => 5, 'waktu' => $carbon_today]));
				}
			}

			$status = 1;
	        $message = 'CPPT baru berhasil dibuat!';
	        $title = 'Berhasil!';


			
            DB::connection('kasus')->commit();
			DB::connection('rawatjalan')->commit();
			return redirect('/kasus/'.$nomor_kasus.'/datamedis/cppt')
            ->with('message', $message)
            ->with('active_nav','cppt')
            ->with('title',$title)
            ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kasus')->rollback();
            DB::connection('rawatjalan')->rollback();

            $status = -1;
            $message = 'CPPT gagal dibuat!';
            $title = 'Gagal!';

            return redirect('/kasus/'.$nomor_kasus.'/datamedis/cppt')
            ->with('message', $message)
            ->with('active_nav','cppt')
            ->with('title',$title)
            ->with('status', $status);
        }
    }
	public function editCPPT(Request $request, $nomor_kasus)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{
			app('App\Http\Controllers\Kasus\CPPT\EditController')
			->editCPPT($request);
			
			$status = 1;
			$message = 'CPPT berhasil diubah!';
			$title = 'Berhasil!';

			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();
			return redirect('/kasus/'.$nomor_kasus.'/datamedis/cppt')
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


	public function deleteCPPT(Request $request, $nomor_kasus)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		//dd($request);
		try
		{			
			app('App\Http\Controllers\Kasus\CPPT\DeleteController')
			->deleteCppt($request);
			$status = 1;
			$message = 'CPPT berhasil dihapus!';
			$title = 'Berhasil!';

			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();
			return redirect('/kasus/'.$nomor_kasus.'/datamedis/cppt')
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

	public function overrideCPPT($nomor_kasus, Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{	
			app('App\Http\Controllers\Kasus\CPPT\EditController')
			->overrideCPPT($nomor_kasus, $request);
            $status = 1;
			$message = 'CPPT berhasil di override!';
			$title = 'Berhasil!';

            //dd($cppt,$createDetail);
			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();
			return redirect('/kasus/'.$nomor_kasus.'/datamedis/cppt')
			->with('active_nav','cppt')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {
			
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();
			;
		}
	}

	public function saveCPPT(Request $request, $nomor_kasus, $jenis = null)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('rawatjalan')->beginTransaction();
		if($jenis == 'rapt')
        	$url = '/kasus/'.$nomor_kasus.'/datamedis/asesmenawal';
        else
        	$url = '/kasus/'.$nomor_kasus.'/datamedis/cppt';

        
        	if(!isset($request->id)){
	        	$cppt = app('App\Http\Controllers\Kasus\CPPT\CreateController')
				->createNewCPPT($request, $nomor_kasus,$jenis);
	        	$message = strtoupper($jenis).' baru berhasil dibuat!';
			}else{
				$cppt = app('App\Http\Controllers\Kasus\CPPT\EditController')
				->editCPPT($request, $jenis);
	        	$message = strtoupper($jenis).' berhasil diubah!';
			}

			if (config('medify.third-party.jkn_online.on')) {
				$kasus = app(\App\Http\Controllers\Kasus\Kasus\ReadController::class)->get($nomor_kasus);
				$transaksi = $kasus->rawat_jalan_transaksi_last_attr;
				$profesi = Auth::user()->profesi;

				if ($kasus->lokasi->lokasi->departemen->id == 2 && $profesi == 1 && $transaksi->task_id_jkn < 4) {
					$carbon_today = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
					$carbon_today = strtotime($carbon_today) * 1000;
					$data['kodebooking'] = $transaksi->id;
					$data['taskid'] = 4;
					$data['waktu'] = $carbon_today;
	
					$returned = app(\App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean\PostController::class)->updateTaskId($data);
					$returned = json_decode($returned);
					if(($returned->metadata->code ?? null) != "200"){
						$data_log['kodebooking'] = $transaksi->id;
						$data_log['response'] = json_encode($returned);
	
						app(\App\Http\Controllers\ThirdParty\LogErrorJkn\CreateController::class)->create($data_log);
					}
					$transaksi->task_id_jkn = 4;
					$transaksi->save();
				}

            }


			$status = 1;
	        $title = 'Berhasil!';
			
            DB::connection('kasus')->commit();
            DB::connection('rawatjalan')->commit();
			return redirect($url)
            ->with('message', $message)
            ->with('active_nav','cppt')
            ->with('title',$title)
            ->with('status', $status);
	}

	public function reviewCPPT(Request $request, $nomor_kasus)
	{
		DB::connection('kasus')->beginTransaction();

        try
        {
			app('App\Http\Controllers\Kasus\CPPT\EditController')->reviewCPPT($request);

			$status = 1;
	        $title = 'Berhasil!';
	        $message = 'Review Berhasil!';


			
            DB::connection('kasus')->commit();
			return back()
            ->with('message', $message)
            ->with('active_nav','cppt')
            ->with('title',$title)
            ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kasus')->rollback();

            $status = -1;
            $message = 'CPPT gagal direview!';
            $title = 'Gagal!';

			return back()
            ->with('message', $message)
            ->with('active_nav','cppt')
            ->with('title',$title)
            ->with('status', $status);
        }
	}

}
