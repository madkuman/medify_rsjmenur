<?php

namespace App\Http\Controllers\LabPK\MikrobiologiSpesimenKategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\MikrobiologiSpesimenKategori;
use Auth;

class EditController extends Controller
{
    public function edit($data)
	{
		$form = MikrobiologiSpesimenKategori::find($data['id']);
		$form->nama =  $data['nama'] ?? null;
		$form->created_by = Auth::user()->id;		
		$form->save();

		return $form;
	}
}
