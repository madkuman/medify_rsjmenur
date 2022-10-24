<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $pegawai = Pegawai::where('id',$id)->delete();
		return $pegawai;
    }
}
