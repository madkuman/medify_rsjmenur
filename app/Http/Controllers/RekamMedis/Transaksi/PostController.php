<?php

namespace App\Http\Controllers\RekamMedis\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\RekamMedis\Transaksi;
use App\Models\Pasien\Pasien;
use Carbon\Carbon;
use DB;

class PostController extends Controller
{
	public function permintaanBaru(Request $request)
	{
		$data['pasien_id'] = $request->pasien_id;
		$data['status'] = 0;
		$data['holder_keterangan'] = $request->keterangan;

		if(!empty($request->group_id))
		{
			$data['holder_type'] = 2;
			$data['holder_user_id'] = null;
			$data['holder_group_id'] = $request->group_id;
		}
		else
		{
			$data['holder_type'] = 1;
			$data['holder_user_id'] = Auth::user()->id;
			$data['holder_group_id'] = null;
		}


		$data['tujuan_id'] = $request->tujuan_id;
		$data['lokasi'] = $request->lokasi;
		$data['tujuan_id'] = $request->tujuan_id;
		$data['jenis'] = 1;

		$data['sender_confirmed_at'] = null;
		$data['sender_confirmed_by'] = null;
		$data['sender_keterangan'] = null;

		$transaksi = app('App\Http\Controllers\RekamMedis\Transaksi\CreateController')->create($data);
		return redirect('/rekammedis/transaksi/'.$transaksi->id);
	}

	public function setujuPengiriman(Request $request, $id)
	{
		$data['id'] = $id;
		$data = app('App\Http\Controllers\RekamMedis\Transaksi\EditController')->setujuPengiriman($data);

		$status = 1;
		$message = $data['message'];
		$title = 'Berhasil!';
		return back()
		->with('message', $message)
		->with('active_nav','cppt')
		->with('title',$title)
		->with('status', $status);
		return redirect('/rekammedis/transaksi/'.$id);

	}

	public function tolakPengiriman(Request $request, $id)
	{
		DB::connection('rekammedis')->beginTransaction();
		try
		{
			$keterangan = $request->keterangan_sender;
			$data = app('App\Http\Controllers\RekamMedis\Transaksi\EditController')->tolakPengiriman($id,$keterangan);

			$status = 1;
			$message = 'Permintaan file berhasil ditolak';
			$title = 'Berhasil!';

			DB::connection('rekammedis')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);


		} catch (\Exception $e) {

			DB::connection('rekammedis')->rollback();
			
		}
		

	}

	public function tolakPengirimanBatch($transaksi)
	{
		foreach($transaksi as $item)
		{
			$keterangan = 'Ditolak secara system';
			$data = app('App\Http\Controllers\RekamMedis\Transaksi\EditController')->tolakPengiriman($item->id,$keterangan);

		}
		$status['status'] = 1;
		$status['message'] = 'Permintaan file berhasil ditolak';
		$status['title'] = 'Berhasil!';


		return $status;
	}

	public function tolakPenerimaan(Request $request, $id)
	{
		DB::connection('rekammedis')->beginTransaction();
		try
		{
			$keterangan = $request->keterangan_holder;
			$data = app('App\Http\Controllers\RekamMedis\Transaksi\EditController')->tolakPenerimaan($id,$keterangan);

			$status = 1;
			$message = 'Anda mengkonfirmasi bahwa tidak menerima file ini!';
			$title = 'Berhasil!';

			DB::connection('rekammedis')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);


		} catch (\Exception $e) {

			DB::connection('rekammedis')->rollback();
			
		}
	}

	public function konfirmasiPenerimaan(Request $request, $id)
	{
		$data = app('App\Http\Controllers\RekamMedis\Transaksi\EditController')->konfirmasiPenerimaan($id);

		$status = 1;
		$message = $data['message'];
		$title = 'Berhasil!';
		
		return back()
		->with('message', $message)
		->with('active_nav','cppt')
		->with('title',$title)
		->with('status', $status);
		return redirect('/rekammedis/transaksi/'.$id);

	}

	public function konfirmasiPenerimaanAPI(Request $request)
	{
		$no_rm = $request->no_rm;
		$pasien = Pasien::where('no_rm',$no_rm)->first();
		if(empty($pasien->id)) 
		{
			$data['type'] = 'error';
			$data['title'] = 'Gagal';
			$data['text'] = 'Tidak ada permintaan untuk file RM ini.';
			$data['url'] = 0;
		}
		else
		{
			$isHolder = app('App\Http\Controllers\RekamMedis\Transaksi\ReadController')->isRMHolder($pasien->id);
			if($isHolder)
			{
				$data = app('App\Http\Controllers\RekamMedis\Transaksi\EditController')->konfirmasiPenerimaan($pasien->rm_transaksi_id);

				$data['type'] = $data['type'];
				$data['title'] = $data['title'];
				$data['text'] = $data['message'];
				$data['url'] = 0;
			}
			else
			{
				$data['type'] = 'error';
				$data['title'] = 'Gagal';
				$data['text'] = 'Tidak ada permintaan untuk file RM ini.';
				$data['url'] = 0;
			}
		}


		
		return json_encode($data);

	}

	public function permintaanKirim(Request $request)
	{
		$no_rm = $request->no_rm;
		$no_rm = explode(',', $no_rm);
		foreach($no_rm as $item)
		{
			//mencari siapa yang lagi megang no_rm
			$pasien_ids = Pasien::where('no_rm',$item)->pluck('id')->toArray();
			//cekapakah ada RM atau ada RM Double
			$count = count($pasien_ids);
			if($count > 1)
			{
				/*$data['type'] = 'error';
				$data['title'] = 'Gagal';
				$data['text'] = 'Ada '.count($pasien).' pasien yang memiliki no rm '.$item;
				$data['url'] = 0;
				return json_encode($data);
				*/
			}
			else if($count == 1)
			{
				$pasien = Pasien::where('no_rm',$item)->first();
			}
			else
			{
				$data['type'] = 'error';
				$data['title'] = 'Gagal';
				$data['text'] = 'No RM '.$item.' Tidak ditemukan';
				$data['url'] = 0;
				return json_encode($data);
			}
			$transaksi = Transaksi::whereIn('pasien_id',$pasien_ids)->where('jenis',1)->whereNull('sender_confirmed_at')->orderBy('id', 'desc')->get();
			
			//jika lebih dari 2 maka tidak bisa dikirim batch harus lewat menu satuan
			if(count($transaksi) > 1)
			{
				$data['type'] = 'question';
				$data['title'] = '';
				$data['text'] = 'Ada lebih dari 1 permintaan, silahkan pilih opsi dibawah.';
				$data['url'] = 0;
				$data['transaksi'] = $this->prosesMultiTransaksiAPI($transaksi);

			}
			elseif(count($transaksi) == 0)
			{
				$text = 'Tidak ada permintaan untuk file RM ini.';
				$last_transaksi = app('App\Http\Controllers\RekamMedis\Transaksi\ReadController')->getLastTransaksi($item);
				if($last_transaksi)
				{
					$text.=' <br>File terakhir dikirim ke <strong>'.$last_transaksi->lokasi.'</strong>. <br>Pada <strong>'.$last_transaksi->created_at->format('d F Y H:i').'</strong>';
				}

				$data['type'] = 'error';
				$data['title'] = 'Gagal';
				$data['text'] = $text;
				$data['url'] = 0;
			}
			else
			{
				$pasien = $transaksi[0]->pasien;
				$holder = $pasien->rm_current_holder;

       			$rm_group = app('App\Http\Controllers\Group\Group\ReadController')->getRMGroupSlug('rekam-medis');

				if($holder->id == $rm_group->id && $holder->type == 2)
				{
					$data['id'] = $transaksi[0]->id;
					$transaksi  = Transaksi::find($transaksi[0]->id);
					$data = app('App\Http\Controllers\RekamMedis\Transaksi\EditController')->setujuPengiriman($data);
					$data['type'] = 'success';
					$data['title'] = 'Berhasil';
					$data['text'] = 'Sukses mengirimkan file '.$pasien->name.' ke '.$transaksi->holder->name;
					$data['url'] = 0;
				}
				else
				{
					$data['type'] = 'error';
					$data['title'] = 'Gagal';
					$data['text'] = 'File tidak ada di ruang RM. File dibawa atau terdapat di <strong>'.$holder->name.'</strong>';
					$data['url'] = 0;
				}
			}

			return json_encode($data);
		}
	}

	public function pengembalianKonfirmasi(Request $request)
	{
		DB::connection('rekammedis')->beginTransaction();
		DB::connection('patients')->beginTransaction();
		try{
			$no_rm = $request->no_rm;
			$force = $request->force;
			$flag = $request->flag;
			$no_rm = explode(',', $no_rm);
			foreach($no_rm as $item)
			{
				$pasien = Pasien::where('no_rm',$item)->first();
				if($force == 1) $data = $this->pengembalianKonfirmasiAmbilRM($pasien);
				else $data = $this->pengembalianKonfirmasiTransaksi($pasien);

				DB::connection('rekammedis')->commit();
				DB::connection('patients')->commit();

				if($flag != 1) return json_encode($data);


			}
		}
		catch (\Exception $e) {
			DB::connection('rekammedis')->rollback();
			DB::connection('patients')->rollback();
		}

		return redirect('/rekammedis/file-tidak-di-rm');
	}

	private function pengembalianKonfirmasiTransaksi($pasien)
	{
		$rm_group = app('App\Http\Controllers\Group\Group\ReadController')->getRMGroupSlug('rekam-medis');
		//mencari siapa yang lagi megang no_rm
		$status = [0,1];
		$transaksi = Transaksi::where('pasien_id',$pasien->id)->where('holder_type',2)->where('holder_group_id',$rm_group->id)->where('jenis',2)->whereIn('status',$status)->get();

					//jika lebih dari 2 maka tidak bisa dikirim batch harus lewat menu satuan
		if(count($transaksi) > 1)
		{
			$data['type'] = 'confirm';
			$data['title'] = 'Warning';
			$data['text'] = 'Ada lebih dari 1 pengembalian, apakah anda tetap mengkonfirmasi penerimaan?';
			$data['url'] = 0;

		}
		elseif(count($transaksi) == 0)
		{
			$data['type'] = 'confirm';
			$data['title'] = 'Warning';
			$data['text'] = 'Tidak ada pengembalian untuk file RM ini. Apakah anda tetap mengkonfirmasi penerimaan?';
			$data['url'] = 0;
		}
		else
		{
			$holder = $pasien->rm_current_holder;

			if($holder->id == $rm_group->id && $holder->type == 2)
			{
				$data['id'] = $transaksi[0]->id;
				$data = app('App\Http\Controllers\RekamMedis\Transaksi\EditController')->konfirmasiPenerimaan($data['id']);
				$data['type'] = 'success';
				$data['title'] = 'Berhasil';
				$data['text'] = 'Sukses menerima file.';
				$data['url'] = 0;
			}
			else
			{
				$data['type'] = 'confirm';
				$data['title'] = 'Warning';
				$data['text'] = 'File tidak ada di ruang RM. File dibawa atau terdapat di <strong>'.$holder->name.'</strong>.Apakah anda tetap mengkonfirmasi penerimaan?';
				$data['url'] = 0;
			}
		}

		return $data;
	}


	private function pengembalianKonfirmasiAmbilRM($pasien)
	{
		$rm_group = app('App\Http\Controllers\Group\Group\ReadController')->getRMGroupSlug('rekam-medis');
		$data['pasien_id'] = $pasien->id;
		$data['status'] = 2;
		$data['holder_type'] = 2;
		$data['holder_user_id'] = null;
		$data['holder_group_id'] = $rm_group->id;
		$data['holder_confirmed_at'] = Carbon::now();
		$data['holder_confirmed_by'] = Auth::user()->id;
		$data['holder_keterangan'] = 'Mengambil file RM via fitur Scan RM';

		$data['tujuan_id'] = 1;
		$data['lokasi'] = 'Ruang File RM';
		$data['jenis'] = 3;

		$data['sender_confirmed_at'] = Carbon::now();
		$data['sender_confirmed_by'] = Auth::user()->id;
		$data['sender_keterangan'] = '';

		$transaksi = app('App\Http\Controllers\RekamMedis\Transaksi\CreateController')->create($data);


		$data['type'] = 'success';
		$data['title'] = 'Sukses';
		$data['text'] = 'Sukses menerima file.';
		$data['url'] = 0;

		return $data;
	}

	public function transferBaru(Request $request)
	{
		DB::connection('rekammedis')->beginTransaction();
		try{
			$data['pasien_id'] = $request->pasien_id;
			$data['status'] = 1;
			$data['holder_type'] = $request->holder_type;
			$data['holder_user_id'] = $request->holder_user_id;
			$data['holder_group_id'] = $request->holder_group_id;
			$data['holder_keterangan'] = null;

			$data['tujuan_id'] = $request->tujuan_id;
			$data['lokasi'] = $request->lokasi;
			$data['jenis'] = 2;

			$data['sender_confirmed_at'] = Carbon::now();
			$data['sender_confirmed_by'] = Auth::user()->id;
			$data['sender_keterangan'] = $request->keterangan;

			$transaksi = app('App\Http\Controllers\RekamMedis\Transaksi\CreateController')->create($data);
			DB::connection('rekammedis')->commit();
			return redirect('/rekammedis/transaksi/'.$transaksi->id);

		}
		catch (\Exception $e) {
			DB::connection('rekammedis')->rollback();
			$status = -1;
			$message = 'Gagal';
			$title = 'Berhasil!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
	}

	public function ambilRM(Request $request)
	{
		DB::connection('rekammedis')->beginTransaction();
		try{
			$data['pasien_id'] = $request->pasien_id;
			$data['status'] = 2;
			$data['holder_type'] = $request->holder_type;
			$data['holder_user_id'] = $request->holder_user_id;
			$data['holder_group_id'] = $request->holder_group_id;
			$data['holder_confirmed_at'] = Carbon::now();
			$data['holder_confirmed_by'] = Auth::user()->id;
			$data['holder_keterangan'] = $request->holder_keterangan;

			$data['tujuan_id'] = $request->tujuan_id;
			$data['lokasi'] = $request->lokasi;
			$data['jenis'] = 3;

			$data['sender_confirmed_at'] = Carbon::now();
			$data['sender_confirmed_by'] = Auth::user()->id;
			$data['sender_keterangan'] = $request->keterangan;

			$transaksi = app('App\Http\Controllers\RekamMedis\Transaksi\CreateController')->create($data);

			DB::connection('rekammedis')->commit();

			$status = 1;
			$message = 'Berhasil';
			$title = 'File RM Berhasil dikembalikan ke Ruang RM!';
		}

		catch (\Exception $e) {
			DB::connection('rekammedis')->rollback();
			$status = -1;
			$message = 'Gagal';
			$title = 'Berhasil!';
		}
		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	private function prosesMultiTransaksiAPI($transaksi)
	{
		$array = array();
		foreach($transaksi as $item)
		{
			$temp = new \stdClass();
			$temp->id = $item->id;
			$temp->tujuan = $item->holder->name;
			$temp->waktu = $item->created_at->diffForHumans();
				array_push($array, $temp);
		}
		return $array;
	}

}
