<?php

namespace App\Http\Controllers\Kasus\FormHasil;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Form;
use App\Models\Kasus\FormHasil;

class ReadController extends Controller
{
    public function all($nomor_kasus)
    {
    	$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
        $forms = Form::with('input')->get();


        foreach ($forms as $form) {
	        	$lasthasil = $form->getLastHasil($kasus->id);
        	if (!empty($lasthasil)) {
        		// if($lasthasil->form_id == 27)dd($lasthasil);
	        	 $hasil = FormHasil::find($lasthasil->id);

		        $data_hasil = json_decode($hasil->hasil);
		        $data_hasil = (array) $data_hasil->hasil;

		        $array_hasil_value = array_column($data_hasil, 'value', 'id');
		        $array_hasil_deskripsi = array_column($data_hasil, 'deskripsi', 'id');
		        $array_hasil_skor = array_column($data_hasil, 'skor', 'id');
		        $array_hasil_id = array_column($data_hasil, 'id', 'id');
		        $array_hasil_keterangan = array_column($data_hasil, 'keterangan', 'id');

		        $text_components = ['h2','h3','h4','notes'];

		        foreach($form->input as $input)
		        {
		            if(!in_array($input->type, $text_components)){

		                if(!empty($array_hasil_skor[$input->id])) $skor = $array_hasil_skor[$input->id]; else $skor = '';
		                if(!empty($array_hasil_value[$input->id])) $value = $array_hasil_value[$input->id]; else $value = '';
		                if(!empty($array_hasil_deskripsi[$input->id])) $deskripsi = $array_hasil_deskripsi[$input->id]; else $deskripsi = '';
		                if(!empty($array_hasil_id[$input->id])) $id = $array_hasil_id[$input->id]; else $id = '';
		                if(!empty($array_hasil_keterangan[$input->id])) $keterangan = $array_hasil_keterangan[$input->id]; else $keterangan = '';

		                $hasil_temp = new \StdClass();
		                $hasil_temp->skor = $skor;
		                $hasil_temp->value = $value;
		                $hasil_temp->deskripsi = $deskripsi;
		                $hasil_temp->id = $id;
		                $hasil_temp->keterangan = $keterangan;
		                $input->hasil = $hasil_temp;
		            }
		        }
	        }
        }

     	return $forms;
    }
}
