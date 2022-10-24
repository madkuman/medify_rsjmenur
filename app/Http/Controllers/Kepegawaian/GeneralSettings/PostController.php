<?php

namespace App\Http\Controllers\Kepegawaian\GeneralSettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class PostController extends Controller
{
    public function submitForm(Request $request)
    {
        try {
            $data = new class{};
            $data->cuti_min_pengajuan_hari = $request->cuti_min_pengajuan_hari;
            $data->cuti_max_pengajuan_hari = $request->cuti_max_pengajuan_hari;

            $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
            if(!file_exists(base_path().'/settings/medify')){
                mkdir(base_path('/settings/medify'));
            }
            file_put_contents(base_path('/settings/medify/kepegawaian.json'), stripslashes($newJsonString));
            Artisan::call('config:cache');
            sleep(5);
            return back()
            ->with('status', 1)
            ->with('title', 'Berhasil!')
            ->with('message', 'Pengaturan Umum Kepegawaian Berhasil Disimpan.'); 
        } catch (Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);         
            return back()
            ->with('status', -1)
            ->with('title', 'Gagal!')
            ->with('message', 'Pengaturan Umum Kepegawaian Gagal Disimpan.');    
        }
    }
}
