<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengkajianAwalPasienTerminal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AsesmenAwalPasienTerminal\PengkajianAwalPasienTerminal;
use Auth;

class DeleteController extends Controller
{
	public function delete(Request $request){
		$id = $request->id;

		$pengkajian_awal_pasien_terminal = PengkajianAwalPasienTerminal::find($id);
		if($pengkajian_awal_pasien_terminal)
		{
			$pengkajian_awal_pasien_terminal->deleted_by = Auth::user()->id;
			$pengkajian_awal_pasien_terminal->save();
			$pengkajian_awal_pasien_terminal->delete();
		}
	}
}