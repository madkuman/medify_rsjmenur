<?php

namespace App\Http\Controllers\Humas\Komplain;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Humas\Komplain;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditController extends Controller
{
    public function update(Request $request)
    {
        DB::connection('humas')->beginTransaction();
        try
        {
        	$komplain = Komplain::find($request->komplainid);
        	$komplain->komplain_keterangan = $request->kompketerangan;
            $komplain->lokasi = $request->lokasi;

            $kompdate = $request->komptahun.'-'.$request->kompbulan.'-'.$request->komphari;
            $komptime = $request->kompjam.':'.$request->kompmenit.':00';
            $komplain->komplain_tanggal = Carbon::createFromTimestamp(strtotime($kompdate.$komptime));

            $respdate = $request->resptahun.'-'.$request->respbulan.'-'.$request->resphari;
            $resptime = $request->respjam.':'.$request->respmenit.':00';
            $komplain->respon_tanggal = Carbon::createFromTimestamp(strtotime($respdate.$resptime));

            $komplain->created_by = Auth::user()->id;
            $komplain->save();

    		$status = 1;
			$message = 'Respon komplain berhasil diperbarui.';
			$title = 'Berhasil!';
    		
        	DB::connection('humas')->commit();
            return redirect('humas')->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('humas')->rollback();
            
        }
    }   
}