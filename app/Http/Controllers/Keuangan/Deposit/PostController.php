<?php

namespace App\Http\Controllers\Keuangan\Deposit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Deposit;
use App\Models\Keuangan\DepositLog;
use Auth;
use DB;

class PostController extends Controller
{
	public function create(Request $request)
	{
		try {
			DB::connection('keuangan')->beginTransaction();
			$pasien_id = $request->pasien_id;
			$jumlah = $request->jumlah;
			$kasir_id = $request->kasir_id;

			$deposit = Deposit::where('pasien_id',$pasien_id)->first();
			if(empty($deposit->id)){
				$deposit = new Deposit;
				$deposit->pasien_id = $pasien_id;
				$deposit->jumlah = $jumlah;
				$deposit->save();
			}
			else
			{
				$deposit->jumlah = $deposit->jumlah + $jumlah;
				$deposit->save();
			}

			$log = new DepositLog;
			$log->deposit_id = $deposit->id;
			$log->kasir_id = $kasir_id;
			$log->jumlah = $jumlah;
			$log->created_by = Auth::user()->id;
			$log->save();

			$status = 1;
			$title = 'Berhasil';
			$message = 'Deposit berhasil dibuat';

			if(!empty($kasir_id))
				$url = 'kasir/'.$kasir_id.'/deposit/single/'.$deposit->id;
			else
				$url = 'keuangan/deposit/single/'.$deposit->id;

			DB::connection('keuangan')->commit();

			return redirect($url)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {
			DB::connection('keuangan')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			$status = -1;
			$title = 'Gagal';
			$message = 'Deposit gagal dibuat : Kesalahan Server, silahkan hubungi admin';
			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}


	}

	public function delete(Request $request)
	{

		try {
			DB::connection('keuangan')->beginTransaction();
			$deposit_log_id = $request->deposit_log_id;
			$deposit_log = DepositLog::find($deposit_log_id);

			$deposit = Deposit::where('id',$deposit_log->deposit_id)->first();
			$deposit->jumlah = $deposit->jumlah - $deposit_log->jumlah;
			$deposit->save();

			$deposit_log->delete();

			$status = 1;
			$title = 'Berhasil';
			$message = 'Deposit berhasil dihapus';

			DB::connection('keuangan')->commit();

		} catch (\Exception $e) {
			DB::connection('keuangan')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			$status = -1;
			$title = 'Gagal';
			$message = 'Deposit gagal dihapus : Kesalahan Server, silahkan hubungi admin';
		}
			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
	}
}
