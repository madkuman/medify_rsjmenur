<?php

namespace App\Http\Controllers\Admin\PengaturanFitur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    protected $form_data;

    #define your module here, prevent akses url yang tidak diperbolehkan
    protected $accept_module_name = ['mutu','pasien','third-party','rawatjalan'];

    public function index(Request $request, $module_name)
    {
        if (!in_array($module_name, $this->accept_module_name)) abort(404);

        $module_name_text = ucfirst(str_replace('-', ' ', $module_name));
        $module_name_function = str_replace('-','',$module_name);
        $form_data = app(\App\Http\Controllers\Admin\PengaturanFitur\DataController::class)->$module_name_function();

        return view('admin.pengaturan-fitur.index', compact('module_name', 'module_name_text', 'form_data'));
    }
}
