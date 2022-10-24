<?php

namespace App\Http\Controllers\Kasus\ToDo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\ToDo;
use Auth;

class CreateController extends Controller
{
    	public function create($desc,$creator,$cppt_id,$kasus_id)
    	{
    		$todo = new ToDo;
    		$todo->kasus_id = $kasus_id;
    		$todo->desc = $desc;
    		$todo->created_by = $creator;
    		$todo->cppt_id = $cppt_id;
    		$todo->save();

    		return $todo;
    	}
}
