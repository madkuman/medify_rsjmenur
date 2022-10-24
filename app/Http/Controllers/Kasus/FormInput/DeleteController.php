<?php

namespace App\Http\Controllers\Kasus\FormInput;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\FormInput;

class DeleteController extends Controller
{
    	public function deletebyFormID($form_id)
    	{
    		$input = FormInput::where('form_id',$form_id)->delete();
    		return $input;
    	}
}
