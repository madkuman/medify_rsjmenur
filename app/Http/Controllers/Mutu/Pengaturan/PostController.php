<?php

namespace App\Http\Controllers\Mutu\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPA\LaporanMaster;
use App\Models\Keuangan\TarifMaster;
use DB;
use Bugsnag;

class PostController extends Controller
{
	public function labpa(Request $req, $slug)
	{
		try {
			DB::connection('lab_pa')->beginTransaction();
			$nama = $req->nama;
			
			$konten = [];
			// dd($req);
			foreach($req->parent as $parent)
			{
				$temp = [];
				foreach($req['header_'.$parent] as $i => $header)
				{
					$detail = [];
					$ids = [];
					foreach ($req['detail_'.$parent][$i] as $key => $val) {
						array_push($detail, [
							'nama' => TarifMaster::find($val)->deskripsi,
							'id' => $val
						]);
						array_push($ids, $val);
					}
					array_push($temp, [
						'header' => $header,
						'detail' => $detail,
						'id' => $ids
					]);
				}
				
				//KALO NAMBAH HEADER BARU
				if(isset($req['header_'.$parent.'_new'])){
					foreach($req['header_'.$parent.'_new'] as $i => $header)
					{
						$detail = [];
						$ids = [];
						foreach ($req['detail_'.$parent.'_new'][$i] as $key => $val) {
							array_push($detail, [
								'nama' => TarifMaster::find($val)->deskripsi,
								'id' => $val
							]);
							array_push($ids, $val);
						}
						array_push($temp, [
							'header' => $header,
							'detail' => $detail,
							'id' => $ids
						]);
					}
				}

				$konten[$parent] = $temp;
			}

			$master = LaporanMaster::where('slug', $slug)->first();
			$master->nama = $nama;
			$master->konten = json_encode($konten);
			$master->save();
			$status = 1;
			$message = 'Berhasil Mengubah Laporan';
			$title = 'Berhasil!';

			DB::connection('lab_pa')->commit();
			return redirect('mutu/laporan')
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
		} catch (\Exception $e) {
			DB::connection('lab_pa')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			$status = -1;
			$message = 'Gagal Mengubah Laporan';
			$title = 'Gagal!';
			return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);

		}
	}

}