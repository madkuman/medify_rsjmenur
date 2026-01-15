<?php

namespace App\Http\Controllers\Kasus\Asesmen\AsesmenAwalDokterNonJiwa;

use App\Models\Kasus\VitalSign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use Auth;

class EditController extends Controller
{
  public function edit(Request $request) {
    try {
      $input = $request->all();
      foreach ($input as $key => $value) {
        if($key == '_token')	continue;
        if($key == 'kasus')	continue;
        if($key == 'id')	continue;
        $hasil[$key] = $value;
      }
      $alatBantu = AlatBantu::where('id', $request->id)->first();
      if($request->jenis == 'Gawat Darurat Dokter Non Jiwa') {
        $alatBantu->type = 'rsj-menur-asesmen-awal-dokter-gawat-darurat-non-jiwa';
      } else if ($request->jenis == 'Rawat Inap Dokter Non Jiwa') {
        $alatBantu->type = 'rsj-menur-asesmen-awal-dokter-rawat-inap-non-jiwa';
      } else if ($request->jenis == 'Rawat Jalan Dokter Non Jiwa') {
        $alatBantu->type = 'rsj-menur-asesmen-awal-dokter-rawat-jalan-non-jiwa';
      }
      $alatBantu->val = json_encode($hasil);
      $alatBantu->created_by = Auth::user()->id;
      $alatBantu->save();
            
      // Input Vital Sign
      $vital = VitalSign::where('kasus_id', $alatBantu->kasus_id)->where('created_at', $alatBantu->created_at)->where('created_by', $alatBantu->created_by)->first();
      $vital->kasus_id = $alatBantu->kasus_id;
      $vital->temperatur = str_replace(",",".",$request->vital_suhu);
      $vital->nadi = str_replace(",",".",$request->vital_nadi);
      $vital->pernapasan = str_replace(",",".",$request->vital_frekuensi_nafas); 
      $vital->sistol = str_replace(",",".",$request->vital_td_sistol);
      $vital->diastol = str_replace(",",".",$request->vital_td_diastol);
      $vital->spo2 = str_replace(",",".",$request->vital_spo2);
      $vital->o2 = str_replace(",",".",$request->vital_o2);
      $sistol = (!empty($request->sistol) ? $request->sistol : 0);
      $diastol = (!empty($request->diastol) ? $request->diastol : 0);
      $sistol_map = ($sistol != 0 ? $sistol/3 : 0);
      $diastol_map = ($diastol != 0 ? $diastol*2/3 : 0);
      $vital->map_sistol_diastol =  $sistol_map + $diastol_map;
      $vital->created_by = Auth::user()->id;
      $vital->save();
      return back()
          ->with('status', 1)
          ->with('title', 'Sukses')
          ->with('message', 'Asesmen Awal Dokter Non Jiwa Berhasil di Simpan');
    } catch (\Exception $e) {
        app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    }
  }
}