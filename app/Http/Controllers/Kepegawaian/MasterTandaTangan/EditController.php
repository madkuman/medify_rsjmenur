<?php

namespace App\Http\Controllers\Kepegawaian\MasterTandaTangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\TandaTangan;
use Auth;

class EditController extends Controller
{
	public function edit($id,$alias,$bagian_atas,$bagian_bawah)
	{
		$tanda_tangan = TandaTangan::find($id);
		$tanda_tangan->alias = $alias;
		$tanda_tangan->bagian_atas = $bagian_atas;
		$tanda_tangan->bagian_bawah = $bagian_bawah;
		$tanda_tangan->save();
		$data = $this->return(1,'Berhasil mengubah data');
		return $data;
		
	}
	private function return($status,$message)
	{
		$data['status'] = $status;
		$data['message'] = $message;
		return $data;
	}
}
