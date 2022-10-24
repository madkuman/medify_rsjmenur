<?php

namespace App\Http\Controllers\LabPK\FormTarif;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\FormTarif;
use App\Models\LabPK\Form;

class ViewController extends Controller
{
	public function edit($tarif_master_id)
    {
        $data['header'] = "pengaturan";
		$data['tarif'] = app('App\Http\Controllers\Keuangan\TarifMaster\ReadController')->getSingle($tarif_master_id);
        $form_tarif = FormTarif::where('tarif_master_id',$tarif_master_id)->with('form')->get();
        $used_form_ids = $form_tarif->pluck('form_id')->toArray();
        $data['forms_available'] = Form::whereNotIn('id',$used_form_ids)->get();
        $data['form_tarif'] = $form_tarif;
        return view('labpk.form-tarif.edit', $data);
    }
}
