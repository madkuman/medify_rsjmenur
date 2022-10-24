<?php

namespace App\Http\Controllers\Humas\Komplain;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Humas\Komplain;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    public function deleteKomplain(Request $request)
    {
        try
        {
        	$komplain = Komplain::find($request->komplainid);
            $komplain->delete();

    		$status = 1;
			$message = 'Respon komplain berhasil dihapus.';
			$title = 'Berhasil!';
    		
            return redirect('humas')->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            
        }
    }
}
