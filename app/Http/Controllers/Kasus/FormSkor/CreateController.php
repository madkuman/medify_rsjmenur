<?php

namespace App\Http\Controllers\Kasus\FormSkor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\FormSkor;

class CreateController extends Controller
{
    	public function create($parent,$child)
    	{
    		$input = new FormSkor;
    		$input->input_parent_id = $parent;
    		$input->input_child_id = $child;
    		$input->save();
    		return $input;
    	}
}
