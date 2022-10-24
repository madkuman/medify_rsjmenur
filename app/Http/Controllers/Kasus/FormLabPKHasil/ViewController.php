<?php

namespace App\Http\Controllers\Kasus\FormLabPKHasil;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Urikkes\LabPKForm;
use App\Models\Urikkes\LabPKFormHasil;
use App\Models\Kasus\Kasus;

class ViewController extends Controller
{
    public function single($nomor_kasus, $slug, $form_id,$hasil_id)
    {
        $kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
        $form = LabPKForm::with('input')->find($form_id);

        if($form->is_parent == 1){
            $form->input = $form->all_input;
        }
        $hasil = LabPKFormHasil::find($hasil_id);

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

        if($slug == 'all'){
            $data['title_extra'] = 'Form Lain-Lain';
            $data['sidebar_active'] = 'form-all';
        }else{
            $sidebar_active = $kasus->sidebar_tambahan->where('slug', $slug)->first();
            $data['title_extra'] = $sidebar_active->nama;
            $data['sidebar_active'] = $sidebar_active->slug;
        }
        $data['slug'] = $slug;
        $data['hasil'] = $hasil;
        $data['form'] = $form;
        $data['kasus'] = $kasus;
        $data['show_data_as'] = 'show';
        return view('kasus.form-hasil.lab-pk.single',$data);

    }

    public function edit($nomor_kasus, $slug, $form_id,$hasil_id)
    {
        $kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
        $form = LabPKForm::with('input')->find($form_id);
        $hasil = LabPKFormHasil::find($hasil_id);


        if($form->is_parent == 1){
            $form->input = $form->all_input;
        }
        
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
                $input->hasil = $hasil_temp;            }
        }

        if($slug == 'all'){
            $data['title_extra'] = 'Form Lain-Lain';
            $data['sidebar_active'] = 'form-all';
        }else{
            $sidebar_active = $kasus->sidebar_tambahan->where('slug', $slug)->first();
            $data['title_extra'] = $sidebar_active->nama;
            $data['sidebar_active'] = $sidebar_active->slug;
        }


        $data['slug'] = $slug;
        $data['hasil'] = $hasil;
        $data['form'] = $form;
        $data['kasus'] = $kasus;
        $data['show_data_as'] = 'edit';
        return view('kasus.form-hasil.lab-pk.edit',$data);

    }
}
