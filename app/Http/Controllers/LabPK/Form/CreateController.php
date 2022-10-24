<?php

namespace App\Http\Controllers\LabPK\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\Form;
use Auth;

class CreateController extends Controller
{
    public function create($data)
	{
		$form = new Form;
		$form->type =  $data['type'] ?? 'text';
		$form->parameter =  $data['parameter'] ?? null;
		$form->slug =  $data['slug'] ?? null;
		$form->satuan =  $data['satuan'] ?? null;
		$form->metode = $data['metode'] ?? null;
		$form->created_by = Auth::user()->id;		
		$form->save();

		return $form;
	}
}
