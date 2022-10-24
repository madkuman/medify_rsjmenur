<?php

namespace App\Http\Controllers\Kasus\Urikkes\Layanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Layanan;
use App\Models\Keuangan\Tarif;
use App\Models\Urikkes\TransaksiDetail;
use Illuminate\Support\Facades\Auth;
use DB;
use Bugsnag;

class EditController extends Controller
{
    public function index(Request $request, $nomor_kasus){
      //dd($request->input());

      foreach ($request->input() as $key => $value) {
        $new = new Layanan();
        try {
          DB::connection('kasus')->beginTransaction();
            if($key != '_token'){
              $new->tarif_id = $key;
              $new->nomor_kasus = $nomor_kasus;
              $new->created_by = Auth::user()->id;
              $new->save();
            }
        DB::connection('kasus')->commit();
      } catch (\Exception $e) {
        DB::connection('kasus')->rollback();
        app('App\Http\Controllers\Error\Handler')->bugsnag($e);
      }
    }

    return back();

    }
}
