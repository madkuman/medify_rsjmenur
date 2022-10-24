<?php

namespace App\Http\Controllers\IGD\Triage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Triage;

class EditController extends Controller
{
    public function edit(Request $request)
    {
        $triage = Triage::find($request->triage_id);
        $triage->nama_pasien = $request->nama_pasien;
        // $triage->keterangan = $request->keterangan;
        $triage->kasus_id = $request->kasus_id;
        $triage->save();

        return $triage;
    }
}
