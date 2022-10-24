<?php

namespace App\Http\Controllers\Kasus\FormLabPK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Urikkes\LabPKForm;
use App\Models\Urikkes\LabPKFormHasil;
use App\Models\Kasus\Kasus;

class ViewController extends Controller
{

    public function single($nomor_kasus,$slug,$id)
    {
        $kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
        $form = LabPKForm::find($id);
        $hasil = LabPKFormHasil::where('form_id',$id)->where('kasus_id',$kasus->id)->orderBy('created_at','desc')->get();

        $sidebar_active = $kasus->sidebar_tambahan->where('slug', $slug)->first();
        $data['title_extra'] = $sidebar_active->nama;
        $data['sidebar_active'] = $sidebar_active->slug;


        $data['hasil'] = $hasil;
        $data['form'] = $form;
        $data['kasus'] = $kasus;
        // dd($data);
        return view('kasus.form.lab-pk.single',$data);
    }

    public function create($nomor_kasus,$slug,$id)
    {
        $kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
        $form = LabPKForm::find($id);

        $sidebar_active = $kasus->sidebar_tambahan->where('slug', $slug)->first();
        $data['title_extra'] = $sidebar_active->nama;
        $data['sidebar_active'] = $sidebar_active->slug;

        if($form->is_parent == 1){
            $form->input = $form->all_input;
        }

        $data['slug'] = $slug;
        $data['form'] = $form;
        $data['kasus'] = $kasus;
        $data['show_data_as'] = 'create';
        return view('kasus.form.lab-pk.create',$data);
    }
}
