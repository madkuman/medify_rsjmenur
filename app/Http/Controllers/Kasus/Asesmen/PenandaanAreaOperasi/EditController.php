<?php

namespace App\Http\Controllers\Kasus\Asesmen\PenandaanAreaOperasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PenandaanAreaOperasi;
use App\Models\Kasus\PenandaanAreaOperasiImageNotes;
use DB;
use Auth;

class EditController extends Controller
{
	public function edit(Request $req){
		$penandaan_area_operasi = PenandaanAreaOperasi::find($req->id);
		
		$penandaan_area_operasi->tanggal_operasi = $req->tanggal_operasi;
		$penandaan_area_operasi->jenis_operasi = $req->jenis_operasi;
		$penandaan_area_operasi->save();

		$ids_to_delete = PenandaanAreaOperasiImageNotes::where('penandaan_area_operasi_id',$req->id)->pluck('id')->toArray();
		$delete = PenandaanAreaOperasiImageNotes::destroy($ids_to_delete);


		$notes = json_decode($req->notes);;
		if(!empty($notes))
		{
			foreach($notes as $note){
				$temp_note = new PenandaanAreaOperasiImageNotes;
				$temp_note->penandaan_area_operasi_id = $penandaan_area_operasi->id;
				$temp_note->x = $note->x;
				$temp_note->y = $note->y;
				$temp_note->note = $note->note;
				$temp_note->created_by = Auth::user()->id;
				$temp_note->save();
			}
		}
	}
}