<?php

namespace App\Http\Controllers\Kasus\Farmasi\CatatanPengobatanPasienDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\CatatanPengobatanPasienDetail;
use Carbon\Carbon;
use Auth;

class PostController extends Controller
{
	public function post($nomor_kasus, Request $request)
	{
		if(!empty($request->tanggal) || !empty($request->jam)) $pemberian_at = Carbon::createFromFormat('d-m-Y H:i', $request->tanggal.' '.$request->jam);
		else $pemberian_at = null;

		if(empty($request->id)) 
		{
			$detail = new CatatanPengobatanPasienDetail;
			$detail->created_by = Auth::user()->id;
		}
		else {
			$detail = CatatanPengobatanPasienDetail::find($request->id);
			$detail->updated_by = Auth::user()->id;
		}

		$detail->catatan_pengobatan_pasien_id = $request->catatan_pengobatan_pasien_id;
		$detail->pemberian_at = $pemberian_at;
        $detail->jumlah = $request->jumlah;
		$detail->status = $request->status;
		$detail->evaluasi = $request->evaluasi;
		$detail->verified_by = $request->verified_by;
		$detail->verified_by_2 = $request->verified_by_2;
		$detail->save();

		$status = 1;
		$message = 'Pemberian obat berhasil dicatat!';
		$title = 'Berhasil!';

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}


	public function delete($nomor_kasus, Request $request)
	{
		$detail = CatatanPengobatanPasienDetail::find($request->id);
		$detail->deleted_by = Auth::user()->id;
		$detail->save();
		$detail->delete();

		$status = 1;
		$message = 'Pemberian obat berhasil dihapus!';
		$title = 'Berhasil!';

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}
}
