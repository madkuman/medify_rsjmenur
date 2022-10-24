<?php

namespace App\Http\Controllers\Gudang\StokOpname;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\StokOpname;
use App\Models\Gudang\Penghapusan;
use App\Models\Gudang\Distribusi;
use Illuminate\Http\Response;
use DB;
use Auth;
use Bugsnag;

class DeleteController extends Controller
{
	public function delete(Request $request)
	{
		$id = $request->input('id');

		

		try {
			$transaction = StokOpname::find($id);
			if($transaction->status)
			{
				if($transaction->penghapusan)
				{
					$penghapusan = Penghapusan::find($transaction->penghapusan->id);
					foreach($penghapusan->log as $item)
					{
						app('App\Http\Controllers\Gudang\LogPenghapusan\DeleteController')->deleteLog($item->id, 1);
					}
					$penghapusan->delete();
				}

				if($transaction->distribusi)
				{
					$distribusi = Distribusi::find($transaction->distribusi->id);
					foreach($distribusi->log as $rec)
					{
						app('App\Http\Controllers\Gudang\LogDistribusi\DeleteController')->deleteLog($rec->id, 1);
					}
					$distribusi->delete();
				}
			}

			$transaction->delete();

			
			return redirect('gudang/stokopname/')
			->with('status', 1)
			->with('message', 'Stok Opname berhasil dihapus')
			->with('title', 'Sukses');
		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			
			return redirect()->back()
			->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
			->with('status', -1)
			->with('title', 'Gagal');
		}
	}
}
