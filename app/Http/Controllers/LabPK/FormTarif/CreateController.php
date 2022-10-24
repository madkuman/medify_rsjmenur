<?php

namespace App\Http\Controllers\LabPK\FormTarif;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\FormTarif;
use Auth;

class CreateController extends Controller
{
	public function createMass($array_form_id, $tarif_master_id)
	{
		foreach($array_form_id as $form_id){
			$form_tarif = new FormTarif;
			$form_tarif->form_id = $form_id;
			$form_tarif->tarif_master_id = $tarif_master_id;
			$form_tarif->created_by = Auth::user()->id;
			$form_tarif->save();
		}

		return;

	}
}
