<?php

namespace App\Http\Controllers\Kepegawaian\MasterInstitusiPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterInstitusiPendidikan;

class ReadController extends Controller
{
    public function getDataAjax($id)
    {
        $institusi_pendidikan = MasterInstitusiPendidikan::find($id);
        return json_encode($institusi_pendidikan);
    }

    public function getMasterInstitusiPendidikan()
	{
		$institusi = MasterInstitusiPendidikan::all();
        return $institusi;
    }
}
