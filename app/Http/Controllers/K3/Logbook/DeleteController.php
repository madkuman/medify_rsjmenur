<?php

namespace App\Http\Controllers\K3\Logbook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\K3\Logbook;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        try
        {
        	$logbook = Logbook::find($request->logbookid);
            $logbook->delete();

    		$status = 1;
			$message = 'Kecelakaan K3 berhasil dihapus.';
			$title = 'Berhasil!';
    		
            return redirect('k3')->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}
