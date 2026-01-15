<?php

namespace App\Http\Controllers\Kasus\Farmasi\KonselingObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\RekonsiliasiObat;
use App\Models\Kasus\RekonsiliasiObatDetail;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use DB;
use Auth;

class CreateController extends Controller
{
    public function create(Request $request, $kasus)
    {
        try {
            $input = $request->all();
            foreach ($input as $key => $value) {
                if ($key == '_token')    continue;
                if ($key == 'kasus')    continue;
                if ($key == 'id')    continue;
                $hasil[$key] = $value;
            }
            $alatBantu = new AlatBantu();
            $alatBantu->kasus_id = $kasus->id;
            $alatBantu->type = 'farmasi-konseling-obat';
            $alatBantu->val = json_encode($hasil);
            $alatBantu->created_by = Auth::user()->id;
            $alatBantu->save();

            return back()
                ->with('status', 1)
                ->with('title', 'Sukses')
                ->with('message', 'Konseling Obat Baru Berhasil di Simpan');
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}
