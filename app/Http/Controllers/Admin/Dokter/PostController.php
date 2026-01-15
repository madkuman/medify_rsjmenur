<?php

namespace App\Http\Controllers\Admin\Dokter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\RawatJalan\Dokter;
use App\Models\RawatJalan\DokterJadwal;
use App\Models\RawatJalan\Poliklinik;
use Auth;
use DB;

class PostController extends Controller
{

	public function create(Request $req)
	{
		try {
			DB::beginTransaction();      

			$creator = Auth::user()->id;

			$dokter = new Dokter;
			$dokter->name = $req->name;
            $dokter->kode_dokter = strtoupper($req->kode_dokter);
			$dokter->kuota_offline = empty($req->unlimited_offline) ? $req->kuota_offline : null;
			$dokter->bpjs_poli = $req->bpjs_poli;
			$dokter->bpjs_poli_text = $req->bpjs_poli_text;
			$dokter->bpjs_kode_dpjp = $req->bpjs_kode_dpjp;
			$dokter->bpjs_kode_dpjp_text = $req->bpjs_kode_dpjp_text;
			$dokter->bpjs_spesialis = $req->bpjs_spesialis;
			$dokter->bpjs_spesialis_text = $req->bpjs_spesialis_text;
			$dokter->created_by = $creator;
			$dokter->save();

			if (isset($req->jadwal_id)) {
				foreach ($req->jadwal_id as $key => $jadwal_id) {
					if ($jadwal_id == 0) $jadwal = new DokterJadwal();
					else $jadwal = DokterJadwal::find($jadwal_id);
					
	                $hari = explode('|', $req->hari[$key]);
					$poli = Poliklinik::find($req->poli[$key], ['name']);
					
					$jadwal->dokter_id = $dokter->id;
					$jadwal->poliklinik_id = $req->poli[$key];
					$jadwal->hari = $hari[1];
					$jadwal->hari_order = $hari[0];
					$jadwal->jam_buka = $req->time_start[$key];
					$jadwal->jam_tutup = $req->time_end[$key];
					$jadwal->nama_poli = $poli->name;
					$jadwal->nama_dokter = $dokter->name;
                    $jadwal->created_by = $creator;
                    $jadwal->is_video = $req->is_video[$key] ?? 0;
					$jadwal->save();
				}
			}

			$user  = User::find($req->user_id);
			if(!empty($user->id)){
				$user->dokter_id = $dokter->id;
				$user->save();
			}


			DB::commit();

			$status = 1;
			$message = "Berhasil menambah dokter";
			$title = 'Berhasil!';

			return redirect('admin/dokter')
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();
			$status = -1;
			$message = "Gagal menambah dokter baru";
			$title = 'Gagal!';

			return redirect()->back()
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);
		}
	}


	public function delete(Request $request)
	{
		$id = $request->id;
		try {
			DB::beginTransaction();

			$dokter = Dokter::find($id);
			$dokter->delete();
			
			DokterJadwal::where('dokter_id',$id)->delete();

			$data['url'] = 'admin/dokter';
			$data['type'] = 'success';
			$data['title'] = 'Berhasil';
			$data['text'] = 'Dokter berhasil dihapus.';
			DB::commit();

		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			$data['url'] = 'admin/dokter';
			$data['type'] = 'Error';
			$data['title'] = 'Gagal';
			$data['text'] = 'Dokter gagal dihapus.';
			DB::rollback();

		}
		return json_encode($data);
	}

	public function edit(Request $req, $id)
	{
		try {
			DB::beginTransaction();      

			$creator = Auth::user()->id;

			$dokter = Dokter::find($id);
			$dokter->name = $req->name;
            $dokter->kode_dokter = strtoupper($req->kode_dokter);
			$dokter->kuota_offline = empty($req->unlimited_offline) ? $req->kuota_offline : null;
			$dokter->bpjs_poli = $req->bpjs_poli;
			$dokter->bpjs_poli_text = $req->bpjs_poli_text;
			$dokter->bpjs_kode_dpjp = $req->bpjs_kode_dpjp;
			$dokter->bpjs_kode_dpjp_text = $req->bpjs_kode_dpjp_text;
			$dokter->bpjs_spesialis = $req->bpjs_spesialis;
			$dokter->bpjs_spesialis_text = $req->bpjs_spesialis_text;
			$dokter->created_by = $creator;
			$dokter->save();

			$jadwal_baru = isset($req->jadwal_id) ? $req->jadwal_id : [];
			$dokter_jadwal = DokterJadwal::where('dokter_id',$id)->pluck('id')->toArray();
			$changes = array_diff($dokter_jadwal, $jadwal_baru);
			if(!empty($changes)) {
				DokterJadwal::whereIn('id', $changes)->delete();
			}
			if (isset($req->jadwal_id)) {
				foreach ($req->jadwal_id as $key => $jadwal_id) {
					if ($jadwal_id == 0) $jadwal = new DokterJadwal();
					else $jadwal = DokterJadwal::find($jadwal_id);
					
	                $hari = explode('|', $req->hari[$key]);
					$poli = Poliklinik::find($req->poli[$key], ['name']);
					
					$jadwal->user_id = $req->user_id;
					$jadwal->dokter_id = $id;
					$jadwal->poliklinik_id = $req->poli[$key];
					$jadwal->hari = $hari[1];
					$jadwal->hari_order = $hari[0];
					$jadwal->jam_buka = $req->time_start[$key];
					$jadwal->jam_tutup = $req->time_end[$key];
					$jadwal->nama_poli = $poli->name;
					$jadwal->nama_dokter = $dokter->name;
                    $jadwal->created_by = $creator;
                    $jadwal->is_video = $req->is_video[$key] ?? 0;
					$jadwal->save();
				}
			}
			
			$user  = User::find($req->user_id);
			if(!empty($user->id)){
				$user->dokter_id = $dokter->id;
				$user->save();
			}

			DB::commit();

			$status = 1;
			$message = "Berhasil mengubah dokter";
			$title = 'Berhasil!';

			return redirect('admin/dokter')
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::rollback();
			$status = -1;
			$message = "Gagal mengubah dokter";
			$title = 'Gagal!';

			return redirect()->back()
			->with('status', $status)
			->with('message', $message)
			->with('title', $title);
		}
	}

	public function importHfis(Request $request)
	{
		if(!(config('medify.third-party.jkn_online.on') && config('medify.third-party.jkn_online.cons_id') != null)) return response()->json([
			'status' => -1,
			'title' => 'Gagal',
			'message' => 'JKN Belum Disetting',
		]);

		$process_queue = app(\App\Http\Controllers\ProcessQueue\MainController::class);
        
		if(!$process_queue->check('import-hfis')) return response()->json([
			'status' => -1,
			'title' => 'Gagal',
			'message' => 'Terdapat proses Import yang masih berjalan, atau tunggu 2 menit lagi',
		]);
		
		$process_queue->make('import-hfis', []);
		try {
			DB::connection('rawatinap')->beginTransaction();

			$import_hfis = app(\App\Http\Controllers\Admin\Dokter\EditController::class)->importHfis();

			if (is_string($import_hfis)) {
				DB::connection('rawatinap')->rollback();
				$process_queue->remove('import-hfis');
				return response()->json([
					'status' => -1,
					'title' => 'Gagal',
					'message' => $import_hfis,
				]);
			}

			DB::connection('rawatinap')->commit();
			$process_queue->remove('import-hfis');
			return response()->json([
				'status' => 1,
				'title' => 'Berhasil',
				'message' => 'Berhasil melakukan Import HFIS',
				'data' => [
					'message' => $import_hfis,
				]
			]);
		} catch (\Throwable $e) {
			DB::connection('rawatinap')->rollback();
			$process_queue->remove('import-hfis');
			// app(\App\Http\Controllers\Error\Handler::class)->bugsnag($e);
			// dd($e);
			return response()->json([
				'status' => -1,
				'title' => 'Gagal, Terjadi kesalahan server.',
				'message' => $e,
			]);
		}
	}
}
