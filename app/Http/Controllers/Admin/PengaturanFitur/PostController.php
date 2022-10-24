<?php

namespace App\Http\Controllers\Admin\PengaturanFitur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class PostController extends Controller
{
    public function save(Request $request, $module_name)
    {
        try {
            $data = [];
            if (file_exists(base_path('/settings/medify/' . $module_name . '.json'))) {
                $data_string = file_get_contents(base_path('/settings/medify/' . $module_name . '.json'));
                $data = json_decode($data_string, true);
            }

            if($module_name == 'third-party' && ($request->fitur_key == 'rs_online')){
                $value = $request->const;
                foreach ($value as $key => $content)
                {
                    if($key == 'on') $data[$request->fitur_key] = [$key => $content];
                    else app('App\Http\Controllers\Admin\ThirdParty\RsOnline\PostController')->update(slug($key),$content);
                }
            }else{
                #default;
                $data[$request->fitur_key] = $request->const;
            }

            $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
            if (!file_exists(base_path() . '/settings/medify')) {
                mkdir(base_path('/settings/medify'));
            }

            file_put_contents(base_path('/settings/medify/' . $module_name . '.json'), stripslashes($newJsonString));
            Artisan::call('config:cache');

            sleep(1);

            return response()->json([
                'status' => 1,
                'title' => 'Berhasil',
                'message' => "Pengaturan Fitur berhasil disimpan",
            ]);
        } catch (\Exception $e) {

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            return response()->json([
                'status' => -1,
                'title' => 'Gagal',
                'message' => "Pengaturan Fitur gagal disimpan",
            ]);
        }
    }
}
