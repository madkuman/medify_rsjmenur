<?php

namespace App\Http\Controllers\Kasus\ToDo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\ToDo;
use App\Models\Kasus\Kasus;

class EditController extends Controller
{
    	public function done($nomor_kasus,$id)
    	{
    		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$todo = ToDo::find($id);

		if($kasus->id != $todo->kasus_id)
		{
			return abort(404);
		}
		else
		{
			$todo->status = 1;
			$todo->save();
			return 1;
		}
    	}
}
