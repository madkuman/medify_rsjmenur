<?php

namespace App\Http\Controllers\Kasus\Penunjang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Penunjang;
use App\Models\Kasus\PenunjangKomentar;
use App\Models\Kasus\Kasus;
use DB;
use Bugsnag;
use Auth;

class EditController extends Controller
{
	public function updateData($title,$caption,$penunjang_id)
	{
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
    		$penunjang = Penunjang::find($penunjang_id);
    		$penunjang->judul = $title;
    		$penunjang->caption = $caption;
    		$penunjang->updated_by = Auth::user()->id;
            $penunjang->save();

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return $penunjang;

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
	}

}