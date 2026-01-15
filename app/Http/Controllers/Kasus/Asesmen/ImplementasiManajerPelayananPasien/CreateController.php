<?php

namespace App\Http\Controllers\Kasus\Asesmen\ImplementasiManajerPelayananPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Kasus\Asesmen\ImplementasiManajerPelayananPasien\ReadController as Read;
use App\Models\Kasus\AlatBantu;
use DB;
use Auth;

class CreateController extends Controller
{
	function create(Request $request, $kasus_id)
	{
		$conn = DB::connection('kasus');
		$conn->beginTransaction();

		try {
			$asesmen = new AlatBantu();
			$asesmen->type = (new Read)->type_asesmen;
			$asesmen->val = $this->createJson($request);
			$asesmen->created_by = Auth::user()->id;
			$asesmen->kasus_id = $kasus_id;
			$asesmen->save();
			$conn->commit();

		} catch (\Exception $e) {
			$conn->rollBack();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}

	function createJson($request)
	{
		$json = new \StdClass;
		$json->diagnosa_medis = $request->diagnosa_medis;
		$json->mpp = $request->mpp;
		$json->data = $request->data;
		return json_encode($json);
	}
}
