<?php

namespace App\Http\Controllers\Kasus\Asesmen\PenandaanAreaOperasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PenandaanAreaOperasi;
use App\Models\Kasus\PenandaanAreaOperasiImageNotes;
use DB;
use Auth;

class CreateController extends Controller
{
	public function create($req, $kasus_id){
		$penandaan_area_operasi = new PenandaanAreaOperasi;

		$penandaan_area_operasi->tanggal_operasi = $req->tanggal_operasi;
		$penandaan_area_operasi->jenis_operasi = $req->jenis_operasi;
		$penandaan_area_operasi->created_by = Auth::user()->id;
		$penandaan_area_operasi->kasus_id = $kasus_id;
		$penandaan_area_operasi->save();

		$notes = json_decode($req->notes);
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