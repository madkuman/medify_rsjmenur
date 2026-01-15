<?php

namespace App\Http\Controllers\Kasus\Farmasi\CatatanPengobatanPasienDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\CatatanPengobatanPasien;
use App\Models\Kasus\CatatanPengobatanPasienDetail;
use Carbon\Carbon;
use Auth;

class PostController extends Controller
{
	public function post($nomor_kasus, Request $request)
	{
		if(!empty($request->tanggal) || !empty($request->jam)) $pemberian_at = Carbon::createFromFormat('Y-m-d H:i', $request->tanggal.' '.$request->jam);
		else $pemberian_at = Carbon::now();

		$verifikator_name_1 =  $request->verifikator_name ?? null;
		$verifikator_name_2 =  $request->verifikator_name_2 ?? null;
		$path_ttd_verif_1 =  $request->imgUrl ?? null;
		$path_ttd_verif_2 =  $request->imgUrl2 ?? null;

		if($request->method == 'create')
		{
            if (is_array($request->cpo_ids)) {
                foreach($request->cpo_ids as $cpo_id)
                {
                    $cpo = CatatanPengobatanPasien::where('id',$cpo_id)->first();

                    $detail = new CatatanPengobatanPasienDetail;
                    $detail->created_by = Auth::user()->id;
                    $detail->save();

                    $this->storeData($detail,$cpo_id,$pemberian_at,$request->status,$request->evaluasi,$request->verified_by, $request->verified_by_2, $verifikator_name_1, $verifikator_name_2, $path_ttd_verif_1, $path_ttd_verif_2);				
                }
            } else {
                    $cpo = CatatanPengobatanPasien::where('id',$request->cpo_ids)->first();

                    $detail = new CatatanPengobatanPasienDetail;
                    $detail->created_by = Auth::user()->id;
                    $detail->save();

                    $this->storeData($detail,$request->cpo_ids,$pemberian_at,$request->status,$request->evaluasi,$request->verified_by, $request->verified_by_2, $verifikator_name_1, $verifikator_name_2, $path_ttd_verif_1, $path_ttd_verif_2);
            }
		}
		else {
			if(!empty($request->tmp_path_signature_1 && $request->tmp_path_signature_1 != null)) $path_ttd_verif_1 = $request->tmp_path_signature_1;
			if(!empty($request->tmp_path_signature_2 && $request->tmp_path_signature_2 != null)) $path_ttd_verif_2 = $request->tmp_path_signature_2;

			$detail = CatatanPengobatanPasienDetail::find($request->id);
			$detail->updated_by = Auth::user()->id;
			$detail->save();

			$this->storeData($detail,$detail->catatan_pengobatan_pasien_id,$pemberian_at,$request->status,$request->evaluasi,$request->verified_by,$request->verified_by_2, $verifikator_name_1, $verifikator_name_2, $path_ttd_verif_1, $path_ttd_verif_2);
		}


		$status = 1;
		$message = 'Pemberian obat berhasil dicatat!';
		$title = 'Berhasil!';

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function storeData($detail,$catatan_pengobatan_pasien_id,$pemberian_at,$status,$evaluasi,$verified_by,$verified_by_2, $verifikator_name_1 = null , $verifikator_name_2 = null, $path_ttd_verif_1 = null, $path_ttd_verif_2 = null)
	{
		$detail->catatan_pengobatan_pasien_id = $catatan_pengobatan_pasien_id;
		$detail->pemberian_at = $pemberian_at;
		$detail->status = $status;
		$detail->evaluasi = $evaluasi;
		$detail->verified_by = $verified_by;
		$detail->verified_by_2 = $verified_by_2;
		$detail->verifikator_name_1 = $verifikator_name_1;
		$detail->verifikator_name_2 = $verifikator_name_2;
		$detail->path_ttd_verif_1 = $path_ttd_verif_1;
		$detail->path_ttd_verif_2 = $path_ttd_verif_2;
		$cpp = CatatanPengobatanPasien::find($catatan_pengobatan_pasien_id);
		if ($cpp->farmasi_resep_detail->count() != 0) {
			$detail->farmasi_resep_detail_id = $cpp->farmasi_resep_detail->last()->id;
		}
		$detail->save();

	}

	public function searchCatatanPengobatanPasienbyObatID($obat_id)
	{
		$data = CatatanPengobatanPasien::where('obat_id',$obat_id)->orderBy('id','desc')->first();
		return $data;
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
