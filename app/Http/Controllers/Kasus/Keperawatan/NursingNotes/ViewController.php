<?php

namespace App\Http\Controllers\Kasus\Keperawatan\NursingNotes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Keperawatan;
use App\Models\Kasus\NursingNotes;
use App\Models\Kasus\NursingNotesDetail;

class ViewController extends Controller
{
	public function index($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$kasus_asuhan = Keperawatan::with(['asuhan.detail'])->where('kasus_id', $kasus->id)->get();

		$nursing_notes = NursingNotes::where('kasus_id',$kasus->id)->with('asuhan','details.implementasi','creator')->orderBy('created_at','desc')->get();

		$data['kasus'] = $kasus;
		$data['nursing_notes'] = $nursing_notes;
		$data['active_nav'] = 'nursing-notes';
		$data['sidebar_active'] = 'keperawatan';
		$data['kasus_asuhan'] = $kasus_asuhan;

		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'view','keperawatan',null);

		return view('kasus.keperawatan.index',$data);
	}
}
