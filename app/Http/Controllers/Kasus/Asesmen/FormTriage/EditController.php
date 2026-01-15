<?php

namespace App\Http\Controllers\Kasus\Asesmen\FormTriage;

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
      $alatBantu->type = 'rsj-menur-rm-04-1-form-triage';
      $alatBantu->val = json_encode($hasil);
      $alatBantu->created_by = Auth::user()->id;
      $alatBantu->save();

      return back()
          ->with('status', 1)
          ->with('title', 'Sukses')
          ->with('message', 'Form Triage Berhasil di Simpan');
    } catch (\Exception $e) {
        app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    }
  }
}