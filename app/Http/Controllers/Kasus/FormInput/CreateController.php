<?php

namespace App\Http\Controllers\Kasus\FormInput;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\FormInput;

class CreateController extends Controller
{
    	public function create($form_id,$label,$caption, $type,$page,$order)
    	{
    		$input = new FormInput;
    		$input->form_id = $form_id;
    		$input->label = $label;
    		$input->type = $type;
            $input->caption = $caption;
            $input->page = $page;
            $input->order = $order;
    		$input->save();
    		return $input;
    	}
}
