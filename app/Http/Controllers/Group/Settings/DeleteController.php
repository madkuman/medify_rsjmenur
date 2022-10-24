<?php

namespace App\Http\Controllers\Group\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Bugsnag;
use App\Models\Hospital\Grup;
use App\Models\Hospital\UserGroup;

class DeleteController extends Controller
{	
    public function delete($id)
    {
    	try {
			DB::connection('mysql')->beginTransaction();
			$grup = Grup::find($id);
			$grup->delete();
			$status = 1;
			DB::connection('mysql')->commit();
			$status = 1;
			$message = 'Berhasil menghapus grup';
			$title = 'Berhasil!';
			
		} catch (Exception $e) {

			$status = -1;
			DB::connection('mysql')->rollback();
			Bugsnag::notifyException($e);
		}
		return redirect('/my/group')
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
    }

    public function deleteFromUnitTindakan($url)
    {
		$grup = Grup::where('url', $url)->first();
    	
		$grup->delete();
		return 1;
    }
}
