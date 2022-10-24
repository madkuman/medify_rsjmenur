<?php

namespace App\Http\Controllers\LabPK\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\Form;
use App\Models\LabPK\FormDetail;
use Auth;

class EditController extends Controller
{
    public function edit($data)
	{
		$form = Form::find($data['id']);
		$form->type =  $data['type'] ?? $form->type;
		$form->parameter =  $data['parameter'] ?? null;
		$form->slug =  $data['slug'] ?? null;
		$form->satuan =  $data['satuan'] ?? null;
		$form->metode = $data['metode'] ?? null;
		$form->created_by = Auth::user()->id;		
		$form->save();

		return $form;
	}

	public function editDetail($data)
	{
		$data = $this->getJenisKelaminCheckBoxes($data);
		if(!isset($data['usia_min']) || count($data['usia_min']) == 0) return 1;
		foreach($data['usia_min'] as $index => $item)
		{
			$form_id = $data['form_id'] ?? [];
			if (!array_key_exists($index, $form_id)) {
	    		$newForm = new FormDetail;
	    		$newForm->created_by = Auth::user()->id;
    		}
	    	else
	    		$newForm = FormDetail::find($data['form_id'][$index]);

    		$newForm->form_id = $data['id'];
    		$newForm->referensi_min = $data['form_referensi_min'][$index] ?? null;
    		$newForm->referensi_max = $data['form_referensi_max'][$index] ?? null;
    		$newForm->referensi_lainnya = $data['form_referensi_lainnya'][$index] ?? null;
    		$newForm->kritis_min = $data['form_kritis_min'][$index] ?? null;
    		$newForm->kritis_max = $data['form_kritis_max'][$index] ?? null;
    		$newForm->jk_pria = $data['jk_pria'][$index];
    		$newForm->jk_wanita = $data['jk_wanita'][$index];
    		$newForm->usia_min = $data['usia_min'][$index] ?? '0';
    		$newForm->usia_max = $data['usia_max'][$index] ?? '999';
    		$newForm->save();
		}
	}

	public function getJenisKelaminCheckBoxes($data)
	{
		$jk_pria = [];
		$jk_wanita = [];

		foreach ($data as $key => $value) {
			if (strpos($key, 'form_jk_pria') !== false) {
				$key_temp = $key;
				$key_temp_pieces = explode("-", $key_temp); 
				$index_temp = $key_temp_pieces[1];
				$jk_pria[$index_temp] = $value;
			}
			else if (strpos($key, 'form_jk_wanita') !== false) {
				$key_temp = $key;
				$key_temp_pieces = explode("-", $key_temp); 
				$index_temp = $key_temp_pieces[1];
				$jk_wanita[$index_temp] = $value;
			}
		}

		$temp_data['jk_pria'] = $jk_pria;
		$temp_data['jk_wanita'] = $jk_wanita;

		//agar urut, misal di submit ernyata array yang keisi 0 dan 2, maka di urutkan agar terisi 0,1 ini terjadi jika waktu ada 3 input, eh yang baris kedua dihapus. 
		foreach($temp_data as $key_array => $item_array)
		{
			foreach($item_array as $item)
			{
				$data[$key_array][] = $item;
			}
		}

		return $data;
	}
}
