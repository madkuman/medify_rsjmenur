<?php

namespace App\Http\Controllers\LabPK\MikrobiologiSpesimen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\MikrobiologiSpesimen;
use Auth;


class CreateController extends Controller
{
	public function create($data)
	{
		$form = new MikrobiologiSpesimen;
		$form->nama =  $data['nama'] ?? null;
		$form->mikrobiologi_spesimen_kategori_id =  $data['mikrobiologi_spesimen_kategori_id'] ?? null;
		$form->input_keterangan =  $data['input_keterangan'] ?? 0;
		$form->created_by = Auth::user()->id;		
		$form->save();

		return $form;
	}
}
