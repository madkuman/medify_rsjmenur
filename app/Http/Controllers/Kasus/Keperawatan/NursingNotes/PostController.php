<?php

namespace App\Http\Controllers\Kasus\Keperawatan\NursingNotes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\NursingNotes;
use App\Models\Kasus\NursingNotesDetail;
use App\Models\Kasus\Kasus;
use DB;
use Carbon\Carbon;
use Auth;

class PostController extends Controller
{
	public function post($nomor_kasus, Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try
		{
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();

			if(empty($request->id))
			{
				$note = new NursingNotes;
				$note->kasus_id = $kasus->id;
				$note->created_by = Auth::user()->id;
				$message = 'Nursing Notes baru berhasil dibuat!';
			}
			else
			{
				$note = NursingNotes::find($request->id);
				$note->updated_by = Auth::user()->id;
				$message = 'Nursing Notes baru berhasil di update!';
			}

			$note->jam = $request->jam;
			$note->evaluasi = $request->evaluasi;
			$note->save();


			$delete_ids = NursingNotesDetail::where('nursing_note_id',$note->id)->pluck('id')->toArray();
			$delete = NursingNotesDetail::destroy($delete_ids);
			$implementasi = json_decode($request->implementasi_text);
			foreach ($implementasi as $item) {
				$detail = new NursingNotesDetail;
				$detail->nursing_note_id = $note->id;
				$detail->implementasi_id = $item->id;
				$detail->implementasi_text = $item->text;
				$detail->diagnosa_text = $item->diagnosa;
				$detail->created_by = Auth::user()->id;
				$detail->save();
			}

			$status = 1;
			$title = 'Berhasil!';

			DB::connection('kasus')->commit();
			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kasus')->rollback();

			$status = -1;
			$message = 'Nursing Notes gagal dibuat!';
			$title = 'Gagal!';

			return back()
			->with('message', $message)
			->with('active_nav','cppt')
			->with('title',$title)
			->with('status', $status);
		}
	}

	public function verifikasi($nomor_kasus, $id)
	{
		$note = NursingNotes::find($id);
		$note->verified_at = Carbon::now();
		$note->verified_by = Auth::user()->id;
		$note->save();

		$status = 1;
		$message = 'Nursing Notes berhasil diverifikasi!';
		$title = 'Berhasil!';

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}

	public function delete($nomor_kasus, Request $request)
	{
		$note = NursingNotes::find($request->id);
		$note->deleted_by = Auth::user()->id;
		$note->save();
		$note->delete();

		$status = 1;
		$message = 'Nursing Notes berhasil dihapus!';
		$title = 'Berhasil!';

		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
	}
}
