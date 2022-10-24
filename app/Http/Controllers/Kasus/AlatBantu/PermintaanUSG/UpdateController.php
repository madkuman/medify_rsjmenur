<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PermintaanUSG;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\Kasus\AlatBantu;
use App\Http\Controllers\Controller;

class UpdateController extends Controller
{
	function __construct($foo = null)
	{
		DB::connection('kasus')->beginTransaction();
	}

    public function update($val, $id)
    {

    	try {

    		$permintaan_usg = AlatBantu::find($id);

    		$permintaan_usg->val = $val;
    		$permintaan_usg->updated_by = Auth::user()->id;

    		$permintaan_usg->save();

    		DB::connection('kasus')->commit();

            $data['status'] = 1;
            $data['message'] = 'Update Berhasil';
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
