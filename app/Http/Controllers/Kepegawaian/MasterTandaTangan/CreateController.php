<?php

namespace App\Http\Controllers\Kepegawaian\MasterTandaTangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\TandaTangan;

class CreateController extends Controller
{
    	public function new($alias,$bagian_atas,$bagian_bawah)
    	{
    		// $check = TandaTangan::where('nama',$nama)->get();
    		// if(count($check) == 0)
    		// {
    			$new = new TandaTangan;
    			$new->alias = $alias;
    			$new->bagian_atas = $bagian_atas;
                $new->bagian_bawah = $bagian_bawah;
    			$new->save();
    		// }
    		return 1;
    	}
}
