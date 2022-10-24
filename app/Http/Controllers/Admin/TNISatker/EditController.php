<?php

namespace App\Http\Controllers\Admin\TNISatker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNISatker;
use DB;
class EditController extends Controller
{
    public function edit($id, $data)
    {
        $satker = TNISatker::find($id);
        $satker->nama = $data['nama'];
        $satker->kode = $data['kode'];
        $satker->kotama_id = $data['kotama_id'];
        $satker->save();

        return $satker;
    }

    public function aktifPrintAjax($id,$flag)
    {	
    	$satker = TNISatker::find($id);
    	$satker->cetak = $flag;
    	$satker->save();

    	if($flag == 1)
    	{
    		$data['type'] = 'success';
	        $data['title'] = 'Sukses';
	        $data['text'] = 'Flag Print Berhasil di Aktifkan';	
    	}
    	else
    	{
    		$data['type'] = 'success';
	        $data['title'] = 'Sukses';
	        $data['text'] = 'Flag Print Berhasil di NonAktifkan';	
    	}
    	return json_encode($data);
    }

    public function editPrintKotama($kotama_id,$flag)
    {
    	TNISatker::where('kotama_id',$kotama_id)->update(['cetak' => $flag]);
    	return;
    }
}
