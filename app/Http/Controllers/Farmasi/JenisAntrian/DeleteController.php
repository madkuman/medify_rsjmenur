<?php

namespace App\Http\Controllers\Farmasi\JenisAntrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\JenisAntrian;
use Illuminate\Support\Facades\Auth;

class DeleteController extends Controller
{
    public function delete($data)
    {
        $jenis_antrian = JenisAntrian::find($data->id);
        $jenis_antrian->deleted_by = Auth::user()->id;
        $jenis_antrian->save();
        $jenis_antrian->delete();
    }
}
