<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PermintaanUSG;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Models\Kasus\AlatBantu;
use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    function __construct()
    {
    	DB::connection('kasus')->beginTransaction();

    	$this->model = new AlatBantu;
    }

    public function store($val, $kasus_id)
    {
    	try {
    		$permintaan_usg = $this->model;

    		$permintaan_usg->kasus_id 	= $kasus_id;
    		$permintaan_usg->type 		= 'permintaan-usg';
    		$permintaan_usg->val 		= $val;
    		$permintaan_usg->created_by = Auth::user()->id;
    		$permintaan_usg->save();

            DB::connection('kasus')->commit();

            $data['status'] = 1;
            $data['message'] = 'Input Berhasil';
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
