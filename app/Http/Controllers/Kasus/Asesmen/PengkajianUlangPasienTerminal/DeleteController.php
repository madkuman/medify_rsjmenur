<?php

namespace App\Http\Controllers\Kasus\Asesmen\PengkajianUlangPasienTerminal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PengkajianUlangPasienTerminal\PengkajianUlangPasienTerminal;
use Auth;

class DeleteController extends Controller
{
	public function delete(Request $request){
		$id = $request->id;

		$pengkajian_ulang_pasien_terminal = PengkajianUlangPasienTerminal::find($id);
		if($pengkajian_ulang_pasien_terminal){
			$pengkajian_ulang_pasien_terminal->deleted_by = Auth::user()->id;
			$pengkajian_ulang_pasien_terminal->save();
			$pengkajian_ulang_pasien_terminal->delete();
		}
	}
}