<?php

namespace App\Http\Controllers\Kepegawaian\MasterPelatihan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Alert;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Pelatihan;
use Carbon\Carbon;

class PostController extends Controller {

    public function baru(Request $request) {

		DB::connection('kepegawaian')->beginTransaction();
		try{
			$status_data = app('App\Http\Controllers\Kepegawaian\MasterPelatihan\CreateController')->create($request);

			DB::connection('kepegawaian')->commit();
			if($status_data['status'] == 0) throw $error;

			$status = 1;
			$message = 'Berhasil menambahkan data';
			$title = 'Berhasil!';

			return redirect('/kepegawaian/master/pelatihan/')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {

			DB::connection('kepegawaian')->rollback();redirect('/kepegawaian/master/pelatihan/')
			->with('message', 'Kualifikasi tersebut sudah ada')
			->with('title', 'GAGAL')
			->with('status', 0);

            $status = -1;
            $message = 'Terjadi kesalahan! Silahkan coba lagi';
            $title = 'Gagal!';

            if(!empty($status_data['message'])) $message = $status_data['message'];

            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
		}
	}

	public function edit(Request $request) {

		DB::connection('kepegawaian')->beginTransaction();
		try{
			
			$status_data = app('App\Http\Controllers\Kepegawaian\MasterPelatihan\EditController')->edit($request);
			
			DB::connection('kepegawaian')->commit();
			if($status_data['status'] == 0) throw $error;

			$status = 1;
			$message = 'Berhasil mengubah data';
			$title = 'Berhasil!';

			return redirect('/kepegawaian/master/pelatihan/')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {

			DB::connection('kepegawaian')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			
			$status = -1;
			$message = 'Terjadi kesalahan! Silahkan coba lagi';
			$title = 'Gagal!';
			if(!empty($status_data['message'])) $message = $status_data['message'];

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}

	public function delete($id) {

		DB::connection('kepegawaian')->beginTransaction();
		try{

			$status_data = app('App\Http\Controllers\Kepegawaian\MasterPelatihan\DeleteController')->delete($id);

			DB::connection('kepegawaian')->commit();
			if($status_data['status'] == 0) throw $error;

			$status = 1;
			$message = 'Berhasil menghapus data';
			$title = 'Berhasil!';

			return redirect('/kepegawaian/master/pelatihan/')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {

			DB::connection('kepegawaian')->rollback();
			$status = -1;
			$message = 'Terjadi kesalahan! Silahkan coba lagi';
			$title = 'Gagal!';
			if(!empty($status_data['message'])) $message = $status_data['message'];

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}

	public function verification(Request $request){
		$item = Pelatihan::find($request->id);
		$auth = \Auth::user();
		$verificator = Pegawai::where('user_id', $auth->id)->where('name', $auth->name)->first();
		$item->status = true;
		$item->verificator = ($verificator ? $verificator->id : $auth->id);
		//$item->is_employee = ($verificator ? true : false);
		$item->verified_at = Carbon::now();
		$ret_update = $item->update();
		$user_id = $item->pegawai_id;
		if ( !$ret_update )    
		  	Alert::error('Terjadi kesalahan saat memverifikasi data pelatihan. Silahkan ulangi lagi', 'Gagal!');
		else 
		  	Alert::success('Data pelatihan berhasil diverifikasi', 'Berhasil!');
	
		return redirect()->route('trainings', ['id' => $user_id, '_' => microtime(true)]);
	}

	public function pegawaiAdd(Request $request, $user_id) {
		$ret_save = app('App\Http\Controllers\Kepegawaian\MasterPelatihan\CreateController')->pegawaiAdd($request, $user_id);
	
		if ( !$ret_save )
		  	Alert::error('Terjadi kesalahan saat menambahkan data pelatihan. Silahkan ulangi lagi', 'Gagal!');
		else 
		  	Alert::success('Data pelatihan berhasil ditambahkan', 'Berhasil!');
	
		return redirect()->route('trainings', ['id' => $user_id, '_' => microtime(true)]);
	}

	public function pegawaiEdit(Request $request, $id){
		$postdata = $request->toArray();
		$rest = app('App\Http\Controllers\Kepegawaian\MasterPelatihan\EditController')->pegawaiEdit($postdata, $id);
	
		if ( !$rest['ret_update'] )    
		  	Alert::error('Terjadi kesalahan saat mengubah data pelatihan. Silahkan ulangi lagi', 'Gagal!');
		else 
		  	Alert::success('Data pelatihan berhasil diubah', 'Berhasil!');
	
		return redirect()->route('trainings', ['id' => $rest['user_id'], '_' => microtime(true)]);
	}

	public function pegawaiDelete($id){
		
		$rest = app('App\Http\Controllers\Kepegawaian\MasterPelatihan\DeleteController')->pegawaiDelete($id);
	
		if ( !$rest['ret_delete'] )    
		  	Alert::error('Terjadi kesalahan saat menghapus data pelatihan. Silahkan ulangi lagi', 'Gagal!');
		else 
			  Alert::success('Data pelatihan berhasil dihapus', 'Berhasil!');

		return back();
	}
}
