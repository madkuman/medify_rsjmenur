<?php

namespace App\Http\Controllers\Admin\Kasus\FormBuilder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Form;

class ViewController extends Controller
{
    	public function create()
    	{
    		return view('admin.kasus.form-builder.create');
    	}

    	public function single($id)
    	{
    		$data['form'] = Form::find($id);
    		$data['input_standard'] = ['text','number'];
    		if(empty($data['form'])) abort(404);
            $data['show_data_as'] = 'create';
    		return view('admin.kasus.form-builder.single',$data);
    	}

    	public function edit($id)
    	{
    		$data['form'] = Form::find($id);
    		$data['input_opsi'] = ['radio','dropdown','checkboxes'];
    		if(empty($data['form'])) abort(404);
    		return view('admin.kasus.form-builder.edit',$data);
    	}
}
