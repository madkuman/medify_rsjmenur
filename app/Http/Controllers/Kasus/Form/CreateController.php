<?php

namespace App\Http\Controllers\Kasus\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Form;

class CreateController extends Controller
{
    	public function create($judul,$deskripsi)
    	{
    		$form = new Form;
    		$form->judul = $judul;
    		$form->deskripsi = $deskripsi;
    		$form->save();
    		return $form;
    	}
}
