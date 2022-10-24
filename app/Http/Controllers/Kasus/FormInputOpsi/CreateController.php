<?php

namespace App\Http\Controllers\Kasus\FormInputOpsi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\FormInputOpsi;


class CreateController extends Controller
{
    	public function create($form_input_id,$deskripsi,$extra_input,$skor)
    	{
    		$input = new FormInputOpsi;
    		$input->form_input_id = $form_input_id;
    		$input->deskripsi = $deskripsi;
    		$input->extra_input = $extra_input;
    		$input->skor = $skor;
    		$input->save();
    		return $input;
    	}
}
