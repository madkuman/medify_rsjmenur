<?php

namespace App\Http\Controllers\Keuangan\Penagihan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\PaketPenagihan;
use App\Models\Keuangan\Piutang;
use DB;

class DeleteController extends Controller
{
	public function deletePenagihan(Request $request){
		try {
			DB::connection('keuangan')->beginTransaction();
			$id = $request->id;
			$piutang = Piutang::where('paket_penagihan_id', $id)->update(['paket_penagihan_id' => null]);
			$paket_penagihan = PaketPenagihan::find($id);
			$paket_penagihan->delete();

			DB::connection('keuangan')->commit();

			return $this->resSuccessJsonWeb(
				$message = 'Berhasil',
				$url = 0,
				$response = []
			);

		} catch (\Throwable $th) {
			DB::connection('keuangan')->rollback();
			return $this->bugsnagJson($th);
		}
	}
}