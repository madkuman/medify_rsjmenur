<?php

namespace App\Http\Controllers\Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi;

use DB;
use App\Models\Kasus\ICD10;
use App\Models\Kasus\Kasus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function searchICD10(Request $request)
    {
        $parameter = $request->long_desc ?? '';
        $icd10 = ICD10::select('id', 'code_icd', 'long_desc')->where('long_desc', 'like', "%" . $parameter . '%')->paginate(10);

        $data['code'] = 200;
        $data['message'] = 'Success';
        $data['data'] = $icd10;
        return json_encode($data);
    }
}