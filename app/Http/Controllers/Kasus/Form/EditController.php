<?php

namespace App\Http\Controllers\Kasus\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Form;


class EditController extends Controller
{
    	public function edit($id, $judul,$deskripsi)
    	{
    		$form = Form::find($id);
    		$form->judul = $judul;
    		$form->deskripsi = $deskripsi;
    		$form->save();
    		return $form;
    	}
}
