<?php

namespace App\Http\Controllers\Kepegawaian\MasterJenisPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJenisPendidikan;

class ReadController extends Controller
{
    public function getDataAjax($id)
    {
        $jenis_pendidikan = MasterJenisPendidikan::find($id);
        return json_encode($jenis_pendidikan);
    }

    public function getMasterJenisPendidikan()
	{
		$jenis_pendidikan = MasterJenisPendidikan::all();
        return $jenis_pendidikan;
    }
}
