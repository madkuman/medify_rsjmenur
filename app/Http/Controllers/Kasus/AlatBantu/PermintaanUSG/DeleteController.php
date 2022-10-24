<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PermintaanUSG;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\Kasus\AlatBantu;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    function __construct($foo = null)
	{
		DB::connection('kasus')->beginTransaction();
	}

	public function delete($id)
    {

    	try {

    		$permintaan_usg = AlatBantu::find($id);

    		$permintaan_usg->delete();

    		DB::connection('kasus')->commit();

            $data['status'] = 1;
            $data['message'] = 'Delete Berhasil';
            $data['title'] = 'Berhasil!';
    	} catch (Exception $e) {
    		
    		DB::connection('kasus')->rollback();

            $data['status'] = -1;
            $data['message'] = 'Error Exception';
            $data['title'] = 'Gagal!';	
    	}

    	return $data;
    }
}
