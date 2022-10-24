<?php

namespace App\Http\Controllers\Kepegawaian\MasterStrataPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterStrataPendidikan;

class ReadController extends Controller
{
    public function getDataAjax($id)
    {
        $strata = MasterStrataPendidikan::find($id);
        return json_encode($strata);
    }

    public function getMasterStrataPendidikan()
	{
		$strata_pendidikan = MasterStrataPendidikan::all();
        return $strata_pendidikan;
    }
}
