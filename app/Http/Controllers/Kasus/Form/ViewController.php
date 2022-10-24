<?php

namespace App\Http\Controllers\Kasus\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Form;
use App\Models\Kasus\FormHasil;
use App\Models\Kasus\Kasus;

class ViewController extends Controller
{
    public function index($nomor_kasus, $slug)
    {
        $kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
        if($slug == 'all'){
            $data['title_extra'] = 'Form Lain-Lain';
            $data['sidebar_active'] = 'form-all';
            $form = Form::all();
            $data['lab'] = [];
        }else{
            $sidebar_active = $kasus->sidebar_tambahan->where('slug', $slug)->first();
            $data['title_extra'] = $sidebar_active->nama;
            $data['sidebar_active'] = $sidebar_active->slug;
            $form = app('App\Http\Controllers\Kasus\Form\ReadController')->getForm($sidebar_active->id);
            $lab = app('App\Http\Controllers\Kasus\Form\ReadController')->getLab($sidebar_active->id);
            $data['lab'] = $lab;
        }
        $data['form'] = $form;
        $data['kasus'] = $kasus;
        return view('kasus.form.index', $data);
    }




    public function single($nomor_kasus,$slug,$id)
    {
        $kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
        $form = Form::find($id);
        $hasil = FormHasil::where('form_id',$id)->where('kasus_id',$kasus->id)->orderBy('created_at','desc')->get();

        if($slug == 'all'){
            $data['title_extra'] = 'Form Lain-Lain';
            $data['sidebar_active'] = 'form-all';
        }else{
            $sidebar_active = $kasus->sidebar_tambahan->where('slug', $slug)->first();
            $data['title_extra'] = $sidebar_active->nama;
            $data['sidebar_active'] = $sidebar_active->slug;
        }

        $data['hasil'] = $hasil;
        $data['form'] = $form;
        $data['kasus'] = $kasus;
        return view('kasus.form.single',$data);
    }

    public function create($nomor_kasus,$slug,$id)
    {
        $kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
        $form = Form::find($id);

        if($slug == 'all'){
            $data['title_extra'] = 'Form Lain-Lain';
            $data['sidebar_active'] = 'form-all';
        }else{
            $sidebar_active = $kasus->sidebar_tambahan->where('slug', $slug)->first();
            $data['title_extra'] = $sidebar_active->nama;
            $data['sidebar_active'] = $sidebar_active->slug;
        }
        $data['slug'] = $slug;
        $data['form'] = $form;
        $data['kasus'] = $kasus;
        $data['show_data_as'] = 'create';
        return view('kasus.form.create',$data);
    }
}
